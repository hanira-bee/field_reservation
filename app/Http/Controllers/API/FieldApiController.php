<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FieldApiController extends Controller
{
    public function index(): JsonResponse
    {
        $fields = Lapangan::query()
            ->orderBy('id')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar lapangan berhasil diambil.',
            'data' => $fields,
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nama_lapangan' => ['required', 'string', 'max:255'],
            'jenis_lapangan' => ['required', 'string', 'in:Futsal,Badminton'],
            'lokasi' => ['required', 'string', 'max:255'],
            'harga_per_jam' => ['required', 'numeric', 'min:0'],
            'deskripsi' => ['nullable', 'string'],
            'fasilitas' => ['nullable', 'string'],
            'ukuran' => ['nullable', 'string', 'max:100'],
            'gambar' => ['nullable', 'string', 'max:255'],
            'status_aktif' => ['sometimes', 'boolean'],
        ]);

        $field = Lapangan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Lapangan berhasil ditambahkan.',
            'data' => $field,
        ], 201);
    }

    public function show(Lapangan $field): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => 'Detail lapangan berhasil diambil.',
            'data' => $field,
        ]);
    }

    public function update(Request $request, Lapangan $field): JsonResponse
    {
        $validated = $request->validate([
            'nama_lapangan' => ['sometimes', 'required', 'string', 'max:255'],
            'jenis_lapangan' => ['sometimes', 'required', 'string', 'in:Futsal,Badminton'],
            'lokasi' => ['sometimes', 'required', 'string', 'max:255'],
            'harga_per_jam' => ['sometimes', 'required', 'numeric', 'min:0'],
            'deskripsi' => ['sometimes', 'nullable', 'string'],
            'fasilitas' => ['sometimes', 'nullable', 'string'],
            'ukuran' => ['sometimes', 'nullable', 'string', 'max:100'],
            'gambar' => ['sometimes', 'nullable', 'string', 'max:255'],
            'status_aktif' => ['sometimes', 'boolean'],
        ]);

        $field->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Lapangan berhasil diperbarui.',
            'data' => $field->refresh(),
        ]);
    }

    public function destroy(Lapangan $field): JsonResponse
    {
        $field->delete();

        return response()->json([
            'success' => true,
            'message' => 'Lapangan berhasil dihapus.',
        ]);
    }
}
