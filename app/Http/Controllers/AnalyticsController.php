<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index()
    {
        $total_paid = count(DB::table('delegates')->where([['paid', '=', 1],['deleted','=',0]])->get()->toArray());
        $total_unpaid = count(DB::table('delegates')->where([['paid', '=', 0],['deleted','=',0]])->get()->toArray());
        $total_registered = count(DB::table('delegates')->where('deleted','=',0)->get()->toArray());
        $analytics = ['total_paid' => $total_paid, 'total_unpaid' => $total_unpaid, 'total_registered' => $total_registered];
        return view('analytics.index', compact('analytics'));
    }
}
