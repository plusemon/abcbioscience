<?php

namespace App\Http\Controllers\Backend\Sheet;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sheet;
use Auth;
use App\Models\Sessiones;
use App\Models\Subject;
use App\Models\Chapter;
use App\Models\Classes;
use App\Models\BatchSetting;
use App\Model\SheetSetting;
use App\Model\StudentSheetSetting;
use App\Model\FeeAmountSetting;
use Validator;
use Carbon\Carbon;

class SheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $data['classes']            = Classes::whereStatus(1)->get();
        $data['sessiones']          = Sessiones::whereStatus(1)->get();
        $data['subjects']           = Subject::all();


        return view('backend.sheet.view',$data);
    }






   public function ajax_index(Request $request)
   {

        $pagination = $request->pagination;


        $query  = Sheet::query();

        if($request->class_id)
        {
            $data['class_id']   = $request->class_id;
            $query = $query->where('class_id',$request->class_id);
        }

        if($request->session_id)
        {
            $data['session_id'] = $request->session_id;
            $query = $query->where('session_id',$request->session_id);
        }

        if($request->subject_id)
        {
            $data['subject_id']   = $request->subject_id;
            $query                = $query->where('subject_id',$request->subject_id);
        }

        if($request->chapter_id)
        {
            $data['chapter_id']   = $request->chapter_id;
            $query                = $query->where('chapter_id',$request->chapter_id);
        }

        if($pagination == 'all_data')
        {
            $pagination = $query->orderBy('id', 'DESC')->count();
        }else{
            $pagination = $pagination;
        }

        $data['sheets'] = $query->orderBy('id','DESC')->where('status',1)->whereNull('deleted_at')->paginate($pagination);

        return view('backend.sheet.ajax_index',$data);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['classes']    = Classes::all();
        $data['sessiones']  = Sessiones::all();
        $data['subjects']   = Subject::all();
        $data['chapters']   = Chapter::all();

        return view('backend.sheet.add',$data);
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
            'sheet_no'    => 'required',
            'class_id'    => 'required',
            'session_id'  => 'required',
            'sheet_file'  => 'required',
            'description'  => 'required',
            'subject_id'  => 'required',
            'status'      => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $sheet = New Sheet();
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

            $input['thumbnail'] = 'public/uploads/sheets/no_image_sheet.png';
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
            'message' => 'Sheet Successfully Added!',
            'alert-type' => 'success'
        );
        return redirect()->route('sheet.index')->with($notification);
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

        StudentSheetSetting::where('sheet_id',$id)->delete();
        $sheetS = SheetSetting::where('sheet_id',$id)->first();

        if($sheetS!=null)
        {
            FeeAmountSetting::where('origin_id',$sheetS->id)
                            ->where('fee_cat_id',6)
                            ->delete();

            StudentSheetSetting::where('sheet_setting_id',$sheetS->id)->delete();

            $sheetS->delete();
        }

        $sheet = Sheet::find($id)->delete();

        $notification = array(
            'message' => 'Sheet Successfully Deleted!',
            'alert-type' => 'success'
        );

        return redirect()->route('sheet.index')->with($notification);
    }
}
