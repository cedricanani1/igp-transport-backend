<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Car;
use App\Models\OrderCar;
use Illuminate\Support\Str;
use App\Services\UserService as User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products =  Order::with('cart')->orderBy('updated_at', 'DESC')->get();

        return response()->json($products);
    }

    public function ordersClient(Request $request)
    {
        $token = $request->header('Authorization');
        $user = $this->userToken($token);
        if ($user) {
            $orders =  Order::with('cart')->where('user_id',$user->id)->orderBy('updated_at', 'DESC')->get();
        }else{
            return response()->json([
                'state' =>false,
                'message' =>'Veillez vous connecter',
            ]);
        }

        return response()->json($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {

        $token = $request->header('Authorization');
        $user = $this->userToken($token);
        if (!$user) {
            return response()->json([
                'state' =>false,
                'message' =>'Veillez vous connecter',
            ]);
        }
        if (count($request->cart)==0) {
            return response()->json([
                'state' =>false,
                'message' =>'Votre panier est vide',
            ]);
        }
        $order =  new Order();
        $order->order_number =  'ORD-'.strtoupper(Str::random(10));
        $order->user_id =  $user->id;
        $order->total_amount =  $request->total_amount;
        $order->payment_status =  'unpaid';
        $order->status =  'new';
        $order->nom =  $request->nom;
        $order->prenoms =  $request->prenoms;
        $order->email =  $request->email;
        $order->phone =  $request->phone;
        $order->shipping =  $request->shipping;
        $order->location =  $request->location;

        $order->save();
        $amount = 0;
        foreach ($request->cart as $key =>  $item) {
            $cart =  new OrderCar();
            $product =  Car::findOrFail($item['id']);

            if ($product) {
                $cart->order_id =  $order->id;
                $cart->car_id =  $item['id'];
                // $cart->quantity =  1;
                $cart->price =  $product->price;
                $cart->days =  $item['days'];
                $cart->to =  $item['to'];
                $cart->from =  $item['from'];
                $cart->driver =  $item['driver'];
                // $cart->other =  $item['other'];
                $amount += $product->price;
                $cart->save();
            }
        }
        $order->total_amount =  $amount;
        $order->save();

        if ($order) {
            return response()->json([
                'state' =>true,
            ]);
        }else{
            return response()->json([
                'state' =>false,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Order $order)
    {
        $token = $request->header('Authorization');
        $user = $this->userToken($token);
        if (!$user) {
            return response()->json([
                'state' =>false,
                'message' =>'Veillez vous connecter',
            ]);
        }
        $order->cart;
        foreach ($order->cart as $key => $value) {
            $value->car;
        }
        if ($order) {
            return response()->json([
                'state' =>true,
                'data' =>$order,
            ]);
        }else{
            return response()->json([
                'state' =>false,
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
    private function userToken($token){

        if(User::get($token)->success == true) {
            return User::get($token)->user;
        }else{
            return null;
        }
    }
}
