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
use Closure;
use Illuminate\Http\Request;
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
            case "item":
                $res = Item::findOrFail($request->route('item_id'));
                break;
            case "good_purchase":
                $res = GoodPurchase::findOrFail($request->route('good_purchase_id'));
                break;
            case "purchase_payment":
                $res = GoodPurchasePayment::findOrFail($request->route('purchase_payment_id'));
                break;
            case "good_sale":
                $res = GoodSale::findOrFail($request->route('good_sale_id'));
                break;
            case "expense":
                $res = Expense::findOrFail($request->route('expense_id'));
                break;
            case "income":
                $res = Income::findOrFail($request->route('income_id'));
                break;
            case "sale_payment":
                $res = GoodSalePayment::findOrFail($request->route('sale_payment_id'));
                break;
            case "export":
                $res = Export::with([
                                'exportItems',
                                'payments' => function ($query) {
                                    $query->orderBy('payment_date', 'asc');
                                }
                            ])
                            ->where('export_id', $request->route('export_id'))
                            ->firstOrFail();
                break;
            case "export_payment":
                $res = ExportPayment::with('export')->where('export_payment_id',$request->route('export_payment_id'))
                                    ->firstOrFail();
                break;
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
