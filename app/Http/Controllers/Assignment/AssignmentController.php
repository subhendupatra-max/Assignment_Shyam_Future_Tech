<?php

namespace App\Http\Controllers\Assignment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

class AssignmentController extends Controller
{
    public function tester_list(Request $request)  // tester list
    {
        $data = $request->session()->get('formData', []);
        return view('assignment.tester_list', compact('data'));
    }

    public function submitForm(Request $request)  // submit tester data
    {
        $data = $request->session()->get('formData', []);

        foreach ($data as $key => $tester) {
            if ($tester['tester_id'] === $request->tester_id) {
                return response()->json(['message' => 'Please Enter a unique Id']); 
            }
        }

        $file_nmae = '';
        if($request->tester_image != null){
            $file_nmae = time().'.'.$request->tester_image->extension();
            $request->tester_image->move('assets/images',$file_nmae);  
        }

        $formData = [
            'tester_id' =>$request->tester_id,
            'tester_name' =>$request->tester_name,
            'address' =>$request->address,
            'gender' =>$request->gender,
            'tester_image' => $file_nmae,
        ];

        $request->session()->push('formData', $formData);

        return response()->json(['message' => 'Data saved successfully']);
    }

    public function delete_tester(Request $request)  // delete tester data
    {
        $data = $request->session()->get('formData', []);

        foreach ($data as $key => $tester) {
            if ($tester['tester_id'] === $request->recordId) {
                unset($data[$key]);
                break; 
            }
        }
        Session::put('formData', $data);
        return response()->json(['message' => 'Data Deleted successfully']);
    }

    public function view_tester_details(Request $request){  // view tester data
        $data = $request->session()->get('formData', []);

        foreach ($data as $key => $tester) {
            if ($tester['tester_id'] === $request->recordId) {
                $main_res = $data[$key];
            }
        }
        Session::put('formData', $data);
        return response()->json($main_res);
    }

    public function updateForm(Request $request)  // update tester data
    {
        $data = $request->session()->get('formData', []);

        foreach ($data as $key => $tester) {
            if ($tester['tester_id'] === $request->tester_id) {
                unset($data[$key]);
                break; 
            }
        }
        Session::put('formData', $data);
        
        if($request->tester_image != null){
            $file_nmae = time().'.'.$request->tester_image->extension();
            $request->tester_image->move('assets/images',$file_nmae);  
        }else{
            $file_nmae = $request->old_tester_image;
        }

        $formData = [
            'tester_id' =>$request->tester_id,
            'tester_name' =>$request->tester_name,
            'address' =>$request->address,
            'gender' =>$request->gender,
            'tester_image' => $file_nmae,
        ];

        $request->session()->push('formData', $formData);

        return response()->json(['message' => 'Data Updated successfully']);
    }

}
