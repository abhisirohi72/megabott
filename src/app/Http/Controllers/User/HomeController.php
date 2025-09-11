<?php

namespace App\Http\Controllers\User;

use App\Concerns\CustomValidation;
use App\Enums\User\KycStatus;
use App\Http\Controllers\Controller;
use App\Services\Investment\CommissionService;
use App\Services\Investment\InvestmentService;
use App\Services\Investment\MatrixInvestmentService;
use App\Services\Payment\DepositService;
use App\Services\Payment\TransactionService;
use App\Services\Payment\WithdrawService;
use App\Services\SettingService;
use App\Services\Trade\ActivityLogService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use App\Models\AdminNotification;
use App\Models\LiverageWallet;
use App\Models\TradeLog;        

class HomeController extends Controller
{

    use CustomValidation;

    public function __construct(
        protected TransactionService $transactionService,
        protected CommissionService $commissionService,
        protected DepositService $depositService,
        protected InvestmentService $investmentService,
        protected WithdrawService $withdrawService,
        protected ActivityLogService $activityLogService,
        protected MatrixInvestmentService $matrixInvestmentService,
        protected UserService $userService,
    )
    {

    }
    public function index(): View
    {
        $setTitle = "Dashboard";

        $userId = (int)Auth::id();
        $investmentReport = $this->investmentService->getInvestmentReport($userId);
        [$months, $depositMonthAmount, $withdrawMonthAmount] = $this->depositService->monthlyReport($userId);
        $deposit = $this->depositService->getReport($userId);
        $withdraw = $this->withdrawService->getReport($userId);
        $tradeReport = $this->activityLogService->getTradeReport($userId);
        $transactions = $this->transactionService->latestTransactions(userId: $userId);
        $commissions = $this->commissionService->getCommissionsSum($userId);
        $matrixInvest = $this->matrixInvestmentService->findByUserId($userId);
        $notifications = AdminNotification::inRandomOrder()->first();
        $get_user_liverage = LiverageWallet::where("user_id", Auth::id())->sum("wallet");
        $get_user_today_algo  = TradeLog::where("user_id", Auth::id())
        ->whereBetween("created_at", [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])
        ->where("type", 2)
        ->sum('amount'); 
        $total_algo  = TradeLog::where("user_id", Auth::id())
        // ->whereBetween("created_at", [date("Y-m-d 00:00:00"), date("Y-m-d 23:59:59")])
        ->where("type", 2)
        ->sum('amount'); 
        // echo "<pre>";
        // print_r($notifications);
        // exit;

        return view('user.dashboard', compact(
            'setTitle',
            'transactions',
            'commissions',
            'months',
            'depositMonthAmount',
            'withdrawMonthAmount',
            'investmentReport',
            'tradeReport',
            'deposit',
            'withdraw',
            'matrixInvest',
            'notifications',
            'get_user_liverage',
            'get_user_today_algo',
            'total_algo',
        ));
    }

    public function setting(): View
    {
        $setTitle = "Setting";
        $user = Auth::user();

        return view('user.setting', compact('setTitle', 'user'));
    }

    /**
     * @return View
     */
    public function transactions(): View
    {
        $setTitle = 'Transactions';

        $userId = (int)Auth::id();
        $transactions = $this->transactionService->getTransactions(userId: $userId);

        return view('user.transaction', compact(
            'setTitle',
            'transactions',
        ));
    }



    public function verifyIdentity(): View
    {
        $setTitle = "Verify Identify";
        $kycConfigurations = SettingService::getKycConfiguration();

        return view('user.kyc', compact(
            'setTitle',
            'kycConfigurations'
        ));
    }

    /**
     * @throws ValidationException
     */
    public function storeIdentity(Request $request): RedirectResponse
    {
        $setting = SettingService::getSetting();
        $this->validate($request, $this->parameterValidation($setting->kyc_configuration, true));

        $parameters = Arr::pluck($setting->kyc_configuration, 'field_label');
        foreach ($parameters as &$parameter) {
            $parameter = getInputName($parameter);
        }
        unset($parameter);

        $user = Auth::user();
        $meta = $user->meta ?? [];
        $user->meta = Arr::set($meta, 'identity', $request->only($parameters));
        $user->kyc_status = KycStatus::REQUESTED->value;
        $user->save();

        return to_route('user.dashboard')->with('notify', [['success', "Identity has been submitted successfully"]]);
    }


    public function findUser(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = $this->userService->findByUuid($request->input('uuid'));

        if ($user && $user->uuid == auth()->user()->uuid) {
            return response()->json([
                'status' => true,
                'message' => 'You cannot send money to your own account'
            ]);
        }

        if ($user) {
            return response()->json([
                'status' => false,
                'message' => 'User found successfully'
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'User not found'
            ]);
        }
    }



}
