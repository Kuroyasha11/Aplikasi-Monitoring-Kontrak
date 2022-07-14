<?php

namespace App\Http\Controllers;

use App\Models\Handling;
use Illuminate\Http\Request;

class HandlingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('handling.index', [
            'title' => 'Handling',
            'judul' => 'Daftar Handling',
            'request' => Handling::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('handling.create', [
            'title' => 'Handling',
            'judul' => 'Buat Daftar Handling Baru'
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
            'keterangan' => 'nullable|max:100'
        ]);

        Handling::create($validated);

        return redirect('/dashboard/handling')->with('berhasil', 'Berhasil menambahkan Handling baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Handling  $handling
     * @return \Illuminate\Http\Response
     */
    public function show(Handling $handling)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Handling  $handling
     * @return \Illuminate\Http\Response
     */
    public function edit(Handling $handling)
    {
        return view('handling.edit', [
            'title' => 'Handling',
            'judul' => 'Ubah Data Warehouse',
            'request' => $handling
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Handling  $handling
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Handling $handling)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'hargadasar' => 'required|numeric|min:0',
            'keterangan' => 'nullable|max:100'
        ]);

        Handling::where('id', $handling->id)->update($validated);

        return redirect('/dashboard/handling')->with('berhasil', 'Berhasil mengubah data Handling');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Handling  $handling
     * @return \Illuminate\Http\Response
     */
    public function destroy(Handling $handling)
    {
        Handling::destroy($handling->id);

        return redirect('/dashboard/handling')->with('berhasil', 'Berhasil menghapus data Handling');
    }
}
