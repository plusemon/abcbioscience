     <div class="row">
                                        <div class="col-md-4">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label >Student Name</label>
                                                        <select name="student_id" id="" class=" student_id form-control" required >
                                                            <option value="">Select Student</option>
                                                            @foreach($students as $student)
                                                            <option {{ $get_student_id ==  $student->id ? 'selected' : ''  }} {{ old('student_id') == $student->id ? 'selected' : '' }} value="{{ $student->id }}">
                                                                {{ $student->user?$student->user->name:NULL }}
                                                                ({{ $student->user?$student->user->mobile:NULL }})
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="" >Class</label>
                                                        <select name="class_id" id="" class="class_id form-control" required>
                                                            <option value="">Select Class</option>
                                                            @foreach($classes as $class)
                                                            <option {{ old('class_id') == $class->id ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                                            @endforeach
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label >Session</label>
                                                        <select name="session_id" id="" class="session_id form-control" required>
                                                            <option value="">Select Session</option>
                                                            @foreach($sessiones as $session)
                                                            <option {{ old('session_id') == $session->id ? 'selected' : '' }} value="{{ $session->id }}">{{ $session->name }}</option>
                                                            @endforeach
                                                    </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label >Type of Class </label>
                                                        <select name="class_type_id" id="" class="class_type_id form-control" required>
                                                            <option value="">Select Type of Class </option>
                                                            @foreach($student_typies as $classtype)
                                                            <option {{ old('class_type_id') == $classtype->id ? 'selected' : '' }} value="{{ $classtype->id }}">{{ $classtype->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label >Month </label>
                                                        <select name="month_id" id="" class="month_id form-control" required>
                                                            <option value="">Select Month</option>
                                                            @foreach($months as $month)
                                                            <option {{ old('month_id') == $month->id ? 'selected' : '' }} value="{{ $month->id }}">{{ $month->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label >Year </label>
                                                        <select name="year" id="" class="year form-control" required>
                                                            <option value="">Select Year</option>
                                                            @php $j = 2020 ; @endphp
                                                            @for($i = 20; $i <= 50; $i++)
                                                                <option value="{{$j}}">{{$j}}</option>
                                                                @php $j++ ;@endphp
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>

                                            </div><!---- child row in a row end--->
                                        </div><!---- col-md-6 end--->

                                        <div class="col-md-8">
                                            <div class="row">

                                                <div class="col-md-12">

                                                    <table class="table table-bordered table-hovered">
                                                        <tr>
                                                            <th>Sl</th>
                                                            <th>Fee Category</th>
                                                            <th>Fee <br/>(Amount)</th>
                                                            <th>Paid <br/>Amount</th>
                                                            <th>Collect <br/>Amount</th>
                                                            <th>Due <br/>Amount</th>
                                                        </tr>
                                                        @foreach($fee_categories as $feeCat)
                                                        <tr>
                                                            <td style="width:15%;">
                                                                <span style="margin-right:8px;font-size:15px;">{{ $loop->iteration }}.</span>
                                                                <input type="checkbox" name="fee_cat_id[]" id="checked_id_{{$feeCat->id}}" value="NULL" style="padding:10%;display:none;" data-check_id="{{$feeCat->id}}" class="check_class"/>
                                                            </td>
                                                            <td style="width:55%;">
                                                                {{ $feeCat->name }}
                                                            </td>
                                                            <td>
                                                                <input type="text" readonly name="fee_amount[]" value="" data-id="{{$feeCat->id}}" id="fee_amount_id_{{$feeCat->id}}" class="fee_amount form-control" />
                                                            </td>
                                                            <td>
                                                                <input type="text" readonly name="paid_amount[]" value="" data-id="{{$feeCat->id}}" id="paid_amount_id_{{$feeCat->id}}" class="paid_amount form-control" />
                                                            </td>
                                                            
                                                            <td style="width:30%;">
                                                                <input type="number" name="amount[]" value="" data-id="{{$feeCat->id}}" id="checked_amount_id_{{$feeCat->id}}" class="type form-control" />
                                                                <input type="hidden" name="id[]" value="" id="ids_{{$feeCat->id}}" />
                                                            </td>
                                                            <td>
                                                                <input type="text" readonly name="due_amount[]" value="" data-id="{{$feeCat->id}}" id="due_amount_id_{{$feeCat->id}}" class="due_amount form-control" />
                                                            </td>
                                                        </tr>

                                                        @endforeach

                                                </table>

                                                </div>

                                            </div><!---- child row in a row end--->
                                        </div><!---- col-md-6 end--->

                                    </div>
                                    <!----div row end--->