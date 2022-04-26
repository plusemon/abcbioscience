
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



                    

              <form action="{{route('admin.account.update', $account->id)}}" method="post">
                @csrf
                @method('PUT')

                <!--------Payment part---->
                    <div class="col-sm-12 col-md-12">
                        
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Payment Method:* </label>
                                    <select name="payment_method_id" id="payment_method_id_id"
                                        class="form-control">
                                        <option value="">Select Payment Method</option>
                                        @foreach ($paymentMethods as $item)
                                        <option {{$account->payment_method_id == $item->id?'selected':''}}
                                            value="{{$item->id}}">{{$item->method}}</option>
                                        @endforeach
                                    </select>
                                    <div style='color:red; padding: 0 5px;'>
                                        {{($errors->has('payment_method_id'))?($errors->first('payment_method_id')):''}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3" >
                                <div class="form-group">
                                    <label for="">Bank:* </label>
                                    <select name="bank_id" id="bank_id" class="form-control">
                                        <option value="">Select Bank</option>
                                        @foreach ($banks as $item)
                                        <option {{$account->bank_id == $item->id?'selected':''}}
                                            value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                    <div style='color:red; padding: 0 5px;'>
                                        {{($errors->has('bank_id'))?($errors->first('bank_id')):''}}</div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Account Name </label>
                                    <input name="account_name" placeholder="Account Name" id="account_name"
                                        type="text" class="form-control" value="{{$account->account_name}}">
                                    <div style='color:red; padding: 0 5px;'>
                                        {{ ($errors->has('account_name')) ? ($errors->first('account_name')) : ''}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Account No </label>
                                    <input name="account_no" placeholder="Account No" id="account_no"
                                        type="text" class="form-control" value="{{$account->account_no}}">
                                    <div style='color:red; padding: 0 5px;'>
                                        {{ ($errors->has('account_no')) ? ($errors->first('account_no')) : ''}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3" >
                                <div class="form-group">
                                    <label for="">Amount:* <small>(opening amount)</small></label>
                                    <input name="opening_amount" type="number" class="form-control" min="0"
                                        value="{{$account->opening_amount}}">
                                    <div style='color:red; padding: 0 5px;'>
                                        {{($errors->has('opening_amount'))?($errors->first('opening_amount')):''}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3" >
                                <div class="form-group">
                                    <label for="">Contract Person </label>
                                    <input name="contract_person" placeholder="Full Name" id="contract_person"
                                        type="text" class="form-control" value="{{$account->contract_person}}">
                                    <div style='color:red; padding: 0 5px;'>
                                        {{ ($errors->has('contract_person')) ? ($errors->first('contract_person')) : ''}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Contract Phone </label>
                                    <input name="contract_phone" placeholder="XXX-XXXXXXX" id="contract_phone"
                                        type="text" class="form-control" value="{{$account->contract_phone}}">
                                    <div style='color:red; padding: 0 5px;'>
                                        {{ ($errors->has('contract_phone')) ? ($errors->first('contract_phone')) : ''}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Address </label>
                                    <input name="address" placeholder="Address" id="address" type="text"
                                        class="form-control" value="{{$account->address}}">
                                    <div style='color:red; padding: 0 5px;'>
                                        {{ ($errors->has('address')) ? ($errors->first('address')) : ''}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for=""> </label>
                                    <input type="submit" value="Update" class="btn btn-primary" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--------Payment part---->
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
