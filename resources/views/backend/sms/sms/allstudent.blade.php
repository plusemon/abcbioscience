@extends('backend.layouts.app')
@section('title','All Student Send SMS')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">All Student Send SMS </h4>
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
                <form action="{{ route('allstudent.sms.send') }}" method="post">
                    @CSRF
                    
                    <div class="form-group">
                        <label for="message" class="col-sm-12 control-label">Message</label>
                        <div class="col-sm-12">
                             <textarea name="message" id="message"  class="form-control" rows="10" placeholder="Write sms here to send all students" required></textarea>
                            <span class="text-danger">{{ $errors->first('message') }}</span>

                            <ul id="sms-counter" class="list-unstyled pt-4">
                              <li>Length: <span class="length"></span></li>
                              <li>Messages: <span class="messages"></span></li>
                              <li>Per Message: <span class="per_message"></span></li>
                              <li>Remaining: <span class="remaining"></span></li>
                            </ul>
                                                         
                        </div>
                    </div>

                     

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
         </div>
    </div>












@endsection
