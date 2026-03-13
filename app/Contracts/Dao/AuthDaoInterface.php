<?php

namespace App\Contracts\Dao;

interface AuthDaoInterface
{
    public function updateProfile(array $profileData);
    public function updatePassword(array $passData, string $hashedPass);
    public function resetWithUsername(string $username);
}
