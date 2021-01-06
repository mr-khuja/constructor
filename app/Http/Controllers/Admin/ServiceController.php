<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function list()
    {
        $data = Service::where('lang', 'ru')->get();
        return view('admin.pages.service.list')->withData($data);
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

            $data = new Service;
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

            return redirect()->route('aservice')->with('message', 'Услуга успешно создана');
        }
        return view('admin.pages.service.create');
    }

    public function edit(Request $request, $id, $l)
    {
        $data = Service::where('trans_id', $id)->where('lang', $l)->first();
        if (!$data) {
            $data = new Service;
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

            return redirect()->route('aservice')->with('message', 'Услуга успешно изменена');
        }
        return view('admin.pages.service.edit')->withL($l)->withId($id)->withData($data);
    }

    public function delete($id)
    {
        $data = Service::find($id);
        foreach ($data->trans as $item) {
            if ($item->trans_id != $item->id) {
                $item->delete();
            }
        }
        $data->trans_id = NULL;
        $data->save();
        $data->delete();

        return redirect()->back()->with('message', 'Услуга успешно удалена');
    }
}
