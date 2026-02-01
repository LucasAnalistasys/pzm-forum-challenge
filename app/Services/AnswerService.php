<?php

namespace App\Services;

use App\Repositories\AnswerRepository;

class AnswerService{

    protected AnswerRepository $answerRepository;
    
    public function __construct()
    {
        
    }

    public function index(){
        $response = $this->answerRepository->index();
        return response()->json($response);
    }

     public function store(array $data)
    {
        return $this->answerRepository->store($data);
    }

     public function show(string $id)
    {
        
        return $this->answerRepository->show($id);
    }

    public function update(string $id, array $data)
    {
        return $this->answerRepository->update($id, $data);
    }

    public function destroy(string $id){
         return $this->answerRepository->destroy($id);
    }
}