<?php

namespace App\Services;

use App\Repositories\AttachmentRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Repositories\QuestionRepository;
use App\Repositories\AnswerRepository;
use App\Models\Question;
use App\Models\Answer;

class AttachmentService
{
    protected $attachmentRepository;
    protected $questionRepository;
    protected $answerRepository;

    public function __construct(
        AttachmentRepository $attachmentRepository,
        QuestionRepository $questionRepository,
        AnswerRepository $answerRepository
    ) {
        $this->attachmentRepository = $attachmentRepository;
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
    }

    
    //Faz o upload e vincula ao model (Question ou Answer)
    public function upload(array $data, $file)
    {
        $resource = ($data['attachable_type'] === 'question')
            ? $this->questionRepository->show($data['attachable_id']) 
            : $this->answerRepository->show($data['attachable_id']);

        $path = $file->store('attachments', 'public');

        // Prepara os dados para o Repository de Anexos
        $attachmentData = [
            'file_path'       => $path,
            'file_name'       => $file->getClientOriginalName(),
            'file_type'       => $file->getClientMimeType(),
            'attachable_id'   => $resource->id,
            'attachable_type' => get_class($resource), // Aqui o Laravel entende se é Question ou Answer
        ];

        return $this->attachmentRepository->upload($attachmentData);
    }

    // Mostra os detalhes do anexo
    public function find(string $id)
    {
        return $this->attachmentRepository->find($id);
    }

    //Remove o arquivo físico e o registro no banco
    public function delete(string $id)
    {
        $attachment = $this->attachmentRepository->find($id);

        if ($attachment) {
            // Remove o arquivo físico do Storage
            Storage::disk('public')->delete($attachment->file_path);
            
            // Remove do banco de dados
            return $this->attachmentRepository->delete($id);
        }

        return false;
    }
}