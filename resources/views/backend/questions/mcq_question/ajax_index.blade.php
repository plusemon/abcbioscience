<div class="table-responsive">
    <table id="" class="table table-hovered table-bordered datatables" width="100%">
                    <thead>
                        <tr>
                            <th class="text-nowrap">Sl</th>
                            <th class="text-nowrap">Subject Name</th>
                            <th class="text-nowrap">Question No/Name</th>

                            <th class="text-nowrap">Class</th>
                            <th class="text-nowrap">Session</th>
                            <th class="text-nowrap">Chapter</th>
                            <th class="text-nowrap">Topic</th>
                            <th class="text-nowrap">Exam Type</th>
                            <th class="text-nowrap">Created Date</th>

                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($questions as $question)
                            <tr>
                                <td>{{ $loop->index + $questions->firstItem() }}</td>
                                <td>{{ $question->subjects ? $question->subjects->name : null }}</td>
                                <td>
                                    <a href="{{ route('admin.mcq.show', $question->id) }}">
                                        {{ $question->question_no }}</td>
                                    </a>

                                <td>{{ $question->classes ? $question->classes->name : '' }}</td>
                                <td>{{ $question->sessiones ? $question->sessiones->name : '' }}</td>
                                <td>{{ $question->chapter ? $question->chapter->name : '' }}</td>
                                <td>{{ $question->topic }}</td>
                                <td>{{ $question->examtypies ? $question->examtypies->name : '' }}</td>
                                <td>
                                    {{ $question->created_at->format('d-m-Y') }}
                                    <br>
                                    {{ $question->created_at->format('H:i A') }}
                                </td>
                                <td>
                                    @if ($question->status == 1)
                                        <span class="badge badge-info">Active</span>
                                    @elseif($question->status==2)
                                        <span class="badge badge-info">inactive</span>
                                    @endif
                                </td>
                                <td class="btn-group-vertical">
                                    {{-- <a href="{{ route('admin.mcq.show', $question->id) }}"
                                        class="btn btn-outline-success btn-sm "> <i class="fa fa-eye"></i> View</a> --}}

                                    <!--    <a href="{{ route('admin.mcq.edit', $question->id) }}"
                                        class="btn btn-outline-success btn-sm "> <i class="fa fa-edit"></i> Edit</a>-->

                                    <a href="{{ route('admin.mcq.edit', $question->id) }}"
                                        class="btn btn-outline-success btn-sm "> <i class="fa fa-edit"></i> Edit</a>


                                    <a href="{{ route('admin.mcq-setting.create', 'qid=' . $question->id) }}"
                                        class="btn btn-outline-success btn-sm d-flex "><i class="fa fa-cogs"></i> Setting</a>

                                    <a id="delete" href="{{route('admin.mcq.destroy', $question->id )}}"
                                           class="btn btn-outline-danger btn-sm">
                                           <i class="fa fa-trash"></i>
                                           {{ trans ('Delete')}}
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

</div>
