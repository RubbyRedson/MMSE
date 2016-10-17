<?php
/**
 * Created by PhpStorm.
 * JobAdvertisement: Nick
 * Date: 10/9/2016
 * Time: 2:47 PM
 */

namespace App\Http\Controllers;

use App\JobAdvertisement;
use Illuminate\Http\Request;


class JobAdvertisementController extends Controller
{
    public function index(){

        $job_advertisements = $this->dataSource->getAllJobAdvertisements();

        return response()->json($job_advertisements);

    }

    public function getJobAdvertisement($id){

        $job_advertisement = $this->dataSource->getJobAdvertisementById($id);

        return response()->json($job_advertisement);
    }

    public function saveJobAdvertisement(Request $request){

        $job_advertisement = $this->dataSource->saveJobAdvertisement(new JobAdvertisement($request->all()));
        return response()->json($job_advertisement);

    }

    public function deleteJobAdvertisement($id){
        $this->dataSource->deleteJobAdvertisementById($id);
        return response()->json('success');
    }

    public function updateJobAdvertisement(Request $request,$id){
        $jobAdvertisement = $this->dataSource->getJobAdvertisementById($id);
        $jobAdvertisement->title = $request->input('title');
        $jobAdvertisement->description = $request->input('description');
        $jobAdvertisement->salary = $request->input('salary');
        $jobAdvertisement->count = $request->input('count');
        $jobAdvertisement = $this->dataSource->saveJobAdvertisement($jobAdvertisement);

        return response()->json($jobAdvertisement);
    }
}