<?php

namespace App\Http\Controllers;

use App\Models\title;
use App\Http\Requests\StoretitleRequest;
use App\Http\Requests\UpdatetitleRequest;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretitleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(title $title)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(title $title)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatetitleRequest $request, title $title)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(title $title)
    {
        //
    }
}
