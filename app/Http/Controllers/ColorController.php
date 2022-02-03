<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    //

    public function index(){

        return Color::all();
    }

    public function store(Request $request){

        $color = new Color;

        $color->color = $request->color;
        $color->save();

        return response()->json([
            "data" => $color
        ]);


    }

    public function destroy($id){

        Color::destroy($id);
    }
}
