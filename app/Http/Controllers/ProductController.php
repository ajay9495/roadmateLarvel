<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;




    function TestFunction(Request $request){

        $req = $request->all();

        $result =  DB::table('test')
        ->where('test.name', 'like', "%{$req['query']}%")
        ->get();


        return response()->json([
            "status" => "success",
            "payload" => $result
        ]);



    }

    function Read(Request $request){

        $result =  DB::table('test')
        ->get();


        return response()->json([
            "status" => "success",
            "payload" => $result
        ]);


    }


    function Search(Request $request){

        $req = $request->all();

        $result =  DB::table('test')
        ->where('test.name', 'like', "%{$req['query']}%")
        ->get();


        return response()->json([
            "status" => "success",
            "payload" => $result
        ]);

        
    }



    

    function Insert(Request $request){


        $payload = [

            'name'=> 'server test'

        ];

        $result = DB::table('test')
                    ->insertGetId($payload);


        return response()->json([
            "status" => "success",
            "message" => $result
        ]);
    }






}
