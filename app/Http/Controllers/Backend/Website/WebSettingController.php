<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebSetting;
use Validator;

class WebSettingController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['setting'] = WebSetting::find(1);
         return view('backend.website.website.view',$data);
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
        //
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
    public function edit()
    {
         $data['setting'] = WebSetting::find(1);
         return view('backend.website.website.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'site_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{


            $setting                    = WebSetting::find(1);
            $setting->site_name         = $request->site_name;
            $setting->about             = $request->about;
            $setting->homepage_title    = $request->homepage_title;
            $setting->meta_tags         = $request->meta_tags;
            $setting->meta_description  = $request->meta_description;

                 
            $sitebanner        = $request->sitebanner;
            if($sitebanner){
                $uniqname      = uniqid();
                $ext           = strtolower($sitebanner->getClientOriginalExtension());
                $filepath      = 'public/images/website/';
                $imagename     = $filepath.$uniqname.'.'.$ext;
                $sitebanner->move($filepath,$imagename);
                $setting->sitebanner = $imagename;
                
            }


            $logo = $request->logo;
            if($logo){
                $uniqname   = uniqid();
                $ext        = strtolower($logo->getClientOriginalExtension());
                $filepath   = 'public/images/website/';
                $imagename  = $filepath.$uniqname.'.'.$ext;
                $logo->move($filepath,$imagename);
                $setting->logo= $imagename;
            }


            $footer_logo   = $request->footer_logo;
            if($footer_logo){
                $uniqname   = uniqid();
                $ext        = strtolower($footer_logo->getClientOriginalExtension());
                $filepath   = 'public/images/website/';
                $imagename  = $filepath.$uniqname.'.'.$ext;
                $footer_logo->move($filepath,$imagename);
                $setting->footer_logo  = $imagename;
            }

            $favicon = $request->favicon;
            if($favicon){
                $uniqname   = uniqid();
                $ext        = strtolower($favicon->getClientOriginalExtension());
                $filepath   = 'public/images/website/';
                $imagename  = $filepath.$uniqname.'.'.$ext;
                $favicon->move($filepath,$imagename);
                $setting->favicon= $imagename;
            }



            $setting->email             = $request->email;
            $setting->phone             = $request->phone;
            $setting->state_address     = $request->state_address;
            $setting->local_address     = $request->local_address;
            $setting->address           = $request->address;
            $setting->map_code          = $request->map_code;

            $setting ->save();


            $notification = array(
                'message' => 'Website Setting Update Successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('website.setting.index')->with($notification);

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
        //

    }
}
