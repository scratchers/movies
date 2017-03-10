<?php

namespace App\Http\Controllers;

use App\Filter;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * Creates Tag Controller.
     *
     * @return TagController
     */
    public function __construct()
    {
        $this->authorizeResource(Filter::class);
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
        return view('filters.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filter = new Filter([
            'name' => $request->input('name'),
            'path' => $request->input('path'),
        ]);

        $request->user()->filters()->save($filter);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vista  $vista
     * @return \Illuminate\Http\Response
     */
    public function show(Vista $vista)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vista  $vista
     * @return \Illuminate\Http\Response
     */
    public function edit(Vista $vista)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vista  $vista
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vista $vista)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vista  $vista
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vista $vista)
    {
        //
    }
}
