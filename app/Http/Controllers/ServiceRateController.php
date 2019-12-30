<?php

namespace App\Http\Controllers;

use App\Http\Filters\ResourceFilters;
use App\Http\Requests\Service\CreateServiceRateRequest;
use App\Repositories\ServiceRate\ServiceRateRepositoryInterface;
use Illuminate\Http\Request;

class ServiceRateController extends Controller
{
    private $model;

    public function __construct(ServiceRateRepositoryInterface $serviceRateRepositoryInterface)
    {
        $this->model = $serviceRateRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResourceFilters $filters)
    {
        return $this->generateCachedResponse(function () use ($filters) {
            $serviceRate = $this->model->filter($filters)
                ->with([
                    'hmo',
                    'service'
                ]);

            return $this->paginateOrGet($serviceRate);
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
    public function store(CreateServiceRateRequest $request)
    {
        $serviceRate = $this->model->create($request->validated());

        return response($serviceRate, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->model->show($id)->load([
            'hmo',
            'service'
        ]);

        return response($data);
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
    public function update(CreateServiceRateRequest $request, $id)
    {
        $serviceRate = $this->model->update($request->validated(), $id);

        return response($serviceRate->load([
            'hmo',
            'service'
        ]));
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
