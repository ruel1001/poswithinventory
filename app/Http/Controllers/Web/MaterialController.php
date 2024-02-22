<?php

namespace App\Http\Controllers\WEB;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class MaterialController extends Controller
{

    public function index()
    {
        $material = Material::orderBy('material_id', 'desc')->get();

        return view('material.material', [
            'material' => $material
        ]);
    }
    public function getmaterial()
    {
        $material = Material::orderBy('material_name', 'asc')->get();
        return response()->json($material);
    }

    public function create()
    {
        return view('material.material-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validated = $request->validate([
            'material_name' => 'required|string|max:191',
            'quantity' => 'required|string|max:191',
            'item' => 'required|string|max:191',
            'amount' => 'required|string|max:191',
            'sale_amount' => 'required|string|max:191',
        ]);

       $material = Material::create($request->all());
            Alert::success('Success', 'Material has been saved !');
            return redirect('/material');

    }

    public function edit($material_id)
    {
        $material = Material::findOrFail($material_id);

        return view('material.material-edit', [
            'material' => $material,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $material_id)
    {
        $validated = $request->validate([
            'material_name' => 'required|string|max:191',
            'quantity' => 'required|string|max:191',
            'item' => 'required|string|max:191',
            'amount' => 'required|string|max:191',
            'sale_amount' => 'required|string|max:191',
        ]);



        $material = Material::findOrFail($material_id);
        $material->update($validated);

        Alert::info('Success', 'Material has been updated !');
        return redirect('/material');
    }

    public function destroy($material_id)
    {
        try {
            $material = Material::findOrFail($material_id);

            $material->delete();

            Alert::error('Success', 'Material has been deleted !');
            return redirect('/material');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Material deleted, already used !');
            return redirect('/material');
        }
    }

}
