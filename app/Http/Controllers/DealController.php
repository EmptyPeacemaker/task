<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\User;
use App\Models\Application;
use App\Http\Requests\DealSave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
    public function index()
    {
        Auth::loginUsingId(2);
        switch (Auth::user()->role) {
            case 2:
                $role = 'author_id';
                break;
            case 1:
            default:
                $role = 'executor_id';
                break;
        }
        $deals = Deal::where($role, Auth::id())->paginate(10);
        return view('user.deal.index', compact('deals'));
    }

    public function show(Deal $deal)
    {
        if ($deal->author_id === Auth::id() || $deal->executor_id === Auth::id()) {
            $returnData=['deal'=>$deal];
            if ($deal->author_id === Auth::id() && $deal->executor_id===null){
                $returnData['executors']=User::where('role',1)->get();
                $returnData['applications']=$deal->getApplications;
            }
//            if ($deal->author_id === Auth::id()){
//                $executor=User::where('id',$deal->executor_id)->first();
//
//                if ($executor===null){
//                    $applications=$deal->getApplications();
//                    $executors=User::where('role',1)->get();
//                }
//
//            }
//            $executor=$deal->executor_id===null?User::where('role',1)->get():
//            dd();


                //deal
            return view('user.deal.show',$returnData);
        }
        return redirect()->route('deal.index');
    }

    public function save(DealSave $dealSave)
    {
        if ($dealSave->executor_id!==null)return back();
        $data = $dealSave->only(['title', 'description', 'price', 'text']);
        if ($dealSave->time) $data['times'] = $dealSave->time;

        Deal::where('id', $dealSave->id)->first()->update($data);
        return back();
    }
}
