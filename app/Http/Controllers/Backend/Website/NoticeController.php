<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = Notice::latest()->get();
        return view('backend.website.notices.index',compact('notices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.website.notices.create');
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
            'title' => 'required',
            'noticesfile' => 'required',
        ]);

        $notices = new Notice();
        $notices->title = $request->title;
        $notices->slug = $request->title;
        $notices->publish_date = Carbon::now();

        $noticesfile = $request->noticesfile;
        if($noticesfile){
            $uniqname = uniqid();
            $ext = strtolower($noticesfile->getClientOriginalExtension());
            $filepath = 'public/images/notices/';
            $filename = $filepath.$uniqname.'.'.$ext;
            $noticesfile->move($filepath,$filename);
            $notices->noticesfile = $filename;
        }
        
        $notices->status = $request->status;
        $notices->user_id = Auth::user()->id;
        $notices->save();

        $notification = array(
            'message' => 'Notice Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('notice.index')->with($notification);
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
        $data['notice'] = Notice::find($id);
        return view('backend.website.notices.edit',$data);
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
            'title' => 'required',
        ]);

        $notices = Notice::find($id);
        $notices->title = $request->title;
        $noticesfile = $request->noticesfile;
        if($noticesfile){
             @unlink($notices->noticesfile);
            $uniqname = uniqid();
            $ext = strtolower($noticesfile->getClientOriginalExtension());
            $filepath = 'public/images/notices/';
            $filename = $filepath.$uniqname.'.'.$ext;
            $noticesfile->move($filepath,$filename);
            $notices->noticesfile = $filename;
        }

        $notices->status = $request->status;
        $notices->status = Auth::user()->id;
        $notices->save();

        $notification = array(
            'message' => 'Notice update Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('notice.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notics =  Notice::find($id)->delete();

        $notification = array(
            'message' => 'Notice Delete Successfully!',
            'alert-type' => 'danger'
        );

        return redirect()->route('notice.index')->with($notification);
    }
}
