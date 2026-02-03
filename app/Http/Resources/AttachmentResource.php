<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AttachmentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'file_name' => $this->file_name,
            'file_type' => $this->file_type,
            // Aqui entra a mágica da URL completa
            'url' => asset(Storage::url($this->file_path)),
            'created_at' => $this->created_at->format('d/m/Y H:i'),
        ];
    }
}