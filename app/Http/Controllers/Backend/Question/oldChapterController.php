<?php

namespace App\Http\Controllers\Backend\Question;

use App\Models\Chapter;
use App\Models\Subject;
use Illuminate\Http\Request;

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
        $chapters = Chapter::latest()->get();
        return view('backend.questions.chapters.index',compact('chapters'),$data);
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
        $data['chapter'] = chapter::findOrFail($id);

        return view('backend.questions.subjects.edit',$data);
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
