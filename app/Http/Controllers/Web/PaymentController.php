<?php

namespace App\Http\Controllers\WEB;

use Exception;
use App\Models\Customer;

use App\Models\Payments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentController extends Controller
{
    public function index()
    {
        $payment = Payments::orderBy('payment_id', 'desc')->get();

        return view('payment.payment', [
            'payment' => $payment
        ]);
    }





    public function addpayment($account_number)
    {
        try {
            $customer = Customer::findOrFail($account_number);

            return view('payment.payment-add', [
                'customer' => $customer
            ]);
        } catch (Exception $ex) {

            Alert::warning('Error', 'Customer data deleted!');
            return redirect('/payment');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function pay(Request $request)
{
    try {
        $validated = $request->validate([
            'account_number' => 'required|string|max:191',
            'account_name' => 'required|string|max:191',
            'account_balance' => 'required|string|max:191',
            'arrears_month' => 'required|string',
            'amount_paid' => 'required|string',
            'collectors_name' => 'required|string',
            'billing_month' => 'required|string',
        ]);

        // Retrieve the customer based on the provided account number
        $customer = Customer::where('account_number', $request->account_number)->first();

        if (!$customer) {
            throw new Exception("Customer not found");
        }

        $payment = Payments::create($request->all());

        // Update customer's account balance
        $temptotal = $customer->plan_subscribed + $customer->account_balance;
        $pretotal = $temptotal - $request->amount_paid;
        $customer->account_balance = $pretotal;
        $customer->save();

        Alert::success('Success', 'Payment Created!');
        return redirect('/payment');
    } catch (Exception $ex) {
        Alert::warning('Error', 'Error in Creating!' . $ex->getMessage());
        return redirect('/payment');
    }
}

    public function edit($payment_id)
    {
        $payment = Payments::findOrFail($payment_id);



        $customer = Customer::where('account_number', $payment->account_number)->first();

        if (!$customer) {
            throw new Exception("Customer not found");
        }

        return view('payment.payment-edit', [
            'payment' => $payment,
            'customer' => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $payment_id)
    {
        $validated = $request->validate([

                'account_number' => 'required|string|max:191',
                'account_name' => 'required|string|max:191',

                'arrears_month' => 'required|string',
                'amount_paid' => 'required|string',
                'collectors_name' => 'required|string',
                'billing_month' => 'required|string',
            ]);



        $payment = Payments::findOrFail($payment_id);
        $payment->update($validated);





        $customer = Customer::where('account_number', $request->account_number)->first();

        if (!$customer) {
            throw new Exception("Customer not found");
        }



        // Update customer's account balance
        $temptotal = $customer->plan_subscribed + $customer->account_balance;
        $pretotal = $temptotal - $request->amount_paid;q

        $customer->account_balance = $pretotal;
        $customer->save();


        Alert::info('Success', 'Payment has been updated !');
        return redirect('/payment');

    }



    public function destroy($account_number)
    {
        try {
            $payment = Payments::findOrFail($account_number);

            $payment->delete();

            Alert::error('Success', 'Payment has been deleted !');
            return redirect('/payment');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Customer deleted, already used !');
            return redirect('/payment');
        }
    }
}
