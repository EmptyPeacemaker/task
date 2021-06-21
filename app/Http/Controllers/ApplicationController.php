<?php

namespace App\Http\Controllers;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Requests\ApplicationAdd;

class ApplicationController extends Controller
{
    public function addApplication(ApplicationAdd $applicationAdd)
    {
        if (Application::where('deal_id',$applicationAdd->deal_id)->where('executor_id',$applicationAdd->executor_id)->first())return back();
        Application::create(($applicationAdd->only('deal_id','executor_id')));
        return back();
    }

    public function delete(Application $application)
    {
        $application->delete();
        return back();
    }
}
