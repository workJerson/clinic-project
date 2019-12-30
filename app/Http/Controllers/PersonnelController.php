<?php

namespace App\Http\Controllers;

use App\Http\Filters\ResourceFilters;
use App\Http\Requests\Personnel\CreatePersonnelRequest;
use App\Repositories\Personnel\PersonnelRepositoryInterface;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    protected $model;

    public function __construct(PersonnelRepositoryInterface $personnelRepositoryInterface)
    {
        $this->model = $personnelRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResourceFilters $filters)
    {
        return $this->generateCachedResponse(function () use ($filters) {
            $personnel = $this->model->filter($filters)
                ->with([
                    'patientServiceHistory',
                ]);

            return $this->paginateOrGet($personnel);
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
    public function store(CreatePersonnelRequest $request)
    {
        $personnel = $this->model->create($request->validated());
        return response($personnel, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $personnel = $this->model->show($id);
        return response($personnel->load([
            'patientServiceHistory',
        ]));
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
    public function update(CreatePersonnelRequest $request, $id)
    {
        $personnel = $this->model->update($request->validated(), $id);
        return response($personnel);
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
