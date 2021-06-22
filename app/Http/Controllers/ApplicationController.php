<?php

namespace App\Http\Controllers;
use App\Models\Application;
use App\Models\Deal;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\ApplicationAdd;
use Illuminate\Support\Facades\Auth;

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

    public function index()
    {
        $applications=Auth::user()->getApplications->where('status','!=',3);
        return view('user.applications',compact('applications'));
    }

    public function refuse(Application $application)
    {
        if ($application->executor_id===Auth::id())$application->update(['status'=>3]);
        return back();
    }

    public function accept(Application $application)
    {
        if ($application->executor_id===Auth::id())$application->update(['status'=>2]);
        return back();
    }

    public function select(Application $application,User $user)
    {
        Deal::where('id',$application->getDeal->id)->update(['executor_id'=>$user->id,'status_id'=>3]);
        Application::where('deal_id',$application->deal_id)->delete();
        return back();
    }
}
