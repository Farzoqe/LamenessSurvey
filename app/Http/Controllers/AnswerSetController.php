<?php

namespace App\Http\Controllers;

use App\AnswerSet;
use Illuminate\Http\Request;

class AnswerSetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("answer-set", ['items' => AnswerSet::all()]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\AnswerSet $answerSet
     * @return \Illuminate\Http\Response
     */
    public function show(AnswerSet $answerSet)
    {
        return view("answers", [
            'items' => $answerSet->answers
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\AnswerSet $answerSet
     * @return \Illuminate\Http\Response
     */
    public function edit(AnswerSet $answerSet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\AnswerSet $answerSet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnswerSet $answerSet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\AnswerSet $answerSet
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnswerSet $answerSet)
    {
        $answerSet->delete();
        return redirect()->back();
    }
}
