<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // ใช้ model ในการ query
use App\Models\Department; // ใช้ model ในการ query
use Illuminate\Support\Facades\DB; // ใช้ query ปกติ
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class DepartmentController extends Controller
{
    public function index(Request $request){
        $data["departments"] = [];
        // debug หรือ ดูข้อมูล และจะไม่ทำงานต่อ เมื่อมาถึงคำสั่งนี้
        // dd("Department controller index.");
        $data["title"] = "department";
        $data["departments"] = Department::get();
        return view('departments.list', $data);
    }

    public function form(Request $request, $id = null){
        $department = Department::find($id);

        if($department){
            $data['department'] = $department;
        }
        else{
            $data['department'] = null;
        }

        return view('departments.form', $data);
    }

    public function formSubmit(Request $request, $id = null){
        $department = Department::find($id);

        if($id){ // for update
            $request->validate([
                'name' => ['required', Rule::unique('departments')->ignore($department->id)],
                'description' => 'nullable',
                'active' => ['required','boolean']
            ]);
        }
        else{ // for insert
            $department = new Department();
            $request->validate([
                'name' => ['required', 'unique:departments'],
                'description' => ['nullable'],
            ]);
        }

        // https://laravel.com/docs/10.x/validation

        $department->name = $request->name;
        $department->description = $request->description;
        $department->active = $request->active;
        $department->save();

        return redirect()->route('department.index')->with('success', 'Department save successfully.'); //use name route
        // return redirect('departments')->with('success', 'Department save successfully.');
    }

    public function delete(Request $request, $id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return back()->with('success', 'Department deleted successfully.');
    }


}
