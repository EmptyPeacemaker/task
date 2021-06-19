<?php

namespace App\Http\Controllers;

use App\Models\Deal;
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
        if ($deal->author_id === Auth::id() || $deal->executor_id === Auth::id())return view('user.deal.show', compact('deal'));
        return redirect()->route('deal.index');
    }
}
