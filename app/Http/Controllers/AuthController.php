<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Frontend\FrontController;
use App\Mail\VerificationMail;
use App\Models\User;
use App\Notifications\NotifyAdmin;
use App\Notifications\VerifyEmail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Nexmo\Laravel\Facade\Nexmo;

class AuthController extends Controller
{

    public function showRegisterForm()
    {
        $data = FrontController::returnData();
        return view('authentication.registration', $data);
    }
    public function processRegister(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'phone_number' => 'required|unique:users,phone_number',
                'password' => 'required|min:6|confirmed',
            ],
            [
                'name.required' => 'We need to know your name',
                'password.confirmed' => 'Password not matched'
            ]
        );

        $data = [
            'name' => trim($request->name),
            'email' => strtolower(trim($request->email)),
            'phone_number' => trim($request->phone_number),
            'password' => bcrypt($request->password),
            'email_verification_token' => str::random(32),
        ];
        try {
            $user = User::create($data);
            // echo $user->email;
            // exit;

            //Mail::to($user->email)->queue(new VerificationMail($user));
            $user->notify(new VerifyEmail($user));


            //alternatr method for sending sms notification

            // Nexmo::message()->send([
            //     'to'   => $request->phone_number,
            //     'from' => '16105552344',
            //     'text' => 'Dear, ' . $request->name . ', Your account has been successfully created'
            // ]);
            // Mail::to($user->email)->send(new VerificationMail($user));


            //**send notification to admin if a user register
            $admin = User::find(1);
            $admin->notify(new NotifyAdmin($user));
            //**


            session()->flash('message', 'User Created');
            session()->flash('type', 'danger');

            return redirect()->route('login');
        } catch (Exception $e) {
            session()->flash('message', $e->getMessage());
            session()->flash('type', 'danger');

            return redirect()->back();
        }
    }

    public function showLoginForm()
    {
        $data = FrontController::returnData();
        return view('authentication.login', $data);
    }
    public function processLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'password' => 'required|min:6',
            ]
        );
        $credentials = $request->except('_token');

        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $user->last_login = Carbon::now();
            $user->save();

            if ($user->email_verified === 0) {
                session()->flash('message', 'Your account is not verified yet');
                session()->flash('type', 'danger');
                auth()->logout();

                return redirect()->route('login');
            }


            return redirect()->route('profile');
        }


        session()->flash('message', 'Invalid Credentials');
        session()->flash('type', 'danger');

        return redirect()->back();
    }
    public function showProfile()
    {
        $data = FrontController::returnData();
        //$data['user'] = auth()->user();
        // $user = User::find(1);

        if (auth()->user()->id == 1) {
            $data['user'] = User::find(1);
        }
        // print_r(auth()->user()->id);
        // exit;

        return view('backend.dashboard', $data);
    }
    public function logout()
    {
        auth()->logout();
        session()->flash('message', 'You have been logged out');
        session()->flash('type', 'danger');

        return redirect()->route('login');
    }
    public function verifyEmail($token)
    {
        if ($token === null) {
            session()->flash('message', 'Invalid token');
            session()->flash('type', 'danger');

            return redirect()->route('login');
        }
        $user = User::where('email_verification_token', $token)->first();
        if ($user === null) {
            session()->flash('message', 'Invalid token');
            session()->flash('type', 'danger');

            return redirect()->route('login');
        }
        $user->update([
            'email_verified' => 1,
            'email_verified_at' => Carbon::now(),
            'email_verification_token' => ''
        ]);
        session()->flash('message', 'Your account is activated');
        session()->flash('type', 'success');

        return redirect()->route('login');
    }
}