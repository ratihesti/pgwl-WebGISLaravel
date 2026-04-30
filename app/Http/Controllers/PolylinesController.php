<?php

namespace App\Http\Controllers;

use App\Models\polylinesModel;
use Illuminate\Http\Request;

class PolylinesController extends Controller
{
    protected $polylines; // deklarasi property

    public function __construct()
    {
    $this->polylines = new polylinesModel();
    }
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate(
            [
                'geometry_polyline' => 'required',
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'image|mimes:jpeg,png,jpg|max:5120',
            ],
            [
                'geometry_polyline.required' => 'Field geometry polyline harus diisi.',
                'name.required' => 'Field name harus diisi.',
                'name.string' => 'Field name harus berupa string.',
                'name.max' => 'Field name tidak boleh lebih dari 255 karakter.',
                'description.string' => 'Field description harus berupa string.',
                'description.required' => 'Field description harus diisi.',
                'image.image' => 'File yang diunggah harus berupa gambar.',
                'image.mimes' => 'Format gambar tidak valid. Harus berupa jpeg, png, jpg.',
                'image.max' => 'Ukuran gambar tidak boleh lebih dari 5MB.',
            ]
        );

        // Cek apakah direktori storage/images sudah ada, jika belum buat direktori tersebut
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // get the uploaded image and move it to the storage/images directory
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
            } else {
            $name_image = null;
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'geom' => $request->geometry_polyline,
            'image' => $name_image,
        ];

        // Simpan data ke database
        if (!$this->polylines->create($data)) {
            return redirect()->route('peta')->with('error', 'Gagal menyimpan data polyline.');
        }

        // Kembali ke halaman peta
        return redirect()->route('peta')->with('success', 'Data polyline berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
