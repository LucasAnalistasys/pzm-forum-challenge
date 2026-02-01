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

    /**
     * Lista de Perguntas.
     */
    public function index():JsonResponse
    {   
        $response = $this->questionService->index();
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {   
        $response = $this->questionService->store($request->all());
        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */

    public function show(Question $question): JsonResponse
    {
        $response = $this->questionService->show($question->id);
        return response()->json($response);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Question $question): JsonResponse
    {
        $response = $this->questionService->update($question->id, $request->all());
        return response()->json($response);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question): JsonResponse
    {
        $this->questionService->destroy($question->id);
        return response()->json(['message' => 'Pergunta removida com sucesso']);
    }

}
