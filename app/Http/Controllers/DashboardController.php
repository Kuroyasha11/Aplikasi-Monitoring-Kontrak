<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\Service;

class DashboardController extends Controller
{
    public function index()
    {
        $gudang = Warehouse::all()->count();
        $contract = Contract::all()->count();
        $user = User::where('is_admin', '0')->count();
        $service = Service::all()->count();
        $title = 'Home';
        $judul = 'Dashboard';
        return view('index', compact([
            'gudang', 'contract', 'user', 'service',
            'title',
            'judul'
        ]));
    }
}
