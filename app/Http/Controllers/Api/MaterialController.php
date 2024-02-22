<?php

namespace App\Http\Controllers\Api;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    //index show all

    // public function index()
    // {

    //     $material= Material::all();
    //     if($material->count()>0){
    //         return response ()->json([
    //             'status'=>200,
    //             'data'=>$material
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
    $materialName = $request->input('material_name');

    // If material_name is provided, search by name
    if (!empty($materialName)) {
        $material = Material::where('material_name', 'like', "%$materialName%")->get();
    } else {
        // If material_name is empty, show all records
        $material = Material::all();
    }

    // Check if any records are found
    if ($material->count() > 0) {
        return response()->json([
            'status' => 200,
            'data' => $material
        ], 200);
    } else {
        return response()->json([
            'status' => 404,
            'message' => "No records available"
        ], 404);
    }
}


    // Create
    public function create_material(Request $request)
    {
        // Validating the request data
        $validator = Validator::make($request->all(), [
            'material_name' => 'required|string|max:191',
            'quantity' => 'required|string|max:191',
            'item' => 'required|string|max:191',
            'amount' => 'required|string|max:191',
            'sale_amount' => 'required|string|max:191',
     ]);

        // Checking if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => 'Invalid Input.',
                'errors' => $validator->messages()
            ], 422);
        } else {

                $material = new Material();
                $material->material_name = $request->material_name;
                $material->quantity = $request->quantity;
                $material->item = $request->item;
                $material->amount = $request->amount;
                $material->sale_amount = $request->sale_amount;
                $material->save();

                return response()->json([
                    'status' => 200,
                    'message' => "Expenses created successfully"
                ], 200);

        }
    }


    //update
    public function update_material(Request $request)
    {
        // Validating the request data
        $validator = Validator::make($request->all(), [
            'material_id' => 'required|string|max:191',
            'material_name' => 'required|string|max:191',
            'quantity' => 'required|string|max:191',
            'item' => 'required|string|max:191',
            'amount' => 'required|string|max:191',
            'sale_amount' => 'required|string|max:191',
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
            $material = Material::where('material_id', $request->material_id)->first();

            // Checking if payment exists
            if ($material) {
                // Payment exists, update the payment
                $material->material_id = $request->material_id;
                $material->material_name = $request->material_name;
                $material->quantity = $request->quantity;
                $material->amount = $request->amount;
                $material->sale_amount = $request->sale_amount;
                // Update other payment fields here...
                $material->save();

                return response()->json([
                    'status' => 200,
                    'message' => "Material updated successfully"
                ], 200);
            } else {
                // Payment not found
                return response()->json([
                    'status' => 404,
                    'message' => "Material with the given  ID not found"
                ], 404);
            }
        }
    }


    //Deelete
    public function delete(Request $request){
        $material_id = $request->input('material_id');
        $material = Material::where('material_id', $material_id)->first();
        if($material){
            $material->delete();
            return response()->json([
                'status'=>200,
                'message'=>"Material deleted"
            ],200);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>"No Material  found"
            ],404);
        }}


            //shwo each data
        public function filterEach(Request $request){
            $material_id = $request->input('material_id');
            $material = Material::find($material_id );
            if($material){
                return response()->json([
                    'status' => 200,
                    'data' => $material
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "No Record found"
                ], 404);
            }}

}