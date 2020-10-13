<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Test;
use App\User;
use Auth;

class IternalCompanyController extends Controller
{
    private function getDepartmentChild($department)
    {
        $result = [];
        $result = array_merge($result, $department->child->pluck('id')->toArray());
        if ($department->child->isNotEmpty()) {
            foreach ($department->child as $child) {
                $result = array_merge($result, $this->getDepartmentChild($child));
            }
        }
        return $result;
    }

    public function showTest($id)
    {
        $department = Department::findOrFail($id);
        $childs = $this->getDepartmentChild($department);
        $user_pos = Auth::user()->position->level;
        $users = User::with(['department, position'])
            ->whereIn('department_id', $childs)
            ->orWhere('department_id', $id)
            ->whereHas('position', function ($query) use ($user_pos) {
                $query->where('level', '>', $user_pos);
            })
            ->pluck('id')
            ->toArray();
        $tests = Test::with(['survey_round_instance', 'survey', 'candiate', 'candiate.position', 'candiate.department'])
            ->whereIn('candiate_id', $users)->get();
        return view('admin.pages.internal_department.show_test', compact('tests'));
    }

}