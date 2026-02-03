<?php

namespace App\Services;

use App\Repositories\AnswerRepository;

class AnswerService{

    protected AnswerRepository $answerRepository;
    
    // Construtor da classe
    public function __construct(AnswerRepository $answerRepository)
    {
        $this->answerRepository = $answerRepository;
    }

    // Lista todas as respostas
    public function index(){
        $response = $this->answerRepository->index();
        return response()->json($response);
    }

    // Armazena uma nova resposta
     public function store(array $data)
    {
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
        return $this->answerRepository->update($id, $data);
    }

    // Remove uma resposta específica
    public function destroy(string $id){
         return $this->answerRepository->destroy($id);
    }
}