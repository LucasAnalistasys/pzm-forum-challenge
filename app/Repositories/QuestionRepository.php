<?php

namespace App\Repositories;

use App\Models\Question;

class QuestionRepository{

    public function __construct()
    {
        
    }

    // Mostra todas as perguntas com os usuários relacionados
    public function index(){
        return Question::with('user')->latest()->get();
    }
    
    // Cria uma nova pergunta no banco de dados
    public function store(array $data)
    {
        return Question::create($data);
    }

    // Mostra uma pergunta específica pelo ID
    public function show(string $id){
        return Question::findOrFail($id);
    }

    // Atualiza uma pergunta existente pelo ID
    public function update(string $id, array $data)
    {
        $question = Question::findOrFail($id);
        $question->update($data);

        return $question;
    }

    // Deleta uma pergunta pelo ID
    public function destroy(string $id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
    }

}