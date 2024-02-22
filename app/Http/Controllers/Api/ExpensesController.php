<?php

namespace App\Http\Controllers\Api;

use App\Models\Expenses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ExpensesController extends Controller
{
    //
    // public function index()
    // {

    //     $expenses= Expenses::all();
    //     if($expenses->count()>0){
    //         return response ()->json([
    //             'status'=>200,
    //             'data'=>$expenses
    //         ],200);
    //     }
    //     else{
    //         return response ()->json([
    //             'status'=>404,
    //             'message'=>"no record available"
    //         ],404);
    //     }
    // }


     public function index(Request $request)
    {
        $nature_of_expenses = $request->input('nature_of_expenses');

        // If material_name is provided, search by name
        if (!empty($nature_of_expenses)) {
            $expenses = Expenses::where('nature_of_expenses', 'like', "%$nature_of_expenses%")->get();
        } else {
            // If material_name is empty, show all records
            $expenses = Expenses::all();
        }

        // Check if any records are found
        if ($expenses->count() > 0) {
            $totalAmount = $expenses->sum('amount');

            return response()->json([
                'status' => 200,
                 'total_amount_expenses' => $totalAmount,
                'data' => $expenses
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No records available"
            ], 404);
        }
    }



// Create
    public function create_expenses(Request $request)
    {
        // Validating the request data
        $validator = Validator::make($request->all(), [
            'nature_of_expenses' => 'required|string|max:191',
            'amount' => 'required|string|max:191',
     ]);

        // Checking if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Invalid Input.',
                'errors' => $validator->messages()
            ], 422);
        } else {

                $expenses = new Expenses();
                $expenses->nature_of_expenses = $request->nature_of_expenses;
                $expenses->amount = $request->amount;
                $expenses->save();

                return response()->json([
                    'status' => 200,
                    'message' => "Expenses created successfully"
                ], 200);

        }
    }


    //update
    public function update_expenses(Request $request)
    {
        // Validating the request data
        $validator = Validator::make($request->all(), [
            'expenses_id' => 'required|string|max:191',
            'nature_of_expenses' => 'required|string|max:191',
            'amount' => 'required|string|max:191',
        ]);

        // Checking if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Invalid Input.',
                'errors' => $validator->messages()
            ], 422);
        } else {
            // Querying the Paymet table to find a record with the provided payment ID
            $expenses = Expenses::where('expenses_id', $request->expenses_id)->first();

            // Checking if payment exists
            if ($expenses) {
                // Payment exists, update the payment
                $expenses->expenses_id = $request->expenses_id;
                $expenses->nature_of_expenses = $request->nature_of_expenses;
                $expenses->amount = $request->amount;

                // Update other payment fields here...
                $expenses->save();

                return response()->json([
                    'status' => 200,
                    'message' => "Expenses updated successfully"
                ], 200);
            } else {
                // Payment not found
                return response()->json([
                    'status' => 404,
                    'message' => "Expenses with the given  ID not found"
                ], 404);
            }
        }
    }


    public function filterEach(Request $request){
        $expenses_id = $request->input('expenses_id');
        $expenses = Expenses::find($expenses_id);
        if($expenses){
            return response()->json([
                'status' => 200,
                'data' => $expenses
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Record found"
            ], 404);
        }
    }


// show account list
    public function show_list(Request $request)
    {

        $accountNumber = $request->input('account_number');

        // Check if the account number is provided
        if (!$accountNumber) {
            return response()->json([
                'status' => 400,
                'message' => "Account number is required "
            ], 400);
        }

        // Fetch payments associated with the provided account number
        $expenses = Expenses::where('account_number', $accountNumber)->orderBy('created_at', 'desc')->get();

        // Check if payments are found
        if ($maintenance->count() > 0) {
            return response()->json([
                'status' => 200,
                'data' => $maintenance
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Maintenance found for the provided account number"
            ], 404);
        }
    }


    public function delete(Request $request){
        $expenses_id = $request->input('expenses_id');
        $expenses = Expenses::where('expenses_id', $expenses_id)->first();
        if($expenses){
            $expenses->delete();
            return response()->json([
                'status'=>200,
                'message'=>"Expenses deleted"
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>"No Expenses found"
            ],404);
        }}
}