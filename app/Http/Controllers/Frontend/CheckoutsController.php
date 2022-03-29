<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Cart;
use Auth;

class CheckoutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::orderBy('priority', 'asc')->get();
        return view('frontend.pages.checkouts', compact('payments'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone_no' => 'required',
            'shipping_address' => 'required',
            'payment_method_id' => 'required',
        ]);

        $order = new Order();

        // check transaction id has given or not
        if ($request->payment_method_id != 'cash_on') {
            if ($request->transaction_id == NULL || empty($request->transaction_id)) {
                session()->flash('error', 'Please give the transaction id for your payment.!');
                return back();
            }
        }

        if (Auth::check()) {
            $order->user_id = Auth::id();
        }

        $order->name = $request->name;
        $order->phone_no = $request->phone_no;
        $order->email = $request->email;
        $order->message = $request->message;
        $order->shipping_address = $request->shipping_address;
        $order->transaction_id = $request->transaction_id;
        $order->ip_address = request()->ip();

        $order->payment_id = Payment::where('short_name', $request->payment_method_id)->first()->id;

        $order->save();

        foreach (Cart::totalCarts() as $cart) {
            $cart->order_id = $order->id;
            $cart->save();
        }

        session()->flash('success', 'Your order has taken successfully !! Please wait , admin will confirm you soon.');
        return redirect()->route('index');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
