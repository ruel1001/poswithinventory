<?php

namespace App\Http\Controllers\WEB;

use App\Models\Expenses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class ExpensesController extends Controller
{
    public function index()
    {
        $expenses = Expenses::orderBy('expenses_id', 'desc')->get();

        return view('expenses.expenses', [
            'expenses' => $expenses
        ]);
    }



    public function create()
    {
        return view('expenses.expenses-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //dd($request->all());
        $validated = $request->validate([
            'nature_of_expenses' => 'required|string|max:191',
            'amount' => 'required|string|max:191',
        ]);

       $expenses = Expenses::create($request->all());
            Alert::success('Success', 'Expenses has been saved !');
            return redirect('/expenses');

    }

    public function edit($expenses_id)
    {
        $expenses = Expenses::findOrFail($expenses_id);

        return view('expenses.expenses-edit', [
            'expenses' => $expenses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $expenses_id)
    {
        $validated = $request->validate([
            'nature_of_expenses' => 'required|string|max:191',
            'amount' => 'required|string|max:191',
        ]);



        $expenses = Expenses::findOrFail($expenses_id);
        $expenses->update($validated);

        Alert::info('Success', 'Expenses has been updated !');
        return redirect('/expenses');
    }

    public function destroy($expenses_id)
    {
        try {
            $expenses = Expenses::findOrFail($expenses_id);

            $expenses->delete();

            Alert::error('Success', 'Expenses has been deleted !');
            return redirect('/expenses');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Expenses deleted, already used !');
            return redirect('/expenses');
        }
    }

}
