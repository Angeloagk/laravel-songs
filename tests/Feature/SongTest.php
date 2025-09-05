<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Song;

class SongTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_song_can_be_created()
    {
        $response = $this->post('/songs', [
            'title' => 'Test Song',
            'singer' => 'Test Singer',
        ]);

        $response->assertRedirect('/songs');
        $this->assertDatabaseHas('songs', [
            'title' => 'Test Song',
            'singer' => 'Test Singer',
        ]);
    }

    /** @test */
    public function a_song_can_be_updated()
    {
        $song = Song::create([
            'title' => 'Old Title',
            'singer' => 'Old Singer',
        ]);

        $response = $this->put("/songs/{$song->id}", [
            'title' => 'New Title',
            'singer' => 'New Singer',
        ]);

        $response->assertRedirect("/songs/{$song->id}");
        $this->assertDatabaseHas('songs', [
            'title' => 'New Title',
            'singer' => 'New Singer',
        ]);
    }

    /** @test */
    public function a_song_can_be_deleted()
    {
        $song = Song::create([
            'title' => 'Delete Me',
            'singer' => 'Singer',
        ]);

        $response = $this->delete("/songs/{$song->id}");
        $response->assertRedirect('/songs');

        $this->assertDatabaseMissing('songs', [
            'title' => 'Delete Me',
        ]);
    }
}
