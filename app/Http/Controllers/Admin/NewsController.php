<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function list()
    {
        $data = News::where('lang', 'ru')->get();
        return view('admin.pages.news.list')->withData($data);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'title' => 'required|string',
                'short' => 'nullable|string',
                'image' => 'nullable|string',
                'body' => 'required|string',
            ]);

            $data = new News;
            $data->title = $request->title;
            $data->short = $request->short;
            $data->body = $request->body;
            $data->image = $request->image;
            $data->created_at = $request->created_at;
            $data->updated_at = $request->updated_at;
            $data->lang = 'ru';
            $data->save();
            $data->trans_id = $data->id;
            $data->save();

            return redirect()->route('anews')->with('message', 'Новость успешно создана');
        }
        return view('admin.pages.news.create');
    }

    public function edit(Request $request, $id, $l)
    {
        $data = News::where('trans_id', $id)->where('lang', $l)->first();
        if (!$data) {
            $data = new News;
        }
        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'title' => 'required|string',
                'short' => 'nullable|string',
                'image' => 'nullable|string',
                'body' => 'required|string',
            ]);

            $data->title = $request->title;
            $data->short = $request->short;
            $data->body = $request->body;
            $data->created_at = $request->created_at;
            $data->updated_at = $request->updated_at;
            $data->image = $request->image;
            $data->lang = $l;
            $data->trans_id = $id;
            $data->save();

            return redirect()->route('anews')->with('message', 'Новость успешно изменена');
        }
        return view('admin.pages.news.edit')->withL($l)->withId($id)->withData($data);
    }

    public function delete($id)
    {
        $data = News::find($id);
        foreach ($data->trans as $item) {
            if ($item->trans_id != $item->id) {
                $item->delete();
            }
        }
        $data->trans_id = NULL;
        $data->save();
        $data->delete();

        return redirect()->back()->with('message', 'Новость успешно удалена');
    }
}
