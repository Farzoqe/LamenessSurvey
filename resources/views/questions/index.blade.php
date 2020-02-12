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
                            <th>Title</th>
                            <th>Options</th>
                            <th>Type</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Options</th>
                            <th>Type</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->title}}</td>
                                <td>{{$item->options}}</td>
                                <td>{{$item->type}}</td>
                                <td><a href="javascript:;" class="text-danger" onclick="$(this).next().submit()">Delete</a>
                                    <form method="post" action="/questions/{{$item->id}}">
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