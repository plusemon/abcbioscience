<?php

namespace App\Http\Controllers\Backend\About;

use App\About;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['about'] = About::find(2);
        return view('backend.about.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new About();
        $data->details = $request->details;
        $data->mission_details = $request->mission_details;
        $data->vission_details = $request->vission_details;

        $image = $request->image;
        if ($image) {
            $uniqname = uniqid();
            $ext = strtolower($image->getClientOriginalExtension());
            $filepath = 'public/frontend/images/about/';
            $imagename = $filepath . $uniqname . '.' . $ext;
            $image->move($filepath, $imagename);
            $data->image = $imagename;
        }


        $image = $request->mission_image;
        if ($image) {
            $uniqname = uniqid();
            $ext = strtolower($image->getClientOriginalExtension());
            $filepath = 'public/frontend/images/about/';
            $imagename = $filepath . $uniqname . '.' . $ext;
            $image->move($filepath, $imagename);
            $data->mission_image = $imagename;
        }

        $image = $request->vission_image;
        if ($image) {
            $uniqname = uniqid();
            $ext = strtolower($image->getClientOriginalExtension());
            $filepath = 'public/frontend/images/about/';
            $imagename = $filepath . $uniqname . '.' . $ext;
            $image->move($filepath, $imagename);
            $data->vission_image = $imagename;
        }
        $data->save();

        $notification = array(
            'message' => 'About Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.about.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['about'] = About::find($id);
        return  view('backend.about.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['about'] =About::find($id);
        return  view('backend.about.edit',$data);
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
        $data = About::find($id);
        $data->details = $request->details;
        $data->mission_details = $request->mission_details;
        $data->vission_details = $request->vission_details;

        $image = $request->image;
        if ($image) {
            @unlink($data->image);
            $uniqname = uniqid();
            $ext = strtolower($image->getClientOriginalExtension());
            $filepath = 'public/frontend/images/about/';
            $imagename = $filepath . $uniqname . '.' . $ext;
            $image->move($filepath, $imagename);
            $data->image = $imagename;
        }


        $image = $request->mission_image;
        if ($image) {
            @unlink($data->mission_image);
            $uniqname = uniqid();
            $ext = strtolower($image->getClientOriginalExtension());
            $filepath = 'public/frontend/images/about/';
            $imagename = $filepath . $uniqname . '.' . $ext;
            $image->move($filepath, $imagename);
            $data->mission_image = $imagename;
        }

        $image = $request->vission_image;
        if ($image) {
            @unlink($data->vission_image);
            $uniqname = uniqid();
            $ext = strtolower($image->getClientOriginalExtension());
            $filepath = 'public/frontend/images/about/';
            $imagename = $filepath . $uniqname . '.' . $ext;
            $image->move($filepath, $imagename);
            $data->vission_image = $imagename;
        }
        $data->save();

        $notification = array(
            'message' => 'About Update Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.about.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        About::find($id)->delete();

        $notification = array(
            'message' => 'About Delete Successfully!',
            'alert-type' => 'danger'
        );

        return redirect()->route('admin.about.index')->with($notification);
    }
}
