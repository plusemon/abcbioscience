<?php

namespace App\Http\Controllers\Backend\Website;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function GuzzleHttp\Promise\all;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('backend.website.blogs.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.website.blogs.create');
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
            'image' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $blogs = new Blog();
        $blogs->title = $request->title;
        $blogs->slug = Str::slug($request->title,'-');


        $image = $request->image;

        if($image){
          //  @unlink($blogs->image);
            $uniqname = uniqid();
            $ext = strtolower($image->getClientOriginalExtension());
            $filepath = 'public/images/blogs/';
            $imagename = $filepath.$uniqname.'.'.$ext;
            $image->move($filepath,$imagename);
            $blogs->image = $imagename;
        }





        $blogs->description = $request->description;
        $blogs->status = $request->status;
        $blogs->save();

        $notification = array(
            'message' => 'Blog Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('blog.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['blog'] = Blog::find($id);
        return view('backend.website.blogs.show',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['blog'] = Blog::find($id);
        return view('backend.website.blogs.edit',$data);
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
            'description' => 'required',
            'status' => 'required',
        ]);

        $blogs =  Blog::find($id);
        $blogs->title = $request->title;
        $blogs->slug = Str::slug($request->title,'-');

        $image = $request->image;
        if($image){
            @unlink($blogs->image);
            $uniqname = uniqid();
            $ext = strtolower($image->getClientOriginalExtension());
            $filepath = 'public/images/blogs/';
            $imagename = $filepath.$uniqname.'.'.$ext;
            $image->move($filepath,$imagename);
            $blogs->image = $imagename;
        }

        $blogs->description = $request->description;
        $blogs->status = $request->status;
        $blogs->save();

        $notification = array(
            'message' => 'Blog Edit Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('blog.index')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $blogs =  Blog::find($id)->delete();

        $notification = array(
            'message' => 'Blog Delete Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('blog.index')->with($notification);
    }
}
