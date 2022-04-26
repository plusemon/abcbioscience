<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMedia;
use Validator;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $data['socialMedia'] = SocialMedia::all();
         return view('backend.website.social.view',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.website.social.add');
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
            'name' => 'required',
            'link' => 'required',
            'icon' => 'required',
            'color'=> 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{
            $social = New SocialMedia();
            $social->name    = $request->name;
            $social->link    = $request->link;
            $social->icon    = $request->icon;
            $social->color   = $request->color;
            $social->status   = 1;

            $social->save();

            $notification = array(
                'message' => 'Social Media Add Successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('social.index')->with($notification);

        }
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
        $data['social'] = SocialMedia::find($id);
       return view('backend.website.social.edit',$data);
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
            'name' => 'required',
            'link' => 'required',
            'icon' => 'required',
            'color'=> 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{
            $social = SocialMedia::find($id);

            $social->name    = $request->name;
            $social->link    = $request->link;
            $social->icon    = $request->icon;
            $social->color   = $request->color;

            $social->save();

            $notification = array(
                'message' => 'Social Media Update Successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('social.index')->with($notification);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         SocialMedia::find($id)->delete();

         $notification = array(
                'message' => 'Social Media Delete Successfully!',
                'alert-type' => 'success'
            );
        return redirect()->route('social.index')->with($notification);

    }
}
