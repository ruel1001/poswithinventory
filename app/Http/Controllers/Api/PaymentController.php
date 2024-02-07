<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Models\Payments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment= Payments::all();
        if($payment->count()>0){
            return response ()->json([
                'status'=>200,
                'data'=>$payment
            ],200);
        }
        else{
            return response ()->json([
                'status'=>404,
                'message'=>"no record available"
            ],404);
        }
    }

//Create Payment
public function create_payment(Request $request)
{
    // Validating the request data
    $validator = Validator::make($request->all(), [
        'account_number' => 'required|string|max:191',
        'account_name' => 'required|string|max:191',
        'account_balance' => 'required|string|max:191',
        'arrears_month' => 'required|string',
        'amount_paid' => 'required|string',
        'collectors_name' => 'required|string',
        'billing_month' => 'required|string',
    ]);

    // Checking if validation fails
    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'message' => $validator->messages()
        ], 422);
    } else {
        // Querying the Customer table to find a record with the provided account number
        $customer = Customer::where('account_number', $request->account_number)->first();

        // Checking if customer exists
        if ($customer) {
            // Account exists, proceed to create payment
            $payment = new Payments();
            $payment->account_number = $request->account_number;
            $payment->account_name = $request->account_name;
            $payment->account_balance = $request->account_balance;
            $payment->arrears_month = $request->arrears_month;
            $payment->amount_paid = $request->amount_paid;
            $payment->collectors_name = $request->collectors_name;
            $payment->billing_month = $request->billing_month;
            // Add other payment fields here...
            $payment->save();

            return response()->json([
                'status' => 200,
                'message' => "Payment created successfully"
            ], 200);
        } else {
            // Account not found
            return response()->json([
                'status' => 404,
                'message' => "Customer with the given account number not found"
            ], 404);
        }
    }
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }


    public function update_payment(Request $request)
    {
        // Validating the request data
        $validator = Validator::make($request->all(), [
            'payment_id' => 'required|string|max:191',
            'account_number' => 'required|string|max:191',
            'account_name' => 'required|string|max:191',
            'account_balance' => 'required|string|max:191',
            'arrears_month' => 'required|string',
            'amount_paid' => 'required|string',
            'collectors_name' => 'required|string',
            'billing_month' => 'required|string',
        ]);
    
        // Checking if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->messages()
            ], 422);
        } else {
            // Querying the Payment table to find a record with the provided payment ID
            $payment = Payments::where('payment_id', $request->payment_id)->first();
    
            // Checking if payment exists
            if ($payment) {
                // Payment exists, update the payment
                $payment->account_number = $request->account_number;
                $payment->account_name = $request->account_name;
                $payment->account_balance = $request->account_balance;
                $payment->arrears_month = $request->arrears_month;
                $payment->amount_paid = $request->amount_paid;
                $payment->collectors_name = $request->collectors_name;
                $payment->billing_month = $request->billing_month;
                // Update other payment fields here...
                $payment->save();
    
                return response()->json([
                    'status' => 200,
                    'message' => "Payment updated successfully"
                ], 200);
            } else {
                // Payment not found
                return response()->json([
                    'status' => 404,
                    'message' => "Payment with the given Payment ID not found"
                ], 404);
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
       
        $accountNumber = $request->input('account_number');

        // Check if the account number is provided
        if (!$accountNumber) {
            return response()->json([
                'status' => 400,
                'message' => "Account number is required in the request body"
            ], 400);
        }
    
        // Fetch payments associated with the provided account number
        $payments = Payments::where('account_number', $accountNumber)->orderBy('created_at', 'desc')->get();
    
        // Check if payments are found
        if ($payments->count() > 0) {
            return response()->json([
                'status' => 200,
                'data' => $payments
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No payments found for the provided account number"
            ], 404);
        }
    }


    public function filter(Request $request){
        $payment_id = $request->input('payment_id');
        $payment = Payments::find($payment_id);
        if($payment){
            return response()->json([
                'status' => 200,
                'data' => $payment
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Record found"
            ], 404);  
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
 
     public function delete(Request $request){
        $payment_id = $request->input('payment_id');
        $payment = Payments::where('payment_id', $payment_id)->first();
        if($payment){
            $payment->delete();
            return response()->json([
                'status'=>200,
                'message'=>"Payment deleted"
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>"No Payment found"
            ],404);  
        }}
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
