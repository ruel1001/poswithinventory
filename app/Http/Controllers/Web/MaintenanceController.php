<?php

namespace App\Http\Controllers\WEB;

use App\Models\Sales;
use App\Models\Customer;
use App\Models\Material;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenance = Maintenance::orderBy('maintenance_id', 'desc')->get();

        return view('maintenance.maintenance', [
            'maintenance' => $maintenance
        ]);
    }

    public function addmaintenance($account_number)
    {
        try {
            $customer = Customer::findOrFail($account_number);

            return view('maintenance.maintenance-add', [
                'customer' => $customer
            ]);
        } catch (Exception $ex) {

            Alert::warning('Error', 'Customer data deleted!');
            return redirect('/maintenance');
        }
    }



    public function newmaintenance(Request $request)
    {
        try {


            $validated = $request->validate([
                'account_number' => 'required|string|max:191',
                'account_name' => 'required|string|max:191',
                'address' => 'required|string|max:191',
                'area' => 'required|string|max:191',
                'material_used' => 'required|string|max:191',
                'material_quantity_used' => 'required|string|max:191',
                'material_id' => 'required|string|max:191',
                'nature_of_repair' => 'required|string|max:191',
            ]);

            // Retrieve the customer based on the provided account number


            $maintenance = Maintenance::create($request->all());

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
                    $sale_amount = floatval($material->sale_amount);
                    $quantity_used = floatval($request->material_quantity_used);

                    // Perform the multiplication
                    $tempgain = $sale_amount * $quantity_used;
                    $temptotal=  $tempgain-$tempsales;
                    $sales->amount_sales =$tempsales;

                    $sales->amount_gain = $temptotal;
                    $sales->save();
                }}


            // Update customer's account balance

            Alert::success('Success', 'Maintenance Created!');
            return redirect('/maintenance');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Error in Creating!' . $ex->getMessage());
            return redirect('/maintenance');
        }
    }






    public function edit($maintenance_id)
    {
        $maintenance = maintenance::findOrFail($maintenance_id);



        $customer = Customer::where('account_number', $maintenance->account_number)->first();

        if (!$customer) {
            throw new Exception("Customer not found");
        }

        return view('maintenance.maintenance-edit', [
            'maintenance' => $maintenance,
            'customer' => $customer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $maintenance_id)
    {
        $validated = $request->validate([
            'account_number' => 'required|string|max:191',
            'account_name' => 'required|string|max:191',
            'address' => 'required|string|max:191',
            'area' => 'required|string|max:191',
            'material_used' => 'required|string|max:191',
            'material_quantity_used' => 'required|string|max:191',
            'material_id' => 'required|string|max:191',
            'nature_of_repair' => 'required|string|max:191',
            ]);



        $maintenance = Maintenance::findOrFail($maintenance_id);
        $maintenance->update($validated);
        $prevQuantity = $maintenance->material_quantity_used;
        $previousMaterialQuantityUsed = $maintenance->material_quantity_used;


        $material = new Material();
        $material = material::where('material_id', $request->material_id)->first();
        if ($material) {

            $currentQuantity = $material->quantity_used;//karaan


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
            }}







        Alert::info('Success', 'Mintenance has been updated !');
        return redirect('/maintenance');

    }



    public function destroy($maintenance_id)
    {
        try {
            $maintenance = Maintenance::findOrFail($maintenance_id);

            $payment->delete();

            Alert::error('Success', 'Payment has been deleted !');
            return redirect('/maintenance');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Maintenancel deleted, already used !');
            return redirect('/maintenance');
        }
    }

}
