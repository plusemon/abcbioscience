<?php

namespace App\Http\Controllers\Backend\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Chapter;
use App\Models\Subject;


class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['subjects'] = Subject::latest()->get();
        $chapters = Chapter::orderBy('subject_id','ASC')
                             
                            ->get();
        return view('backend.questions.chapters.index',compact('chapters'),$data);
    }


    public function getchapter(Request $request)
    {
        $batch          = "<option value=''>Select Chapter</option>";
        $subject_id     = $request->subject_id;
          
        $chapters = Chapter::where('subject_id',$subject_id)->get();
        foreach ($chapters as $key => $value) {
            $batch .= "<option value='$value->id'> $value->name </option>";
        }


        return($batch);
        
    }
 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['subjects'] = Subject::latest()->get();
        return  view('backend.questions.chapters.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'subject_id' => 'required',
        ]);

        $chapters = new Chapter();
        $chapters->subject_id = $request->subject_id;
        $chapters->name       = $request->name;
        
        $chapters->save();

        $notification = array(
            'message' => 'Chapter Create Successfully Completed!',
            'alert-type' => 'success'
        );

        return redirect()->route('chapter.index')->with($notification);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['subjects'] = Subject::latest()->get();
        $data['chapter'] = Chapter::findOrFail($id);

        return view('backend.questions.chapters.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required',
            'subject_id' => 'required',
        ]);

        $chapters =  Chapter::FindOrFail($id);
        $chapters->subject_id = $request->subject_id;
        $chapters->name       = $request->name;
        
        $chapters->save();

        $notification = array(
            'message' => 'Chapter Updated Successfully Completed!',
            'alert-type' => 'success'
        );

        return redirect()->route('chapter.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $chapter =  Chapter::find($id)->delete();

        $notification = array(
            'message' => 'Chapter Delete Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('chapter.index')->with($notification);
    }
}
