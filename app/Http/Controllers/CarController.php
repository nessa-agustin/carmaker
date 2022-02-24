<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Car::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('carmaker');



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        // $validation = $request->validate([
        //     'car_name' => 'required',
        //     'manufacturer' => 'required',
        //     'type' => 'required',
        //     'color' => 'required',
        // ]);

        // if($validation->fails){
        //     return response()->json([
        //         "error" => $validation->errors()->messages()
        //     ]); 
        // } 

        // REMOVED: not returning error
        
            $car = new Car;

            $car->car_name = $request->car_name;
            $car->manufacturer = $request->manufacturer;
            $car->type = $request->type;
            $car->color = $request->color;

            $car->save();

            return response()->json([
                "car" => $car
            ]);
        
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
        $car = Car::find($id);

        return response()->json([
            "car" => $car
        ]);

    }
}
