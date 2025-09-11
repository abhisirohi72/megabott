<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisteredRequest;
use App\Jobs\SendEmailVerificationJob;
use App\Models\Agent;
use App\Models\User;
use App\Notifications\UserRegisteredNotification;
use App\Providers\RouteServiceProvider;
use App\Services\Payment\WalletService;
use App\Services\SettingService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\LiverageWallet;

class RegisteredUserController extends Controller
{
    public function __construct(
        protected WalletService $walletService,
        protected UserService $userService,
    )
    {

    }
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        $setTitle = 'Register';
        $reference = $request->query('reference');
        session()->put("reference_uuid", $reference);
        $referral = $this->userService->getReferral();

        if(!$referral){
            $referral =  $this->getAgentReferral();
        }

        $setting = SettingService::getSetting();
        if (getArrayValue($setting?->system_configuration, 'registration_status.value') != Status::ACTIVE->value) {
            abort(404);
        }

        return view('auth.register', compact('referral', 'setTitle'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(RegisteredRequest $request)
    {
        $setting = SettingService::getSetting();

        if (getArrayValue($setting?->system_configuration, 'registration_status.value') != Status::ACTIVE->value) {
            abort(404);
        }

        if (getArrayValue($setting?->recaptcha_setting, 'registration') == Status::ACTIVE->value
            && RecaptchaV3::verify($request->input('g-recaptcha-response')) <= 0.3) {
            return back()->with('notify', [['error', 'Captcha verification failed']]);
        }

        $referral = $this->userService->getReferral();
        $agentReferral = null;
        if(!$referral){
            $agentReferral =  $this->getAgentReferral();
        }

        $user = User::create([
            'uuid' => Str::uuid(),
            'first_name' => $request->input('name'),
            'email' => $request->input('email'),
            'referral_by' => $referral?->id,
            'agent_id' => $agentReferral?->id,
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'algo_status'=>'1',
        ]);
        LiverageWallet::create([
            "user_id"       => $user->id,
            "liverage_id"   => 0,
            "wallet"        => "100.00"
        ]);
        if (getArrayValue($setting->system_configuration, 'email_verification.value') == Status::ACTIVE->value){
            SendEmailVerificationJob::dispatchSync($user);
        }else{
            $user->email_verified_at = now();
            $user->save();
        }
        
        $this->walletService->save($this->walletService->prepParams((int) $user->id));
        $user->notify(new UserRegisteredNotification());

        Auth::login($user);
        try {
            $name= $request->input('name');
            $email = $request->input('email'); // Replace with the recipient's email
            $messageContent = $name."\n".$email. '\nThanks for subscribing to us!';
    
            // Mail::to($email)->send(new SubscriberMail($messageContent));megabottai
            $mail = Mail::to($email)->send(new RegisterMail($messageContent));

            $msg = "Subject: Vendor Registration Successful – Megabott \n\nDear ".$name.",\nGreetings from Megabott!\nWe are pleased to inform you that your vendor registration has been successfully completed. You can now log in using the credentials below:\n\nLogin ID: ".$email."\n\nPassword: ".$request->input('password')."\n\nFor any assistance, feel free to reach out.\n\nThanks & Regards,\nMegabott Team";
            $params = array(
                'token' => $setting->whatsapp_token,
                // 'to' => '+918826302951',
                'to' => '+91'. $request->phone,
                "image"=>"https://megabott.com/assets/files/I9AqJJAsFwSFKQ2i.png",
                'caption' => $msg
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
            // echo "<pre>";
            // print_r($response);
            // exit;
            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                // echo "balbla";
                // echo $response;
            }

            Log::info("Mail sent successfully to {$email}");
            return redirect(RouteServiceProvider::HOME);
        } catch (\Exception $e) {
            Log::error("Failed to send mail to {$email}: " . $e->getMessage());
            Log::error("Mail Error: " . $e->getMessage());
            Log::error("Trace: " . $e->getTraceAsString());
            echo $e->getMessage();
            echo "<br>".$e->getTraceAsString();
            return response(['error' => 'Failed to send email'], 500);
        }
        // exit("abhishek");
        return redirect(RouteServiceProvider::HOME);
    }


    public function getAgentReferral(): ?Agent
    {
        $referral = null;

        if (session()->get('reference_uuid')) {
            $referral = Agent::where('uuid', session()->get('reference_uuid'))->first();
        }

        return $referral;
    }
}
