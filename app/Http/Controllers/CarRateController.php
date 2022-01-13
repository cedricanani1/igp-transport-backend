<?php

namespace App\Http\Controllers;

use App\Models\CarRate;
use App\Http\Requests\StoreCarRateRequest;
use App\Http\Requests\UpdateCarRateRequest;
use App\Services\UserService as User;

class CarRateController extends Controller
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
     * @param  \App\Http\Requests\StoreCarRateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarRateRequest $request)
    {
        $token = $request->header('Authorization');
        $user = $this->userToken($token);
        if (!$user) {
            return response()->json([
                'state' =>false,
                'message' =>'Veillez vous connecter',
            ]);
        }
        $types =  new CarRate;
        $types->rate =  $request->rate;
        $types->object =  $request->object;
        $types->message =  $request->message;
        $types->product_id =  $request->product_id;
        $types->user_id =  $user->id;
        $types->save();
        if ($types) {
            return response()->json([
                'state' =>true
            ]);
        }else{
            return response()->json([
                'state' =>false
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarRate  $carRate
     * @return \Illuminate\Http\Response
     */
    public function show(CarRate $carRate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarRate  $carRate
     * @return \Illuminate\Http\Response
     */
    public function edit(CarRate $carRate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRateRequest  $request
     * @param  \App\Models\CarRate  $carRate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRateRequest $request, CarRate $carRate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarRate  $carRate
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarRate $carRate)
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
