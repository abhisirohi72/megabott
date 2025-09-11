<?php

namespace App\Http\Controllers\User;

use App\Enums\Trade\TradeType;
use App\Enums\Transaction\Type;
use App\Enums\Transaction\WalletType;
use App\Http\Controllers\Controller;
use App\Http\Requests\TradeRequest;
use App\Services\Payment\WalletService;
use App\Services\SettingService;
use App\Services\Trade\ActivityLogService;
use App\Services\Trade\CryptoCurrencyService;
use App\Services\Trade\ParameterService;
use App\Services\UserService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\TradeLog;

class TradeController extends Controller
{
    public function __construct(
        protected WalletService $walletService,
        protected UserService $userService,
        protected ActivityLogService $activityLogService,
        protected CryptoCurrencyService $cryptoCurrencyService,
        protected ParameterService $parameterService,
    ){
    }

    public function index(): View
    {
        $setting = SettingService::getSetting();
        if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::TRADE_PREDICTION->name)) == 0){
            abort(404);
        }

        $setTitle = "Trades";
        $cryptoCurrency = $this->cryptoCurrencyService->getActiveCryptoCurrencyByPaginate();
        $get_user_today_algo  = TradeLog::where("user_id", Auth::id())
        ->whereBetween("created_at", [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])
        ->where("type", 2)
        ->sum('amount'); 
        $total_algo  = TradeLog::where("user_id", Auth::id())
        // ->whereBetween("created_at", [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])
        ->where("type", 2)
        ->sum('amount'); 

        return view('user.trade.index', compact(
           'setTitle',
            'cryptoCurrency',
            'get_user_today_algo',
            'total_algo',
        ));
    }

    public function tradeLog(): View
    {
        $setting = SettingService::getSetting();
        if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::TRADE_PREDICTION->name)) == 0){
            abort(404);
        }

        $setTitle = "Trade logs";
        $userId = (int)Auth::id();
        [$days, $amount] = $this->activityLogService->dayReport($userId);
        $trade = $this->activityLogService->getTradeReport($userId);
        // DB::enableQueryLog();
        $tradeLogs = $this->activityLogService->getByUser($userId, TradeType::TRADE, "", "2");
        // dd(DB::getQueryLog());

        return view('user.trade.trade_log', compact(
            'setTitle',
            'tradeLogs',
            'trade',
            'days',
            'amount',
        ));
    }

    public function practiceLog(): View
    {
        $setting = SettingService::getSetting();
        if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::TRADE_PREDICTION->name)) == 0){
            abort(404);
        }

        $setTitle = "Practice logs";
        $userId = Auth::id();
        $practiceLogs = $this->activityLogService->getByUser($userId, TradeType::PRACTICE);

        return view('user.trade.practice_log', compact(
            'setTitle',
            'practiceLogs',
        ));
    }

   /**
     * @param string $pair
     * @return View
     */
    public function trade(string $pair): View
    {   
        $setting = SettingService::getSetting();
        if (getArrayValue($setting->system_configuration, 'binary_trade.value') != \App\Enums\Status::ACTIVE->value) {
            abort(404);
        }

        if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::TRADE_PREDICTION->name)) == 0){
            abort(404);
        }

        $setTitle = "Trade now";
        $userId = (int)Auth::id();
        $crypto = $this->cryptoCurrencyService->findByPair($pair);
        $parameters = $this->parameterService->activeParameter();
        // DB::enableQueryLog();
        $tradeLogs = $this->activityLogService->getByUser($userId, TradeType::TRADE, false, "2");
        // dd(DB::getQueryLog());
        // echo "<pre>";
        // print_r($tradeLogs);
        // exit;
        $user_details= User::where("id", $userId)->first();
        return view('user.trade.trading', compact(
            'setTitle',
            'crypto',
            'parameters',
            'tradeLogs',
            'user_details'
        ));
    }

    public function updateSwitchStatus(Request $request){
        $status = $request->status;
        $userId = (int)Auth::id();
        $update = User::where("id", $userId)->update([
            "algo_status"   =>  $status
        ]);

        if ($update) {
            echo 1;
        }
    }

    /**
     * @param string $pair
     * @return View
     */
    public function practice(string $pair): View
    {
        $setting = SettingService::getSetting();
        if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::TRADE_PREDICTION->name)) == 0){
            abort(404);
        }

        if (getArrayValue($setting->system_configuration, 'practice_trade.value') != \App\Enums\Status::ACTIVE->value) {
            abort(404);
        }

        $setTitle = "Practice now";
        $userId = (int)Auth::id();
        $crypto = $this->cryptoCurrencyService->findByPair($pair);
        $parameters = $this->parameterService->activeParameter();
        $tradeLogs = $this->activityLogService->getByUser($userId, TradeType::PRACTICE, true);

        return view('user.trade.trading', compact(
            'setTitle',
            'crypto',
            'parameters',
            'tradeLogs',
        ));
    }

    /**
     * @throws Exception
     */
    public function store(TradeRequest $request, $id)
    {
        // echo "enter";
        $setting = SettingService::getSetting();
        if(getArrayValue($setting->investment_setting, getInputName(\App\Enums\InvestmentType::TRADE_PREDICTION->name)) == 0){
            abort(404);
        }

        try {
            
            $parameter = $this->parameterService->findById($request->integer('parameter_id'));
            $crypto = $this->cryptoCurrencyService->findById((int)$id);
            // echo "<pre>";
            // print_r($crypto);
            // exit;
            if(!$parameter || !$crypto){
                abort(404);
            }

            $walletType = $request->integer('type') == TradeType::TRADE->value ? WalletType::TRADE->value : WalletType::PRACTICE->value;

            [$wallet, $account] = $this->walletService->checkWalletBalance($request->input('amount'), $walletType, true);
            // echo "<pre>";
            // print_r($crypto);
            // exit;
            $this->activityLogService->executeTrade($request, $wallet, $account, Type::MINUS, $parameter, $crypto);
            // exit("abhishek");
            $notify[] = ['success', "Trade has been generated"];
            return back()->withNotify($notify);

        }catch (Exception $exception){

            $notify[] = ['warning', $exception->getMessage()];
            return back()->withNotify($notify);
        }
    }
}
