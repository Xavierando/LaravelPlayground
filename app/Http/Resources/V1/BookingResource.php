<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'booking',
            'id' => $this->id,
            'attributes' => [
                'date' => $this->s_date,
                'time' => $this->s_time,
                'payed' => $this->payed
            ],
            'includes' => new ServiceResource($this->whenLoaded('service')),
            'relationships' => [
                'user' => [
                    'data' => [
                        'type' => 'user',
                        'id' => $this->user_id
                    ]
                ],
                'service' => [

                    'data' => [
                        'type' => 'user',
                        'id' => $this->user_id
                    ],
                    'links' => [
                        'self' => route('api.services.show', ['service' => $this->service_id])
                    ]
                ]
            ],
            'links' => [
                'self' => route('api.bookings.show', ['booking' => $this->id])
            ]
        ];
    }
}
