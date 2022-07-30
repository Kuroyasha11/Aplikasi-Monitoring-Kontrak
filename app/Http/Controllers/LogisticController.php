<?php

namespace App\Http\Controllers;

use App\Models\Logistic;
use Illuminate\Http\Request;

class LogisticController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('logistic.index', [
            'title' => 'Logistic',
            'judul' => 'Daftar Logistic',
            'request' => Logistic::latest()->paginate(10)
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
            'nama' => 'required|unique:Logistics,nama',
            'keterangan' => 'nullable|max:100'
        ]);

        $validated['nama'] = $kapital;

        Logistic::create($validated);

        return redirect('/dashboard/logistic')->with('berhasil', 'Berhasil menambahkan Logistic baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Logistic  $logistic
     * @return \Illuminate\Http\Response
     */
    public function show(Logistic $logistic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Logistic  $logistic
     * @return \Illuminate\Http\Response
     */
    public function edit(Logistic $logistic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Logistic  $logistic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Logistic $logistic)
    {
        $rules = [
            'nama' => 'required',
            'keterangan' => 'nullable|max:100'
        ];

        // if (isset($request->aktif)) {
        //     if ($request->aktif != $logistic->aktif) {
        //         $rules['aktif'] = 'required';
        //     }

        //     $validated = $request->validate($rules);
        // } else {
        //     $request->merge([
        //         'aktif' => 0
        //     ]);

        //     if ($request->aktif != $logistic->aktif) {
        //         $rules['aktif'] = 'required';
        //     }
        //     $validated = $request->validate($rules);
        // }
        $validated = $request->validate($rules);
        Logistic::where('id', $logistic->id)->update($validated);

        return redirect('/dashboard/logistic')->with('berhasil', 'Berhasil mengubah data Logistic');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Logistic  $logistic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Logistic $logistic)
    {
        Logistic::destroy($logistic->id);

        return redirect('/dashboard/logistic')->with('berhasil', 'Berhasil menghapus data Logistic');
    }
}
