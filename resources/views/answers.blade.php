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
                            <th>Question</th>
                            <th>Options</th>
                            <th>Comment</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Question</th>
                            <th>Options</th>
                            <th>Comment</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->question->title ?? ''}}</td>
                                <td>{{$item->options}}</td>
                                <td>{{$item->comment}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@stop
