<?php

namespace App\Services;

use App\Repositories\QuestionRepository;

class QuestionService{

    protected QuestionRepository $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function index(){
        return $this->questionRepository->index();
    }

    public function store(array $data)
    {
        return $this->questionRepository->store($data);
    }

     public function show(string $id)
    {
        
        return $this->questionRepository->show($id);
    }

    public function update(string $id, array $data)
    {
        return $this->questionRepository->update($id, $data);
    }

    public function destroy(string $id){
        return $this->questionRepository->destroy($id);
    }

}