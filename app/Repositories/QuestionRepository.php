<?php

namespace App\Repositories;

use App\Models\Question;

class QuestionRepository{

    public function __construct()
    {
        
    }

    public function index(){
        return Question::all();
    }

    public function store(array $data)
    {
        return Question::create($data);
    }

    public function show(string $id){
        return Question::findOrFail($id);
    }

    public function update(string $id, array $data)
    {
        $question = Question::findOrFail($id);
        $question->update($data);

        return $question;
    }

    public function destroy(string $id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
    }

}