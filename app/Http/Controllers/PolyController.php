<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Poly;
use App\Models\Queue;
use Illuminate\Http\Request;

class PolyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $polies = Poly::latest()->get();

        $doctors = [];
        $queues = [];
        // get doctor and queue with poly -> count
        foreach ($polies as $poly) {
            $doctors[] = Doctor::where('id_poli', $poly->id_poli)->get();
            $queues[] = Queue::where('id_poli', $poly->id_poli)->get();
        }

        return view('polies.index', [
            'pageTitle' => 'Data Poli',
            'polies' => $polies,
            'doctors' => collect($doctors)->map(function ($doctor) {
                return $doctor->count();
            }),
            'queues' => collect($queues)->map(function ($queue) {
                return $queue->count();
            })
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
        $validatedData = $request->validate([
            'id_poli' => ['required', 'unique:polies', 'size:5'],
            'nama_poli' => ['required', 'max:100']
        ]);

        Poly::create($validatedData);

        return redirect()->route('poli.index')->with('success', 'Data berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Poly  $poly
     * @return \Illuminate\Http\Response
     */
    public function show(Poly $poly)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Poly  $poly
     * @return \Illuminate\Http\Response
     */
    public function edit(Poly $poli)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Poly  $poly
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Poly $poli)
    {

        $rules = [
            'nama_poli' => ['required', 'max:100']
        ];

        if ($poli->id_poli !== $request->id_poli) {
            $rules['id_poli'] = ['required', 'unique:polies', 'size:5'];
        }

        $validatedData = $request->validate($rules);

        Poly::where('id_poli', $poli->id_poli)->update($validatedData);

        return redirect()->route('poli.index')->with('success', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Poly  $poly
     * @return \Illuminate\Http\Response
     */
    public function destroy(Poly $poli)
    {
        Poly::where('id_poli', $poli->id_poli)->delete();
        return back()->with('success', 'Data berhasil dihapus');
    }
}