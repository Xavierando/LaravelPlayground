<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Filters\V1\ServiceFilter;
use App\Http\Requests\Api\V1\StoreServiceRequest;
use App\Http\Resources\V1\ServiceResource;
use App\Models\Service;
use App\Policies\ServicePolicy;
use Illuminate\Http\Request;

class ServiceController extends ApiController
{
    protected $policyClass = ServicePolicy::class;
    /**
     * Display a listing of the resource.
     */
    public function index(ServiceFilter $filter)
    {
        return ServiceResource::collection(Service::filter($filter)->paginate());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        if ($this->isAbleTo('store', Service::class)) {
            return new ServiceResource(Service::create($request->mappedAttributes()));
        }

        return $this->notAuthorized('Unauthorized');  
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return new ServiceResource($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        if ($this->isAbleTo('update', $service)) {
            $service->update($request->mappedAttributes());
            return new ServiceResource($service);
        }

        return $this->notAuthorized('Unauthorized');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Service $service)
    {
        if ($this->isAbleTo('delete', $service)) {
            $service->delete();

            return $this->ok('Service successfully deleted');
        }

        return $this->notAuthorized('Unauthorized');
    }
}
