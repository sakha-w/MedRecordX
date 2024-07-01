<?php

namespace App\Http\Controllers;

use App\Models\Nurse;
use App\Models\User;
use Illuminate\Http\Request;

class NurseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('nurses.index', [
            'pageTitle' => 'Data Perawat',
            'nurses' => Nurse::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nurses.create', [
            'pageTitle' => 'Tambah Perawat',
            'nurses' => Nurse::latest()->limit(5)->pluck('nama', 'id_perawat')
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
            'email' => ['nullable', 'email:dns', 'unique:nurses', 'max:50'],
            'jenis_kelamin' => ['required'],
            'no_hp' => ['required', 'numeric', 'unique:nurses', 'max_digits:15'],
            'tgl_lahir' => ['nullable', 'date'],
            'tempat_lahir' => ['nullable', 'max:50'],
            'alamat' => ['nullable', 'max:255'],
            'username' => ['required', 'unique:users', 'max:255'],
            'password' => ['required', 'min:5']
        ]);

        // create nurse id
        $nurseCount = Nurse::count() + 1;
        if($nurseCount < 10) {
            $code = '00' . $nurseCount;
        }
        elseif($nurseCount < 100) {
            $code = '0' . $nurseCount;
        }else {
            $code = '';
        }

        $validatedData['id_perawat'] = 'PE' . $code;

        // create user first, and get the user id for nurse
        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => 'perawat'
        ]);
        $user_id = User::where('username', $request->username)->pluck('id');
        $validatedData['id'] = $user_id[0];

        // store nurse data
        Nurse::create($validatedData);

        return redirect()->route('perawat.index')->with('success', 'Data berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nurse  $nurse
     * @return \Illuminate\Http\Response
     */
    public function show(Nurse $perawat)
    {
        return view('nurses.detail', [
            'pageTitle' => $perawat->nama,
            'nurse' => $perawat
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nurse  $nurse
     * @return \Illuminate\Http\Response
     */
    public function edit(Nurse $perawat)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Nurse  $nurse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Nurse $perawat)
    {
        // if request photo is true
        // return var_dump($request->photo);
        if($request->photo) {
            $validatedData = $request->validate([
                'photo' => ['nullable', 'image', 'file', 'max:1024']
            ]);

            $validatedData['photo'] = $request->file('photo')->store('user-photo');

            Nurse::where('id_perawat', $perawat->id_perawat)->update($validatedData);
            
            return back()->with('success', 'Foto berhasil di update');
        }

        // data validation
        $rules = [
            'nama' => ['required', 'max:100'],
            'jenis_kelamin' => ['required'],
            'tgl_lahir' => ['nullable', 'date'],
            'tempat_lahir' => ['nullable', 'max:50'],
            'alamat' => ['nullable', 'max:255'],
        ];

        // rules if request number, email is equal nurse
        if($request->no_hp !== $perawat->no_hp) {
            $rules['no_hp'] = ['required', 'numeric', 'unique:nurses', 'max_digits:15'];
        }

        if($request->email !== $perawat->email) {
            $rules['email'] = ['nullable', 'email:dns', 'unique:nurses', 'max:50'];
        }

        $validatedData = $request->validate($rules);

        // update
        Nurse::where('id_perawat', $perawat->id_perawat)
                ->update($validatedData);

        return back()->with('success', 'Data berhasil di update')
                ->with('success', 'Data berhasil di update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nurse  $nurse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nurse $perawat)
    {
        Nurse::where('id_perawat', $perawat->id_perawat)->delete();
        User::where('id', $perawat->user->id)->delete();
        return redirect()->route('perawat.index')->with('success', "Data <strong>$perawat->nama</strong> berhasil dihapus");
    }
}
