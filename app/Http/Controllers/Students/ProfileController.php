<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\User;
use App\Models\StudentInfo;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Sessiones;
use App\Models\Shift;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $data['student'] = User::find($id);
        return view('students.profile',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
        $id = Auth::user()->id;
        $data['student'] = User::find($id);
        $data['classes'] = Classes::all();
        $data['sectiones']  = Section::all();
        $data['sessiones']  = Sessiones::all();
        $data['shifts']     = Shift::all();
        
        return view('students.editprofile',$data);
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
            'mobile'    => 'required|unique:users,mobile,'.Auth::user()->id,
            'name'      => 'required',
            'address'   => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{

            $user = User::find(Auth::user()->id);

            $user->name     = $request->name;
            $user->mobile   = $request->mobile;
            $user->email    = $request->email;
            
              
              
            $image = $request->file('photo');
            
            if($image){
                $uniqname = uniqid();
                $ext = strtolower($image->getClientOriginalExtension());
                $filepath = 'public/uploads/students/';
                $imagename = $filepath.$uniqname.'.'.$ext;
                $image->move($filepath,$imagename);
                
                $user->image = $imagename;
            }
            
            $user->class_id     = $request->class_id;
            $user->sessiones_id = $request->sessiones_id;
            $user->section_id   = $request->section_id;
            $user->shift_id     = $request->shift_id;
            $user->roll         = $request->roll;
            $user->school_name= $request->school_name;
            
            $user->address  = $request->address;
            $user->save();

            $notification = array(
                'message' => 'Profile update successfully Completed!',
                'alert-type' => 'success'
            );

            return redirect()->route('student.profile')->with($notification);

        }
    }





    public function personalinformation()
    {

                
            $countinfo = StudentInfo::where('user_id',Auth::user()->id)->count();

            if($countinfo>0)
            {

                $data['student'] = StudentInfo::where('user_id',Auth::user()->id)->first();

                return view('students.personalinformation',$data);
            }
            else{
                 return view('students.personalinformationcreate');
            }

           
    }



    


    public function personalinformationstore(Request $request)
    {

         $validator = Validator::make($request->all(), [
            'father'    => 'required',
            'guardian_mobile'      => 'required',
            'address'   => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{

            $studentinfo = New StudentInfo();

            $studentinfo->user_id           = Auth::user()->id;
            $studentinfo->father            = $request->father;
            $studentinfo->mother            = $request->mother;
            $studentinfo->guardian_mobile   = $request->guardian_mobile;
            $studentinfo->own_mobile        = $request->own_mobile;
            $studentinfo->address           = $request->address;
            $studentinfo->whatsapp_number   = $request->whatsapp_number;
            $studentinfo->facebook_id       = $request->facebook_id;
            $studentinfo->bkash_number      = $request->bkash_number;
            $studentinfo->email             = $request->email;
            $studentinfo->address           = $request->address;
            $studentinfo->save();



            $notification = array(
                'message' => 'Personal Information successfully Inserted!',
                'alert-type' => 'success'
            );

            return redirect()->route('student.personal.information')->with($notification);

        }


    }

    
 
    public function personalinformationedit()
    {
          $data['student'] = StudentInfo::where('user_id',Auth::user()->id)->first();

          return view('students.personalinformationedit',$data);
    }



    public function personalinformationupdate(Request $request)
    {
          $validator = Validator::make($request->all(), [
            'father'    => 'required',
            'guardian_mobile'      => 'required',
            'address'   => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{

            $studentinfo =  StudentInfo::where('user_id',Auth::user()->id)->first();

            $studentinfo->father            = $request->father;
            $studentinfo->mother            = $request->mother;
            $studentinfo->guardian_mobile   = $request->guardian_mobile;
            $studentinfo->own_mobile        = $request->own_mobile;
            $studentinfo->address           = $request->address;
            $studentinfo->whatsapp_number   = $request->whatsapp_number;
            $studentinfo->facebook_id       = $request->facebook_id;
            $studentinfo->bkash_number      = $request->bkash_number;
            $studentinfo->email             = $request->email;
            $studentinfo->address           = $request->address;

            $studentinfo->save();

            $notification = array(
                'message' => 'Personal Information successfully Updated!',
                'alert-type' => 'success'
            );

            return redirect()->route('student.personal.information')->with($notification);

        }
    } 









    public function  setting()
    {
        return view('students.setting');
    }




    public function settingupdate(Request $request)
    {   
        $this->validate($request,[
            'current_password'  => 'required',
            'new_password'      => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation'=>'min:6'
        ]);
        if(Auth::attempt(['id' => Auth::user()->id, 'password' => $request->current_password])){
            $user = User::find(Auth::user()->id);
            $user->password = bcrypt($request->new_password);
            $user->save();
            $notification = array(
            'message' => 'Successfully password changed.',
            'alert-type' => 'success'
             );
            return redirect()->route('student.profile')->with($notification);
        }else{
            $notification = array(
            'message' => 'Sorry! Your current password dost not match.',
            'alert-type' => 'error'
             );
            return redirect()->back()->with($notification);
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
