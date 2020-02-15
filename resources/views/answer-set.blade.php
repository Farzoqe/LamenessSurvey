@extends('layout')
@section("content")
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Questions</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Survey</th>
                            <th>Date</th>
                            <th>Show Answers</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Survey</th>
                            <th>Date</th>
                            <th>Show Answers</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->survey->title ?? ''}}</td>
                                <td>{{$item->created_at->toDateString()}}</td>
                                <td><a href="/answer-set/{{$item->id}}">Show Answers</a></td>
                                <td><a href="javascript:;" class="text-danger" onclick="$(this).next().submit()">Delete</a>
                                    <form method="post" action="/answer-set/{{$item->id}}">
                                        @method("delete")
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@stop
