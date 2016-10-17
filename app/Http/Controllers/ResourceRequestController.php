<?php
/**
 * Created by PhpStorm.
 * User: victoraxelsson
 * Date: 2016-10-17
 * Time: 10:33
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ResourceRequestController extends Controller
{

    /**
     * Creates a new resource request
     * */
    public function createNewRequest(Request $request){
        $data = $request->all();

        $data['approved'] = false;

        if($data['type'] == 'budget' || $data['type'] == 'people'){
            return $this->dataSource->createResourceRequest($data);
        }else{
            return response("Bad request, the type needs to be either: people or budget.", 400);
        }
    }

    public function removeResourceRequestHR($id){
        $res = $this->dataSource->getResourceRequestById($id);

        if($res){
            if($res->type == 'people'){
                $this->dataSource->deleteResourceRequestById($id);
                return response()->json('success');
            }else{
                return response("Unauthorized. You are not authorized to remove this resource request type.", 401);
            }
        }else{
            return response("ok");
        }
    }

    public function getHrRequests(Request $request){
        return $this->dataSource->getResourceRequestByType('people');
    }

}