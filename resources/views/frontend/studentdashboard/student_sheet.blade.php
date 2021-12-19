@extends('frontend.layouts.app')
@section('title', 'Available Sheet')
@section('content')

    <!--USER DASHBOARD-->
    <section class="user-dashboard py-4">
        <div class="container">
            <div class="dashboard-area d-flex bd-highlight">



            @include('frontend.studentdashboard.dashboardmenu')


              <div class="dashboard-main w-100 bd-highlight py-3">
                  <div class="dr-head dashboard-header">
                      <div class="ud-mobile">
                            <i class="fa fa-bars" id="ud-mobile-btn"></i> Profile Menu
                        </div>
                        <h6>Available Sheet </h6>

                    </div>
                    <div class="hr-body">


                          <div class="table-responsive">
                                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
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
                                             @if ($element->sheet->download_capability)
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
    </section>
    <!--END USER DASHBOARD-->



    @include('frontend.studentdashboard.mobilemenu')


@endsection
