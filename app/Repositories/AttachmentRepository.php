<?php

namespace App\Repositories;

use App\Models\Attachment;

class AttachmentRepository
{
    protected $model;

    public function __construct(Attachment $model)
    {
        $this->model = $model;
    }

    // Faz o upload do anexo 
    public function upload(array $data)
    {
        return $this->model->create($data);
    }

    //Mostrar os detalhes do anexo
    public function find(string $id)
    {
        return $this->model->findOrFail($id);
    }

    //Deletar o anexo
    public function delete(string $id): bool
    {
        return (bool) $this->model->destroy($id);
    }
}