<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSeriesRequest;
use App\Jobs\UpdateSeriesParts;
use App\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param   Series $series
     * @return \Illuminate\Http\Response
     */
    public function show(Series $series)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param   Series $series
     * @return \Illuminate\Http\Response
     */
    public function edit(Series $series)
    {
        $series->load('parts');
        return view('series.edit', compact('series'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param   Series $series
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSeriesRequest $request, Series $series)
    {
        // php artisan queue:listen to run update method
        $series->update([
            'title' => $request->title
        ]);

        dispatch(new UpdateSeriesParts($series, $request->parts));
        return response(null, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   Series $series
     * @return \Illuminate\Http\Response
     */
    public function destroy(Series $series)
    {
        //
    }
}
