<?php

namespace App\Http\Controllers;

use App\Domain\Services\UserService;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    private $userService;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct(UserService $userService)
    {
        $this->middleware('guest')->except('logout');
        $this->userService = $userService;
    }

    public function index()
    {
        return view('users.login');
    }


    public function login(LoginRequest $request)
    {
        Log::info('login method');
        $request->validated();

        $credentials = $request->only('email', 'password');

        Log::info('login method processing');

        if (auth()->attempt($credentials)) {
            Log::info('login attempt');
            return redirect()->intended('/dashboard');
        }
        Log::info('erorrs occurs');
        return back()->withErrors([
            'email_error' => 'Email 혹은 Password가 일치하지 않습니다.',
        ])->withInput();


    }

    public function logout()
    {
        auth()->logout();
        return redirect('/auth');
    }
}
