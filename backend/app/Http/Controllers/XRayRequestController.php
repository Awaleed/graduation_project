<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreXRayRequestRequest;
use App\Http\Requests\UpdateXRayRequestRequest;
use App\Models\XRayRequest;

class XRayRequestController extends Controller
{
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
     * @param  \App\Http\Requests\StoreXRayRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreXRayRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\XRayRequest  $xRayRequest
     * @return \Illuminate\Http\Response
     */
    public function show(XRayRequest $xRayRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\XRayRequest  $xRayRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(XRayRequest $xRayRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateXRayRequestRequest  $request
     * @param  \App\Models\XRayRequest  $xRayRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateXRayRequestRequest $request, XRayRequest $xRayRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\XRayRequest  $xRayRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(XRayRequest $xRayRequest)
    {
        //
    }
}
