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

    /**
     * Display a listing of the resource.
     */
    public function index($questionId):JsonResponse
    {   
        $response = $this->answerService->index($questionId);
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
    public function store(AnswerRequest $request, $questionId): JsonResponse
    {   
        $response = $this->answerService->store($request->validated(), $questionId);
        return response()->json($response, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Answer $answer): JsonResponse
    {
        $response = $this->answerService->show($answer->id);
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Answer $answer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnswerRequest $request, Answer $answer): JsonResponse
    {
        $response = $this->answerService->update($answer->id, $request->validated());
        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer): JsonResponse
    {
        $response = $this->answerService->destroy($answer->id);
        return response()->json(['message' => 'Resposta removida com sucesso']);
    }
}
