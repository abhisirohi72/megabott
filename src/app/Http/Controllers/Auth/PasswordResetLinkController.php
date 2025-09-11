<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Services\SettingService;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Auth\Passwords\PasswordBroker;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        $setTitle = 'forgot-password';
        return view('auth.forgot-password', compact('setTitle'));
    }

    /**
     * Handle an incoming password reset link request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );
        // You can manually generate the reset link using the token
        // if ($status == Password::RESET_LINK_SENT) {
        //     $user = User::where('email', $request->email)->first();
        //     $token = app(PasswordBroker::class)->createToken($user); // create a token
        //     $resetLink = route('password.reset', ['token' => $token, 'email' => $request->email]);

        //     // Human-friendly version for WhatsApp
        //     $readableLink = str_replace(urlencode($request->email), $request->email, $resetLink);

        //     // Here you can log the link or pass it along to WhatsApp
        //     $data = $this->whatsapp($request, $readableLink); // assuming you modify the function to accept the link
        // }
        if ($status == Password::RESET_LINK_SENT) {
            $user = User::where('email', $request->email)->first();
            $token = app(PasswordBroker::class)->createToken($user);
            $resetLink = route('password.reset', ['token' => $token, 'email' => $request->email]);
        
            // Decode the whole URL to make it WhatsApp-friendly
            $readableLink = urldecode($resetLink);
        
            $this->whatsapp($request, $readableLink);
        }
        // echo "<pre>";
        // print_r($data);
        // exit;
        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }

    private function whatsapp($request, $resetLink){
        $user = User::where("email", $request->input("email"))->first();
        $setting = SettingService::getSetting();
        $params=array(
            'token' => $setting->whatsapp_token,
            'to' => '8826302951,'.$user->phone,
            'image' => 'https://megabott.com/assets/files/I9AqJJAsFwSFKQ2i.png',
            'caption' => "Hello ".$user->first_name." 👋,  \n\nWelcome to Megabott! 🎉  \nWe're sending a link on your email to forgot password.  \n\nHere is your link \n\n $resetLink \n\n Happy exploring!"
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
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }
}
