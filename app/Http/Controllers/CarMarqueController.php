<?php

namespace App\Http\Controllers;

use App\Models\CarMarque;
use App\Http\Requests\StoreCarMarqueRequest;
use App\Http\Requests\UpdateCarMarqueRequest;

class CarMarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $carmarques= CarMarque::All();
     return response()->json($carmarques);
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
     * @param  \App\Http\Requests\StoreCarMarqueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarMarqueRequest $request)
    {
        $types =  new CarMarque;
        $types->libelle =  $request->libelle;
        $types->description =  $request->description;
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
     * @param  \App\Models\CarMarque  $carMarque
     * @return \Illuminate\Http\Response
     */
    public function show(CarMarque $carMarque)
    {
        $carMarque->models;
        if ($carMarque) {
            return response()->json($carMarque);
        }else{
            return response()->json([
                'state' =>false
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarMarque  $carMarque
     * @return \Illuminate\Http\Response
     */
    public function edit(CarMarque $carMarque)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarMarqueRequest  $request
     * @param  \App\Models\CarMarque  $carMarque
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarMarqueRequest $request, CarMarque $carMarque)
    {
        $carMarque->libelle =  $request->libelle;
        $carMarque->description =  $request->description;
        $carMarque->save();
        if ($carMarque) {
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarMarque  $carMarque
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarMarque $carMarque)
    {
        $carMarque->delete();
        if ($carMarque) {
            return response()->json([
                'state' =>true
            ]);
        }else{
            return response()->json([
                'state' =>false
            ]);
        }
    }
}
