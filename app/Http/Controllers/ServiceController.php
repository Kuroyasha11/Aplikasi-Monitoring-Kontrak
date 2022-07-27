<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('service.index', [
            'title' => 'Service',
            'judul' => 'Daftar Service',
            'request' => Service::latest()->paginate(10)
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
        // $kapital = ucfirst($request->nama);

        // $validated = $request->validate([
        //     'nama' => 'required|unique:services,nama',
        //     'keterangan' => 'nullable|max:100'
        // ]);

        // $validated['nama'] = $kapital;

        // Service::create($validated);

        // return redirect('/dashboard/service')->with('berhasil', 'Berhasil menambahkan Service baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        // $validated = $request->validate([
        //     'nama' => 'required',
        //     'keterangan' => 'nullable|max:100'
        // ]);

        // Service::where('id', $service->id)->update($validated);

        // return redirect('/dashboard/service')->with('berhasil', 'Berhasil mengubah data Service');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        // Service::destroy($service->id);

        // return redirect('/dashboard/service')->with('berhasil', 'Berhasil menghapus data Service');
    }
}
