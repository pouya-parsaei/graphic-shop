<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\StoreRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\User;

class UsersController extends Controller
{
    public function all()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.add');
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        $createdUser = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'mobile' => $validatedData['mobile'],
            'role' => $validatedData['role']
        ]);
        if (!$createdUser)
            return back()->with('failed', 'خطا در ایجاد کاربر جدید.');
        return back()->with('success', 'کاربر جدید با موفقیت ایجاد شد.');
    }

    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateRequest $request, $user_id)
    {
        $validatedData = $request->validated();
        $user = User::findOrFail($user_id);
        $updatedUser = $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'mobile' => $validatedData['mobile'],
            'role' => $validatedData['role']
        ]);

        if (!$updatedUser)
            return back()->with('failed', 'خطا در بروزرسانی اطلاعات کاربر.');

        return back()->with('success', 'کاربر با موفقیت بروزرسانی گردید.');

    }

    public function delete($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();
        return back()->with('success', 'کاربر حذف شد.');
    }
}
