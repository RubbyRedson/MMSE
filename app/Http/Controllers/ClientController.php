<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/9/2016
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;

use App\Client;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;


class ClientController extends BaseController
{
    public function index(){

        $clients  = Client::all();

        return response()->json($clients);

    }

    public function getClient($id){

        $client  = Client::find($id);

        return response()->json($client);
    }

    public function saveClient(Request $request){

        $client = Client::create($request->all());

        return response()->json($client);

    }

    public function deleteClient($id){
        $client  = Client::find($id);

        $client->delete();

        return response()->json('success');
    }

    public function updateClient(Request $request,$id){
        $client  = Client::find($id);


        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->discount = $request->input('discount');

        $client->save();

        return response()->json($client);
    }
}