<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\AdminNotification;
use App\Models\User;
use App\Models\UserLogin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    use RegistersUsers;

    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('registration.status')->except('registrationNotAllowed');
        $this->activeTemplate = activeTemplate();
    }

    public function showRegistrationForm()
    {
        $pageTitle = "Register";
        $info = json_decode(json_encode(getIpInfo()), true);
        $mobileCode = @implode(',', $info['code']);
        $countries = json_decode(file_get_contents(resource_path('views/includes/country.json')));
        return view($this->activeTemplate . 'user.auth.register', compact('pageTitle','mobileCode','countries'));
    }

    protected function validator(array $data)
    {
        $general = gs();
        $passwordValidation = Password::min(6);
        if ($general->secure_password) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }
        $agree = 'nullable';
        if ($general->agree) {
            $agree = 'required';
        }
        $countryData = (array)json_decode(file_get_contents(resource_path('views/includes/country.json')));
        $countryCodes = implode(',', array_keys($countryData));
        $mobileCodes = implode(',',array_column($countryData, 'dial_code'));
        $countries = implode(',',array_column($countryData, 'country'));
        $validate = Validator::make($data, [
            'email' => 'required|string|email|unique:users',
            'mobile' => 'required|regex:/^([0-9]*)$/',
            'password' => ['required', 'confirmed', $passwordValidation],
            'username' => 'required|unique:users|min:6',
            'captcha' => 'sometimes|required',
            'mobile_code' => 'required|in:' . $mobileCodes,
            'country_code' => 'required|in:' . $countryCodes,
            'country' => 'required|in:' . $countries,
            'agree' => $agree,
        ]);
        return $validate;
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $request->session()->regenerateToken();

        if (preg_match("/[^a-z0-9_]/", trim($request->username))) {
            $notify[] = ['info', 'Le nom d\'utilisateur ne peut contenir que des lettres minuscules, des chiffres et un trait de soulignement..'];
            $notify[] = ['error', 'Aucun caractère spécial, espace ou majuscule dans le nom d\'utilisateur.'];
            return back()->withNotify($notify)->withInput($request->all());
        }

        if (!verifyCaptcha()) {
            $notify[] = ['error', 'Invalid captcha provided'];
            return back()->withNotify($notify);
        }

        $exist = User::where('mobile', $request->mobile_code . $request->mobile)->first();
        if ($exist) {
            $notify[] = ['error', 'The mobile number already exists'];
            return back()->withNotify($notify)->withInput();
        }

        $user = $this->create($request->all());

        // Trigger webhook to CodeIgniter
        $this->trigger_codeigniter_webhook($request->all());
        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    // Function to send the webhook
    protected function trigger_codeigniter_webhook(array $data)
    {
        // Prepare the data to send to CodeIgniter
        $ciData = [
            'first_name' => $data['username'],
            'last_name' => '', 
            'email' => $data['email'],
            'password' => $data['password'],
            'status' => 1, 
            'role_id' => 2,
            'date_added' => strtotime(date("Y-m-d H:i:s")),
            'verification_code' => rand(100000, 200000),
        ];

        // Send the data via a webhook to CodeIgniter
        $url = "http://localhost:8080/login/register";
        $client = new Client();
        $response = $client->post($url, [
            'form_params' => $ciData,
        ]);

        if ($response->getStatusCode() == 200) {
        } else {
        }
    }

    protected function create(array $data): \App\Models\User
    {
        $general = gs();

        $referBy = session()->get('reference');
        if ($referBy) {
            $referUser = User::where('username', $referBy)->first();
        } else {
            $referUser = null;
        }

        //User Create
        $user = new User();
        $user->email = strtolower(trim($data['email']));
        $user->password = Hash::make($data['password']);
        $user->username = trim($data['username']);
        $user->ref_by = $referUser ? $referUser->id : 0;
        $user->country_code = $data['country_code'];
        $user->mobile = $data['mobile_code'] . $data['mobile'];
        $user->address = [
            'address' => '',
            'state' => '',
            'zip' => '',
            'country' => isset($data['country']) ? $data['country'] : null,
            'city' => ''
        ];
        $user->status = 1;
        $user->reg_step = 1;
        $user->kv = $general->kv ? 0 : 1;
        $user->ev = 1; // email vérifié par défaut
        $user->sv = 1; // mobile vérifié par défaut
        $user->ts = 0;
        $user->tv = 1;
        $user->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New member registered';
        $adminNotification->click_url = urlPath('admin.users.detail', $user->id);
        $adminNotification->save();

        //Login Log Create
        $ip = getRealIP();
        $exist = UserLogin::where('user_ip', $ip)->first();
        $userLogin = new UserLogin();

        //Check exist or not
        if ($exist) {
            $userLogin->longitude = $exist->longitude;
            $userLogin->latitude = $exist->latitude;
            $userLogin->city = $exist->city;
            $userLogin->country_code = $exist->country_code;
            $userLogin->country = $exist->country;
        } else {
            $info = json_decode(json_encode(getIpInfo()), true);
            $userLogin->longitude = @implode(',', $info['long']);
            $userLogin->latitude = @implode(',', $info['lat']);
            $userLogin->city = @implode(',', $info['city']);
            $userLogin->country_code = @implode(',', $info['code']);
            $userLogin->country = @implode(',', $info['country']);
        }

        $userAgent = osBrowser();
        $userLogin->user_id = $user->id;
        $userLogin->user_ip = $ip;

        $userLogin->browser = @$userAgent['browser'];
        $userLogin->os = @$userAgent['os_platform'];
        $userLogin->save();

        return $user;
    }

    public function checkUser(Request $request)
    {
        $exist['data'] = false;
        $exist['type'] = null;
        if ($request->email) {
            $exist['data'] = User::where('email', $request->email)->exists();
            $exist['type'] = 'email';
        }
        if ($request->mobile) {
            $exist['data'] = User::where('mobile', $request->mobile)->exists();
            $exist['type'] = 'mobile';
        }
        if ($request->username) {
            $exist['data'] = User::where('username', $request->username)->exists();
            $exist['type'] = 'username';
        }
        return response($exist);
    }

    public function registered(Request $request, $user)
    {
        // Redirect to user home directly after registration
        return redirect()->route('user.home');
    }
}
