<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Poly;
use App\Models\Queue;
use Illuminate\Http\Request;

class QueueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queues = Queue::all();

        if (auth()->user()->role === 'dokter') {
            $queues = Queue::where('id_poli', auth()->user()->doctor->id_poli)->get();
        }

        return view('queues.index', [
            'pageTitle' => 'Data Antrian',
            'queues'    => $queues,
            'patients'  => Patient::latest()->pluck('nama', 'nik'),
            'polies'    => Poly::latest()->pluck('nama_poli', 'id_poli'),
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
            'id_poli'   => ['required', 'exists:polies,id_poli'],
            'nik'       => ['required', 'numeric', 'digits:16', 'exists:patients,nik'],
        ]);
    
        $patient = Patient::where('nik', $validatedData['nik'])->first();
        if (!$patient) {
            return redirect()->back()->withErrors(['nik' => 'Pasien tidak ditemukan.'])->withInput();
        }
    
        $existingQueue = Queue::where('id_pasien', $patient->id_pasien)
            ->where('status', 0)
            ->first();
    
        if ($existingQueue) {
            return redirect()->back()
                ->withErrors(['error' => 'Pasien ini sudah ada di antrian dan belum diperiksa.'])
                ->withInput();
        }

        $queueData = [
            'id_poli'   => $validatedData['id_poli'],
            'id_pasien' => $patient->id_pasien,
            'status'    => 0,
        ];
        
        Queue::create($queueData);
    
        return redirect()->back()
            ->with('success', 'Data berhasil ditambahkan ke antrian');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function show(Queue $antrian)
    {
        //
    }

    public function check(Queue $antrian)
    {
        return view('queues.check', [
            'pageTitle' => 'Periksa | ' . $antrian->patient->nama,
            'queue'     => $antrian,
            'doctors'   => Doctor::where('id_poli', $antrian->id_poli)
                ->pluck('nama', 'id_dokter'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function edit(Queue $queue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Queue $queue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Queue  $queue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Queue $antrian)
    {
        Queue::where('id_antrian', $antrian->id_antrian)->delete();
        return redirect()->route('antrian.index')->with('success', 'Antrian berhasil dihapus');
    }

    public function destroyAll()
    {
        Queue::where('status', 1)->delete();
        return redirect()->back()->with('delete_all_success', 'Data pasien telah diperiksa berhasil dihapus');
    }
}
