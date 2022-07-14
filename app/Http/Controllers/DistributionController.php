<?php

namespace App\Http\Controllers;

use App\Models\Distribution;
use Illuminate\Http\Request;

class DistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('distributions.index', [
            'title' => 'Distribution',
            'judul' => 'Daftar Distribusi',
            'distribution' => Distribution::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('distributions.create', [
            'title' => 'Distribution',
            'judul' => 'Buat Daftar Distribusi'
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

        Distribution::create($validated);

        return redirect('/dashboard/distribution')->with('berhasil', 'Berhasil menambahkan data distribusi terbaru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function show(Distribution $distribution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function edit(Distribution $distribution)
    {
        return view('distributions.edit', [
            'title' => 'Distribution',
            'judul' => 'Ubah Data Distribusi',
            'distribution' => $distribution
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Distribution $distribution)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'hargadasar' => 'required|numeric|min:0',
        ]);

        Distribution::where('id', $distribution->id)->update($validated);

        return redirect('/dashboard/distribution')->with('berhasil', 'Berhasil mengubah data distribusi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Distribution  $distribution
     * @return \Illuminate\Http\Response
     */
    public function destroy(Distribution $distribution)
    {
        Distribution::destroy($distribution->id);

        return redirect('/dashboard/distribution')->with('berhasil', 'Berhasil menghapus data distribusi');
    }
}
