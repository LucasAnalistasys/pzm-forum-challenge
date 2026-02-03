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

    public function index() // Listar perguntas
    {
        return $this->questionRepository->index();
    }

    public function store(array $data) // Criar nova pergunta
    {
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']) . '-' . Str::random(5); // Gera: minha-pergunta-abc12
        
        return $this->questionRepository->store($data);
    }

     public function show(string $id) // Exibir pergunta específica
    {
        
        return $this->questionRepository->show($id);
    }

    public function update(string $id, array $data) // Atualizar pergunta
    {
        $question = $this->questionRepository->show($id);

        if ($question->user_id !== Auth::id()) {
            abort(403, 'Acesso negado');
        }

        return $this->questionRepository->update($id, $data);
    }

    public function destroy(string $id) // Deletar pergunta
    {
        $question = $this->questionRepository->show($id);

        if ($question->user_id !== Auth::id()) {
            abort(403, 'Acesso negado');
        }

        return $this->questionRepository->destroy($id);
    }

}