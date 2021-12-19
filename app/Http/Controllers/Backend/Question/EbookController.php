<?php

namespace App\Http\Controllers\Backend\Question;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ebook;
use App\Models\OldSubject;
use App\Models\Classes;
use Validator;


class EbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data['classes']            = Classes::whereStatus(1)->get();
        $data['subjects']           = OldSubject::all();
        $data['ebooks']             = Ebook::latest()->get();
 
        return view('backend.questions.ebooks.index',$data);
    }

 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['classes']    = Classes::all();
        $data['subjects']   = OldSubject::all();
         

        return view('backend.questions.ebooks.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        
            'class_id'    => 'required',
            'ebook_file'  => 'required',
            'old_subject_id'  => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $sheet = New Ebook();
        $input               = $request->except('_token');
 
        $ebook_file          = $request->ebook_file;
        if($ebook_file){
            $uniqname   = uniqid();
            $filenameoriginal = $ebook_file->getClientOriginalName();
            $ext        = strtolower($ebook_file->getClientOriginalExtension());
            $filepath   = 'public/uploads/ebooks/';
            $namedata   =  pathinfo($filenameoriginal, PATHINFO_FILENAME);

            $imagename  = $filepath.$namedata."_".$uniqname.'.'.$ext;
            $ebook_file->move($filepath,$imagename);
            $input['ebook_file'] = $imagename;
        }


        $thumbnail          = $request->thumbnail;
        if($thumbnail){
            $uniqname   = uniqid();
            $filenameoriginal = $thumbnail->getClientOriginalName();
            $ext        = strtolower($thumbnail->getClientOriginalExtension());
            $filepath   = 'public/uploads/ebooks/';
            $namedata   =  pathinfo($filenameoriginal, PATHINFO_FILENAME);
            $imagename  = $filepath.$namedata."_thumbnail_".$uniqname.'.'.$ext;
            $thumbnail->move($filepath,$imagename);
            $input['thumbnail'] = $imagename;
        }
 
        $sheet->fill($input)->save();

        $notification = array(
            'message' => 'Ebook Successfully Added!',
            'alert-type' => 'success'
        );
        return redirect()->route('ebooks.index')->with($notification);
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
        $data['classes']    = Classes::all();
        $data['sessiones']  = Sessiones::all();
        $data['subjects']   = Subject::all();
        $data['sheet'] = Sheet::find($id);

        return view('backend.sheet.edit',$data);
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
        $validator = Validator::make($request->all(), [
            'sheet_no'    => 'required',
            'class_id'    => 'required',
            'session_id'  => 'required',
            'description'  => 'required',
            'subject_id'  => 'required',
            'status'      => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $sheet =  Sheet::find($id);
        $input               = $request->except('_token');

        $sheet_file          = $request->sheet_file;
        if($sheet_file){
            $uniqname   = uniqid();
            $filenameoriginal = $sheet_file->getClientOriginalName();
            $ext        = strtolower($sheet_file->getClientOriginalExtension());
            $filepath   = 'public/uploads/sheets/';
            $namedata   =  pathinfo($filenameoriginal, PATHINFO_FILENAME);

            $imagename  = $filepath.$namedata."_".$uniqname.'.'.$ext;
            $sheet_file->move($filepath,$imagename);
            $input['sheet_file'] = $imagename;
        }

        $thumbnail          = $request->thumbnail;
        if($thumbnail){
            $uniqname   = uniqid();
            $filenameoriginal = $thumbnail->getClientOriginalName();
            $ext        = strtolower($thumbnail->getClientOriginalExtension());
            $filepath   = 'public/uploads/sheets/';
            $namedata   =  pathinfo($filenameoriginal, PATHINFO_FILENAME);
            $imagename  = $filepath.$namedata."_thumbnail_".$uniqname.'.'.$ext;
            $thumbnail->move($filepath,$imagename);
            $input['thumbnail'] = $imagename;
        }

        $input['created_by'] = Auth::user()->id;
        $sheet->fill($input)->save();

        $notification = array(
            'message' => 'Sheet Successfully Updated!',
            'alert-type' => 'success'
        );
        return redirect()->route('sheet.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
 
        $sheet = Ebook::find($id)->delete();

        $notification = array(
            'message' => 'Ebook Successfully Deleted!',
            'alert-type' => 'success'
        );

        return redirect()->route('ebooks.index')->with($notification);
    }
}
