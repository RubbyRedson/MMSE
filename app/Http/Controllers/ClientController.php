<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/9/2016
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;


class ClientController extends Controller
{

    public function index(){
        return response()->json($this->dataSource->getAllClients());
    }


    public function getClient($id){

        $client  = $this->dataSource->getClientById($id);

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

        $client = $this->dataSource->getClientById($id);

        $client->name = $request->input('name');
        $client->phone = $request->input('phone');
        $client->discount = $request->input('discount');

        //TODO: Put this in the datasouce instead
        $client->save();

        return response()->json($client);
    }

    public function getProjectSum($id){
        return $this->dataSource->getProjectCostSummation($id);
    }
}