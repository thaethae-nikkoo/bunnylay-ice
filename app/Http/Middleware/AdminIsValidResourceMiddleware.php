<?php

namespace App\Http\Middleware;

use App\Models\Admin;
use App\Models\Expense;
use App\Models\Export;
use App\Models\ExportPayment;
use App\Models\GoodPurchase;
use App\Models\GoodPurchasePayment;
use App\Models\GoodSale;
use App\Models\GoodSalePayment;
use App\Models\Income;
use App\Models\Item;
use App\Models\PaymentMethod;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class AdminIsValidResourceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $type
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, $type = null): Response
    {
        $controller = $request->route()->getController();
        $res = null;
        switch ($type) {
            case "admin":
                $res = Admin::findOrFail($request->route('admin_id'));
                break;
            case "payment_method":
                $res = PaymentMethod::findOrFail(Route::input('payment_method_id'));
                break;
            default:
                $res = null;
        }
        $controller->_resource = $res;
        if (!$request->is("api/*")) {
            view()->share([
                '_resource' => $res,
            ]);
        }
        return $next($request);
    }
}
