<?php

namespace App\Http\Controllers\Backend\Question;

use App\Http\Controllers\Controller;
use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $years = Year::latest()->get();
        return view('backend.questions.years.index',compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.questions.years.create');
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
            'name' => 'required'
        ]);


		$year = new Year();
        $year->name = $request->name;
        $year->save();

        $notification = array(
            'message' => 'Year Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('year.index')->with($notification);

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
        $year= Year::find($id);
        return view('backend.questions.years.edit',compact('year'));
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
        echo "success";
        $request->validate([
            'name' => 'required'
        ]);


        $year = year::find($id);
        $year->name = $request->name;
        $year->save();

        $notification = array(
            'message' => 'Year update Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('year.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $years =  Year::find($id)->delete();

        $notification = array(
            'message' => 'Year Delete Successfully!',
            'alert-type' => 'danger'
        );

        return redirect()->route('year.index')->with($notification);
    }
}
