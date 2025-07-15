<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Filters\V1\BookingFilter;
use App\Http\Requests\Api\V1\StoreBookingRequest;
use App\Http\Resources\V1\BookingResource;
use App\Models\Booking;
use App\Policies\BookingPolicy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends ApiController
{
    protected $policyClass = BookingPolicy::class;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, BookingFilter $filter)
    {
        if ($this->isAbleTo('indexAll', Booking::class)) {
            return BookingResource::collection(Booking::filter($filter)->paginate());
        }

        $request->merge(['filter' => ['user' => Auth::user()->id]]);

        return BookingResource::collection(Booking::filter($filter)->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookingRequest $request)
    {
        if ($this->isAbleTo('store', Booking::class)) {
            return new BookingResource(Booking::create($request->mappedAttributes()));
        }

        return $this->notAuthorized('Unauthorized');
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        if ($this->isAbleTo('indexAll', Booking::class)) {
        return new BookingResource($booking);
        }

        if ($this->isAbleTo('show', $booking)) {
            return new BookingResource($booking);
        }        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        if ($this->isAbleTo('update', $booking)) {
            $booking->update($request->mappedAttributes());

            return new BookingResource($booking);
        }

        return $this->notAuthorized('Unauthorized');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        if ($this->isAbleTo('delete', $booking)) {
            $booking->delete();

            return $this->ok('Booking successfully deleted');
        }

        return $this->notAuthorized('Unauthorized');
    }
}
