<?php

namespace App\Http\Controllers;

use App\Http\Filters\ResourceFilters;
use App\Http\Requests\Patient\CreatePatientHmoRequest;
use App\Repositories\PatientHmo\PatientHmoRepositoryInterface;
use Illuminate\Http\Request;

class PatientHmoController extends Controller
{
    protected $model;

    public function __construct(PatientHmoRepositoryInterface $patientHmoRepositoryInterface)
    {
        $this->model = $patientHmoRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResourceFilters $filters)
    {
        return $this->generateCachedResponse(function () use ($filters) {
            $patientHmo = $this->model->filter($filters)
                ->with([
                    'patient',
                    'hmo',
                ]);

            return $this->paginateOrGet($patientHmo);
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
    public function store(CreatePatientHmoRequest $request)
    {
        $patientHmo = $this->model->create($request->validated());
        return response($patientHmo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patientHmo = $this->model->show($id);

        return response($patientHmo->load([
            'patient',
            'hmo'
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
    public function update(CreatePatientHmoRequest $request, $id)
    {
        $patientHmo = $this->model->update($request->validated(), $id);
        return response($patientHmo);
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
