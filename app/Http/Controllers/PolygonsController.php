<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\polygonsModel;

class PolygonsController extends Controller
{
    protected $polygons; // deklarasi property
    public function __construct()
    {
        $this->polygons = new polygonsModel();
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
                'geometry_polygon' => 'required',
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            ],
            [
                'geometry_polygon.required' => 'Field geometry polygon harus diisi.',
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
            $name_image = time() . "_polygon." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
            } else {
            $name_image = null;
        }

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'geom' => $request->geometry_polygon,
            'image' => $name_image,
        ];

        // Simpan data ke database
        if (!$this->polygons->create($data)) {
            return redirect()->route('peta')->with('error', 'Gagal menyimpan data polygon.');
        }

        // Kembali ke halaman peta
        return redirect()->route('peta')->with('success', 'Data polygon berhasil disimpan.');
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
        //mencari nama file gambar berdasarkan id polygon
        $image = $this->polygons->find($id)->image;

        //hapus file gambar dari storage/images
        if ($image != null) {
            // Cek apakah file gambar ada sebelum menghapus
            if (file_exists('./storage/images/' . $image)) {
                // Hapus file gambar
                unlink('./storage/images/' . $image);
            }
        }

        // Hapus data dari database
        if (!$this->polygons->destroy($id)) {
            return redirect()->route('peta')->with('error', 'Gagal menghapus data polygon.');
        }

        // Kembali ke halaman peta
        return redirect()->route('peta')->with('success', 'Data polygon berhasil dihapus.');
    }
}
