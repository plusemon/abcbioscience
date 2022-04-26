@extends('backend.layouts.app')
@section('title','Fee Setting')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Fee Setting  </h4>
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


                    @if (session()->has('error'))
                    <div class="alert alert-danger">
                        @if(is_array(session('error')))
                            <ul>
                                @foreach (session('error') as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        @else
                            {{ session('error') }}
                        @endif
                    </div>
                    @endif



                    

                <form action="{{ route('admin.waiver.store') }}" method="post">
                    @CSRF
                    <div class="row" >

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="name" value="" name="name" class="form-control" placeholder="Name"/>
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            </div>
                        </div>
                       

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="class">Waiver Type :</label>
                                <select name="waiver_type_id" id="class_id" class="form-control" required>
                                    <option value="">Select Waiver Type</option>
                                    @foreach($waiverTypes as $webtype)
                                        <option {{ old('waiver_type_id') == $webtype->id ? 'selected' :'' }} value="{{ $webtype->id }}"> {{ $webtype->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('waiver_type_id') }}</div>
                            </div>
                        </div>

                        
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="">Waiver Value (amount)</label>
                                <input type="number" value="" name="amount" class="form-control" placeholder="Amount"/>
                                <div class="text-danger">{{ $errors->first('amount') }}</div>
                            </div>
                        </div>
                       
                        <div class="col-xs-12 col-sm-6 col-md-2">
                            <input type="submit" value="Submit" class="btn btn-primary" style="margin-top:5%;"/>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>







@section('customjs')

    <script>
        $(document).ready( function () {
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

         $('#session_id').on('change', function () {
              var class_id    = $('#class_id').val();
              var session_id  = $('#session_id').val();
                $.ajax({
                    type: "get",
                    url: "{{ route('get.batch.setting') }}",
                    data: {class_id:class_id,session_id:session_id},
                    success: function (data) {
                         $("#batch_setting_id").html(data);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            });
        });
    </script>


@endsection
@endsection
