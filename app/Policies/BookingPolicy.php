<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;
use App\Permissions\V1\Abilities;

class BookingPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function indexAll(User $user)
    {
        if ($user->userCan(Abilities::IndexAllBooking)) {
            return true;
        }

        return  false;
    }

    public function delete(User $user, Booking $booking)
    {
        if ($user->userCan(Abilities::DeleteBooking)) {
            return true;
        }

        if (
            $booking->user_id == $user->id
            && $user->userCan(Abilities::DeleteOwnBooking)
        ) {
            return true;
        }
        return  false;
    }

    public function replace(User $user)
    {
        return $user->userCan(Abilities::ReplaceBooking);
    }

    public function store(User $user, Booking $booking)
    {
        if ($user->userCan(Abilities::CreateBooking)) {
            return true;
        }

        if (
            $booking->user_id == $user->id
            && $user->userCan(Abilities::CreateOwnBooking)
        ) {
            return true;
        }
        return  false;
    }

    public function update(User $user, Booking $booking)
    {
        if ($user->userCan(Abilities::UpdateBooking)) {
            return true;
        }

        if (
            $booking->user_id == $user->id
            && $user->userCan(Abilities::UpdateOwnBooking)
        ) {
            return true;
        }
        return  false;
    }
}
