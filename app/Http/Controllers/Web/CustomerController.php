<?php

namespace App\Http\Controllers\WEB;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Exception;
class CustomerController extends Controller

{
    //

    public function index()
    {
        $customer = Customer::orderBy('account_name', 'desc')->get();
        
        return view('customer.customer', [
            'customer' => $customer
        ]);
    }



    public function create()
    {
        return view('customer.customer-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dd($request->all());
        $validated = $request->validate([
            'account_name' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'date_plan' => 'required|string|max:191',
            'amount_of_installation' => 'required|numeric',
            'due_date_month' => 'required|string|max:191',
            'arrears' => 'required|string|max:191',
            'foc' => 'required|string|max:191',
            'modem' => 'required|string|max:191',
            'connector' => 'required|string|max:191',
            'ficamp' => 'required|string|max:191',
            'others' => 'required|string|max:191',
            'messenger' => 'required|string|max:191',
            'contact_number' => 'required',
            'area' => 'required|string|max:191',
            'plan_subscribed' => 'required|string|max:191'
        ]);

       $customer = Customer::create($request->all());
            Alert::success('Success', 'Customer has been saved !');
            return redirect('/customer');

    }

    public function edit($account_number)
    {
        $customer = customer::findOrFail($account_number);

        return view('customer.customer-edit', [
            'customer' => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $account_number)
    {
        $validated = $request->validate([
            'account_name' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'date_plan' => 'required|string|max:191',
            'amount_of_installation' => 'required|numeric',
            'due_date_month' => 'required|string|max:191',
            'arrears' => 'required|string|max:191',
            'foc' => 'required|string|max:191',
            'modem' => 'required|string|max:191',
            'connector' => 'required|string|max:191',
            'ficamp' => 'required|string|max:191',
            'others' => 'required|string|max:191',
            'messenger' => 'required|string|max:191',
            'contact_number' => 'required',
            'area' => 'required|string|max:191',
            'plan_subscribed' => 'required|string|max:191'
        ]);








        $customer = Customer::findOrFail($account_number);
        $customer->update($validated);





        Alert::info('Success', 'Customer has been updated !');
        return redirect('/customer');
    }

    public function destroy($account_number)
    {
        try {
            $customer = Customer::findOrFail($account_number);

            $customer->delete();

            Alert::error('Success', 'Customer has been deleted !');
            return redirect('/customer');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Customer deleted, already used !');
            return redirect('/customer');
        }
    }

}
