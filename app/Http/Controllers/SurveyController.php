<?php

namespace App\Http\Controllers;

use App\Answer;
use App\AnswerSet;
use App\Question;
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
                $question = Question::find($qid);
                if ($question) {
                    if ($question->type == 'Picture') {
                        if ($options) {
                            $file = uniqid("uploads/") . ".jpg";
                            file_put_contents(public_path($file), base64_decode($options));
                            $selectedOptions[] = url($file);
                        }
                    } elseif ($question->type == 'Ranking') {
                        $selectedOptions = $options;
                    } else {
                        foreach ($options as $option => $isSelected) {
                            if ($isSelected == 'true') {
                                $selectedOptions[] = $option;
                            }
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

        }
        return response()->json(['status' => 'success']);
    }

    function export($id)
    {
        $survey = Survey::findOrFail($id);
        $answerSets = $survey->answer_sets;
        $file = "exports/" . time() . '.csv';
        $handle = fopen($file, "w+");
        $heads = [];
        foreach ($survey->questions as $question) {
            $heads[] = $question->title;
            $heads[] = '';
        }
        fputcsv($handle, $heads);
        foreach ($answerSets as $answerSet) {
            $values = [];
            foreach ($survey->questions as $question) {
                $answer = $answerSet->answers()->where("question_id", $question->id)->first();
                if ($answer) {
                    $values[] = $answer->options;
                    $values[] = $answer->comment;
                } else {
                    $values[] = '';
                    $values[] = '';
                }
            }
            fputcsv($handle, $values);
        }
        fclose($handle);
        return response()->download(public_path($file), "survey-$survey->title-export.csv");

    }
}
