<?php

namespace App\Http\Controllers\Api;

use App\Models\Sales;
use App\Models\Customer;
use App\Models\Material;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MaintainanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index()
    {

        $maintenance= Maintenance::all();
        if($maintenance->count()>0){
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


    //Create
    public function create_maintenance(Request $request)
    {
        // Validating the request data
        $validator = Validator::make($request->all(), [
            'account_name' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'account_number' => 'required|string|max:191',
            'area' => 'required|string|max:191',
            'material_used' => 'required|string|max:191',
            'material_quantity_used' => 'required|string|max:191',
            'material_id' => 'required|string|max:191',
            'nature_of_repair' => 'required|string|max:191',

        ]);

        // Checking if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Invalid Input.',
                'errors' => $validator->messages()
            ], 422);
        } else {
            // Querying the Customer table to find a record with the provided account number
            $customer = Customer::where('account_number', $request->account_number)->first();

            // Checking if customer exists
            if ($customer) {
                // Account exists, proceed to create payment
                $maintenance = new Maintenance();
                $maintenance->account_name = $request->account_name;
                $maintenance->address = $request->address;
                $maintenance->account_number = $request->account_number;
                $maintenance->area = $request->area;
                $maintenance->material_used = $request->material_used;
                $maintenance->material_id = $request->material_id;
                $maintenance->material_quantity_used = $request->material_quantity_used;
                $maintenance->nature_of_repair = $request->nature_of_repair;
                // Add other payment fields here...
                $maintenance->save();
                $material = new Material();
                $material = material::where('material_id', $request->material_id)->first();



                if ($material) {
                    $currentQuantity = $material->quantity_used;
                    $newQuantity = $currentQuantity + $request->material_quantity_used;
                    $material->quantity_used     = $newQuantity;
                    $availableQuantity = $material->quantity_used;
                    $requestedQuantity = $request->material_quantity_used;

                    if ($requestedQuantity <= $availableQuantity) {
                        $newQuantity = $availableQuantity + $requestedQuantity;
                        $material->quantity_used = $newQuantity;

                        $material->save();


                        $sales = new Sales();
                        $sales->material_name = $request->material_used;
                        $sales->material_id = $request->material_id;
                        $sales->maintenance_id = $maintenance->maintenance_id;
                        $tempsales= $material->amount*$request->material_quantity_used;
                        $tempgain= $material->sale_amount*$request->material_quantity_used;
                        $temptotal=  $tempgain-$tempsales;
                        $sales->amount_sales =$tempsales;

                        $sales->amount_gain = $temptotal;
                        $sales->save();



                        return response()->json([
                            'status' => 200,
                            'message' => "Maintenance created successfully",
                            'data'=>$maintenance,
                        ], 200);
                    } else {
                        return response()->json([
                            'status' => 400,
                            'message' => "Requested quantity exceeds available quantity"
                        ], 400);
                    }
                } else {
                    return response()->json([
                        'status' => 404,
                        'message' => "Material number not found"
                    ], 404);
                }



            } else {
                // Account not found
                return response()->json([
                    'status' => 404,
                    'message' => "Customer with the given account number not found"
                ], 404);
            }
        }
    }


//update

public function update_maintenance(Request $request)
{
    // Validating the request data
    $validator = Validator::make($request->all(), [
        'maintenance_id' => 'required|string|max:191',
        'account_name' => 'required|string|max:191',
        'address' => 'required|string|max:191',
        'account_number' => 'required|string|max:191',
        'area' => 'required|string|max:191',
        'material_used' => 'required|string|max:191',
        'nature_of_repair' => 'required|string|max:191',
        'material_quantity_used' => 'required|string|max:191',
    ]);

    // Checking if validation fails
    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'message' => 'Invalid Input.',
            'errors' => $validator->messages()
        ], 422);
    } else {
        // Querying the Payment table to find a record with the provided payment ID
        $maintenance = Maintenance::where('maintenance_id', $request->maintenance_id)->first();
        $previousMaterialQuantityUsed = $maintenance->material_quantity_used;
        // Checking if payment exists
        if ($maintenance) {
            // Payment exists, update the payment
            $maintenance->maintenance_id = $request->maintenance_id;
            $maintenance->account_name = $request->account_name;
            $maintenance->address = $request->address;
            $maintenance->account_number = $request->account_number;
            $maintenance->area = $request->area;
            $maintenance->material_used = $request->material_used;
            $maintenance->material_id = $request->material_id;
            $maintenance->material_quantity_used = $request->material_quantity_used;
            $maintenance->nature_of_repair = $request->nature_of_repair;

            // Update other payment fields here...
            $maintenance->save();

            $material = new Material();
            $material = material::where('material_id', $request->material_id)->first();
            if ($material) {

                $currentQuantity = $material->quantity_used;//karaan
                $prevQuantity = $maintenance->material_quantity_used;

                $newQuantity = $currentQuantity - $previousMaterialQuantityUsed;

               $newQuantityUsed = $newQuantity + $request->material_quantity_used;



                $material->quantity_used = $newQuantityUsed;
                $material->save();

                $sales = Sales::where('maintenance_id', $request->maintenance_id)->first();
                if ($sales) {

                $sales->material_name = $request->material_used;
                $sales->material_id = $request->material_id;

                $tempsales= $material->amount*$request->material_quantity_used;
                $tempgain= $material->sale_amount*$request->material_quantity_used;
                $temptotal=  $tempgain-$tempsales;
                $sales->amount_sales =$tempsales;

                $sales->amount_gain = $temptotal;
                $sales->save();
                }else{
                    return response()->json([
                        'status' => 404,
                        'message' => "Sales number not found"
                    ], 404);
                }


                return response()->json([
                    'status' => 200,
                    'message' => "Maintenance Updated successfully",
                    'data'=>$maintenance,
                ], 200);
            }
            else{
                return response()->json([
                    'status' => 404,
                    'message' => "Material number not found"
                ], 404);
            }




        } else {
            // Payment not found
            return response()->json([
                'status' => 404,
                'message' => "Maintenance with the given Payment ID not found"
            ], 404);
        }
    }
}

//filter
public function filter(Request $request){
    $maintenance_id = $request->input('maintenance_id');
    $maintenance = Maintenance::find($maintenance_id);
    if($maintenance){
        return response()->json([
            'status' => 200,
            'data' => $maintenance
        ], 200);
    } else {
        return response()->json([
            'status' => 404,
            'message' => "No Record found"
        ], 404);
    }
}


   //show all transaction ni customer
   public function show(Request $request)
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
        $maintenance = Maintenance::where('account_number', $accountNumber)->orderBy('created_at', 'desc')->get();

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


    // delete ta
    public function delete(Request $request){
        $maintenance_id = $request->input('maintenance_id');
        $maintenance = Maintenance::where('maintenance_id', $maintenance_id)->first();
        if($maintenance){
            $maintenance->delete();
            return response()->json([
                'status'=>200,
                'message'=>"Maintenance deleted"
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>"No maintenance found"
            ],404);
        }}
}
