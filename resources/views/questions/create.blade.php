@extends('layout')
@section("content")
    <div class="container-fluid">
        <div class="card mb-3">
            <form method="post" action="/questions">
                @csrf
                <input type="hidden" name="id" value="{{$item->id ?? ''}}">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Add Question</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="hidden" name="survey_id" value="{{request('sid',$item->survey_id ?? null)}}"/>
                        <input type="text" value="{{$item->title ?? ''}}" name="title" class="form-control" placeholder="Title"/>
                    </div>
                    <div class="form-group">
                        <input type="text" value="{{$item->title_ur ?? ''}}" name="title_ur" class="form-control" placeholder="Title Urdu"/>

                    </div>
                    <div class="form-group">
                        <select class="form-control" name="type">
                            <option {{($item->type??null) == 'Short Answer'?'selected':''}}>Short Answer</option>
                            <option {{($item->type??null) == 'Multiple Choice'?'selected':''}}>Multiple Choice</option>
                            <option {{($item->type??null) == 'Long Answer'?'selected':''}}>Long Answer</option>
                            <option {{($item->type??null) == 'Ranking'?'selected':''}}>Ranking</option>
                            <option {{($item->type??null) == 'Picture'?'selected':''}}>Picture</option>
                            {{--                            <option>Location</option>--}}
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Options" name="options">{{$item->options ?? ''}}</textarea>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Options Urdu" name="options_ur">{{$item->options_ur ?? ''}}</textarea>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@stop
