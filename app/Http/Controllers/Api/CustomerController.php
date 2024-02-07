<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $customer= Customer::all();
        if($customer->count()>0){
            return response ()->json([
                'status'=>200,
                'data'=>$customer
            ],200);
        }
        else{
            return response ()->json([
                'status'=>404,
                'message'=>"no record available"
            ],404);
        }
    }

    public function create(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'account_name' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'account_balance' => 'required|string|max:191',
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
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Invalid Input.',
                'errors' => $validator->messages(),
            ], 422);
        } else {
            // Check if account_name already exists
            $existingCustomer = Customer::where('account_name', $request->account_name)->first();
    
            // If account_name already exists, return conflict response
            if ($existingCustomer) {
                return response()->json([
                    'status' => 409, // Conflict status code
                    'message' => 'Account name already exists in the database.',
                ], 409);
            }
    
            // If account_name does not exist, proceed with creating the record
            $customer = Customer::create([
                'account_name' => $request->account_name,
                'address' => $request->address,
                'account_balance' => $request->account_balance,
                'date_plan' => $request->date_plan,
                'amount_of_installation' => $request->amount_of_installation,
                'due_date_month' => $request->due_date_month,
                'arrears' => $request->arrears,
                'foc' => $request->foc,
                'modem' => $request->modem,
                'connector' => $request->connector,
                'ficamp' => $request->ficamp,
                'others' => $request->others,
                'messenger' => $request->messenger,
                'contact_number' => $request->contact_number,
                'area' => $request->area
            ]);
    
            // Check if customer record was created successfully
            if ($customer) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Customer created successfully',
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something went wrong',
                ], 500);
            }
        }
    }
    public function show($account_number){
        $customer=Customer::find($account_number);
        if($customer){
            return response()->json([
                'status'=>200,
                'data'=>$customer
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>"No Student found"
            ],404);  
        }
    }

    public function shows(Request $request){
        $account_number = $request->input('account_number');
        $customer = Customer::find($account_number);
        if($customer){
            return response()->json([
                'status' => 200,
                'data' => $customer
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Customer found"
            ], 404);  
        }
    }

    public function edit($account_number){
        $customer=Customer::find($account_number);
        if($customer){
            return response()->json([
                'status'=>200,
                'data'=>$customer
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>"No Student found"
            ],404);  
        }
    }

    public function update(Request $request)
{
    $validator = Validator::make($request->all(), [
        'account_number' => 'required|string|max:191',
        'account_name' => 'required|string|max:191',
        'address' => 'required|string|max:191',
        'date_plan' => 'required|string|max:191',
        'amount_of_installation' => 'required|numeric',
        'due_date_month' => 'required|string|max:191',
        'foc' => 'required|string|max:191',
        'modem' => 'required|string|max:191',
        'connector' => 'required|string|max:191',
        'ficamp' => 'required|string|max:191',
        'others' => 'required|string|max:191',
        'messenger' => 'required|string|max:191',
        'contact_number' => 'required',
        'account_balance' => 'required|string|max:191',
        'area' => 'required|string|max:191',

    ]);
    
    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'message' => 'Invalid Input.',
            'errors' => $validator->messages(),
        ], 422);
    } else {
        $customer = Customer::where('account_number', $request->account_number)->first();

        if ($customer) {
            $customer->update([
                'account_name' => $request->account_name,
                'address' => $request->address,
                'date_plan' => $request->date_plan,
                'amount_of_installation' => $request->amount_of_installation,
                'due_date_month' => $request->due_date_month,
                'foc' => $request->foc,
                'modem' => $request->modem,
                'connector' => $request->connector,
                'ficamp' => $request->ficamp,
                'others' => $request->others,
                'messenger' => $request->messenger,
                'contact_number' => $request->contact_number,
                'account_balance' => $request->account_balance,
                'area' => $request->area,
            ]);

            return response()->json([
                'status' => 200,
                'message' => "Customer Updated Successfully"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Customer not found"
            ], 404);
        }
    }
}

    public function destroy($account_number){
        $customer=Customer::find($account_number);
        if($customer){
            $customer->delete();
            return response()->json([
                'status'=>200,
                'message'=>"Customer deleted"
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>"No Student found"
            ],404);  
        }
    }
    

    public function delete(Request $request){
        $account_number = $request->input('account_number');
        $customer = Customer::where('account_number', $account_number)->first();
        if($customer){
            $customer->delete();
            return response()->json([
                'status'=>200,
                'message'=>"Customer deleted"
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>"No Customer found"
            ],404);  
        }}
}
