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
//        Logoutを除いては認証が必要ありません。
        $this->middleware('guest')->except('logout');
        $this->userService = $userService;
    }

//    Login Form
    public function index()
    {
        return view('users.login');
    }


    public function login(LoginRequest $request)                    // Form RequestでValidation検査
    {
        $request->validated();
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->intended(route('diary.index'));
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
