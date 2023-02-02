<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use App\Models\course;
use App\Models\courselist;
use App\Models\student_course_map;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $student = new student();
        if ($request->name) {
            $student = $student->where('name', 'LIKE', "%{$request->name}%");
        }
        if ($request->email) {
            $student = $student->where('email', 'LIKE', "%{$request->email}%");
        }
        if ($request->phone) {
            $student = $student->where('phone', 'LIKE', "%{$request->phone}%");
        }
        if ($request->address) {
            $student = $student->where('address', 'LIKE', "%{$request->address}%");
        }

        $students = $student->get();
        $data['students'] = $students;

        //get courses
        $courses = courselist::all();
        $data['courses'] = $courses;

//      return $data;
        return view('student_list', $data);
    }

    public function add_student()
    {
        return view('add_student');
    }

    public function save_student(Request $request)
    {
//        dd($request->all());

        $request->validate([
            'name' => 'required|min:4',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);
        $name = $request->name;
        $email = $request->email;
        $phone = $request->phone;
        $address = $request->address;

        $stu = new student();
        $stu->name = $name;
        $stu->email = $email;
        $stu->phone = $phone;
        $stu->address = $address;
        $stu->save();
        return redirect()->back()->with('success', 'Student Added Successfully');
    }

    public function edit_student($id)
    {
        $data = student::where('id', '=', $id)->first();

        return response()->json([
            'status' => 200,
            'student' => $data
        ]);
    }

    public function update_students(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $studentObj = new student();
        $student = $studentObj->find($request->id);
        $student->fill($request->all())->save();

        return redirect()->back()->with('success', 'student updated successfully');
    }

    public function delete_student($id)
    {
        student::find($id)->delete();
        return redirect('student_list')->with('success', 'Student Delete Successfully');
    }

    public function save_course(Request $request)
    {

        $course = new courselist();
        $course_name = $request->coursename;

        if (!empty($course_name)) {
            $found = courselist::where('course_name', $course_name)->count();
            if ($found == 0) {
                $course->course_name = $course_name;
                $course->save();
                return redirect()->back()->with('success', 'Course Added Successfully');
            } else {
                return redirect()->back()->with('fail', 'Course Already Exists');
            }
        } else {
            return redirect()->back()->with('fail', 'Do not Added');
        }
    }

    public function view_course($id)
    {
        $student_courses = student_course_map::with('course')->where('student_id', $id)->get();
        //$view=student::find($id)->student_course_map;
        return response()->json([
            'status' => 200,
            'viewcourse' => $student_courses
        ]);

    }

    public function course_list()
    {
        $courselist = new courselist();
        $courses = $courselist->get();
        return response()->json([
            'status' => 200,
            'course_List' => $courses
        ]);
    }

    public function assign_course(Request $request)
    {
        $student_course_map = new student_course_map();
        $studentid = $request->studentid;
        $courseid = $request->assigncourseid;

        if (!empty($studentid) && !empty($courseid)) {

            $found = student_course_map::where('course_id', $courseid)->where('student_id', $studentid)->count();
            if ($found == 0) {
                $student_course_map->student_id = $studentid;
                $student_course_map->course_id = $courseid;
                $student_course_map->save();
                return redirect()->back()->with('success', 'Course Assign Successfully');
            } else {
                return redirect()->back()->with('fail', 'Course Already assigned');
            }
        } else {
            return redirect()->back()->with('fail', 'Do not assigned');
        }
    }
}
