<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentPropertyController extends Controller
{
    public function index(Department $department)
    {
        $properties = Property::where('department_id', $department->id)
            ->get();
        $dept = Department::select('id', 'name', 'user_id')
            ->with('user:id,name')
            ->find($department->id);
        
        return inertia('Department/Show', [
           'department' => $department,
           'properties' => $properties
        ]);
    }
}
