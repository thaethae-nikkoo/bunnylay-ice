<?php

namespace App\Http\Controllers;

use App\Contracts\Services\DashboardServiceInterface;
use App\Http\Requests\UpdateOpeningBalanceRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public $dashboardService;

    /**
     * Admin Dashboard
     *
     * @return View
     *
     */
    public function dashboard()
    {
        return view('dashboard');
    }
}
