<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AttachmentController;


/*
|--------------------------------------------------------------------------
| Public Routes (Acesso Livre)
|--------------------------------------------------------------------------
*/

// Autenticação
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Visualização (Read-only)
Route::apiResource('questions', QuestionController::class)->only(['index', 'show']);
Route::get('/questions/{question}/answers', [AnswerController::class, 'index']);

/*
|--------------------------------------------------------------------------
| Protected Routes (Exigem Token Sanctum)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
    
    // Usuário
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // CRUD de Perguntas (Escrita)
    Route::apiResource('questions', QuestionController::class)->except(['index', 'show']);
    
    // 1. Criação vinculada à pergunta
    Route::post('/questions/{question}/answers', [AnswerController::class, 'store']);
    
    // Atualizar e deletar respostas
    Route::apiResource('answers', AnswerController::class)->except(['index', 'store']);

    // Rota de Upload de Anexos
    Route::post('/attachments', [AttachmentController::class, 'upload']);
    
    // Rota para ver detalhes de um anexo
    Route::get('/attachments/{id}', [AttachmentController::class, 'find']);
    
    // Rota para deletar Anexos
    Route::delete('/attachments/{id}', [AttachmentController::class, 'delete']);
});
