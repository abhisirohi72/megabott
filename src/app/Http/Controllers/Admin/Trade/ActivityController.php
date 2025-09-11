<?php

namespace App\Http\Controllers\Admin\Trade;

use App\Enums\Trade\TradeType;
use App\Http\Controllers\Controller;
use App\Services\Trade\ActivityLogService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\Payment\WalletService;
use App\Services\SettingService;
use App\Services\Trade\CryptoCurrencyService;
use App\Services\Trade\ParameterService;
use App\Services\UserService;
use App\Services\Api\CoinGeckoService;
use App\Models\TradeDetails;
use App\Models\CryptoDetail;
use App\Models\User;
use App\Models\Transaction;
use App\Models\TradeLog;
use App\Models\LiverageWallet;
use Illuminate\Support\Facades\DB;


class ActivityController extends Controller
{
    public function __construct(
        protected WalletService $walletService,
        protected UserService $userService,
        protected ActivityLogService $activityLogService,
        protected CryptoCurrencyService $cryptoCurrencyService,
        protected ParameterService $parameterService,
        protected CoinGeckoService $coinGeckoService,
    ) {}
    const TRADE_INDEX_PAGE = 'admin.trade.index';

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        $setTitle = __('admin.trade_activity.page_title.index');
        $trades = $this->activityLogService->getByPaginate(tradeType: TradeType::TRADE, with: ['user', 'cryptoCurrency']);

