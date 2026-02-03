<?php

namespace App\Repositories;

use App\Models\Answer;

class AnswerRepository{

    // Listar Respostas de uma Pergunta específica
    public function index($questionId){
        return Answer::where('question_id', $questionId)
                       ->with('user') // Dados de quem respondeu
                       ->latest()     // Filtro de mais recentes
                       ->get();
    }

    // Cria Perguntas no Banco
    public function store(array $data)
    {
        return Answer::create($data);
    }

    // Buscar resposta por ID
    public function show(string $id){
       return Answer::with('user')->findOrFail($id);
    }

    // Atualizar uma Resposta
    public function update(string $id , array $data){
        $answer = Answer::findOrFail($id);
        $answer->update($data);

        return $answer;
    }

    // Deletar uma Resposta
    public function destroy(string $id){
        $answer = Answer::FindOrFail($id);
        $answer->delete();
    }
}