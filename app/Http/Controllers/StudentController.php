<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\session;
use App\Models\Students;
use Yajra\DataTables\Facades\Datatables;
use Image;
Use DB;


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



    public function View_students(Request $request){
        if(Auth::id()){
            $id=Auth::user()->id;

        if ($request->ajax()) {
            $data = Students::select('*');
            return Datatables::of($data)
                ->addIndexColumn()

                
                 ->addColumn('action', function($row){
                    $actionBtn = '<a class="btn btn-sm btn-success edit_std" href="javascript:void(0)" title="Edit" name="Edit" id="'.$row->id.'"><i class="fa fa-pencil"></i> Edit</a>


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


    public function edit_student($id){

        if(Auth::id()){
            $ids=Auth::user()->id;
            
            $output = array();
          $Students = DB::table('Students')
            ->where('students.id', $id)
            ->get();

        foreach($Students as $row)
        {
       
        $output['id'] = $row->id; 
      
        $output['Lastname'] = $row->lastname;
        $output['Firstname'] = $row->firstname;
        $output['gender'] = $row->gender;


    if(!empty($row->image)){
     

        $output['std_image2'] = '<img src="http://127.0.0.1:8000/image/thumbnails/'.$row->image.'"  width="200" height="150"/>
        <input type="text" name="hidden_user_image" value="'.$row->image.'" />';
    }else
    {
        $output['std_image'] = '<input type="text" name="hidden_user_image" value="" />';
    }

        return response()->json($output);

         }

     }else{
        return redirect('login');
    }
    }


    public function Update_Student(Request $request)
    {

        if(Auth::id()){
            $id=Auth::user()->id; 

            $attr = $request->validate([

                'lastname' => 'required|string|max:250',
                'firstname' => 'required|string|max:250',
                'gender' => 'required|string|max:250',
                'student_image' =>'mimes:jpg,jpeg,png,gif,svg',
               
               ]);

               $ids = $request->ids;
               $image=$request->file('student_image');
               if($image){
                    $imagename = time().'.'.$image->extension();
                    $destinationPath = public_path('image\thumbnails');
                    $img = Image::make($image->path());
                    $img->resize(100, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$imagename);
                   

                 

                            $data = [               
                            'lastname'   => $request->lastname,
                             'firstname'   => $request->firstname,
                              'gender'   => $request->gender,
				               'image'             => $imagename
       
                                  ];    
                        Students::where('students.id',$ids)
                        ->update($data);

		            }else{
			            $data = [               
                            'lastname'   => $request->lastname,
                             'firstname'   => $request->firstname,
                              'gender'   => $request->gender,
				              
          
                                  ];    
                        Students::where('students.id',$ids)
                        ->update($data);

			}

            return redirect('Homedashboard')->with('message','Student Info Updated Successfully');


             }else{
        return redirect('login');
    }
    }
}
