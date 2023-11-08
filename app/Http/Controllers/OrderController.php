<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user(); 
        $orders = Order::with('user')->where('user_id', $user->id)->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'total' => 'required',
            'phone' => 'required|string',
            'shipping_address' => 'required|string',
            'billing_address' => 'required|string',
        ]);
    
        $order = new Order();
        $order->total = $request->input('total'); 
        $order->user_id = auth()->user()->id; 
        $order->status = 'pending';
        $order->shipping_address = $request->input('shipping_address'); 
        $order->phone = $request->input('phone');
        $order->billing_address = $request->input('billing_address'); 
    
        $order->save();

        return redirect()->route('orders.index');
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
}
