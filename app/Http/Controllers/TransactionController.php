<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::all();
        return view('transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('transaction.detail', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'proof' => 'required|image|mimes:jpg,png,jpeg|max:2048'
        ]);
        $transaction = Transaction::findOrFail($id);
        DB::beginTransaction();
        try {
            if ($transaction->status == 'menunggu pembayaran'){
                $transaction->update([
                    'status' =>2,
                ]);
            }
            $transaction->update([
                'proof_of_payment' => $request->file('proof')->store('payment', 'public')
            ]);
        }catch (\Exception $exception){
            DB::rollBack();
            toastr()->error('error upload proof of payment');
            return redirect()->back();
        }
        DB::commit();
        toastr()->success('success upload proof of payment');
        return redirect()->back();


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function approve($id){
        $transacation = Transaction::findOrFail($id);
        DB::beginTransaction();
        try {
            $transacation->update([
                'status' => 3
            ]);
        }catch (\Exception $exception){
            DB::rollBack();
            toastr()->error('Error update status data');
            return redirect()->back();
        }
        DB::commit();
        toastr()->success('Success update status transaction');
        return redirect()->back();
    }
}
