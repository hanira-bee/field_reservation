<?php

it('renders the home page with available courts data', function () {
    $response = $this->get(route('home'));

    $response->assertOk()
        ->assertSee('Pengalaman olahraga yang lebih baik')
        ->assertSee('Pilihan Venue Terbaik Kami')
        ->assertViewHas('lapangans');
});
