<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use Validator;
use App\Models\Classes;
use App\Models\Section;
use App\Models\Shift;
use App\Models\SmsHistroy;
use Illuminate\Support\Str;

class LoginController extends Controller
{ 
    
    public function studentlogin()
    {
        
        
        if(Auth::check())
        {
            return redirect()->route('student.dashboard');
        }
         
        
        return view('frontend.studentauth.login');
    }

      
    public function studentauthlogin(Request $request)
    {

         $input = $request->all();

         $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{

  
  
            $fieldType = filter_var($request->mobile, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
            if(auth()->attempt(array($fieldType => $input['mobile'], 'password' => $input['password'])))
            {
                    if(Auth::user()->status!=1)
                    {
                        $notification = array(
                            'message' => 'Your account Not verified! Please Contact Admin',
                            'alert-type' => 'error'
                        );

                        Auth::logout();
                        return redirect()->route('student.login')->with($notification); 


                    }
                    else{
                         return redirect()->route('student.dashboard');
                    }


            }
            else{

                $notification = array(
                    'message' => 'Password Donot Match!',
                    'alert-type' => 'error'
                );

                return redirect()->route('student.login')->with($notification);
                   
            }
     
        }

    }

   
    public function studentregister()
    {
        $data['classes']    = Classes::all();
        $data['sectiones']  = Section::all();
        $data['shifts']     = Shift::all();
        
        return view('frontend.studentauth.register',$data);
    }


     
    public function studentregisterstore(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'mobile'    => 'required|unique:users',
            'name'      => 'required',
            'address'   => 'required',
            'roll'  => 'required',
            'school_name'=> 'required',
            'password'  => 'required',
            'class_id'  => 'required',
            'com_password'  => 'required|same:password',
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{


            $checkusercount = User::orderBy('id','DESC')->where('role_id',3)->count();
            $checkuser = User::orderBy('id','DESC')->where('role_id',3)->first();

            $random = Str::random(10);


            $user = new User();

            if($checkusercount>0)
            {
                $user->useruid = $checkuser->useruid+1;
            }
            else{
                $user->useruid = '20210001';
            }

            $user->name     = $request->name;
            $user->mobile   = $request->mobile;
           /* $user->email    = $request->email;*/


           $user->otp = rand(1000,9999);


            $user->password = bcrypt($request->password);
            
            $user->remember_token =  $random;
            
            
            $image = $request->file('photo');
            
            if($image){
                $uniqname = uniqid();
                $ext = strtolower($image->getClientOriginalExtension());
                $filepath = 'public/uploads/students/';
                $imagename = $filepath.$uniqname.'.'.$ext;
                $image->move($filepath,$imagename);
                
                $user->image = $imagename;

            }
            
            
            $user->class_id   = $request->class_id;
            $user->section_id = $request->section_id;
            $user->shift_id   = $request->shift_id;
            $user->roll       = $request->roll;
            $user->school_name= $request->school_name;
            $user->address    = $request->address;
            $user->role_id    = 3;
            $user->status     = 3;
            $user->save();



            $message = "Dear Student,
Your verification OTP: " .$user->otp ."
Thanks
ABCBioScience";

            $this->curlSmsSend($user->mobile,$message);



                $smshistory = new SmsHistroy();
                $smshistory->user_id    = $user->id;
                $smshistory->message    = $message;
                $smshistory->status     = 1;
                $smshistory->save();
                
                


            $notification = array(
                'message' => 'Your are registration complete successfully!',
                'alert-type' => 'success'
            );

            return redirect()->route('student.register.otp',$user->remember_token)->with($notification);

        }
    }






    public function studenotpverify($secrate_key)
    {
        return view('frontend.studentauth.otp_verify');
    }


    public function studentpasswordotpverify(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'otp'    => 'required'
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{

            $counttoken = User::where('remember_token',$request->remember_token)->count();

            if($counttoken>0)
            {
                $otp = User::where('otp',$request->otp)->count();


                if($otp>0)
                {
                     $user = User::where('otp',$request->otp)->first();
                     $user->status = 1;
                     $user->save();



                    $notification = array(
                            'message' => 'Your Account successfully verified! Please login.',
                            'alert-type' => 'success'
                    );
                    return redirect()->route('student.login')->with($notification);
                }
                else{
                     $notification = array(
                        'message' => 'Invalid OTP!',
                        'alert-type' => 'error'
                    );
                    return redirect()->back()->with($notification);
                }

            }
            else{
                $notification = array(
                    'message' => 'Token Do not Match!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);

            }


        }

 
    }








    /* ================ for password reset =======================*/

    public function studentpasswordforgot()
    {
        return view('frontend.studentauth.forgot');
    }



    public function studentpasswordforgotsend(Request $request)
    {


         $validator = Validator::make($request->all(), [
            'mobile'    => 'required'
        ]);

        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        else{

            $usercount = User::where('mobile',$request->mobile)->count();


            if($usercount>0){


            $password = rand(100000,999999);

            $user = User::where('mobile',$request->mobile)->first();
            $user->password = bcrypt($password);
            $user->save();

            $message = "Dear Student,
Your new password is : ".$password. ". 
ABCBioScience";

            $this->curlSmsSend($user->mobile,$message);


                $smshistory = new SmsHistroy();
                $smshistory->user_id    = $user->id;
                $smshistory->message    = $message;
                $smshistory->status     = 1;
                $smshistory->save();



                $notification = array(
                    'message' => 'New password send your mobile. please check!',
                    'alert-type' => 'success'
                );
                return redirect()->route('student.login')->with($notification);


            }

            else{
                  $notification = array(
                    'message' => 'Do not match your mobile number!',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }


    }




  

    public function studentlogout()
    {
        Auth::logout();

        $notification = array(
                'message' => 'Logout!',
                'alert-type' => 'success'
            );

        return redirect()->route('student.login')->with($notification);
    }





    private function curlSmsSend($mobile_no, $message)
    {

      $message = urlencode($message);
        $url = "http://66.45.237.70/api.php?username=01818737845&password=BlackAzad&number=$mobile_no&message=$message";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Sample cURL Request');
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

     
}
