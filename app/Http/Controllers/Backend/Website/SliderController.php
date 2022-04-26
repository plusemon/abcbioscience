<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        return  view('backend.website.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.website.slider.create');
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
                'imagetfile' => 'required',
            ]);

            $sliders = new Slider();
            


            $image = $request->imagetfile;

            if($image){
              
                $uniqname = uniqid();
                $ext = strtolower($image->getClientOriginalExtension());
                $filepath = 'public/images/sliders/';
                $imagename = $filepath.$uniqname.'.'.$ext;
                $image->move($filepath,$imagename);
                $sliders->image = $imagename;
            }
 

          
            $sliders->status = $request->status;
            $sliders->save();

            $notification = array(
                'message' => 'slider Create Successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('slider.index')->with($notification);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $id
     * @param $request
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['slider'] = Slider::find($id);
        return view('backend.website.slider.edit',$data);
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
                'imagefile' => 'required',
            ]);

            $sliders =  Slider::find($id);
            


            $image = $request->imagefile;

            if($image){
                unlink($sliders->image);
                $uniqname = uniqid();
                $ext = strtolower($image->getClientOriginalExtension());
                $filepath = 'public/images/sliders/';
                $imagename = $filepath.$uniqname.'.'.$ext;
                $image->move($filepath,$imagename);
                $sliders->image = $imagename;
            }
 
 
            $sliders->status = $request->status;
            $sliders->save();

            $notification = array(
                'message' => 'slider Create Successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('slider.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        

            $sliders =  Slider::find($id)->delete();

            $notification = array(
                'message' => 'slider Delete Successfully!',
                'alert-type' => 'danger'
            );

            return redirect()->route('slider.index')->with($notification);
        
    }
}
