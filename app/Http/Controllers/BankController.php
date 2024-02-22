<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banks = Bank::all();
        return view('bank.index', compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bank.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'owner' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'rekening' => 'required|string'
        ]);
        DB::beginTransaction();
        try {
            Bank::create([
                'name' => $request->name,
                'owner' => $request->owner,
                'image' => $request->file('image')->store('bank', 'public'),
                'rekening' => $request->rekening
            ]);
        }catch (Exception $exception){
            DB::rollBack();
            toastr()->error('error create data');
            return redirect()->back()->withInput();
        }
        DB::commit();
        toastr()->success('success create data');
        return redirect()->route('admin.bank.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $bank = Bank::findOrFail($id);
        return view('bank.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'owner' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'rekening' => 'required|string'
        ]);
        DB::beginTransaction();
        $bank = Bank::findOrFail($id);
        try {
            $bank->update([
                'name' => $request->name,
                'owner' => $request->owner,
                'image' => $request->file('image')->store('bank', 'public'),
                'rekening' => $request->rekening
            ]);
        }catch (Exception $exception){
            DB::rollBack();
            toastr()->error('error update data');
            return redirect()->back()->withInput();
        }
        DB::commit();
        toastr()->success('success update data');
        return redirect()->route('admin.bank.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bank = Bank::findOrFail($id);
        DB::beginTransaction();
        try {
            $bank->delete();
        }catch (\Exception $exception){
            DB::rollBack();
            toastr()->error('Error delete product');
            return redirect()->back();
        }
        DB::commit();
        toastr()->success('success delete product');
        return redirect()->back();
    }
}
