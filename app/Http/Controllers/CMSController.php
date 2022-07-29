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
            'title' => 'CMS',
            'judul' => 'Daftar CMS',
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
            'nama' => 'required|unique:c_m_s,nama',
            'keterangan' => 'nullable|max:100'
        ]);

        $validated['nama'] = $kapital;

        CMS::create($validated);

        return redirect('/dashboard/cms')->with('berhasil', 'Berhasil menambahkan CMS baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CMS  $cm
     * @return \Illuminate\Http\Response
     */
    public function show(CMS $cm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CMS  $cm
     * @return \Illuminate\Http\Response
     */
    public function edit(CMS $cm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CMS  $cm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CMS $cm)
    {
        $rules = [
            'nama' => 'required',
            'keterangan' => 'nullable|max:100'
        ];

        // if (isset($request->aktif)) {
        //     if ($request->aktif != $cm->aktif) {
        //         $rules['aktif'] = 'required';
        //     }

        //     $validated = $request->validate($rules);
        // } else {
        //     $request->merge([
        //         'aktif' => 0
        //     ]);

        //     if ($request->aktif != $cm->aktif) {
        //         $rules['aktif'] = 'required';
        //     }
        //     $validated = $request->validate($rules);
        // }
        $validated = $request->validate($rules);
        CMS::where('id', $cm->id)->update($validated);

        return redirect('/dashboard/cms')->with('berhasil', 'Berhasil mengubah data CMS');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CMS  $cm
     * @return \Illuminate\Http\Response
     */
    public function destroy(CMS $cm)
    {
        CMS::destroy($cm->id);

        return redirect('/dashboard/cms')->with('berhasil', 'Berhasil menghapus data CMS');
    }
}
