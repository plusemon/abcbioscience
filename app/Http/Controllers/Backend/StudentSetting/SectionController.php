<?php

namespace App\Http\Controllers\Backend\StudentSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Auth;
use Validator;
use Redirect,Response;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Section::select('*'))
            ->addColumn('action', 'backend.studentsetting.section.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('backend.studentsetting.section.view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $section_id = $request->section_id;
        $section  =  Section::updateOrCreate(['id'=>$section_id],[
                         'name' => $request->name,
                         'status' => 1
                    ]);    

        return Response::json($section);
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
         $where = array('id' => $id);
        $section  = Section::where($where)->first();
      
        return Response::json($section);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $section = Section::where('id',$id)->delete();
        return Response::json($section);
    }
}
