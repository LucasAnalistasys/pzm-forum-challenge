<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AttachmentTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_user_can_upload_an_attachment_to_a_question()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $this->actingAs($user);

        $question = Question::factory()->create(['user_id' => $user->id]);

        $file = UploadedFile::fake()->create('documento.pdf', 500);

        $payload = [
            'file' => $file,
            'attachable_id' => $question->id,
            'attachable_type' => 'question'
        ];

        $response = $this->postJson('/api/attachments', $payload);

        $response->assertStatus(201);
        
        $path = 'attachments/' . $file->hashName();
        Storage::disk('public')->assertExists($path);

        $this->assertDatabaseHas('attachments', [
            'file_name' => 'documento.pdf',
            'attachable_id' => $question->id,
            'attachable_type' => Question::class
        ]);
    }

    #[Test]
    public function a_user_can_delete_their_attachment()
    {
        Storage::fake('public');
        
        $user = User::factory()->create();
        $this->actingAs($user);

        $question = Question::factory()->create(['user_id' => $user->id]);
        $file = UploadedFile::fake()->create('documento.pdf', 500);        
        $uploadResponse = $this->postJson('/api/attachments', [
            'file' => $file,
            'attachable_id' => $question->id,
            'attachable_type' => 'question'
        ]);

        $attachmentId = $uploadResponse->json('id');

        $deleteResponse = $this->deleteJson("/api/attachments/{$attachmentId}");

        $deleteResponse->assertStatus(200);

        Storage::disk('public')->assertMissing('attachments/' . $file->hashName());

        $this->assertDatabaseMissing('attachments', ['id' => $attachmentId]);
    }

    #[Test]
    public function file_must_be_a_valid_type()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $file = UploadedFile::fake()->create('malware.php', 100, 'application/x-php');
        $response = $this->postJson('/api/attachments', [
            'file' => $file,
            'attachable_id' => 'algum-id',
            'attachable_type' => 'question'
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['file']);
    }
}