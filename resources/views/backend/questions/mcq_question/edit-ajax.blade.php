 @foreach ($question->mcqQuestions ? $question->mcqQuestions : null as $mcqQes)
     <form action="{{ route('admin.mcq.update', $mcqQes->id) }}" method="POST" enctype="multipart/form-data">
         @csrf
         @method('put')

         <div class="row" style="margin-bottom:5%;margin-top:5%;margin-left:5%;">
             <input type="hidden" value="0" class="questionIndex" />
             <div class="col-md-1">
                 <span class="badge badge-primary">
                     {{ $loop->iteration }}
                 </span>
             </div>
             <div class="col-md-10" style="border: 1px dashed #e2d1d1;padding-top:20px;padding-bottom:20px;margin-left:-5%;">
                 <div class="row">
                     <div class="col-md-12 question">
                         <div style="margin-bottom:10px;">
                             <div class="row">
                                 <div class="col-md-12">
                                     <textarea name="describe" class="form-control mb-3" placeholder="leave empty if have not"
                                               rows="2">{{ $mcqQes->describe }}</textarea>
                                 </div>
                                 <div class="col-md-2">
                                     <h5 style="text-align: right;">
                                         Question :
                                     </h5>
                                 </div>
                                 <div class="col-md-10">
                                     <div class="form-group">
                                         <textarea name="question" id="" class="form-control"
                                                   required>{{ $mcqQes ? $mcqQes->question : null }}</textarea>
                                     </div>

                                     {{-- preview --}}
                                     <img style="max-width:500px" id="image_preview_{{ $mcqQes->id }}">
                                     @if ($mcqQes->image)
                                         <img style="max-width:500px" src="{{ url($mcqQes->image) }}" alt="Image">
                                         <a href="{{ route('admin.mcq.question.image.destroy', $mcqQes->id) }}"
                                            class="btn btn-outline-danger"><i class="fa fa-trash"></i>
                                             Remove</a>
                                     @else
                                         <div class="form-group">
                                             <input type="file" name="image" accept="image/*" class="form-control-file"
                                                    onchange="upload(this,{{ $mcqQes->id }});">
                                         </div>
                                     @endif
                                 </div>
                             </div>
                         </div>
                         <div style="border-bottom: 1px dashed #efeaea;margin-bottom:15px;"></div>
                         <div class="optionRows">
                             @foreach ($mcqQes ? ($mcqQes->options ? $mcqQes->options : null) : null as $optio)

                                 <div class="row">
                                     <input type="hidden" name="option_ids[]" value="{{ $optio->id }}">
                                     <div class="col-md-2">
                                         <label for="">Pattern</label>
                                         <input required name="pattern[]" value="{{ $optio ? $optio->pattern : null }}"
                                                type="text" type="text" class="form-control" style="margin-bottom:1%;">
                                     </div>
                                     <div class="col-md-7">
                                         <label for="">Option</label>
                                         <input required name="option[]" value="{{ $optio ? $optio->option : null }}"
                                                type="text" type="text" class="form-control" style="margin-bottom:1%;">
                                     </div>
                                     <div class="col-md-2">
                                         <label for="">Answer</label>
                                         <select name="answer[]" class="form-control" style="margin-bottom:1%;">
                                             <option value="0">False</option>
                                             <option value="1" {{ $optio->answer == 1 ? 'selected' : '' }}>
                                                 Correct</option>
                                         </select>
                                     </div>
                                     <div class="col-md-1 mt-4">
                                         <a class="removeOption btn btn-outline-danger">X</a>
                                     </div>
                                 </div>

                             @endforeach
                         </div>
                         <div class="d-flex justify-content-between  mt-3">
                             <a class="addOption btn btn-secondary"><i class="fa fa-plus"></i> Add Option</a>

                             <button type="submit" class="btn btn-primary">Save Question</button>

                             <a href="{{ route('admin.mcq.question.delete', $mcqQes->id) }}"
                                onclick=" return confirm('Are you sure want to delete this question?')" class="btn btn-danger"><i
                                    class="fa fa-trash"></i> Delete Question</a>
                         </div>

                     </div>
                 </div>
             </div>
         </div>
     </form>
 @endforeach
