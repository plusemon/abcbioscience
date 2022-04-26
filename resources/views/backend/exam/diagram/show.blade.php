@extends('backend.layouts.app')
@section('title', 'Diagram Exam Results')
@section('content')

    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Result View </h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload">
                        <i class="fa fa-redo"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse">
                        <i class="fa fa-minus"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove">
                        <i class="fa fa-times"></i>
                    </a>

                </div>
            </div>
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>Name of Exam</td>
                        <td>:</td>
                        <td>{{ optional($result->topic)->question_no }}</td>
                        <td>Student Name</td>
                        <td>:</td>
                        <td> {{ optional($result->user)->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Class</td>
                        <td>:</td>
                        <td>{{ optional($result->class)->name }}</td>
                        <td>Date</td>
                        <td>:</td>
                        <td>{{ $result->created_at->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td>Session</td>
                        <td>:</td>
                        <td>{{ optional($result->session)->name }}</td>
                        <td>Subject</td>
                        <td>:</td>
                        <td>{{ optional($result->subject)->name }}</td>
                    </tr>
                    <tr>
                        <td>Answersheets</td>
                        <td>:</td>
                        <td>
                            <ul class="list-group">
                               
                            </ul>
                        </td>
                        <td>Result</td>
                        <td>:</td>
                        <td>{!! $result->result ?? '<i>result not not set yet</i>' !!}</td>
                    </tr>
                </table>
                <form action="{{ route('admin.written.exam.results.update', $result->id) }}" method="POST" class="d-flex justify-content-center">
                    @csrf
                    @method('put')
                    <div class="mx-2">
                        <input type="text" value="{{ $result->result }}" min="0" max="100" name="result" class="form-control text-center" autocomplete="false" placeholder="result">
                    </div>
                    <button class="btn btn-success">Set Result</button>
                </form>
                <button onclick="window.history.back()" class="btn btn-dark">Back to list</button>
            </div>
        </div>

    </div>
    </div>

@endsection
