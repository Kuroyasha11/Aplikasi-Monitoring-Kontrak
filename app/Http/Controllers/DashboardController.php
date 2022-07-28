<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\CMS;
use App\Models\Depo;
use App\Models\Logistic;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $gudang = Warehouse::all()->count();
        $contract = Contract::all()->count();
        $cms = CMS::all()->count();
        $depo = Depo::all()->count();
        $logistic = Logistic::all()->count();
        $user = User::where('is_admin', '0')->count();
        $datacontract = Contract::where('user_id', '=', Auth::user()->id)->first();
        $title = 'Home';
        $judul = 'Dashboard';
        return view('index', compact([
            'gudang', 'contract', 'cms', 'depo', 'logistic', 'user','datacontract',
            'title',
            'judul'
        ]));
    }
}
