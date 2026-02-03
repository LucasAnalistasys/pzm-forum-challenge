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
    use RefreshDatabase; // Limpa o banco a cada teste

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
                'content' => 'Esta é uma resposta de teste com mais de cinco caracteres.'
            ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('answers', [
            'content' => 'Esta é uma resposta de teste com mais de cinco caracteres.',
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
                'content' => 'Oi' // Menor que 5 caracteres (definido na AnswerRequest)
            ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['content']);
    }
}