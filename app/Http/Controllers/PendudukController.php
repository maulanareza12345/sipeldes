<?php

namespace App\Http\Controllers;

use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PendudukController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,perangkat']);
    }

    public function index()
    {
        $penduduks = Penduduk::latest()->paginate(10);
        $penduduk = new Penduduk();

        return view('penduduk.index', compact('penduduks', 'penduduk'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nik' => ['required', 'unique:penduduks,nik'],
            'nama' => ['required'],
            'tempat_lahir' => ['nullable'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable'],
            'alamat' => ['nullable'],
            'pekerjaan' => ['nullable'],
            'kewarganegaraan' => ['nullable'],
            'status' => ['nullable'],
            'agama' => ['nullable'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = Str::slug($request->nama) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/penduduk'), $filename);
            $data['foto'] = 'uploads/penduduk/' . $filename;
        }

        Penduduk::create($data);

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil ditambahkan.');
    }

    public function edit(Penduduk $penduduk)
    {
        $penduduks = Penduduk::latest()->paginate(10);

        return view('penduduk.index', compact('penduduks', 'penduduk'));
    }

    public function update(Request $request, Penduduk $penduduk)
    {
        $data = $request->validate([
            'nik' => ['required', 'unique:penduduks,nik,' . $penduduk->id],
            'nama' => ['required'],
            'tempat_lahir' => ['nullable'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['nullable'],
            'alamat' => ['nullable'],
            'pekerjaan' => ['nullable'],
            'kewarganegaraan' => ['nullable'],
            'status' => ['nullable'],
            'agama' => ['nullable'],
            'foto' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = Str::slug($request->nama) . '-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/penduduk'), $filename);
            $data['foto'] = 'uploads/penduduk/' . $filename;
        }

        $penduduk->update($data);

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil diperbarui.');
    }

    public function destroy(Penduduk $penduduk)
    {
        $penduduk->delete();

        return redirect()->route('penduduk.index')->with('success', 'Data penduduk berhasil dihapus.');
    }
}

