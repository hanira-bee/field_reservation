<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use Illuminate\Http\Request;

class FieldApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mengambil semua data lapangan dari database
        $fields = Lapangan::all();

        // Mengembalikan data dalam bentuk format JSON standar REST API
        return response()->json([
            'success' => true,
            'message' => 'Daftar data lapangan olahraga berhasil diambil.',
            'data' => $fields
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // menambah data baru
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
        ]);

        // simpan ke database
        $field = Lapangan::create([
            'name' => $request->name,
            'type' => $request->type,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Lapangan baru berhasil ditambahkan.',
            'data' => $field
        ], 201); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $field = Lapangan::find($id);

        if (!$field) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // perbarui data
        $field->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data lapangan berhasil diperbarui.',
            'data' => $field
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $field = Lapangan::find($id);

        if (!$field) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $field->delete();

        return response()->json([
            'success' => true,
            'message' => 'Lapangan berhasil dihapus.'
        ], 200);
    }
}
