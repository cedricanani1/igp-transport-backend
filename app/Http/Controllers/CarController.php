<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Order;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::with('models','type','rate')->get();
        foreach ($cars as $key => $car) {
            $car->models;
            $car->models->marques;

            $rate=0;
            foreach ($car->rate as $key => $value) {
                $rate += (int) $value->rate;
            }
            if (count($car->rate) > 0) {
                $car->start = round($rate/count($car->rate));
            }else{
                $car->start = 0;
            }
        }

        return response()->json($cars);
    }

    public function searchCar(Request $request)
    {
        $marqueId= $request->marque_id;
        // return response()->json($request->all());
        $cars = Car::with('models','type')->orWhere('car_type_id',$request->type_id)
                                          ->orWhereBetween('price',$request->price)
                                          ->orWhereHas('models', function($q) use ($marqueId){
                                                $q->where('car_marque_id',$marqueId);
                                            })->get();

        foreach ($cars as $key => $car) {
            $car->models;
            $car->models->marques;
            // foreach ( as $key => $model) {
            //     $model->marques;
            // }
        }
        return response()->json($cars);
    }

    public function bestRate()
    {
        $products =  Car::withCount('order','type','rate')->orderByDesc("rate_count")->get();
        foreach ($products as $key => $product) {
            $rate=0;
            foreach ($product->rate as $key => $value) {
                $rate += (int) $value->rate;
            }
            if (count($product->rate) > 0) {
                $product->start = round($rate/count($product->rate));
            }else{
                $product->start =  0;
            }
            $product->type;

        }
        return response()->json($products);
    }
    public function best(Request $request)
    {
        $status= $request->status;
        $products =  Car::withCount('order')->orderByDesc("order_count")->whereHas('order', function($q) use ($status){
            $q->where('status', $status);
        })->get();
        foreach ($products as $key => $product) {
            $rate=0;
            foreach ($product->rate as $key => $value) {
                $rate += (int) $value->rate;
            }

            if (count($product->rate) > 0) {
                $product->start = round($rate/count($product->rate));
            }else{
                $product->start =  0;
            }

        }
        return response()->json($products);
    }
    public function sellerAlltime()
    {

        $cars= Car::has('order')->get();
        $orders =  Order::with('cart')->where('status', 'new')->get();
        foreach ($cars as $key => $car) {
            foreach ($orders as $key => $order) {
                foreach ($order->cart as $key => $cart) {
                   if ($car->id === $cart->car_id) {
                       $car->count += 1;
                       $car->amount += $cart->days * $cart->price;
                   }else{
                    $car->count += 0;
                    $car->amount += 0;
                   }
                }
            }
        }
        return response()->json($cars);
    }

    public function bestview()
    {
        $products =  Car::orderByDesc("view")->orderByDesc("view")->get();

        return response()->json($products);
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
     * @param  \App\Http\Requests\StoreCarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarRequest $request)
    {
        $car =  new Car;
        $car->libelle =  $request->libelle;
        $car->description =  $request->description;
        $car->slug =  $request->slug;
        $car->price =  $request->price;
        $car->discount =  $request->discount;
        $car->mileage =  $request->mileage;
        $car->fuel_type =  $request->fuel_type;
        $car->color_exterior =  $request->color_exterior;
        $car->color_interior =  $request->color_interior;
        $car->transmission =  $request->transmission;
        $car->year =  $request->year;
        $car->car_type_id =  $request->car_type_id;
        $car->car_model_id =  $request->car_model_id;

        $file_path='';
        if (request()->hasFile('photo')) {
            $files = $request->file('photo');
            foreach ($files as $file) {
                $fileName= $file->getClientOriginalName();
                $path = $file->storeAs('Car', $fileName);
                $file_path = $file_path. $path .';';
            }
        }
        $car->photo = $file_path;
        $car->save();
        if ($car) {
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
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function show(Car $car)
    {
        $car->type;
        $car->models;
        $car->rate;
        $rate=0;
        $car->view +=1;
        $car->save();
        foreach ($car->rate as $key => $value) {
            $rate += (int) $value->rate;
        }
        if (count($car->rate) > 0) {
            $car->start = round($rate/count($car->rate));
        }else{
            $car->start = 0;
       }
        $car->models->marques;
        return response()->json($car);
    }


    public function deleteFile(Request $request){
        $car = Car::findOrFail($request->id);
        if ($request->path) {
            File::delete($request->path);
           $file =  str_replace($request->path.';',"",$car->photo);
        }
        $car->photo = $file;
        $car->save();
        return response()->json([
            'state'=> true,
        ]);
    }

    public function addFile(Request $request){
        $car = Car::findOrFail($request->id);

        $filecar = $car->photo;

        if (request()->hasFile('photo')) {
            $files = $request->file('photo');
            foreach ($files as $file) {
                $fileName= $file->getClientOriginalName();
                $path = $file->storeAs('Car', $fileName);
                $filecar = $filecar. $path .';';
            }
        }
        $car->photo =  $filecar;
        $car->save();
        return response()->json([
            'state'=> true,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarRequest  $request
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $car->libelle =  $request->libelle;
        $car->description =  $request->description;
        $car->slug =  $request->slug;
        $car->price =  $request->price;
        $car->discount =  $request->discount;
        $car->mileage =  $request->mileage;
        $car->fuel_type =  $request->fuel_type;
        $car->color_exterior =  $request->color_exterior;
        $car->color_interior =  $request->color_interior;
        $car->transmission =  $request->transmission;
        $car->year =  $request->year;
        $car->car_type_id =  $request->car_type_id;
        $car->car_model_id =  $request->car_model_id;
        $car->save();

        if ($car) {
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
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(Car $car)
    {
        $car->delete();
        if ($car) {
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
