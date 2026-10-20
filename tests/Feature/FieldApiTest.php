<?php

use App\Models\Lapangan;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('lists fields as json', function () {
    Lapangan::create([
        'nama_lapangan' => 'Lapangan Futsal',
        'jenis_lapangan' => 'Futsal',
        'lokasi' => 'Bandung',
        'harga_per_jam' => 100000,
    ]);

    $this->getJson('/api/fields')
        ->assertOk()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.0.nama_lapangan', 'Lapangan Futsal');
});

it('creates a field with valid data', function () {
    $this->postJson('/api/fields', [
        'nama_lapangan' => 'Lapangan Futsal',
        'jenis_lapangan' => 'Futsal',
        'lokasi' => 'Bandung',
        'harga_per_jam' => 100000,
        'ukuran' => '38 meter x 18 meter',
    ])
        ->assertCreated()
        ->assertJsonPath('success', true)
        ->assertJsonPath('data.nama_lapangan', 'Lapangan Futsal');

    $this->assertDatabaseHas('lapangans', [
        'nama_lapangan' => 'Lapangan Futsal',
        'jenis_lapangan' => 'Futsal',
        'lokasi' => 'Bandung',
        'harga_per_jam' => 100000,
        'ukuran' => '38 meter x 18 meter',
    ]);
});

it('validates required field data', function () {
    $this->postJson('/api/fields', [
        'nama_lapangan' => 'Lapangan Futsal',
    ])
        ->assertUnprocessable()
        ->assertJsonValidationErrors([
            'jenis_lapangan',
            'lokasi',
            'harga_per_jam',
        ]);
});

it('shows one field and returns not found for an unknown field', function () {
    $field = Lapangan::create([
        'nama_lapangan' => 'Lapangan Futsal',
        'jenis_lapangan' => 'Futsal',
        'lokasi' => 'Bandung',
        'harga_per_jam' => 100000,
    ]);

    $this->getJson("/api/fields/{$field->id}")
        ->assertOk()
        ->assertJsonPath('data.id', $field->id)
        ->assertJsonPath('data.nama_lapangan', 'Lapangan Futsal');

    $this->getJson('/api/fields/999')
        ->assertNotFound();
});

it('updates only the provided valid fields', function () {
    $field = Lapangan::create([
        'nama_lapangan' => 'Lapangan Futsal',
        'jenis_lapangan' => 'Futsal',
        'lokasi' => 'Bandung',
        'harga_per_jam' => 100000,
    ]);

    $this->patchJson("/api/fields/{$field->id}", [
        'harga_per_jam' => 120000,
        'unexpected_field' => 'ignored',
    ])
        ->assertOk()
        ->assertJsonPath('data.harga_per_jam', 120000)
        ->assertJsonMissingPath('data.unexpected_field');

    $this->assertDatabaseHas('lapangans', [
        'id' => $field->id,
        'nama_lapangan' => 'Lapangan Futsal',
        'harga_per_jam' => 120000,
    ]);
});

it('deletes a field and returns not found when it does not exist', function () {
    $field = Lapangan::create([
        'nama_lapangan' => 'Lapangan Futsal',
        'jenis_lapangan' => 'Futsal',
        'lokasi' => 'Bandung',
        'harga_per_jam' => 100000,
    ]);

    $this->deleteJson("/api/fields/{$field->id}")
        ->assertOk()
        ->assertJsonPath('success', true);

    $this->assertDatabaseMissing('lapangans', ['id' => $field->id]);

    $this->deleteJson('/api/fields/999')
        ->assertNotFound();
});
