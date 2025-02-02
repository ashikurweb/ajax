<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{

    public function view ()
    {
        $students = Student::all();
        return response()->json([
            'status' => 200,
            'data' => $students
        ]);
    }

    public function store ()
    {
        $validator = Validator::make(request()->all(), [
            'name'      => 'required',
            'email'     => 'required|email|unique:students,email|max:255',
            'reg'       => 'required',
            'roll'      => 'required',
            'phone'     => 'required',
            'address'   => 'required',
            'gender'    => 'required',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 400,
                'errors'     => $validator->errors()
            ]);
        }

        $student = new Student();

        $student->name = request('name');
        $student->email = request('email');
        $student->reg = request('reg');
        $student->roll = request('roll');
        $student->phone = request('phone');
        $student->address = request('address');
        $student->gender = request('gender');

        if (request()->hasFile('image')) {
            $image = request()->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('students'), $imageName);
            $student->image = $imageName;
        } else {
            $student->image = null;
        }

        $student->save();

        return response()->json([
            'status'    => 200,
            'message'   => 'Student created successfully'
        ]);
    }

    public function edit ($id)
    {
        $student = Student::findOrFail($id);
        return response()->json([
            'status'    => 200,
            'student'      => $student
        ]);
    }

    public function update ( $id )
    {
        $validator = Validator::make(request()->all(), [
            'name'      => 'required',
            'email'     => 'required|email|max:255',
            'reg'       => 'required',
            'roll'      => 'required',
            'phone'     => 'required',
            'address'   => 'required',
            'gender'    => 'required',
            'image'     => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 400,
                'errors'     => $validator->errors()
            ]);
        }

        $student = Student::findOrFail($id);

        $student->name = request('name');
        $student->email = request('email');
        $student->reg = request('reg');
        $student->roll = request('roll');
        $student->phone = request('phone');
        $student->address = request('address');
        $student->gender = request('gender');

        if (request()->hasFile('image')) {
            $image = request()->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('students'), $imageName);
            $student->image = $imageName;
        }

        if (!$student->isDirty()) {
            return response()->json([
                'status'    => 200,
                'message'   => 'Nothing to update'
            ]);
        }

        $student->save();

        return response()->json([
            'status'    => 200,
            'message'   => 'Student updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        if ($student->image) {
            $imagePath = public_path('students/' . $student->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $student->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Student deleted successfully'
        ]);
    }

}
