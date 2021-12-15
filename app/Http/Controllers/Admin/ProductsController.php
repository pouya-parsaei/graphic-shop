<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\StoreRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Utilities\ImageUploader;

class ProductsController extends Controller
{
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.add', compact('categories'));
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validated();
        $admin = User::where('email', 'admin@gmail.com')->first();
        $createdProduct = Product::create([
            'title' => $validatedData['title'],
            'category_id' => $validatedData['category_id'],
            'price' => $validatedData['price'],
            'description' => $validatedData['description'],
            'owner_id' => $admin->id
        ]);

        try {
            $basePath = 'products/' . $createdProduct->id . '/';
            $sourceImageFullPath = $basePath . 'source_url' . $validatedData['thumbnail_url']->getClientOriginalName();

            $images = [
                'thumbnail_url' => $validatedData['thumbnail_url'],
                'demo_url' => $validatedData['demo_url'],
            ];

            $imagesPath = ImageUploader::uploadMany($images, $basePath);
            ImageUploader::upload($validatedData['thumbnail_url'], $sourceImageFullPath, 'local_storage');
            $createdProduct->update([
                'thumbnail_url' => $imagesPath['thumbnail_url'],
                'demo_url' => $imagesPath['demo_url'],
                'source_url'=> $sourceImageFullPath
            ]);
            return back()->with('success','محصول ایجاد شد.');
        } catch (\Exception $e) {
            return back()->with('failed', $e->getMessage());
        }
    }
}
