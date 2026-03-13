<?php

namespace App\Http\Controllers;

use App\Contracts\Services\AuthServiceInterface;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\PasswordUpdateRequest;
use App\Http\Requests\Auth\ProfileRequest;
use App\Http\Requests\UsernameRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Login form page
     *
     * @return  view
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    /**
     * Forget Password Page
     *
     * @return view
     */
    public function forgetPass()
    {
        return view('auth.forget_password');
    }

    /**
     * Password Update page if user forget password
     *
     * @return RedirectResponse
     */
    public function forgetPassPage(UsernameRequest $request)
    {
        $data = $request->validated();
        $correctAccess = $this->authService->resetWithUsername($data['username']);
        if (isset($correctAccess)) {
            $userCredential = $correctAccess->toArray();
            return redirect()->route('passwordUpdatePage')
                ->with('userCredential', $userCredential);
        } else {
            return redirect()->back()->with('error', __('messages.login_fail'));
        }
    }

    /**
     * Password Update function
     *
     * @return view
     */
    public function passUpdatePage()
    {
        return view('auth.password_update');
    }

    /**
     * Register function
     *
     * @param LoginRequest $req
     * @return RedirectResponse
     */
    public function login(LoginRequest $req)
    {
        $credentials = $req->validated();
        $result = $this->authService->login($credentials);
        if ($result) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->back()->with('error', __('messages.login_fail'));
        }
    }

    /**
     * Profile
     * @return view
     */
    public function profile()
    {
        return view('auth.profile.profile');
    }

    /**
     * Profile Update
     *
     * @param ProfileRequest $request
     * @return RedirectResponse
     */
    public function updateProfile(ProfileRequest $request)
    {
        $data = $request->validated();
        $this->authService->updateProfile($data);
        return redirect()->route('profile')->with("success", __('messages.update_success'));
    }

    /**
     * Profile
     * @return View
     */
    public function psmanage()
    {
        return view('auth.profile.passwordEdit');
    }

    /**
     * Password Update
     *
     * @param PasswordUpdateRequest $request
     * @return View
     */
    public function updatePassword(PasswordUpdateRequest $request)
    {
        $passData = $request->validated();
        $this->authService->updatePassword($passData);
        return redirect()->route('loginForm');
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('loginForm');
    }
}
