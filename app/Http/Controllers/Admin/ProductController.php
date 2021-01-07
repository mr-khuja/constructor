<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content\Category;
use App\Models\Content\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list()
    {
        $data = Product::where('lang', 'ru')->get();
        return view('admin.pages.product.list')->withData($data);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'title' => 'required|string',
                'short' => 'nullable|string',
                'image' => 'nullable|string',
                'body' => 'required|string',
                'full' => 'nullable|string',
                'price' => 'required|numeric',
                'category_id' => 'required|numeric',
            ]);

            $data = new Product;
            $data->title = $request->title;
            $data->short = $request->short;
            $data->body = $request->body;
            $data->full = $request->full;
            $data->price = $request->price;
            $data->category_id = $request->category_id;
            $data->image = $request->image;
            $data->created_at = $request->created_at;
            $data->updated_at = $request->updated_at;
            $data->lang = 'ru';
            $data->save();
            $data->trans_id = $data->id;
            $data->save();

            return redirect()->route('aproduct')->with('message', 'Продукт успешно создан');
        }

        $categories = Category::where('lang', 'ru')->get();

        return view('admin.pages.product.create')->withCategories($categories);
    }

    public function edit(Request $request, $id, $l)
    {
        $data = Product::where('trans_id', $id)->where('lang', $l)->first();
        if (!$data) {
            $data = new Product;
        }
        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'title' => 'required|string',
                'short' => 'nullable|string',
                'image' => 'nullable|string',
                'body' => 'required|string',
                'full' => 'nullable|string',
                'price' => 'required|numeric',
                'category_id' => 'required|numeric',
            ]);

            $data->title = $request->title;
            $data->short = $request->short;
            $data->body = $request->body;
            $data->full = $request->full;
            $data->price = $request->price;
            $data->category_id = $request->category_id;
            $data->created_at = $request->created_at;
            $data->updated_at = $request->updated_at;
            $data->image = $request->image;
            $data->lang = $l;
            $data->trans_id = $id;
            $data->save();

            return redirect()->route('aproduct')->with('message', 'Продукт успешно изменен');
        }

        $categories = Category::where('lang', 'ru')->get();

        return view('admin.pages.product.edit')->withL($l)->withId($id)->withData($data)->withCategories($categories);
    }

    public function delete($id)
    {
        $data = Product::find($id);
        foreach ($data->trans as $item) {
            if ($item->trans_id != $item->id) {
                $item->delete();
            }
        }
        $data->trans_id = NULL;
        $data->save();
        $data->delete();

        return redirect()->back()->with('message', 'Продукт успешно удален');
    }
}
