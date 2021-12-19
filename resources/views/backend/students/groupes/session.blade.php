@extends('backend.layouts.app')
@section('title','Student Session Folder list ')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Student Session Folder list  </h4>
                    
                </div>
                <div class="panel-body">
  						
  						<div class="row">
  							@foreach($sessiones as $session)
  							<div class="col-md-3">
  								 <a href="{{ route('student.folder.class',$session->id) }}"  class="p-2 text-decoration-none text-success">   <h1><i class="fa fa-folder"></i> {{ $session->name }}</h1> </a>
  							</div>
  							@endforeach

  						</div>  
                </div>
            </div>
        </div>


 
@endsection
