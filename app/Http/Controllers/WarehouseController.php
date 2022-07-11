<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('warehouse.index', [
            'title' => 'Warehouse',
            'judul' => 'Daftar Warehouse',
            'request' => Warehouse::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('warehouse.create', [
            'title' => 'Warehouse',
            'judul' => 'Buat Daftar Warehouse Baru'
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

        Warehouse::create($validated);

        return redirect('/dashboard/warehouse')->with('berhasil', 'Berhasil menambahkan Warehouse baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(Warehouse $warehouse)
    {
        return view('warehouse.edit', [
            'title' => 'Warehouse',
            'judul' => 'Ubah Data Warehouse',
            'request' => $warehouse
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'hargadasar' => 'required|numeric|min:0',
            'keterangan' => 'nullable|max:100'
        ]);

        Warehouse::where('id', $warehouse->id)->update($validated);

        return redirect('/dashboard/warehouse')->with('berhasil', 'Berhasil mengubah data Warehouse');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        Warehouse::destroy($warehouse->id);

        return redirect('/dashboard/warehouse')->with('berhasil', 'Berhasil menghapus data Warehouse');
    }
}
