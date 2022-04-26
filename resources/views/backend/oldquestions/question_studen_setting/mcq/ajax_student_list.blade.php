

    @foreach ($students as $student)
    <tr>
        <td style="width:8%;">{{$loop->iteration}}</td>
        <td style="width:15%;">{{ $student->user?$student->user->useruid:NULL }}</td>
        <td>{{ $student->user?$student->user->name:NULL }}</td>
        <td>{{ $student->roll }}</td>
        <td>
            @if($student->checkExistingStudent())
            <strong  class="action_active  all_action btn btn-sm btn-primary">
                Active
            </strong>
                @else
                <strong class="action_inactive all_action  btn btn-sm btn-danger">
                    Inative
                </strong>
            @endif
        </td>
        <td>
            <input type="hidden" id="student_id_{{$student->id}}" class="currentStudentId" name="student_id[]" value="{{ $student->id }}"  />
            
            @if($student->checkExistingStudent())
                <a href="#" data-id="{{$student->id}}" data-action="in_active" class="action_inactive all_action  btn btn-sm btn-danger">
                    Inative
                </a>
                @else
                <a href="#" data-id="{{$student->id}}" data-action="active" class="action_active  all_action btn btn-sm btn-success">
                    Active
                </a>
            @endif
        </td>
    </tr>
    @endforeach