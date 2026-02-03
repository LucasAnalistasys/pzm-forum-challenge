<?php

namespace Tests\Feature;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class AnswerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function a_user_can_list_answers_for_a_specific_question()
    {
        $question = Question::factory()->create();
        Answer::factory()->count(3)->create(['question_id' => $question->id]);

        $response = $this->getJson("/api/questions/{$question->id}/answers");

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    #[Test]
    public function an_authenticated_user_can_answer_a_question()
    {
        $user = User::factory()->create();
        $question = Question::factory()->create();

        $response = $this->actingAs($user)
            ->postJson("/api/questions/{$question->id}/answers", [
                'content' => 'Esta é uma resposta de teste válida com mais de cinco caracteres.'
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('answers', [
            'content' => 'Esta é uma resposta de teste válida com mais de cinco caracteres.',
            'question_id' => $question->id,
            'user_id' => $user->id
        ]);
    }

    #[Test]
    public function a_user_cannot_answer_with_less_than_five_characters()
    {
        $user = User::factory()->create();
        $question = Question::factory()->create();

        $response = $this->actingAs($user)
            ->postJson("/api/questions/{$question->id}/answers", [
                'content' => 'Oi' 
            ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['content']);
    }

    #[Test]
    public function an_authenticated_user_can_update_their_own_answer()
    {
        $user = User::factory()->create();
        $answer = Answer::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->putJson("/api/answers/{$answer->id}", [
                'content' => 'Conteúdo devidamente atualizado!'
            ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('answers', [
            'id' => $answer->id,
            'content' => 'Conteúdo devidamente atualizado!'
        ]);
    }

    #[Test]
    public function a_user_cannot_update_someone_elses_answer()
    {
        $owner = User::factory()->create();
        $stranger = User::factory()->create();
        $answer = Answer::factory()->create(['user_id' => $owner->id]);

        $response = $this->actingAs($stranger)
            ->putJson("/api/answers/{$answer->id}", [
                'content' => 'Tentando hackear a resposta.'
            ]);

        // Aqui depende da sua lógica: se você não tratou no Service, pode dar 200.
        // Como o Service de Update ainda não tem a trava de dono (apenas o destroy tem),
        // este teste pode falhar se você não adicionar a trava lá também!
        $response->assertStatus(403); 
    }

    #[Test]
    public function an_authenticated_user_can_delete_their_own_answer()
    {
        $user = User::factory()->create();
        $answer = Answer::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)
            ->deleteJson("/api/answers/{$answer->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('answers', ['id' => $answer->id]);
    }

    #[Test]
    public function a_user_cannot_delete_someone_elses_answer()
    {
        $owner = User::factory()->create();
        $stranger = User::factory()->create();
        $answer = Answer::factory()->create(['user_id' => $owner->id]);

        $response = $this->actingAs($stranger)
            ->deleteJson("/api/answers/{$answer->id}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('answers', ['id' => $answer->id]);
    }
}