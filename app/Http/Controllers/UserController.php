<?php

namespace App\Http\Controllers;

use App\Http\Requests\JSONAPIRequest;
use App\Services\JSONAPIService;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * PostController constructor.
     */
    private $service;
    public function __construct(JSONAPIService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->service->index(User::class, 'user');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(JSONAPIRequest $request)
    {
        $data = $request->all();
        $data['password'] = $this->service->Hash($request->password);
        return $this->service->create(User::class, $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->service->show(User::class, $id,'user');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['password'] = $this->service->Hash($request->password);
        return $this->service->update(User::class, $data, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->service->delete(User::class, $id);
    }
}
