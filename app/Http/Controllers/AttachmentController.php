<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AttachmentService;
use App\Http\Requests\AttachmentRequest;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\AttachmentResource;

class AttachmentController extends Controller
{
    protected $attachmentService;

    public function __construct(AttachmentService $attachmentService)
    {
        $this->attachmentService = $attachmentService;
    }
    
    public function upload(AttachmentRequest $request): JsonResponse
    {
        // A Service agora recebe os dados validados e o arquivo
        $attachment = $this->attachmentService->upload(
            $request->validated(), 
            $request->file('file')
        );

        return response()->json(new AttachmentResource($attachment), 201);
    }

    //Mostrar os detalhes do anexo
    public function find(string $id): JsonResponse
    {
        $attachment = $this->attachmentService->find($id);

        return response()->json(new AttachmentResource($attachment), 200);
    }

    public function delete(string $id): JsonResponse
    {
        $deleted = $this->attachmentService->delete($id);

        if ($deleted) {
            return response()->json(['message' => 'Anexo deletado com sucesso.'], 200);
        }

        return response()->json(['message' => 'Anexo não encontrado.'], 404);
    }
}
