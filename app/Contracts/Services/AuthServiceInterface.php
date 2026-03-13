<?php

namespace App\Contracts\Services;

interface AuthServiceInterface
{
    public function login(array $credentials);
    public function logout();
    public function updateProfile(array $profileData);
    public function updatePassword(array $passData);
    public function resetWithUsername(string $username);
}
