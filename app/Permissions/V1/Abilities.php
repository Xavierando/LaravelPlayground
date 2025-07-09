<?php

namespace App\Permissions\V1;

use App\Models\User;

final class Abilities {
    public const CreateService = 'service:create';
    public const UpdateService = 'service:update';
    public const ReplaceService = 'service:replace';
    public const DeleteService = 'service:delete';

    public const CreateBooking = 'booking:create';
    public const UpdateBooking = 'booking:update';
    public const ReplaceBooking = 'booking:replace';
    public const DeleteBooking = 'booking:delete';

    public const CreateOwnBooking = 'booking:own:create';
    public const UpdateOwnBooking = 'booking:own:update';
    public const DeleteOwnBooking = 'booking:own:delete';

    public const CreateUser = 'user:create';
    public const UpdateUser = 'user:update';
    public const ReplaceUser = 'user:replace';
    public const DeleteUser = 'user:delete';

    public static function getAbilities(User $user) {
        if ($user->isAdmin) {
            return [
                self::CreateService,
                self::UpdateService,
                self::ReplaceService,
                self::DeleteService,
                self::CreateBooking,
                self::UpdateBooking,
                self::ReplaceBooking,
                self::DeleteBooking,
                self::CreateUser,
                self::UpdateUser,
                self::ReplaceUser,
                self::DeleteUser,
            ];
        } else {
            return [
                self::CreateOwnBooking,
                self::UpdateOwnBooking,
                self::DeleteOwnBooking
            ];
        }
    }
    

}