<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content\Basic;
use Illuminate\Http\Request;

class BasicController extends Controller
{
    public function list()
    {
        $data = Basic::where('lang', 'ru')->get();
        return view('admin.pages.basic.list')->withData($data);
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

            $data = new Basic;
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

            return redirect()->route('abasic')->with('message', 'Страница успешно создана');
        }
        return view('admin.pages.basic.create');
    }

    public function edit(Request $request, $id, $l)
    {
        $data = Basic::where('trans_id', $id)->where('lang', $l)->first();
        if (!$data) {
            $data = new Basic;
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

            return redirect()->route('abasic')->with('message', 'Страница успешно изменена');
        }
        return view('admin.pages.basic.edit')->withL($l)->withId($id)->withData($data);
    }

    public function delete($id)
    {
        $data = Basic::find($id);
        foreach ($data->trans as $item) {
            if ($item->trans_id != $item->id) {
                $item->delete();
            }
        }
        $data->trans_id = NULL;
        $data->save();
        $data->delete();

        return redirect()->back()->with('message', 'Страница успешно удалена');
    }
}
