<?php

namespace App\Services;

use App\Repositories\QuestionRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class QuestionService{

    protected QuestionRepository $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    // Listar perguntas
    public function index() 
    {
        return $this->questionRepository->index();
    }
     // Criar nova pergunta
    public function store(array $data) 
    {
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(5); // Gera: minha-pergunta-abc12
        
        return $this->questionRepository->store($data);
    }

    // Mostrar pergunta específica
    public function show(string $id) 
    {
        return $this->questionRepository->show($id);
    }

    // Atualizar pergunta
    public function update(string $id, array $data) 
    {
        $question = $this->questionRepository->show($id);

        if ($question->user_id !== Auth::id()) {
            abort(403, 'Acesso negado');
        }

        return $this->questionRepository->update($id, $data);
    }

    // Deletar pergunta
    public function destroy(string $id) // Deletar pergunta
    {
        $question = $this->questionRepository->show($id);

        if ($question->user_id !== Auth::id()) {
            abort(403, 'Acesso negado');
        }

        return $this->questionRepository->destroy($id);
    }

}