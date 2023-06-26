<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\session;
use App\Models\Students;
use Yajra\DataTables\Facades\Datatables;
use Image;
use DB;

class StudentController extends Controller
{
    public function Add_Student(){

        if(Auth::id()){
            $id=Auth::user()->id;
           

                    $title="YouTube Project";

                    return view('user_template.add_student',compact('title'));
                }else{
                return redirect('login');
            }
    }

    public function Save_Student(Request $request){
        $attr = $request->validate([

            'lastname' => 'required|string|max:250',
            'firstname' => 'required|string|max:250',
            'gender' => 'required|string|max:250',
            'student_image' =>'mimes:jpg,jpeg,png,gif,svg|required',
           
           
           ]);

           $image=$request->file('student_image');
           if($image){
                 $imagename = time().'.'.$image->extension();
                 $destinationPath = public_path('image\thumbnails');
                 $img = Image::make($image->path());
                 $img->resize(100, 100, function ($constraint) {
                     $constraint->aspectRatio();
                 })->save($destinationPath.'/'.$imagename);

                 Students::create([              
                       
                    'lastname'          => $request->lastname,
                    'firstname'         => $request->firstname,
                    'gender'            => $request->gender,
                    'image'             => $imagename
                                       
                              ]);    

                            }
             return redirect('Homedashboard')->with('message','Student Added Successfully');

    }

    public function View_Students(Request $request){
        if(Auth::id()){
            $id=Auth::user()->id;

        if ($request->ajax()) {
            $data = Students::select('*');
            return Datatables::of($data)
                ->addIndexColumn()

                
                 ->addColumn('action', function($row){
                    $actionBtn = '<a class="btn btn-sm btn-success edit_std" href="javascript:void(0)" title="Edit" name="Edit" id=""><i class="fa fa-pencil"></i> Edit</a>


                                <a class="btn btn-sm btn-danger delete" href="javascript:void(0)" title="Delete" name="delete" id=""><i class="fa fa-trash"></i>Delete</a>';
                    return $actionBtn;
                })
                
                 ->rawColumns(['action'])
                        ->make(true);       
            }

            }else{
                return redirect('login');
            }
        }

        public function student_v()
            {
                if(Auth::id()){
                    $id=Auth::user()->id;
                    $email=Auth::user()->email;
        
                            $title="YouTube Project";
        
                            return view('user_template.bot_modal',compact('title'));
                        }else{
                        return redirect('login');
                    }
                
            }
        




}
