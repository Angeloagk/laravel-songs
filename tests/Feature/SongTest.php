<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SongTest extends TestCase
{
    /**
     * A basic feature test example.
     */
   public function test_song_can_be_created()
{
    $response = $this->post('/songs', [
        'title' => 'Test Song',
        'artist' => 'Test Artist',
        'album' => 'Test Album'
    ]);

    $response->assertStatus(302); // redirect na create
    $this->assertDatabaseHas('songs', ['title' => 'Test Song']);
}

}
