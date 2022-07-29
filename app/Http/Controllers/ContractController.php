<?php

namespace App\Http\Controllers;

use App\Models\CMS;
use App\Models\Contract;
use App\Models\Depo;
use App\Models\Logistic;
use App\Models\Service;
use App\Models\User;
use App\Models\Warehouse;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Nette\Schema\Context;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $caridata = Contract::all()->where('selesai', false);

        // foreach ($caridata as $item) {
        //     $tanggal = ($item->tglakhir);
        //     $date = new DateTime($tanggal);
        //     $date_minus = $date->modify("-30 days");
        //     $caritglakhir = Contract::whereBetween('tglkonfirmasi', [$date_minus, $item['tglakhir']])->get();
        // }
        // dd($caritglakhir);

        return view('contracts.index', [
            'title' => 'Kontrak',
            'judul' => 'Daftar Kontrak',
            'contract' => Contract::latest()->paginate(10),
            'notif' => Contract::where('selesai', false)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contracts.create', [
            'title' => 'Kontrak',
            'judul' => 'Buat Daftar Kontrak Baru',
            'layanan' => Service::all(),
            'gudang' => Warehouse::latest()->where('aktif', true)->get(),
            'depo' => Depo::latest()->where('aktif', true)->get(),
            'cms' => CMS::latest()->where('aktif', true)->get(),
            'logistic' => Logistic::latest()->where('aktif', true)->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Tanggal
        $tanggal = ($request->tglakhir);
        $date = new DateTime($tanggal);
        $date_minus = $date->modify("-30 days");

        // Mengubah Status
        // $getwarehouse = Contract::where('warehouse_id', $request->warehouse_id)->first();
        // $ubahstatus = $getwarehouse->warehouse->aktif;
        // $tidakaktif = '0';

        $rules1 = [
            'service_id' => 'required|min:1|numeric',
            'manajemen' => 'required',
            'warehouse_id' => ['nullable'],
            'depo_id' => ['nullable'],
            'c_m_s_id' => ['nullable'],
            'logistic_id' => ['nullable'],
            'harga' => 'required|numeric',
            'luassewa' => ['required'],
            'peruntukan' => 'nullable',
            'tglmulai' => 'required',
            'tglakhir' => 'required',
            'keterangan' => 'nullable'
        ];

        // $warehouse = [
        //     'aktif' => [$ubahstatus],
        // ];

        // validasi kontrak
        $validatedData1 = $request->validate($rules1);
        // $validatedData1 = $request->validate($warehouse);
        $validatedData1['tglkonfirmasi'] = $date_minus;
        // $validatedData1['aktif'] = $tidakaktif;

        // Lainnya
        if ($request->nama) {
            if ($request->service_id == 1) {
                $kapital = ucfirst($request->nama);
                $tidaktersedia = isset($request->aktif);
                $rules2 = [
                    'nama' => 'nullable|min:3|unique:warehouses,nama',
                    'aktif' => '0'
                ];

                // validasi gudang
                $validatedData2 = $request->validate($rules2);

                $validatedData2['nama'] = $kapital;
                $validatedData2['aktif'] = $tidaktersedia;

                Warehouse::create($validatedData2);

                $cek = Warehouse::all()->where('nama', $validatedData2['nama'])->first();

                $validatedData1['warehouse_id'] = $cek['id'];
            } elseif ($request->service_id == 2) {
                $kapital = ucfirst($request->nama);
                $tidaktersedia = isset($request->aktif);
                $rules2 = [
                    'nama' => 'nullable|min:3|unique:depos,nama',
                    'aktif' => '0'
                ];

                // validasi depo
                $validatedData2 = $request->validate($rules2);

                $validatedData2['nama'] = $kapital;
                $validatedData2['aktif'] = $tidaktersedia;

                Depo::create($validatedData2);

                $cek = Depo::all()->where('nama', $validatedData2['nama'])->first();

                $validatedData1['depo_id'] = $cek['id'];
            } elseif ($request->service_id == 3) {
                $kapital = ucfirst($request->nama);
                $tidaktersedia = isset($request->aktif);
                $rules2 = [
                    'nama' => 'nullable|min:3|unique:c_m_s,nama',
                    'aktif' => '0'
                ];

                // validasi cms
                $validatedData2 = $request->validate($rules2);

                $validatedData2['nama'] = $kapital;
                $validatedData2['aktif'] = $tidaktersedia;

                CMS::create($validatedData2);

                $cek = CMS::all()->where('nama', $validatedData2['nama'])->first();

                $validatedData1['c_m_s_id'] = $cek['id'];
            } elseif ($request->service_id == 4) {
                $kapital = ucfirst($request->nama);
                $tidaktersedia = isset($request->aktif);
                $rules2 = [
                    'nama' => 'nullable|min:3|unique:logistics,nama',
                    'aktif' => '0'
                ];

                // validasi logistic
                $validatedData2 = $request->validate($rules2);

                $validatedData2['nama'] = $kapital;
                $validatedData2['aktif'] = $tidaktersedia;

                Logistic::create($validatedData2);

                $cek = Logistic::all()->where('nama', $validatedData2['nama'])->first();

                $validatedData1['logistic_id'] = $cek['id'];
            }
        }

        // USER
        if ($request->name) {
            $rules3 = [
                'name' => 'required|min:3',
                'email' => 'required|email:dns|unique:users',
            ];

            $validatedData3 = $request->validate($rules3);
            $validatedData3['username'] = $request->email;
            $validatedData3['password'] = bcrypt('12345678');

            User::create($validatedData3);

            $cekuser = User::all()->where('email', $validatedData3['email'])->first();

            $validatedData1['user_id'] = $cekuser['id'];
        }

        Contract::create($validatedData1);

        return redirect('/dashboard/contract')->with('berhasil', 'Berhasil menambahkan kontrak baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        // return view('contracts.edit', [
        //     'title' => 'Kontrak',
        //     'judul' => 'Ubah Data Kontrak',
        //     'request' => $contract,
        //     'layanan' => Service::all(),
        //     'gudang' => Warehouse::latest()->where('aktif', true)->get(),
        //     'depo' => Depo::latest()->where('aktif', true)->get(),
        //     'cms' => CMS::latest()->where('aktif', true)->get(),
        //     'logistic' => Logistic::latest()->where('aktif', true)->get(),
        // ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        // Tanggal Notifikasi
        $tanggal = ($request->tglakhir);
        $date = new DateTime($tanggal);
        $date_minus = $date->modify("-30 days");

        $rules1 = [
            'tglakhir' => 'required',
            'keterangan' => 'nullable'
        ];

        // validasi kontrak
        $validatedData1 = $request->validate($rules1);
        $validatedData1['tglkonfirmasi'] = $date_minus;

        Contract::where('id', $contract->id)->update($validatedData1);

        return redirect('/dashboard/contract')->with('berhasil', 'Berhasil memperpanjang sewa kontrak');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contract  $contract
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        Contract::destroy($contract->id);

        User::destroy($contract->user_id);

        return redirect('/dashboard/contract')->with('berhasil', 'Berhasil menghapus data kontrak');
    }
}
