<?php

namespace App\Services;

use App\Contracts\Dao\AuthDaoInterface;
use App\Contracts\Services\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    private $authDao;

    public function __construct(AuthDaoInterface $authDao)
    {
        $this->authDao = $authDao;
    }
    
    /**
     * Login
     * @param  array $credentials
     * @return bool
     */
    public function login(array $credentials)
    {
        if (Auth::attempt($credentials)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Logout
     * @return void
     */
    public function logout()
    {
        Auth::logout();
    }

    /**
     * Profile Update
     *
     * @param array $data
     *
     * @return authDao
     */
    public function updateProfile(array $profileData)
    {
         if (Auth::check()) {
            return $this->authDao->updateProfile($profileData);
        } else {
            abort(403);
        }
    }

    /**
     * Password Update After Authenticating
     *
     * @param array $passData
     *
     * @return authDao
     */
    public function updatePassword(array $passData)
    {
        $hashedPass = Hash::make($passData['confirmPassword']);
        return $this->authDao->updatePassword($passData, $hashedPass);
    }

    /**
     * Reset with UserId
     *
     * @param string $userId
     *
     * @return authDao
     */
    public function resetWithUsername(string $username)
    {
        return $this->authDao->resetWithUsername($username);
    }
}
