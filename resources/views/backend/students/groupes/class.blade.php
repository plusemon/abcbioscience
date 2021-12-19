@extends('backend.layouts.app')
@section('title','Student Class Folder list ')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Student Class Folder list  </h4>
                    
                </div>
                <div class="panel-body">
  						
  						<div class="row">
  							@foreach($classes as $class)
  							<div class="col-md-3">
  								 <a href="{{ route('student.folder.batch',$class->id) }}"  class="p-2 text-decoration-none text-success">   <h1><i class="fa fa-folder"></i> {{ $class->name }}</h1> </a>
  							</div>
  							@endforeach

  						</div>  
                </div>
            </div>
        </div>


 
@endsection
