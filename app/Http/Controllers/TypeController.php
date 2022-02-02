<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Type;

class TypeController extends Controller
{
    //
    public function index(){

        return Type::all();
    }

    public function store(Request $request){

        $type = new Type;
        $type->type = $request->type;
        $type->save();

        return response()->json([
            "data" => $type
        ]);


    }

    public function destroy($id){

        Type::destroy($id);
    }
}
