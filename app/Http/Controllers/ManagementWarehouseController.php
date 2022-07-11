<?php

namespace App\Http\Controllers;

use App\Models\ManagementWarehouse;
use Illuminate\Http\Request;

class ManagementWarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('management_warehouse.index', [
            'title' => 'Management Warehouse',
            'judul' => 'Daftar Management Warehouse',
            'request' => ManagementWarehouse::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('management_warehouse.create', [
            'title' => 'Management Warehouse',
            'judul' => 'Buat Daftar Management Warehouse Baru'
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

        ManagementWarehouse::create($validated);

        return redirect('/dashboard/management-warehouse')->with('berhasil', 'Berhasil menambahkan Management Warehouse baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ManagementWarehouse  $management_warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(ManagementWarehouse $management_warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ManagementWarehouse  $management_warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit(ManagementWarehouse $management_warehouse)
    {
        return view('management_warehouse.edit', [
            'title' => 'Management Warehouse',
            'judul' => 'Ubah Data Warehouse',
            'request' => $management_warehouse
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ManagementWarehouse  $management_warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManagementWarehouse $management_warehouse)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'hargadasar' => 'required|numeric|min:0',
            'keterangan' => 'nullable|max:100'
        ]);

        ManagementWarehouse::where('id', $management_warehouse->id)->update($validated);

        return redirect('/dashboard/management-warehouse')->with('berhasil', 'Berhasil mengubah data Management Warehouse');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ManagementWarehouse  $management_warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManagementWarehouse $management_warehouse)
    {
        ManagementWarehouse::destroy($management_warehouse->id);

        return redirect('/dashboard/management-warehouse')->with('berhasil', 'Berhasil menghapus data Management Warehouse');
    }
}
