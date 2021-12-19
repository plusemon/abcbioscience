@extends('backend.layouts.app')

@section('title', 'Subjects')

@section('content')

    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">
                    Board: {{ $year->board->name }}, Year: {{ $year->year }} - Subjects
                </h4>
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

                @include('components.form-errors')

                <button data-toggle="modal" data-target="#addNewModal" class="btn btn-primary btn-sm float-right mb-1"
                        id="create-new-class"><i class="fa fa-plus"></i> Add New </button>

                <table class="table table-striped table-bordered table-td-valign-middle">
                    <thead>
                        <tr>
                            <th class="text-nowrap">SL</th>
                            <th class="text-nowrap">Subject</th>
                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($year->subjects as $subject)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('old_school.board_subjects.show', $subject->id) }}">
                                        {{ $subject->name }}</a>
                                </td>
                                <td>
                                    @if ($subject->status)
                                        <p class="badge badge-success">Active</p>
                                    @else
                                        <p class="badge badge-danger">Inactive</p>
                                    @endif
                                </td>
                                <td>
                                    <form action="{{ route('old_school.board_subjects.destroy', $subject->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure want to delete?')">
                                        @csrf
                                        @method('delete')
                                        <a href="#" onclick="setEditModal({{ $subject }})"
                                           class="btn btn-sm btn-primary mx-2">Edit</a>
                                        <button type="submit" class="btn btn-sm btn-danger">Delate</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
    {{-- =============  for add new class ========================== --}}

    <div class="modal fade" id="addNewModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New Subject</h4>
                </div>
                <form class="form-horizontal" action="{{ route('old_school.board_subjects.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" name="year_id" value="{{ $year->id }}">
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Subject Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-12 control-label">Status</label>
                                <div class="col-sm-12">
                                    <select name="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" value="create">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- =============  for edit  ========================== --}}
    <div class="modal fade" id="editModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Board</h4>
                </div>
                <form id="editForm" class="form-horizontal" method="POST">
                    <div class="modal-body">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Subject Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-12 control-label">Status</label>
                            <div class="col-sm-12">
                                <select name="status" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" value="create">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        function setEditModal({
            id,
            name,
            status,
        }) {
            // declare the vars
            let route = `{{ route('old_school.board_subjects.index') }}/${id}`
            let editForm = $('#editForm');

            // set the form values
            editForm.attr('action', route);
            editForm.find('[name=name]').val(name)
            editForm.find('[name=status]').val(status)
            $('#editModal').modal('show');
        }
    </script>
@endpush
