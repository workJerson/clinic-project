<?php

namespace App\Http\Controllers;

use App\Http\Filters\ResourceFilters;
use App\Http\Requests\Service\CreateServiceTypeRequest;
use App\Repositories\Service\ServiceTypeRepositoryInterface;
use Illuminate\Http\Request;

class ServiceTypeController extends Controller
{
    protected $model;

    public function __construct(ServiceTypeRepositoryInterface $serviceTypeRepositoryInterface)
    {
        $this->model = $serviceTypeRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResourceFilters $filters)
    {
        return $this->generateCachedResponse(function () use ($filters) {
            $serviceType = $this->model->filter($filters)
                ->with([
                    'services',
                ]);

            return $this->paginateOrGet($serviceType);
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateServiceTypeRequest $request)
    {
        $serviceType = $this->model->create($request->validated());
        return response($serviceType, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $serviceType = $this->model->show($id);

        return response($serviceType->load(['services']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateServiceTypeRequest $request, $id)
    {
        $serviceType = $this->model->update($request->validated(), $id);
        return response($serviceType);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
