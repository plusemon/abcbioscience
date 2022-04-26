<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\User;
use App\Models\Student;
use App\Models\BatchSetting;
use App\Model\BatchType;
use Illuminate\Http\Request;

class GetStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function getStudentByKeyup(Request $request) //admin.get_student_by_key_up
    {
        $search = $request->name;
        $query = User::query()->where('role_id',3);
                $query->whereNull('deleted_at')
                ->where('name','like','%'.$search.'%');
                $query->orWhere(function($q) use ($search) {
                    return $q->where('mobile','like','%'.$search . '%')
                    ->where('role_id',3);
                });
                $query->orWhere(function($q) use ($search) {
                    return $q->where('useruid','like','%'.$search . '%')
                    ->where('role_id',3);
                });
                $query->orWhere(function($q) use ($search) {
                    return $q->where('email','like','%'.$search . '%')
                    ->where('role_id',3);
                });
        $students =  $query->select('id','useruid','name','mobile','role_id')->get();


        $output = '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="display:block;position:relation;">';
        foreach($students as $student)
        {
            $output .='<li><a href="#" data-id="'.$student->id.'" class="dropdown-item dropdown_class">'.$student->useruid.' - '.$student->name. ' - ('. $student->mobile .')'.'</a> </li>';
        }
        $output .= "</ul>";
        //return $output;
        return response()->json([
            'status'    => true,
            'data'      => $output
        ]);

    }

    public function getStudentBatch(Request $request) //admin.getStudentBatch
    {
        $batch_ids    =  Student::where('user_id',$request->user_id)
                        ->where('activate_status',1)
                        ->whereNull('deleted_at')
                        ->pluck('batch_setting_id')
                        ->toArray();

        $batches = BatchSetting::where('status',1)
                        ->whereIn('id',$batch_ids)
                        ->latest()
                        ->get();

        $output = '<option value="">'.'Please Select One'.'</option>';
        foreach($batches as $data)
        {
            $output .='<option value="'.$data->id.'">'.$data->batch_name.'</option>';
        }
        //$output .= '</select>';
        if($batches)
        {
            return response()->json([
                'status'    => true,
                'data'      => $output
            ]);
        }
        return response()->json([
            'status'    => false,
            'data'      => $output
        ]);
    }



    public function getStudentBatchType(Request $request) //admin.getStudentBatch
    {
        $batch_ids    =  Student::where('user_id',$request->user_id)
                        ->where('batch_setting_id',$request->batch_setting_id)
                        ->where('activate_status',1)
                        ->whereNull('deleted_at')
                        ->pluck('batch_type_id')
                        ->toArray();

        $batches = BatchType::where('status',1)
                        ->whereIn('id',$batch_ids)
                        ->latest()
                        ->get();

        $output = '<option value="">'.'Please Select One'.'</option>';
        foreach($batches as $data)
        {
            $output .='<option value="'.$data->id.'">'.$data->name.'</option>';
        }
        //$output .= '</select>';
        if($batches)
        {
            return response()->json([
                'status'    => true,
                'data'      => $output
            ]);
        }
        return response()->json([
            'status'    => false,
            'data'      => $output
        ]);
    }



    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
