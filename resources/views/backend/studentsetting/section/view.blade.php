@extends('backend.layouts.app')
@section('title','Section List')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Section  </h4>
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

                    <a href="javascript:void(0)" class="btn btn-primary btn-sm float-right mb-1" id="create-new-section"><i class="fa fa-plus"></i> Add Section</a>

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

                <div class="modal fade" id="ajax-section-modal" aria-hidden="true">
                 <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modeltitle"></h4>
                        </div>
                        <div class="modal-body">
                            <form id="sectionForm" name="sectionForm" class="form-horizontal">
                               <input type="hidden" name="section_id" id="section_id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Section</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"  value="" placeholder="Enter class name" required="">
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
                  url: "{{ route('section.index') }}",
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
          $('body').on('click', '.edit-section', function () {
            var section_id = $(this).data('id');
            $.get('edit/'+section_id, function (data) {
               $('#title-error').hide();
               $('#product_code-error').hide();
               $('#description-error').hide();
               $('#modeltitle').html("Edit Section");
                $('#btn-save').val("edit-section");
                $('#ajax-section-modal').modal('show');
                $('#section_id').val(data.id);
                $('#name').val(data.name);
                
            })
         });
       
          $('body').on('click', '#delete-section', function () {
        
              var section_id = $(this).data("id");
              
              if(confirm("Are You sure want to delete !")){
                $.ajax({
                    type: "get",
                    url: "destroy/"+section_id,
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
            $('#create-new-section').click(function () {
                $('#btn-save').val("create-product");
                $('#section_id').val('');
                $('#sectionForm').trigger("reset");
                $('#modeltitle').html("Add New section");
                $('#ajax-section-modal').modal('show');
            });


            if ($("#sectionForm").length > 0) {
                    $("#sectionForm").validate({
                
                   submitHandler: function(form) {
                
                    var actionType = $('#btn-save').val();
                    $('#btn-save').html('Sending..');
                     
                    $.ajax({
                        data: $('#sectionForm').serialize(),
                        url:"{{ route('section.store') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                
                            $('#sectionForm').trigger("reset");
                            $('#ajax-section-modal').modal('hide');
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