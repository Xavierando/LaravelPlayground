<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\SlotsRequest;
use App\Http\Resources\V1\SlotsResource;
use App\Models\Service;
use App\Models\Slots;
use App\Policies\BookingPolicy;

class SlotsController extends ApiController
{
    protected $policyClass = BookingPolicy::class;

    /**
     * Display a listing of the resource.
     */
    public function index(SlotsRequest $request, Service $service)
    {
        $date = $request->validated('date');

        $Slots = new Slots($service, new \DateTimeImmutable($date));

        return new SlotsResource($Slots);

        // return response()->json(['slots' => $slots]);
    }
}
