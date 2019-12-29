<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateUserDetailRequest;
use App\Repositories\UserDetails\UserDetailsRepositoryInterface;
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    protected $model;
    public function __construct(UserDetailsRepositoryInterface $userDetailsRepositoryInterface)
    {
        $this->model = $userDetailsRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(CreateUserDetailRequest $request)
    {
        $user = $this->model->create($request->validated());
        return response($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response($this->model->show($id)->load(['user']));
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
    public function update(CreateUserDetailRequest $request, $id)
    {
        $user = $this->model->update($request->validated(), $id);

        return response($user->load(['user']));
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
