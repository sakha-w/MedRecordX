<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Poly;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('doctors.index', [
            'pageTitle' => 'Data Dokter',
            'doctors' => Doctor::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctors.create', [
            'pageTitle' => 'Tambah dokter',
            'doctors' => Doctor::latest()->limit(5)->pluck('nama', 'id_dokter'),
            'polies' => Poly::all()
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
        // data validation
        $validatedData = $request->validate([
            'nama' => ['required', 'max:100'],
            'email' => ['nullable', 'email:dns', 'unique:doctors', 'max:50'],
            'jenis_kelamin' => ['required'],
            'no_hp' => ['required', 'numeric', 'unique:doctors', 'max_digits:15'],
            'tgl_lahir' => ['nullable', 'date'],
            'id_poli' => ['required'],
            'tempat_lahir' => ['nullable', 'max:50'],
            'alamat' => ['nullable', 'max:255'],
            'username' => ['required', 'unique:users', 'max:255'],
            'password' => ['required', 'min:5']
        ]);

        // create doctor id
        $doctorCount = Doctor::count() + 1;
        if($doctorCount < 10) {
            $code = '00' . $doctorCount;
        }
        elseif($doctorCount < 100) {
            $code = '0' . $doctorCount;
        }else {
            $code = '';
        }

        $validatedData['id_dokter'] = 'DO' . $code;

        // create user first, and get the user id for doctor
        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'dokter'
        ]);
        $user_id = User::where('username', $request->username)->pluck('id');
        $validatedData['id'] = $user_id[0];

        // store doctor data
        Doctor::create($validatedData);

        return redirect()->route('dokter.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $dokter)
    {
        return view('doctors.detail', [
            'pageTitle' => $dokter->nama,
            'doctor' => $dokter,
            'polies' => Poly::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $dokter)
    {
        // if request photo is true
        // return var_dump($request->photo);
        if($request->photo) {
            $validatedData = $request->validate([
                'photo' => ['nullable', 'image', 'file', 'max:1024']
            ]);

            $validatedData['photo'] = $request->file('photo')->store('user-photo');

            Doctor::where('id_dokter', $dokter->id_dokter)->update($validatedData);
            
            return back()->with('success', 'Foto berhasil di update');
        }

        // data validation
        $rules = [
            'nama' => ['required', 'max:100'],
            'jenis_kelamin' => ['required'],
            'tgl_lahir' => ['nullable', 'date'],
            'id_poli' => ['required'],
            'tempat_lahir' => ['nullable', 'max:50'],
            'alamat' => ['nullable', 'max:255'],
        ];

        // rules if request number, email is equal doctor
        if($request->no_hp !== $dokter->no_hp) {
            $rules['no_hp'] = ['required', 'numeric', 'unique:doctors', 'max_digits:15'];
        }

        if($request->email !== $dokter->email) {
            $rules['email'] = ['nullable', 'email:dns', 'unique:doctors', 'max:50'];
        }

        $validatedData = $request->validate($rules);

        // update
        Doctor::where('id_dokter', $dokter->id_dokter)
                ->update($validatedData);

        return back()->with('success', 'Data berhasil di update')
                ->with('success', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $dokter)
    {
        Doctor::where('id_dokter', $dokter->id_dokter)->delete();
        User::where('id', $dokter->user->id)->delete();
        return redirect()->route('dokter.index')->with('success', "Data <strong>$dokter->nama</strong> berhasil dihapus");
    }
}
