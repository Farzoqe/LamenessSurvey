@extends('layout')
@section("content")
    <div class="container-fluid">
        <div class="card mb-3">
            <form method="post" action="/questions">
                @csrf
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Add Question</h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="hidden" name="survey_id" value="{{request('sid')}}"/>
                        <input type="text" name="title" class="form-control" placeholder="Title"/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="title_ur" class="form-control" placeholder="Title Urdu"/>

                    </div>
                    <div class="form-group">
                        <select class="form-control" name="type">
                            <option>Short Answer</option>
                            <option>Multiple Choice</option>
                            <option>Long Answer</option>
                            <option>Ranking</option>
                            <option>Picture</option>
{{--                            <option>Location</option>--}}
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Options" name="options"></textarea>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="Options Urdu" name="options_ur"></textarea>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@stop
