<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('storage.index', [
            'title' => 'Storage',
            'judul' => 'Daftar Gudang',
            'storage' => Storage::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('storage.create', [
            'title' => 'Storage',
            'judul' => 'Buat Daftar Gudang Baru'
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

        Storage::create($validated);

        return redirect('/dashboard/storage')->with('berhasil', 'Berhasil menambahkan gedung baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function show(Storage $storage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function edit(Storage $storage)
    {
        return view('storage.edit', [
            'title' => 'Storage',
            'judul' => 'Ubah Data Gudang',
            'storage' => $storage
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Storage $storage)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'hargadasar' => 'required|numeric|min:0',
        ]);

        Storage::where('id', $storage->id)->update($validated);

        return redirect('/dashboard/storage')->with('berhasil', 'Berhasil mengubah data gedung');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Storage  $storage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Storage $storage)
    {
        Storage::destroy($storage->id);

        return redirect('/dashboard/storage')->with('berhasil', 'Berhasil menghapus data gedung');
    }
}
