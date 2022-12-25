<?php

namespace Tests\Feature;

use App\Models\BookCSV;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CSVControllerTest extends TestCase
{
    use WithFaker;
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_we_can_view_index()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/bookcsv');
        $response->assertStatus(200);
        $response->assertViewIs('book-csv.index');
    }

    public function test_we_cannot_view_index_unauthenticated()
    {
        $response = $this->get('/bookcsv');
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_we_can_view_show()
    {
        $bookCSV = BookCSV::factory()->create();
        $response = $this->actingAs($bookCSV->user)->get("/bookcsv/{$bookCSV->id}");
        $response->assertStatus(200);
        $response->assertViewIs('book-csv.show');
    }

    public function test_we_cannot_view_show_unauthenticated()
    {
        $bookCSV = BookCSV::factory()->create();
        $response = $this->get("/bookcsv/{$bookCSV->id}");
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_we_can_view_create()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/bookcsv/create');
        $response->assertStatus(200);
        $response->assertViewIs('book-csv.create');
    }

    public function test_we_cannot_view_create_unauthenticated()
    {
        $response = $this->get('/bookcsv/create');
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function test_we_can_upload_a_file()
    {
        Storage::fake('s3');
        $user = User::factory()->create();

        $csv =  new UploadedFile(
            base_path('tests/Files/test.csv'),
            'test.csv',
            'text/csv',
            null,
            true
        );

        $response = $this->actingAs($user)->post('/bookcsv', ['csv' => $csv]);
        $bookCSV = $user->BookCSVs()->first();
        $response->assertStatus(302)
            ->assertRedirect("/bookcsv/{$bookCSV->id}");

        Storage::disk('s3')->assertExists('/' . $bookCSV->file_name);
    }
}
