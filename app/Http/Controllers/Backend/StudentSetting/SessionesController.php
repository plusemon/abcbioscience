<?php

namespace App\Http\Controllers\Backend\StudentSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sessiones;
use Auth;
use Validator;
use Redirect,Response;

class SessionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Sessiones::select('*'))
            ->addColumn('action', 'backend.studentsetting.sessiones.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('backend.studentsetting.sessiones.view');
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
        $sessiones_id = $request->sessiones_id;
        $sessiones  =  Sessiones::updateOrCreate(['id'=>$sessiones_id],[
                         'name' => $request->name,
                         'status' => 1
                    ]);    

        return Response::json($sessiones);
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
        $where = array('id'=>$id);
        $sessiones  = Sessiones::where($where)->first();
        return Response::json($sessiones);
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
        $sessiones = Sessiones::where('id',$id)->delete();
        return Response::json($sessiones);
    }
}
