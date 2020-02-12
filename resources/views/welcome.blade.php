@extends('layout')
@section("content")
    <div class="container-fluid">
        <div class="card mb-3">
            <form method="post" action="/survey">
                @csrf
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Add Survey</h6>
                </div>
                <div class="card-body">
                    <input type="text" name="title" class="form-control"/>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>


        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Surveys</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Add Question</th>
                            <th>View Questions</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Title</th>
                            <th>Add Question</th>
                            <th>View Questions</th>
                            <th>Delete</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($items as $item)
                            <tr>
                                <td>{{$item->title}}</td>
                                <td><a href="/questions/create?sid={{$item->id}}">Add Question</a></td>
                                <td><a href="/questions?sid={{$item->id}}">View Questions</a></td>
                                <td><a href="javascript:;" class="text-danger" onclick="$(this).next().submit()">Delete</a>
                                    <form method="post" action="/survey/{{$item->id}}">
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