<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 10/9/2016
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;

use App\PlanningRequest;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;


class PlanningRequestController extends Controller
{
    public function index(){
        $planningRequests = $this->dataSource->getAllPlanningRequests();
        return response()->json($planningRequests);
    }

    public function getPlanningRequestForCustomerServiceManager(){
        $planningRequests = $this->dataSource->getPlanningRequestsByStatusId(1);

        return response()->json($planningRequests);
    }

    public function getPlanningRequestForFinancialManager(){
        $planningRequests = $this->dataSource->getPlanningRequestsByStatusId(2);

        return response()->json($planningRequests);
    }

    public function updatePlanningRequestFromCustomerServiceManager(Request $request, $id){
        $statusId = $request->input("status");
        if($statusId  == 2 || $statusId  == 5){
            return $this->dataSource->setPlanningRequestsStatus($id, $statusId);
        }else{
            return response("Bad request. You cannot set this status.", 400);
        }
    }

    public function updatePlanningRequestFromFinancialManager(Request $request, $id){
        $statusId = $request->input("status");
        if($statusId  == 3 || $statusId  == 5){
            return $this->dataSource->setPlanningRequestsStatus($id, $statusId);
        }else{
            return response("Bad request. You cannot set this status.", 400);
        }
    }

    public function getPlanningRequest($id){

        $planningRequest  = PlanningRequest::find($id);

        return response()->json($planningRequest);
    }

    public function savePlanningRequest(Request $request){

        $r = new PlanningRequest($request->all());
        $r->status = 1;
        return $this->dataSource->savePlanningRequest($r);

       // $planningRequest = PlanningRequest::create($request->all());
       // return response()->json($planningRequest);
    }

    public function deletePlanningRequest($id){
        $planningRequest  = PlanningRequest::find($id);

        $planningRequest->delete();

        return response()->json('success');
    }

    public function updatePlanningRequest(Request $request,$id){
        $planningRequest  = PlanningRequest::find($id);

        $planningRequest->client = $request->input('client');
        $planningRequest->status = $request->input('status');
        $planningRequest->feedback = $request->input('feedback');

        $planningRequest->save();

        return response()->json($planningRequest);
    }
}