<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function an_authenticated_user_can_list_questions()
    {
        $user = User::factory()->create();
        Question::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')
                         ->getJson('/api/questions');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    #[Test]
    public function an_authenticated_user_can_create_a_question()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'sanctum')
                         ->postJson('/api/questions', [
                             'title' => 'Minha primeira pergunta',
                             'content' => 'Conteúdo da pergunta de teste'
                         ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('questions', [
            'title' => 'Minha primeira pergunta',
            'user_id' => $user->id // Verifica se o Service injetou o ID do autor
        ]);
    }

    #[Test]
    public function a_user_cannot_update_someone_elses_question()
    {
        $owner = User::factory()->create();
        $stranger = User::factory()->create();
        $question = Question::factory()->create(['user_id' => $owner->id]);

        $response = $this->actingAs($stranger, 'sanctum')
                         ->putJson("/api/questions/{$question->id}", [
                             'title' => 'Tentando hackear'
                         ]);
                         
        $response->assertStatus(403);
    }

    #[Test]
    public function a_user_can_delete_their_own_question()
    {
        $user = User::factory()->create();
        $question = Question::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user, 'sanctum')
                         ->deleteJson("/api/questions/{$question->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('questions', ['id' => $question->id]);
    }
}