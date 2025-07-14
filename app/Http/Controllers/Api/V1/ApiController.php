<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use Illuminate\Auth\Access\AuthorizationException;

class ApiController extends Controller
{
    use ApiResponses;

    protected $policyClass;

    /**
     * check authorization against the Controller defined policy
     */
    protected function isAbleTo(string $ability, $targetModel)
    {
        try {
            $this->authorize($ability, [$targetModel, $this->policyClass]);

            return true;
        } catch (AuthorizationException $ex) {
            return false;
        }
    }
}
