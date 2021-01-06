<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function order(Request $request)
    {
        foreach ($request->order as $key => $item) {
            $menu = Category::find($item['id']);
            $menu->order = $key;
            $menu->parent_id = null;
            $menu->save();

            $trans = Category::where('trans_id', $menu->id)->get();
            foreach ($trans as $tran) {
                $tran->parent_id = $menu->parent_id;
                $tran->order = $menu->order;
                $tran->save();
            }
            if (isset($item['children'])) {
                foreach ($item['children'] as $chkey => $child) {
                    $children = Category::find($child['id']);
                    $children->parent_id = $item['id'];
                    $children->order = $chkey;
                    $children->save();

                    $trans = Category::where('trans_id', $children->id)->get();
                    foreach ($trans as $tran) {
                        $tran->parent_id = $children->parent_id;
                        $tran->order = $children->order;
                        $tran->save();
                    }
                    if (isset($child['children'])) {
                        foreach ($child['children'] as $chkey2 => $child2) {
                            $children2 = Category::find($child2['id']);
                            $children2->parent_id = $child['id'];
                            $children2->order = $chkey2;
                            $children2->save();

                            $trans = Category::where('trans_id', $children2->id)->get();
                            foreach ($trans as $tran) {
                                $tran->parent_id = $children2->parent_id;
                                $tran->order = $children2->order;
                                $tran->save();
                            }
                            if (isset($child2['children'])) {
                                foreach ($child2['children'] as $chkey3 => $child3) {
                                    $children3 = Category::find($child3['id']);
                                    $children3->parent_id = $child2['id'];
                                    $children3->order = $chkey3;
                                    $children3->save();

                                    $trans = Category::where('trans_id', $children3->id)->get();
                                    foreach ($trans as $tran) {
                                        $tran->parent_id = $children3->parent_id;
                                        $tran->order = $children3->order;
                                        $tran->save();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        $request->session()->flash('message', 'Порядок категорий успешно обновлена');
    }

    public function list()
    {
        $data = Category::whereNull('parent_id')->where('lang', 'ru')->orderBy('order', 'ASC')->get();

        return view('admin.pages.category.list')->withData($data);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'title' => 'required|string',
                'path' => 'required|string',
            ]);

            $data = new Category;
            $data->path = $request->path;
            $data->title = $request->title;
            $data->lang = 'ru';
            $data->order = 0;
            $data->save();
            $data->trans_id = $data->id;
            $data->save();

            return redirect()->route('acategory')->with('message', 'Категория успешно создана');
        }
        return view('admin.pages.category.create');
    }

    public function edit(Request $request, $id, $l)
    {
        $parent = Category::find($id);
        $data = Category::where('trans_id', $id)->where('lang', $l)->first();
        if (!$data) {
            $data = new Category;
        }
        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'title' => 'required|string',
                'path' => 'required|string',
            ]);

            $data->path = $request->path;
            $data->title = $request->title;
            $data->lang = $l;
            $data->parent_id = $parent->parent_id;
            $data->order = $parent->order;
            $data->trans_id = $id;
            $data->save();

            $trans = Category::where('trans_id', $parent->id)->get();
            foreach ($trans as $item) {
                $item->parent_id = $parent->parent_id;
                $item->order = $parent->order;
                $item->save();
            }

            return redirect()->route('acategory')->with('message', 'Категория успешно обновлена');
        }
        return view('admin.pages.category.edit')->withData($data)->withL($l)->withId($id);
    }

    public function delete($id)
    {
        $data = Category::find($id);
        foreach ($data->children as $item) {
            $item->parent_id = NULL;
            $item->save();
        }
        foreach ($data->trans as $item) {
            if ($item->trans_id != $item->id) {
                $item->delete();
            }
        }
        $data->trans_id = NULL;
        $data->save();
        $data->delete();

        return redirect()->back()->with('message', 'Категория успешно удалена');
    }
}
