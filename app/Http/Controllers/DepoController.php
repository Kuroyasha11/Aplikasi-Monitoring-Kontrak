<?php

namespace App\Http\Controllers;

use App\Models\Depo;
use Illuminate\Http\Request;

class DepoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('depo.index', [
            'title' => 'Depo',
            'judul' => 'Daftar Depo',
            'request' => Depo::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kapital = ucfirst($request->nama);

        $validated = $request->validate([
            'nama' => 'required|unique:depos,nama',
            'keterangan' => 'nullable|max:100'
        ]);

        $validated['nama'] = $kapital;

        Depo::create($validated);

        return redirect('/dashboard/depo')->with('berhasil', 'Berhasil menambahkan Depo baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Depo  $depo
     * @return \Illuminate\Http\Response
     */
    public function show(Depo $depo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Depo  $depo
     * @return \Illuminate\Http\Response
     */
    public function edit(Depo $depo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Depo  $depo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Depo $depo)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'keterangan' => 'nullable|max:100'
        ]);

        Depo::where('id', $depo->id)->update($validated);

        return redirect('/dashboard/depo')->with('berhasil', 'Berhasil mengubah data Depo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Depo  $depo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Depo $depo)
    {
        Depo::destroy($depo->id);

        return redirect('/dashboard/depo')->with('berhasil', 'Berhasil menghapus data Depo');
    }
}
