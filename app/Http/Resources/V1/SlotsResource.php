<?php

namespace App\Http\Resources\V1;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SlotsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'slots',
            'date' => $this->dateFormatted,
            'attributes' => [
                'slots' => $this->slots,
            ],
            'includes' => new ServiceResource(Service::find($this->service_id)),
            'links' => [
                'self' => route('api.services.slots', ['service' => $this->service_id, 'date' => $this->dateFormatted]),
            ],
        ];
    }
}
