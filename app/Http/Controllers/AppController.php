<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Exception;
use Validator;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $data = [
            'pageTitle' => 'Student Management',
            'students' => Students::get()->toArray()
        ];
        return view('student-list', $data);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_name' => 'required',
            'address' => 'required',
            'student_class' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'ERROR', 'data' => [], 'msg' => $validator->errors()->first()], 200);
        }
        try {
            Students::create([
                'name' => $request->student_name,
                'address' => $request->address,
                'class' => $request->student_class,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            return response()->json(['status' => 'OK', 'data' => [], 'msg' => 'Data Added Successfully!']);
        } catch (Exception $e) {
            return response()->json(['ERROR' => 'OK', 'data' => [], 'msg' => $e->getMessage()]);
        }
    }

    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'student_name' => 'required',
            'address' => 'required',
            'student_class' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'ERROR', 'data' => [], 'msg' => $validator->errors()->first()], 200);
        }
        try {
            Students::where('id', $request->id)->update([
                'name' => $request->student_name,
                'address' => $request->address,
                'class' => $request->student_class,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            return response()->json(['status' => 'OK', 'data' => [], 'msg' => 'Data Updated Successfully!']);
        } catch (Exception $e) {
            return response()->json(['ERROR' => 'OK', 'data' => [], 'msg' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {
        try {
            Students::where('id', $id)->delete();
            return response()->json(['status' => 'OK', 'data' => [], 'msg' => 'Data Deleted Successfully!']);
        } catch (Exception $e) {
            return response()->json(['ERROR' => 'OK', 'data' => [], 'msg' => $e->getMessage()]);
        }
    }
}
