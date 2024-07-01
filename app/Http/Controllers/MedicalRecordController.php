<?php

namespace App\Http\Controllers;

use App\Models\MedicalPrescription;
use App\Models\MedicalRecord;
use App\Models\Medicine;
use App\Models\Patient;
use App\Models\Queue;
use Carbon\Carbon;
use Faker\Provider\Medical;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\VarDumper;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validatedMedRecord = $request->validate([
            'id_pasien' => ['required', 'size:5'],
            'id_dokter' => ['required', 'size:5'],
            'id_poli' => ['required', 'size:5'],
            'sistole' => ['nullable', 'numeric', 'max_digits:3'],
            'diastole' => ['nullable', 'numeric', 'max_digits:3'],
            'gula_darah' => [ 'nullable','numeric', 'max_digits:3'],
            'alergi' => ['nullable', 'max:100'],
            'keluhan' => ['required'],
            'diagnosis' => ['required'],
            'terapi' => ['required'],
            'resep_obat' => ['required'],
            'harga' => ['nullable']
        ]);

        $validatedMedRecord['tgl_periksa'] = Carbon::now();

        MedicalRecord::create($validatedMedRecord);

        // get id in latest medical record
        $latest_med_record = MedicalRecord::latest()->first();

        // validate medical prescription
        // $validatedMedPrescription = $request->validate([
        //     'id_obat' => ['required', 'numeric'],
        //     'jumlah' => ['required', 'numeric'],
        //     'aturan_pakai' => ['required', 'max:255']
        // ]);

        // // fill all relationship id
        // $validatedMedPrescription["id_dokter"] = $request->id_dokter;
        // $validatedMedPrescription["id_rekmed"] = $latest_med_record->id_rekmed;

        // MedicalPrescription::create($validatedMedPrescription);

        // update patient check status
        $queue = Queue::where('id_antrian', $request->id_antrian)->first();
        $queue->update([
            'status' => 1
        ]);

        $patient_id = $queue->patient->id_pasien;

        // return Queue::where('id_antrian', $request->id_antrian)->get();
        return redirect()->route('antrian.index')
            ->with('success', 'Pasien dengan nama
                <strong>' . $queue->patient->nama . "</strong>
                telah di periksa <a class='btn btn-sm btn-primary text-decoration-none' href='/pasien/$patient_id'>Tampilkan</a>");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $pasien, MedicalRecord $rekam_medis)
    {
        return view('medical_records.detail', [
            'pageTitle' => 'Detail Rekam Medis',
            'medRecord' => $rekam_medis,
            'patient' => $pasien
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $pasien, MedicalRecord $rekam_medis)
    {
        return view('medical_records.edit', [
            'pageTitle' => 'Edit Rekam Medis',
            'medRecord' => $rekam_medis,
            'patient' => $pasien,
            // 'medicines' => Medicine::all(),
            // 'prescription' => MedicalPrescription::where('id_rekmed', $rekam_medis->id_rekmed)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicalRecord $rekam_medis)
    {
        $validatedMedRecord = $request->validate([
            'sistole' => ['nullable', 'numeric', 'max_digits:3'],
            'diastole' => ['nullable', 'numeric', 'max_digits:3'],
            'gula_darah' => [ 'nullable', 'numeric', 'max_digits:3'],
            'alergi' => ['nullable', 'max:100'],
            'keluhan' => ['required'],
            'diagnosis' => ['required'],
            'terapi' => ['required'],
            'resep_obat' => ['required'],
            'harga' => ['nullable']
        ]);

        // validate medical prescription
        // $validatedMedPrescription = $request->validate([
        //     'id_obat' => ['required', 'numeric'],
        //     'jumlah' => ['required', 'numeric'],
        //     'aturan_pakai' => ['required', 'max:255']
        // ]);

        // update query
        // medical record
        $medRecordUpdate = MedicalRecord::where('id_rekmed', $rekam_medis->id_rekmed)->first();
        $medRecordUpdate->fill($validatedMedRecord);
        $changesMedRecord = $medRecordUpdate->getDirty();
        $medRecordUpdate->save();

        // prescription
        // $prescriptionUpdate = MedicalPrescription::where('id_resep', $rekam_medis->prescription->id_resep)->first();
        // $prescriptionUpdate->fill($validatedMedPrescription);
        // $changesPrescription = $prescriptionUpdate->getDirty();
        // $prescriptionUpdate->save();
        // || $changesPrescription !== []

        if ($changesMedRecord !== [] ) {
            return redirect()->route('rekam_medis.show', [$rekam_medis->id_pasien, $rekam_medis->id_rekmed])
                ->with('success', 'Data rekam medis berhasil di update');
        } else {
            return redirect()->route('rekam_medis.show', [$rekam_medis->id_pasien, $rekam_medis->id_rekmed]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicalRecord $rekam_medis)
    {
        MedicalRecord::where('id_rekmed', $rekam_medis->id_rekmed)->delete();

        return redirect()->route('pasien.show', $rekam_medis->id_pasien)->with('success', 'Data berhasil dihapus');
    }

    public function print(MedicalRecord $rekam_medis)
    {
        return view('prints.medical_record', [
            'medRecord' => $rekam_medis
        ]);
    }

    public function printAll(Patient $pasien)
    {
        return view('prints.medical_record_all', [
            'patient' => $pasien,
            'medRecords' => $pasien->medicalRecord
        ]);
    }
}
