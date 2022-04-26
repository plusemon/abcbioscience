@extends('backend.layouts.app')
@section('title','Fee Category')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Fee Category  </h4>
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


                <form action="{{ route('admin.fee-category.store') }}" method="post" >
                    @CSRF
                    <div class="row">
                        {{-- <div class="col-xs-12 col-sm-6 col-md-5">
                            <div class="form-group">
                                <label for="">Module</label>
                                <select name="module_id" class="form-control" required>
                                    <option value="">Select Module</option>
                                    @foreach ($modules as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('module_id') }}</div>
                            </div>
                        </div> --}}
                        
                        <div class="col-xs-12 col-sm-6 col-md-5">
                            <div class="form-group">
                                <label for="">Fee Category</label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Fee Category" >
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-5">
                            <div class="form-group">
                                <label for="">Fee Category Type</label>
                                <select name="fee_category_type_id" class="form-control" required>
                                    <option value="">Select Fee Category Type</option>
                                    @foreach ($typies as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('fee_category_type_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-2">
                            <button type="submit" class="btn btn-primary" style="margin-top:16%;">Submit</button>
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
