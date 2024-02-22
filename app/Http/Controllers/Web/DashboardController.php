<?php

namespace App\Http\Controllers\WEB;

use App\Models\Sales;
use App\Models\Customer;
use App\Models\Expenses;
use App\Models\Payments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function index(Request $request)
    {
       $customer = Customer::count();

       $payment = Payments::orderBy('payment_id', 'desc')->get();

       $customer_debt = Customer::orderBy('account_number', 'desc')->get();
       $totalPaymentdebt = $customer_debt->sum('account_balance');



       $sales = Sales::orderBy('sales_id', 'desc')->get();
       $totalAmountSales = $sales->sum('amount_sales');
       $totalAmountgain = $sales->sum('amount_gain');


       $totalAmount = $payment->sum('amount_paid');


       $expenses = Expenses::orderBy('expenses_id', 'desc')->get();
 $totalexpenses = $expenses->sum('amount');



        return view('dashboard.dashboard', [
            'customer' => $customer,
            'payment' => $payment,
            'totalAmount' => $totalAmount,
            'totalAmountSales' => $totalAmountSales,
            'totalAmountgain' => $totalAmountgain,
                'totalexpenses' => $totalexpenses,
                'totalPaymentdebt' => $totalPaymentdebt,
        ]);
    }
}
