<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function detail($slug){
        $product = Product::where('slug', $slug)->first();
        if (empty($product)){
            abort(404);
        }
        $banks = Bank::all();
        return view('checkout.index', compact('product', 'banks'));
    }

    public function buy(Request $request, $slug){
        $this->validate($request, [
            'quantity' => 'required|integer',
            'bank' => 'required|integer'
        ]);
        $product = Product::where('slug', $slug)->first();
        if (empty($product)){
            abort(404);
        }
        $user = Auth::user();
        $bank = Bank::findOrFail($request->bank);
        DB::beginTransaction();
        try {
            Transaction::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'quantity' => $request->quantity,
                'price' => ($request->quantity * $product->price) + random_int(1,999),
                'bank_id' => $bank->id
            ]);
        }catch (\Exception $exception){
            DB::rollBack();
            toastr()->error('Error checkout product');
            return redirect()->back();
        }
        DB::commit();
        toastr()->success('success checkout product');
        return redirect()->route('user.dashboard');
    }
}
