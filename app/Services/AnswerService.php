<?php

namespace App\Services;

use App\Repositories\AnswerRepository;
use Illuminate\Support\Str; 

class AnswerService{

    protected AnswerRepository $answerRepository;
    
    // Construtor da classe
    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    // Lista todas as respostas
    public function index($questionId){
        return $this->answerRepository->index($questionId);
    }

    // Armazena uma nova resposta
     public function store(array $data, $questionId)
    {   
        $data['id'] = Str::uuid();
        $data['user_id'] = auth()->id(); 
        $data['question_id'] = $questionId;

        return $this->answerRepository->store($data);
    }

    // Exibe uma resposta específica
     public function show(string $id)
    {
        return $this->answerRepository->show($id);
    }

    // Atualiza uma resposta específica
    public function update(string $id, array $data)
    {
        $answer = $this->answerRepository->show($id);
        
        if ($answer->user_id !== auth()->id()) {
            abort(403, 'Você não tem permissão para editar esta resposta.');
        }

        return $this->answerRepository->update($id, $data);
    }

    // Remove uma resposta específica
    public function destroy(string $id){
        $answer = $this->answerRepository->show($id);

        //Verfica se usário é dono da Resposta
        if ($answer->user_id !== auth()->id())
        {
            abort(403, 'Você não tem Permissão para remover esta resposta.');
        }

         return $this->answerRepository->destroy($id);
    }
}