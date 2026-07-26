<?php

use App\Models\User;

it('allows guests to view the public home page', function () {
    $response = $this->get(route('home'));

    $response->assertOk();
    $response->assertSee('Pengalaman olahraga yang lebih baik');
});

it('blocks customers from accessing the admin dashboard', function () {
    $user = User::create([
        'name' => 'Customer User',
        'email' => 'customer@example.com',
        'password' => 'customer123',
        'no_telepon' => '081111111111',
        'tgl_daftar' => now()->toDateString(),
        'role' => 'pelanggan',
    ]);

    $this->actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

it('redirects admins to the dashboard after login', function () {
    $user = User::create([
        'name' => 'Admin User',
        'email' => 'admin@example.com',
        'password' => 'admin123',
        'no_telepon' => '082222222222',
        'tgl_daftar' => now()->toDateString(),
        'role' => 'admin',
    ]);

    $response = $this->post(route('login'), [
        'email' => $user->email,
        'password' => 'admin123',
    ]);

    $response->assertRedirect(route('admin.dashboard'));
    $this->assertAuthenticatedAs($user);
});
