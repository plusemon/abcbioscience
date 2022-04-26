@extends('backend.layouts.app')
@section('title','Extra Exam')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Extra Exam</h4>
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



                <a href="{{ route('extraexam.create') }}" class="btn btn-primary btn-xs pull-right mb-2"> <i class="fa fa-plus"></i> Add New</a>

                <br>
                <div class="table-responsive">
                    <table id="datatables" class="table table-bordered table-hovered">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Name</th>
                            <th>MCQ Mark</th>
                            <th>Written Mark</th>
                            <th>Exam Date</th>

                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($extraexams as $extraexam)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $extraexam->exam_name }}</td>
                            <td>{{ $extraexam->mcq_mark }}</td>
                            <td>{{ $extraexam->written_mark }}</td>
                            <td>{{ $extraexam->exam_date }}</td>

                             <td>
                                <a href="{{ route('extraexam.edit', $extraexam->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{ route('extraexam.show', $extraexam->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> Show</a>

                                <form action="{{ route('extraexam.destroy',$extraexam->id) }}">
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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












@endsection