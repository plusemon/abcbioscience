@extends('backend.layouts.app')
@section('title','Session list')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Session  </h4>
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

                    <a href="javascript:void(0)" class="btn btn-primary btn-sm float-right mb-1" id="create-new-session"><i class="fa fa-plus"></i> Add Session</a>

                    <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th width="1%">ID</th>
                                <td>SL</td>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                    
                             
                        </tbody>
                    </table>
                </div>



                {{--  =============  for add new class ========================== --}}

                <div class="modal fade" id="ajax-session-modal" aria-hidden="true">
                 <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modeltitle"></h4>
                        </div>
                        <div class="modal-body">
                            <form id="sessionForm" name="sessionForm" class="form-horizontal">
                               <input type="hidden" name="sessiones_id" id="sessiones_id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Session</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"  value="" placeholder="Enter session name" required="">
                                    </div>
                                </div> 
                                <div class="col-sm-offset-2 col-sm-10">
                                 <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
                                 </button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                             
                        </div>
                    </div>
                 </div>
                </div>









                {{--  =============  for add new class ========================== --}}







            </div>
        </div>
        


@section('customjs')
    

    <script type="text/javascript">



        $(document).ready( function () {

           $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          $('#laravel_datatable').DataTable({
                 processing: true,
                 serverSide: true,
                 ajax: {
                  url: "{{ route('sessiones.index') }}",
                  type: 'GET',
                 },
                 columns: [
                          {data: 'id', name: 'id', 'visible': false},
                          {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                          { data: 'name', name: 'name' },
                          {data: 'action', name: 'action', orderable: false},
                       ],
                order: [[0, 'ASC']]
              });


 

           /* When click edit user */
          $('body').on('click', '.edit-session', function () {
            var sessiones_id = $(this).data('id');
            $.get('edit/'+sessiones_id, function (data) {
               
               $('#modeltitle').html("Edit Session");
                $('#btn-save').val("edit-session");
                $('#ajax-session-modal').modal('show');
                $('#sessiones_id').val(data.id);
                $('#name').val(data.name);
                
            })
         });
       
          $('body').on('click', '#delete-session', function () {
        
              var session_id = $(this).data("id");
              
              if(confirm("Are You sure want to delete !")){
                $.ajax({
                    type: "get",
                    url: "destroy/"+session_id,
                    success: function (data) {
                    var oTable = $('#laravel_datatable').dataTable(); 
                    oTable.fnDraw(false);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
              }
          }); 

 


         /*  When user click add user button */
            $('#create-new-session').click(function () {
                $('#btn-save').val("create-product");
                $('#session_id').val('');
                $('#sessionForm').trigger("reset");
                $('#modeltitle').html("Add New Session");
                $('#ajax-session-modal').modal('show');
            });


            if ($("#sessionForm").length > 0) {
                    $("#sessionForm").validate({
                
                   submitHandler: function(form) {
                
                    var actionType = $('#btn-save').val();
                    $('#btn-save').html('Sending..');
                     
                    $.ajax({
                        data: $('#sessionForm').serialize(),
                        url:"{{ route('sessiones.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                
                            $('#sessionForm').trigger("reset");
                            $('#ajax-session-modal').modal('hide');
                            $('#btn-save').html('Save');
                            var oTable = $('#laravel_datatable').dataTable();
                            oTable.fnDraw(false);
                             
                        },
                        error: function (data) {
                            console.log('Error:', data);
                            $('#btn-save').html('Save');
                        }
                    });
                  }
                })
              }



        });

    </script>
    
@endsection
@endsection