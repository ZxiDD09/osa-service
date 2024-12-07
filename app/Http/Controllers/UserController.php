<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $builder = User::latest()->with('student', 'staff');

        if ($request->staff) {
            $builder->has('staff')->with('staff.user');
        }

        if ($request->student) {
            $builder->has('student.section')->with(['student.candidate.information']);
        }

        $users = $builder->paginate($request->per_page ?? 20);

        return JsonResource::collection($users);
    }
}
