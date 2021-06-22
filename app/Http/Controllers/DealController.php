<?php

namespace App\Http\Controllers;

use App\Http\Requests\createDeal;
use App\Models\Deal;
use App\Models\User;
use App\Models\Application;
use App\Http\Requests\DealSave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DealController extends Controller
{
    public function ready(Deal $deal)
    {
        $deal->update(['status_id'=>4]);
        return redirect()->route('deal');
    }
    public function delete(Deal $deal)
    {
        Application::where('deal_id',$deal->id)->delete();
        $deal->delete();
        return redirect()->route('deal');
    }
    public function newDeal()
    {
        if (Auth::user()->role!==2)return back();

        if (\Illuminate\Support\Facades\App::environment('local')){
            $deal=new Deal();
            $deal->title="Title test";
            $deal->description="Description test";
            $deal->price=rand(100,1000);
            $deal->times=rand(60,99999);
            $deal->text="Text test";
            return view('user.deal.create',compact('deal'));
        }

        return view('user.deal.create');
    }

    public function create(createDeal $createDeal)
    {
        $data=$createDeal->only(['title','description','price','times','text'])+['author_id'=>Auth::id(),'status_id'=>1];

        if ($createDeal->img){
            preg_match('/img\/\w+\.\w+/',$createDeal->file('img')->store('public/img'),$path);
            $data['img']='/storage/'.$path[0];
        }

        return redirect()->route('deal.show',['deal'=>Deal::create($data)->id]);
    }
    public function index()
    {
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
        if ($deal->author_id === Auth::id() || $deal->executor_id === Auth::id() ||
            ($deal->whereHas('getApplications',function ($table){
                $table->where('executor_id',Auth::id());
            })->first() && $deal->executor_id===null)) {
            $returnData=['deal'=>$deal];
            if ($deal->author_id === Auth::id() && $deal->executor_id===null){
                $returnData['executors']=User::with('getApplications')->where('role',1)->doesntHave('getApplications')->get();
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
            return view('user.deal.create',$returnData);
        }
        return redirect()->route('deal');
    }

    public function save(DealSave $dealSave)
    {
        if ($dealSave->executor_id!==null)return back();
        $data = $dealSave->only(['title', 'description', 'price', 'text']);
        if ($dealSave->times) $data['times'] = $dealSave->times;

        Deal::where('id', $dealSave->id)->first()->update($data);
        return back();
    }
}
