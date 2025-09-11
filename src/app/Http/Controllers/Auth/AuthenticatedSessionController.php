<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Status;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Services\SettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Actions\CanonicalizeUsername;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        $setTitle = 'Sign In';
        return view('auth.login', compact('setTitle'));
    }


    public function store(LoginRequest $request)
    {
        // echo "bla"; exit;
        $setting = SettingService::getSetting();

        if (getArrayValue($setting->recaptcha_setting, 'login') == Status::ACTIVE->value
            && RecaptchaV3::verify($request->input('g-recaptcha-response')) <= 0.3) {
            return back()->with('notify', [['error', 'Captcha verification failed']]);
        }

        return $this->loginPipeline($request)->then(function ($request) {
            $data= $this->whatsapp($request);
            // echo "<pre>";
            // print_r($data);
            // exit;
            return  redirect()->intended(RouteServiceProvider::HOME);
        });
    }

    private function whatsapp($request){
        $user = User::where("email", $request->input("email"))->first();
        $setting = SettingService::getSetting();
        $params=array(
            'token' => $setting->whatsapp_token,
            'to' => $user->phone,
            'image' => 'https://megabott.com/assets/files/I9AqJJAsFwSFKQ2i.png',
            'caption' => "Hello ".$user->first_name." 👋,  \n\nWelcome to Megabott! 🎉  \nWe're excited to have you on board. If you have any questions, feel free to ask.  \n\nHappy exploring!"
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

    /**
     * Get the authentication pipeline instance.
     *
     * @param LoginRequest $request
     * @return Pipeline
     */
    protected function loginPipeline(LoginRequest $request): Pipeline
    {
        if (Fortify::$authenticateThroughCallback) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                call_user_func(Fortify::$authenticateThroughCallback, $request)
            ));
        }

        if (is_array(config('fortify.pipelines.login'))) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                config('fortify.pipelines.login')
            ));
        }

        return (new Pipeline(app()))->send($request)->through(array_filter([
            config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
            config('fortify.lowercase_usernames') ? CanonicalizeUsername::class : null,
            Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        if ($request->hasSession()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return redirect('/');
    }


}
