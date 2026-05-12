<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_admin_can_upload_ckfinder_image(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.ckfinder.upload'), [
            'upload' => UploadedFile::fake()->createWithContent(
                'editor-image.png',
                base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+/p9sAAAAASUVORK5CYII=')
            ),
        ]);

        $response
            ->assertOk()
            ->assertJsonPath('uploaded', 1)
            ->assertJsonStructure(['uploaded', 'fileName', 'url']);

        Storage::disk('public')->assertExists('uploads/images/'.$response->json('fileName'));
    }

    public function test_ckfinder_upload_returns_json_error_without_file(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('admin.ckfinder.upload'));

        $response
            ->assertStatus(422)
            ->assertJsonPath('uploaded', 0)
            ->assertJsonStructure(['uploaded', 'error' => ['message']]);
    }
}
