<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;



    function AddProductData(Request $request){

        $validator = Validator::make($request->all(), [
            "name" => 'required|string'
        ]);


        if (!$validator->fails()) {

            $req = $request->all();
    

            $payload = [
                'name'=> $req["name"],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $result = DB::table('products')
                        ->insert($payload);

            if($result){

                return response()->json([
                    "status" => "success",
                    "message" =>  "Successfully entered data into the database" 
                ]);
            }
            else{

                return response()->json([
                    "status" => "failed",
                    "message" =>  "Failed to enter data into the database" 
                ]);
            }

        }
        else{
            return response()->json(['status' => "failed",'message' => 'Failed to fetch query', 'errors' => $validator->errors()]);
        }

    }

    function SearchProductData(Request $request){


        $validator = Validator::make($request->all(), [
            "query" => 'required|string'
        ]);


        if (!$validator->fails()) {
            

            $req = $request->all();

            $result =  DB::table('products')
            ->where('products.name', 'like', "%{$req['query']}%")
            ->select('id','name')
            ->get();
    
            return response()->json([
                "status" => "success",
                "payload" => $result
            ]);

        }
        else{
            return response()->json(['status' => "failed",'message' => 'Failed to fetch query', 'errors' => $validator->errors()]);
        }

    }

    function GetAllProductsData(Request $request){

        $result =  DB::table('products')
        ->select('id','name')
        ->get();

        return response()->json([
            "status" => "success",
            "payload" => $result,
            "message" => "Succesfully got data from the server"
        ]);

    }



    function TestFunction(Request $request){


        $validator = Validator::make($request->all(), [
            "query" => 'required'
        ]);


        if (!$validator->fails()) {
            
            return response()->json(['status' => "success"]);
        }
        else{
            return response()->json(['status' => "failed",'message' => 'Failed to fetch query', 'errors' => $validator->errors()]);
        }

        // $req = $request->all();

        // return response()->json([
        //     "status" => "success",
        //     "payload" => $req
        // ]);



    }

}
