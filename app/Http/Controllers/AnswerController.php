<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Services\AnswerService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\AnswerRequest;

class AnswerController extends Controller
{   

    protected AnswerService $answerService;
    
    public function __construct(AnswerService $answerService)
    {
        $this->answerService = $answerService;
    }

    // Lista as respostas de uma pergunta específica
    public function index($questionId):JsonResponse
    {   
        $response = $this->answerService->index($questionId);
        return response()->json($response);
    }

    
    public function create()
    {
        //
    }

    // Cria uma nova resposta para uma pergunta específica
    public function store(AnswerRequest $request, $questionId): JsonResponse
    {   
        $response = $this->answerService->store($request->validated(), $questionId);
        return response()->json($response, 201);
    }

    // Exibe uma resposta específica
    public function show(Answer $answer): JsonResponse
    {
        $response = $this->answerService->show($answer->id);
        return response()->json($response);
    }

    public function edit(Answer $answer)
    {
        //
    }

    // Atualiza uma resposta específica
    public function update(AnswerRequest $request, Answer $answer): JsonResponse
    {
        $response = $this->answerService->update($answer->id, $request->validated());
        return response()->json($response);
    }

    // Deleta uma resposta específica
    public function destroy(Answer $answer): JsonResponse
    {
        $response = $this->answerService->destroy($answer->id);
        return response()->json(['message' => 'Resposta removida com sucesso']);
    }
}
