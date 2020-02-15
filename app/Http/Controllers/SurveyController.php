<?php

namespace App\Http\Controllers;

use App\Answer;
use App\AnswerSet;
use App\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome', [
            'items' => Survey::all(),

        ]);

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
        Survey::create($request->all());
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Survey $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Survey $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Survey $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Survey $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        $survey->delete();
        return redirect()->back();

    }

    function json()
    {
        return response()->json(Survey::with("questions")->get());
    }

    function saveAnswers(Request $request)
    {
//        dd($request->all());
//        mail('farzoqe@gmail.com', 'String request data', json_encode($request->all()));
        foreach ($request->data ?? [] as $surveyData) {
            $surveyId = $surveyData['surveyId'];
            $optionAnswers = $surveyData['optionAnswers'];
//            $comments = [];
            foreach ($surveyData['comments'] as $qid => $comment) {
                if (!isset($optionAnswers[$qid])) {
                    $optionAnswers[$qid] = [];
                }
            }
            $set = AnswerSet::create(['survey_id' => $surveyId]);
            foreach ($optionAnswers as $qid => $options) {
                $selectedOptions = [];
                foreach ($options as $option => $isSelected) {
                    if ($isSelected == 'true') {
                        $selectedOptions[] = $option;
                    }
                }
                Answer::create([
                    'answer_set_id' => $set->id,
                    'comment' => $surveyData['comments'][$qid] ?? null,
                    'options' => implode(', ', $selectedOptions),
                    'question_id' => $qid,
                ]);
            }

        }
        return response()->json(['status' => 'success']);
    }
}
