<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Patient\PatientRepositoryInterface;
use App\Http\Filters\ResourceFilters;
use App\Http\Requests\Patient\CreatePatientRequest;

class PatientController extends Controller
{
    private $model;

    public function __construct(PatientRepositoryInterface $patient)
    {
        $this->model = $patient;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResourceFilters $filters)
    {
        return $this->generateCachedResponse(function () use ($filters) {
            $patients = $this->model->filter($filters)
                ->with([
                    'serviceHistories',
                    'serviceHistories.patientHmo',
                    'hmos',
                ]);

            return $this->paginateOrGet($patients);
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePatientRequest $request)
    {
        $patient = $this->model->create($request->validated());

        return response($patient, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->model->show($id)->load([
            'serviceHistories',
            'serviceHistories.patientHmo',
            'hmos',
        ]);

        return response($data);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePatientRequest $request, $id)
    {
        $patient = $this->model->update($request->validated(), $id);
        return response($patient->load(['serviceHistories', 'serviceHistories.transactions', 'hmos']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }
}
