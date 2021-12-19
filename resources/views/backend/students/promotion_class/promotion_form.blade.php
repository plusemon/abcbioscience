        <hr style="margin-bottom:5%;margin-top:1px;"/>
            <form action="{{ route('admin.promotion-class.store') }}" method="post">
                    @CSRF
                    <div class="row" style="">
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="class">Class :</label>
                                <select name="class_id"  class="class_id form-control" required>
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option {{ old('class_id') == $class->id ? 'selected' :'' }} value="{{ $class->id }}"> {{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('class_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="Session">Session :</label>
                                <select name="session_id" i class="session_id form-control" required>
                                    <option value="">Select Session</option>
                                    @foreach($sessiones as $session)
                                        <option {{ old('session_id') == $session->id ? 'selected' :'' }} value="{{ $session->id }}"> {{ $session->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('session_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="Batch Setting">Batch  :</label>
                                <select name="batch_setting_id"  class="batch_setting_id form-control" required>
                                    <option  value="1">Select Batch</option>
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_setting_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="Batch Setting">Batch Type :</label>
                                <select name="batch_type_id"  class="batch_type_id form-control" required>
                                    <option  value="">Select Batch</option>
                                    @foreach ($batchTypies as $item)
                                    <option  value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_type_id') }}</div>
                            </div>
                        </div>
                        {{-- <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="Batch Setting">Section  :</label>
                                <select name="section_id" id="section_id" class="form-control" required>
                                    <option value="">Select Section</option>
                                </select>
                                <div class="text-danger">{{ $errors->first('section_id') }}</div>
                            </div>
                        </div> --}}
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Roll</label>
                                <input type="text" name="roll" value="{{ old('roll') }}" class="form-control" placeholder="Roll">
                                <div class="text-danger">{{ $errors->first('roll') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Admission Date</label>
                                <input type="date" name="admission_date" value="{{ old('admission_date') }}" class="form-control" placeholder="Admission Date">
                                <div class="text-danger">{{ $errors->first('admission_date') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Month</label>
                                <select name="month_id" id="month_id" class="form-control" >
                                    <option value="">Select Month</option>
                                   @foreach($months as $month)
                                    <option value="{{ $month->id }}">{{ $month->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('month_id') }}</div>
                            </div>
                        </div>
                        {{--  <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Student Type</label>
                                <select name="student_type_id"  class="student_type_id form-control" >
                                    <option value="">Select Student Type</option>
                                    @foreach($student_typies as $student_type)
                                    <option value="{{ $student_type->id }}">{{ $student_type->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('student_type_id') }}</div>
                            </div>
                        </div>  --}}
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="">School</label>
                               <input type="text" name="school_name" value="{{ $schoolName}}" class="form-control" placeholder="Enter Student School Name">
                                <div class="text-danger">{{ $errors->first('school_name') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="activate_status" id="status" class="form-control" required>
                                    <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ old('status') == 2 ? 'selected' : ''  }} value="2">inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-2">
                            <input type="submit" value="Submit" class="btn btn-primary" style="margin-top: 25px;" />
                        </div>

                    </div>

                    <div class="hiddenData"></div>
                </form>
