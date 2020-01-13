<?php

namespace App\Http\Controllers;

use App\Http\Filters\ResourceFilters;
use App\Http\Requests\Patient\CreatePatientServiceHistoryRequest;
use App\Repositories\PatientServiceHistory\PatientServiceHistoryRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use DB;

class PatientServiceHistoryController extends Controller
{
    protected $model;

    public function __construct(PatientServiceHistoryRepositoryInterface $patientServiceHistoryController)
    {
        $this->model = $patientServiceHistoryController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResourceFilters $filters)
    {
        return $this->generateCachedResponse(function () use ($filters) {
            $serviceHistories = $this->model->filter($filters)
                ->with([
                    'patient',
                    'patientHmo',
                    'transactions',
                    'personnel',
                ]);

            return $this->paginateOrGet($serviceHistories);
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
    public function store(CreatePatientServiceHistoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $payload = $request->validated();
            $serviceHistory = $this->model->store($payload);

            if (isset($serviceHistory['error'])) {
                return response($serviceHistory, 400);
            }

            if ($payload['patient_transactions']) {
                foreach ($payload['patient_transactions'] as $key => $value) {
                    $serviceHistory->transactions()->create($value);
                }
            }

            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
            dd($ex);
        }

        return response($serviceHistory, 201);
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
            'patient',
            'patientHmo',
            'transactions',
            'personnel',
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
    public function update(CreatePatientServiceHistoryRequest $request, $id)
    {
        $payload = $request->validated();
        try {
            DB::beginTransaction();
            $object = $this->model->update($payload, $id);
            switch ($payload['transaction_status']) {
                case 2:
                    $totalAmount = 0;
                    foreach ($object->transactions as $value) {
                        $totalAmount += $value->rate->total_rate;
                    }
                    $object->total_charges = $totalAmount;
                    if (isset($object->patientHmo->hmo->discount)) {
                        $discount = $object->patientHmo->hmo->discount;
                        $object->discount_rate = $discount;
                        $object->discounted_charges = $totalAmount - ($totalAmount * ($discount / 100));
                    }
                    $object->save();
                    break;

                default:
                    break;
            }
            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
            dd($ex);
        }
        return response($object);
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
