<?php

namespace App\Repositories;

use App\Models\Answer;

class AnswerRepository{

    public function index(){
        return Answer::all();
    }

    public function store(array $data)
    {
        return Answer::create($data);
    }

    public function show(string $id){
       return Answer::findOrFail($id);
    }

    public function update(string $id , array $data){
        $answer = Answer::findOrFail($id);
        $answer->update($data);

        return $answer;
    }

    public function destroy(string $id){
        $answer = Answer::FindOrFail($id);
        $answer->delete();
    }
}