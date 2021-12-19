@extends('students.layouts.app')
@section('title', 'Available Sheets')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Available Sheets</h4>
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
                <div class="row">
                    <div class="col-md-12">



                          <div class="table-responsive">
                                <table id="" class="table table-striped table-bordered table-td-valign-middle datatables">
                                <thead>
                                    <tr>
                                        <th width="1%">ID</th>
                                        <th class="text-nowrap">Sheet No/Name</th>
                                        <th class="text-nowrap">Class</th>
                                        <th class="text-nowrap">Session</th>
                                        <th class="text-nowrap">Batch</th>
                                        <th class="text-nowrap">Subject</th>
                                        <th class="text-nowrap">Publish Date</th>
                                        <th class="text-nowrap">File</th>

                                    </tr>
                                </thead>
                                <tbody>

                                  @foreach ($sheetsetting as $element)
                                     <tr>
                                          <td> {{ $loop->iteration }}</td>
                                          <td> {{ $element->sheets?$element->sheets->sheet_no:'' }} </td>
                                          <td> {{ $element->classes?$element->classes->name:'' }}</td>
                                          <td> {{ $element->sessiones?$element->sessiones->name:'' }}</td>
                                          <td> {{ $element->batchsetting?$element->batchsetting->batch_name:'' }}</td>
                                          <td> {{ $element->subjects?$element->subjects->name:'' }}</td>
                                          <td> {{ Date('d-m-Y',strtotime($element->publish_date ))}}</td>
                                          <td>
                                             @if ($element->sheet?$element->sheet->download_capability:'')
                                                <a href="{{ asset($element->sheets?$element->sheets->sheet_file:'') }}" class="btn btn-primary btn-sm" download> <i class="fa fa-download"> </i> Download </a>
                                                @else
                                                Not Allowed
                                            @endif
                                            
                                        </td>
                                     </tr>
                                  @endforeach




                                </tbody>
                            </table>

                          </div>




                    </div>
                </div>

            </div>
        </div>
    </div>
     


@endsection
