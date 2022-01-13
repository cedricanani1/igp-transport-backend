<?php

namespace App\Http\Controllers;

use App\Models\OrderCar;
use App\Http\Requests\StoreOrderCarRequest;
use App\Http\Requests\UpdateOrderCarRequest;

class OrderCarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreOrderCarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderCarRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderCar  $orderCar
     * @return \Illuminate\Http\Response
     */
    public function show(OrderCar $orderCar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderCar  $orderCar
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderCar $orderCar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderCarRequest  $request
     * @param  \App\Models\OrderCar  $orderCar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderCarRequest $request, OrderCar $orderCar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderCar  $orderCar
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderCar $orderCar)
    {
        //
    }
}
