@extends('backend.layouts.app')
@section('title','Sheet Setting ')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Sheet Setting </h4>
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





                <form action="{{ route('admin.sheet.setting.update', $setting->id ) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="row" >

                        <div class="col-xs-12 col-sm-6 col-md-5">
                            <div class="form-group">
                                <label for="Session">Sheet No/Name :</label>
                                <input type="text" value="{{$sheetName}}" disabled class=" form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Session">Subject :</label>
                                <input type="text" value="{{$subjectName}}" disabled class=" form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Sheet Type :</label>
                                <input type="text" value="{{$sheetTypeName}}" disabled class=" form-control"/>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="class">Class :</label>
                                <input type="text" value="{{$className}}" disabled class="batch_setting_id form-control"/>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Session :</label>
                                <input type="text" value="{{$sessionName}}" disabled class="batch_setting_id form-control"/>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Batch Setting">Batch  :</label>
                                <select name="batch_setting_id" id="" class="batch_setting_id form-control" required>
                                    <option  value="">Select Batch</option>
                                    @foreach($batches as $batch)
                                        <option {{ $setting->batch_setting_id == $batch->id ? 'selected' :'' }} value="{{ $batch->id }}"> {{ $batch->batch_name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_setting_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Batch Type :</label>
                                <select name="batch_type_id" id="batch_type_id" class="batch_type_id form-control" required>
                                    <option value="">Select Session</option>
                                    @foreach($batchTypies as $batchType)
                                        <option {{ $setting->batch_type_id  == $batchType->id ? 'selected' :'' }} value="{{ $batchType->id }}"> {{ $batchType->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_type_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Publish</label>
                                <select name="publish_by" id="publish_by" class="form-control" required>
                                    <option value="1" {{ $setting->publish_by  == 1 ? 'selected' :'' }}>Now</option>
                                    <option value="2" {{ $setting->publish_by  == 2 ? 'selected' :'' }}>Later</option>
                                     
                                </select>
                                <div class="text-danger">{{ $errors->first('taken_by') }}</div>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Publish Date :</label>
                                <input type="date" value="{{ $setting->publish_date }}" name="publish_date" class="form-control" required/>
                                <div class="text-danger">{{ $errors->first('publish_date') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Batch Setting">Fee Category  :</label>
                                <select name="fee_cat_id" class="form-control" required>
                                    <option value="">Fee Category</option>
                                    @foreach($fee_categories as $fee_cat)
                                    <option {{ $setting->fee_cat_id  == $fee_cat->id ? 'selected' :'' }} value="{{ $fee_cat->id }}">{{ $fee_cat->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('fee_cat_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Batch Setting">Pay Times  :</label>
                                <select name="pay_time_id" id="pay_time_id" class="form-control" required>
                                    <option value="">Select Pay Time</option>
                                    @foreach($payTimes as $paytime)
                                    <option {{ optional($setting->amounts)->pay_time_id == $paytime->id ? 'selected' :'' }} value="{{ $paytime->id }}">{{ $paytime->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('pay_time_id') }}</div>
                            </div>
                        </div>



                        
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input type="number" value="{{ optional($setting->amounts)->amount }}" name="amount" step="any" class="form-control" placeholder="Amount"/>
                                <div class="text-danger">{{ $errors->first('amount') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Taken By</label>
                                <select name="taken_by" id="taken_by" class="form-control" required>
                                    <option value="1" {{ $setting->taken_by = 1 ? 'selected':''}}>Global Student</option>
                                    <option value="2" {{ $setting->taken_by = 2 ? 'selected':''}}>Only Batch Student</option>
                                     
                                </select>
                                <div class="text-danger">{{ $errors->first('taken_by') }}</div>
                            </div>
                        </div>

                        

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <input type="submit" value="Submit" class="btn btn-primary" />
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
