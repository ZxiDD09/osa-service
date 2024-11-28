<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        $builder = Staff::latest();

        $builder->with('user');

        $staffs = $builder->paginate($request->per_page ?? 20);

        return JsonResource::collection($staffs);
    }

    public function store(StoreStaffRequest $request)
    {

        $password = Str::password();

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => bcrypt($password),
        ]);

        $staff = Staff::create([
            ...$request->validated(),
            'user_id' => $user->id,
        ]);

        $staff->load('user');

        return JsonResource::make($staff)->additional([
            'message' => 'Staff created successfully',
        ]);
    }

    public function show(Staff $staff)
    {
        $staff->load('information', 'user');

        return JsonResource::make($staff);
    }

    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        $staff->update($request->validated());

        $staff->load('user');

        return JsonResource::make($staff)->additional([
            'message' => 'Staff updated successfully',
        ]);
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();

        $staff->user->delete();

        return JsonResource::make($staff)->additional(['message' => 'Staff removed successfully']);
    }
}
