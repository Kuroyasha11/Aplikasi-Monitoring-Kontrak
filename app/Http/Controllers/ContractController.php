<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Service;
use App\Models\User;
use App\Models\Warehouse;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contracts.index', [
            'title' => 'Kontrak',
            'judul' => 'Daftar Kontrak',
            'contract' => Contract::latest()->paginate(10)
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
            'gudang' => Warehouse::latest()->get(),
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
        $tanggal = ($request->tglakhir);
        $date = new DateTime($tanggal);
        $date_minus = $date->modify("-13 days");

        $rules1 = [
            'service_id' => 'required|min:1|numeric',
            'manajemen' => 'required',
            'warehouse_id' => ['nullable'],
            'namamitra' => ['nullable', 'min:3'],
            'harga' => 'required|numeric',
            'luassewa' => ['required'],
            'peruntukan' => 'nullable',
            'tglmulai' => 'required',
            'tglakhir' => 'required',
            'keterangan' => 'nullable'
        ];

        // validasi kontrak
        $validatedData1 = $request->validate($rules1);
        $validatedData1['tglkonfirmasi'] = $date_minus;

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

        // GUDANG
        if ($request->nama) {
            $kapital = ucfirst($request->nama);
            $rules2 = [
                'nama' => 'nullable|min:3|unique:warehouses,nama'
            ];

            // validasi gudang
            $validatedData2 = $request->validate($rules2);

            $validatedData2['nama'] = $kapital;

            Warehouse::create($validatedData2);

            $cekgudang = Warehouse::all()->where('nama', $validatedData2['nama'])->first();

            $validatedData1['warehouse_id'] = $cekgudang['id'];
        }


        Contract::create($validatedData1);

        return redirect('/dashboard/contract')->with('Berhasil', 'Berhasil menambahkan kontrak baru');
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
        return view('contracts.edit', [
            'title' => 'Kontrak',
            'judul' => 'Ubah Data Kontrak',
            'request' => $contract,
            'layanan' => Service::all(),
            'gudang' => Warehouse::latest()->get(),
        ]);
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
        $date_minus = $date->modify("-13 days");

        $rules1 = [
            'service_id' => 'required|min:1|numeric',
            'manajemen' => 'required',
            'harga' => 'required|numeric',
            'warehouse_id' => 'nullable',
            'namamitra' => 'nullable|min:3',
            'luassewa' => ['required'],
            'peruntukan' => 'nullable',
            'tglmulai' => 'required',
            'tglakhir' => 'required',
            'keterangan' => 'nullable'
        ];

        // $cekdatagudangkontrak = Warehouse::all()->where('id', $contract->warehouse_id);
        // if ($request->warehouse_id != $cekdatagudangkontrak->id) {
        //     $rules1['warehouse_id'] = 'nullable';
        // } elseif ($request->warehouse_id) {
        //     $rules1['warehouse_id'] = 'nullable';
        // }

        // if ($request->namamitra != $contract->namamitra) {
        //     $rules1['namamitra'] = 'nullable|min:3';
        // } elseif ($request->namamitra) {
        //     $rules1['namamitra'] = 'nullable|min:3';
        // }
        // validasi kontrak
        $validatedData1 = $request->validate($rules1);
        $validatedData1['tglkonfirmasi'] = $date_minus;

        $cekdatauser = User::all()->where('id', $contract->user_id)->first();
        // USER
        if ($request->name != $cekdatauser->name) {
            $rules3 = [
                'name' => 'required|min:3',
            ];

            if ($request->email != $cekdatauser->email) {
                $rules3['email'] = 'required|email:dns|unique:users';
            }

            $validatedData3 = $request->validate($rules3);
            if ($request->email != $cekdatauser->email) {
                $validatedData3['username'] = $validatedData3['email'];
            }
            $validatedData3['password'] = bcrypt('12345678');

            User::where('id', $contract->user_id)->update($validatedData3);
        }

        $cekdatagudang  = Warehouse::all()->where('id', $contract->warehouse_id)->first();
        // GUDANG
        if ($request->nama) {
            if ($request->nama != $cekdatagudang->nama) {
                $kapital = ucfirst($request->nama);
                $rules2 = [
                    'nama' => 'nullable|min:3|unique:warehouses,nama'
                ];

                // validasi gudang
                $validatedData2 = $request->validate($rules2);

                $validatedData2['nama'] = $kapital;

                Warehouse::create($validatedData2);

                $cekgudang = Warehouse::all()->where('nama', $validatedData2['nama'])->first();

                $validatedData1['warehouse_id'] = $cekgudang['id'];
            }
        }

        if ($request->warehouse_id == null) {
            Contract::where('id', $contract->id)->update(['warehouse_id' => null]);
        } elseif ($request->namamitra == null) {
            Contract::where('id', $contract->id)->update(['namamitra' => null]);
        }

        Contract::where('id', $contract->id)->update($validatedData1);

        return redirect('/dashboard/contract')->with('berhasil', 'Berhasil mengubah data kontrak');
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
