<?php

namespace App\Dao;

use App\Contracts\Dao\AuthDaoInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthDao implements AuthDaoInterface
{
    /**
     * Profile Updat
     *
     * @param array $data
     *
     * @return void
     */
    public function updateProfile(array $data)
    {
        DB::transaction(function () use ($data) {
            Admin::where('admin_id', Auth::user()->admin_id)->update($data);
        });
    }

    /**
     * Password Update after Authenticating
     *
     * @param array $passData
     * @param stirng $hashedPass
     *
     * @return void
     */
    public function updatePassword(array $passData, string $hashedPass)
    {
        DB::transaction(function () use ($passData, $hashedPass) {
            if (Auth::check()) {
                Admin::where('admin_id', Auth::user()->admin_id)->update([
                    'password' => $hashedPass
                ]);
                Auth::logout();
            } else {
                Admin::where('username', $passData['username'])->update([
                    'password' => $hashedPass
                ]);
            }
        });
    }

    /**
     * Reset with userId
     *
     * @param string $username
     *
     * @return void
     */
    public function resetWithUsername(string $username)
    {
        return   Admin::where('username', $username)->select("username")->first();
    }
}