        return view(self::TRADE_INDEX_PAGE, compact('setTitle', 'trades'));
    }

    /**
     * @param Request $request
     * @return View
     */
    public function practice(Request $request): View
    {
        $setTitle = "Practice trade logs";
        $trades = $this->activityLogService->getByPaginate(tradeType: TradeType::PRACTICE, with: ['user', 'cryptoCurrency']);

        return view(self::TRADE_INDEX_PAGE, compact('setTitle', 'trades'));
    }

    public function abhiTradeLogs(Request $request)
    {
        return view("admin.trade.abhi_trade");
    }

    public function startLog(Request $request)
    {
        $tradeReport = $this->activityLogService->getTradeReport($userId); //trade->total
        $crypto = $this->cryptoCurrencyService->findById((int)$request->type);
        $original_price = $this->coinGeckoService->getCoinRate($crypto);
    }

    public function createLogs(Request $request)
    {
        $details = TradeDetails::all();
        return view("admin.trade.abhi_form", compact('details'));
    }

    public function addTradeLogs(Request $request)
    {
        $request->validate([
            'min_balance'   => 'required',
            'max_balance'   => 'required',
            'inc_limit'     => 'required',
            'min_return'    => 'required',
            'max_return'    => 'required',
        ]);

        $insert = TradeDetails::create([
            "min_balance"   =>  $request->min_balance,
            "max_balance"   =>  $request->max_balance,
            "inc_limit"     =>  $request->inc_limit,
            "min_return"    =>  $request->min_return,
            "max_return"    =>  $request->max_return
        ]);

        if ($insert) {
            return back()->with('notify', 'Successfull Inserted!!!');
        } else {
            return back()->with('notify', 'There is some issue on inserted!!!');
        }
    }

    public function cryptoSave(Request $request)
    {
        $request->validate([
            "data"  =>  "required"
        ]);

        $data = $request->data;

        $crypto = $this->cryptoCurrencyService->findByPair($data);
        $crypto = $this->cryptoCurrencyService->findById((int)$crypto->id);

        $original_price = $this->coinGeckoService->getCoinRate($crypto);
        // echo "<pre>";
        // print_r($original_price);

        $insert = CryptoDetail::create([
            "name"              =>  $request->data,
            "original_value"    =>  $original_price
        ]);

        if ($insert) {
            echo 1;
        }
    }

    public function stopCryptoSave(Request $request)
    {
        try {
            $request->validate([
                "data"  =>  "required"
            ]);

            $data = $request->data;

            $crypto = $this->cryptoCurrencyService->findByPair($data);
            $crypto_id = $crypto->id;
            $crypto = $this->cryptoCurrencyService->findById((int)$crypto->id);

            $original_price = $this->coinGeckoService->getCoinRate($crypto);

            $details = CryptoDetail::where("name", $request->data)
                ->where(function ($query) {
                    $query->whereNull("future_price")
                        ->orWhere("future_price", "");
                })
                ->orderBy("id", "desc")
                ->limit(1)
                ->first();  // Ensure we fetch the result

            $update = CryptoDetail::where("name", $request->data)
                ->where(function ($query) {
                    $query->whereNull("future_price")
                        ->orWhere("future_price", "");
                })
                ->orderBy("id", "desc")
                ->limit(1)
                ->update([
                    "future_price" => $original_price
                ]);
            // $update=1;

            if ($update) {
                $all_users = User::with("wallet")->where("algo_status", '1')->get();
                // echo "<pre>";
                // print_r($all_users);
                // exit;
                foreach ($all_users as $key => $value) {
                    // error_reporting(E_ALL);
                    // ini_set('display_errors', '1');
                    $get_trade_inc = $this->activityLogService->getTradeReport($value->id);
                    $tradeAmnt = shortAmount($get_trade_inc->total);
                    //check total algo
                    $get_user_algo  = TradeLog::where('user_id', $value->id)->where("type", 2)->sum('amount');

                    //get leverage amount
                    $get_user_liverage=0;
                    if($get_user_algo < 15){
                        $get_user_liverage = LiverageWallet::where("user_id", $value['id'])->sum("wallet");
                    }
                    // echo "trade=" . $value?->wallet->primary_balance. "<br>";
                    $tradeAmnt = shortAmount($tradeAmnt + $get_user_liverage + $value?->wallet->trade_balance + $value?->wallet->primary_balance);
                    // echo "trade=".$tradeAmnt;
                    // exit;
                    // echo "<br>";
                    if ($tradeAmnt > 0) {
                        $slabsQuery = TradeDetails::where('min_balance', '<=', $tradeAmnt)
                            ->orderBy('id', 'desc')
                            ->first();
                        // DB::enableQueryLog();
                        $count_trade_log = TradeLog::where("user_id", $value['id'])
                            ->whereBetween("created_at", [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])
                            ->where("type", 2)
                            ->count();
                        // dd(DB::getQueryLog());

                        if (!empty($slabsQuery) && ($slabsQuery->inc_limit > $count_trade_log)) {
                            // echo "enter"; exit;
                            $send_value = number_format($slabsQuery['min_return'] + mt_rand() / mt_getrandmax() * ($slabsQuery['max_return'] - $slabsQuery['min_return']), 2, '.', '');
                            $old_inc = str_replace(",", "", $tradeAmnt);
                            $sendVal = number_format((($tradeAmnt / 100) * $send_value) / 45, 2, '.', '');
                            // $new_income = number_format(($old_inc + $sendVal), 2, '.', '');

                            $insert = TradeLog::create([
                                "user_id"               =>  $value['id'],
                                "crypto_currency_id"    =>  (int)$crypto->id,
                                "original_price"        =>  $details->original_value ?? 0,  // Avoid null reference
                                "amount"                =>  $sendVal,
                                "duration"              =>  3600,
                                "arrival_time"          =>  now(),
                                "type"                  =>  2,
                                "volume"                =>  1,
                                "outcome"               =>  2,
                                "status"                =>  2,
                                "meta"                  =>  ["result_price" => $original_price],
                                "created_at"            =>  now(),
                                "updated_at"            =>  now()
                            ]);

                            $insert_in_transaction = Transaction::create([
                                "user_id" => $value['id'],
                                "amount" => $details->original_value,
                                "post_balance" => $sendVal,
                                "charge"    =>  "0.00",
                                "type"  =>  "1",
                                "wallet_type"   =>  "1",
                                "source"    =>  "1",
                                "details"    =>  "Added Trade Log $".$sendVal,
                            ]);
                        }
                    }
                }
                echo 1;
            }
        } catch (\Exception $e) {
            echo "Error on line " . $e->getLine() . ": " . $e->getMessage();
        }
    }

    public function abhiCron(Request $request)
    {
        echo $start_date = date("Y-m-d 00:00:00", strtotime("-1 day"));
        echo "<br>" . $end_date   = date("Y-m-d 23:59:59", strtotime("-1 day"));

        $details = TradeLog::whereBetween("arrival_time", [$start_date, $end_date])->get();
        // echo "<pre>";
        // print_r($details);
        // exit;
        foreach ($details as $key => $value) {
            $user_id = $value->user_id;
            $amnt = $value->amount;

            $user = User::where("id", $user_id)->first();
            $setting = SettingService::getSetting();
            $params = array(
                'token' => $setting->whatsapp_token,
                'to' => $user->phone,
                'image' => 'https://megabott.com/assets/files/I9AqJJAsFwSFKQ2i.png',
                'caption' => "Hello " . $user->first_name . " 👋,  \n\nWelcome to Megabott! 🎉  \nYour yesterday income is " . $amnt . " \n  If you have any questions, feel free to ask.  \n\nHappy exploring!"
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => $setting->whatsapp_api_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                // echo "cURL Error #:" . $err;
            } else {
                // echo $response;
            }
        }
    }
}
