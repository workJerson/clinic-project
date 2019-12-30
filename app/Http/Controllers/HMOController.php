<?php

namespace App\Http\Controllers;

use App\Http\Filters\ResourceFilters;
use App\Http\Requests\HMO\CreateHMORequest;
use App\Repositories\HMO\HmoRepositoryInterface;
use Illuminate\Http\Request;

class HMOController extends Controller
{
    protected $model;

    public function __construct(HmoRepositoryInterface $hmoRepositoryInterface)
    {
        $this->model = $hmoRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResourceFilters $filters)
    {
        return $this->generateCachedResponse(function () use ($filters) {
            $hmo = $this->model->filter($filters)
                ->with([
                    'patientHmo',
                ]);

            return $this->paginateOrGet($hmo);
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
    public function store(CreateHMORequest $request)
    {
        $hmo = $this->model->create($request->validated());
        return response($hmo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $hmo = $this->model->show($id);
        return response($hmo->load(['patientHmo']));
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
    public function update(CreateHMORequest $request, $id)
    {
        $hmo = $this->model->update($request->validated(), $id);
        return response($hmo);
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
