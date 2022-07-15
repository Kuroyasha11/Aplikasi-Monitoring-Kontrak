<?php

namespace App\Http\Controllers;

use App\Models\Contract;
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
            'judul' => 'Buat Daftar Kontrak Baru'
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
        $validated = $request->validate([
            'jenislayanan' => 'required',
            'namagudang' => 'required',
            'manajemen' => 'required',
            'namapelanggan' => 'required',
            'harga' => 'required',
            'luassewa' => 'required',
            'peruntukan' => 'required',
            'tglmulai' => 'required',
            'tglakhir' => 'required',
            'keterangan' => 'nullable',
            'tglakhir' => 'nullable',
            'sisasewa' => 'nullable '
        ]);

        Contract::create($validated);

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
            'contract' => $contract
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
        $validated = $request->validate([
            'storage_id' => 'required',
            'nama' => 'required',
            'keterangan' => 'required',
        ]);

        Contract::where('id', $contract->id)->update($validated);

        return redirect('')->with('berhasil', 'Berhasil mengubah data kontrak');
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
