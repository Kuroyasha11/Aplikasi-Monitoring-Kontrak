<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Service;
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
        // dd($date_minus);
        // $new = $request->tglmulai = new Carbon();
        // $new->addDays(10);
        // dd($new);
        $rules1 = [
            'service_id' => 'required|min:1|numeric',
            'manajemen' => 'required',
            'namapelanggan' => 'required|min:3',
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
        $validatedData1['tglsblm'] = $date_minus;

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
        $rules1 = [
            'service_id' => 'required|min:1|numeric',
            'manajemen' => 'required',
            'namapelanggan' => 'required|min:3',
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

        return redirect('/dashboard/contract')->with('berhasil', 'Berhasil menghapus data kontrak');
    }
}
