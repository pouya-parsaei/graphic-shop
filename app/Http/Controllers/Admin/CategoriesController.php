<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Categories\StoreRequest;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        $createdCategory = Category::create([
            'title' => $validatedData['title'],
            'slug' => $validatedData['slug'],
        ]);
        if (!$createdCategory)
            return back()->with('failed', 'خطا در ایجاد دسته بندی');

        return back()->with('success', 'دسته بندی با موفقیت ایجاد شد.');
    }

    public function all()
    {
        $categories = Category::paginate(1);
        return view('admin.categories.all',compact('categories'));
    }
}
