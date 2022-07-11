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
        return view('depos.index', [
            'title' => 'Depo Container',
            'judul' => 'Daftar Depo Container',
            'depo' => Depo::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('depos.create', [
            'title' => 'Depo Container',
            'judul' => 'Buat Daftar Depo Container Baru'
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
            'nama' => 'required',
            'hargadasar' => 'required|numeric|min:0',
        ]);

        Depo::create($validated);

        return redirect('/dashboard/depo-container')->with('berhasil', 'Berhasil menambahkan data depo container terbaru');
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
    public function edit(Depo $depo_container)
    {
        return view('depos.edit', [
            'title' => 'Depo Container',
            'judul' => 'Ubah Data Depo Container',
            'depo' => $depo_container
        ]);
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
            'hargadasar' => 'required|numeric|min:0',
        ]);

        Depo::where('id', $depo->id)->update($validated);

        return redirect('/dashboard/depo-container')->with('berhasil', 'Berhasil mengubah data depo container');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Depo  $depo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Depo $depo_container)
    {
        Depo::destroy($depo_container->id);

        return redirect('/dashboard/depo-container')->with('berhasil', 'Berhasil menghapus data depo container');
    }
}
