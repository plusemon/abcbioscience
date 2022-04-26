<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::latest()->get();
        return  view('backend.website.contact.index',compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.website.contact.create');
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
           'name' => 'required',
           'mobile' => 'required',
           'email' => 'required',
           'subject' => 'required',
           'message' => 'required',
        ]);

        $contacts = new Contact();
        $contacts->name = $request->name;
        $contacts->mobile =  $request->mobile;
        $contacts->email =  $request->email;
        $contacts->subject =  $request->subject;
        $contacts->message =  $request->message;
        $contacts->status =  $request->status;
        $contacts->save();

        $notification = array(
            'message' => 'Contact Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('contact.index')->with($notification);
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

        $data['contact'] = Contact::where('id',$id)->first();

        return view('backend.website.contact.edit',$data);
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
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $contacts = Contact::where('id',$id)->first();
        $contacts->name  =  $request->name;
        $contacts->mobile =  $request->mobile;
        $contacts->email =  $request->email;
        $contacts->subject =  $request->subject;
        $contacts->message =  $request->message;
        $contacts->status =  $request->status;
        $contacts->save();

        $notification = array(
            'message' => 'Contact Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('contact.index')->with($notification);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contacts =  Contact::where('id',$id)->first()->delete();

        $notification = array(
            'message' => 'Contact Delete Successfully!',
            'alert-type' => 'danger'
        );

        return redirect()->route('contact.index')->with($notification);
    }
}
