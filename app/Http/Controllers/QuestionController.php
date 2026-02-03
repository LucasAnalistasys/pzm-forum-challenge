<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class QuestionController extends Controller
{

    protected QuestionService $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    
    // Lista de Perguntas. 
    public function index():JsonResponse // Listar perguntas
    {   
        $response = $this->questionService->index();
        return response()->json($response);
    }

    public function create() 
    {
        //
    }

    // Cria uma nova pergunta
    public function store(Request $request): JsonResponse // Criar nova pergunta
    {   
        $response = $this->questionService->store($request->all());
        return response()->json($response);
    }

    // Exibe uma pergunta específica
    public function show(Question $question): JsonResponse // Exibir pergunta específica
    {
        $response = $this->questionService->show($question->id);
        return response()->json($response);
    }

    public function edit(Question $question)
    {
        //
    }

    // Atualiza uma pergunta existente
    public function update(Request $request, Question $question): JsonResponse // Atualizar pergunta
    {
        $response = $this->questionService->update($question->id, $request->all());
        return response()->json($response);
    }


    // Deleta uma pergunta
    public function destroy(Question $question): JsonResponse // Deletar pergunta
    {
        $this->questionService->destroy($question->id);
        return response()->json(['message' => 'Pergunta removida com sucesso']);
    }

}
