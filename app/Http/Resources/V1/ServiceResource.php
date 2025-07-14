<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'service',
            'id' => $this->id,
            'attributes' => [
                'title' => $this->title,
                'description' => $this->description,
                'price' => $this->price,
                'duration' => $this->duration / 60,
            ],
            'includes' => '',
            'links' => [
                'self' => route('api.services.show', ['service' => $this->id]),
            ],
        ];
    }
}
