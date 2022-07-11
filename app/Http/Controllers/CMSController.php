<?php

namespace App\Http\Controllers;

use App\Models\CMS;
use Illuminate\Http\Request;

class CMSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cms.index', [
            'title' => 'Collateral Management Services',
            'judul' => 'Daftar Collateral Management Services (CMS)',
            'request' => CMS::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.create', [
            'title' => 'Collateral Management Services',
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

        CMS::create($validated);

        return redirect('/dashboard/collateral-management-services')->with('berhasil', 'Berhasil menambahkan CMS baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CMS  $collateral_management_service
     * @return \Illuminate\Http\Response
     */
    public function show(CMS $collateral_management_service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CMS  $collateral_management_service
     * @return \Illuminate\Http\Response
     */
    public function edit(CMS $collateral_management_service)
    {
        return view('cms.edit', [
            'title' => 'Collateral Management Services',
            'judul' => 'Ubah Data CMS',
            'request' => $collateral_management_service
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CMS  $collateral_management_service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CMS $collateral_management_service)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'hargadasar' => 'required|numeric|min:0',
        ]);

        CMS::where('id', $collateral_management_service->id)->update($validated);

        return redirect('/dashboard/collateral-management-services')->with('berhasil', 'Berhasil mengubah data CMS');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CMS  $collateral_management_service
     * @return \Illuminate\Http\Response
     */
    public function destroy(CMS $collateral_management_service)
    {
        CMS::destroy($collateral_management_service->id);

        return redirect('/dashboard/collateral-management-services')->with('berhasil', 'Berhasil menghapus data CMS');
    }
}
