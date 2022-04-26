<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function _fileUpload( $file, string $upload_path, string $name = null)
    {

        // dd($file);

        $file_path = 'public/uploads/'.$upload_path;

        $name = $name ? $name : uniqid();
        $ext = strtolower($file->getClientOriginalExtension());
        $file_name = $file_path. '/' . $name . '.' . $ext;

        $file->move($file_path, $file_name);
        return $file_name;
    }

}
