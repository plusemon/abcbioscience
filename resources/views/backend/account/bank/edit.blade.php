 
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



                    

                 <form action="{{route('admin.bank.update',$bank->id)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Bank Name</label>
                                <input value="{{$bank->name}}" name="name" type="text" placeholder="Full name" class="form-control">
                                <div style='color:red; padding: 0 5px;'>{{($errors->has('name'))?($errors->first('name')):''}}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Short Name</label>
                                <input value="{{$bank->short_name}}" name="short_name" type="text" placeholder="Short Name" class="form-control">
                                <div style='color:red; padding: 0 5px;'>{{($errors->has('short_name'))?($errors->first('short_name')):''}}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Address</label>
                                <input value="{{$bank->address}}" name="address" type="text" placeholder="Address" class="form-control">
                                <div style='color:red; padding: 0 5px;'>{{($errors->has('address'))?($errors->first('address')):''}}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" value="Update">
                                <a href="{{route('admin.bank.index')}}" class="btn btn-info">Back</a>
                            </div>
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
