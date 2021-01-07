<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content\Service;
use App\Models\Content\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function list()
    {
        $data = Project::where('lang', 'ru')->get();
        return view('admin.pages.project.list')->withData($data);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'title' => 'required|string',
                'short' => 'nullable|string',
                'image' => 'nullable|string',
                'body' => 'required|string',
                'service_id' => 'required|numeric',
            ]);

            $data = new Project;
            $data->title = $request->title;
            $data->short = $request->short;
            $data->body = $request->body;
            $data->service_id = $request->service_id;
            $data->image = $request->image;
            $data->created_at = $request->created_at;
            $data->updated_at = $request->updated_at;
            $data->lang = 'ru';
            $data->save();
            $data->trans_id = $data->id;
            $data->save();

            return redirect()->route('aproject')->with('message', 'Проект успешно создан');
        }

        $categories = Service::where('lang', 'ru')->get();

        return view('admin.pages.project.create')->withCategories($categories);
    }

    public function edit(Request $request, $id, $l)
    {
        $data = Project::where('trans_id', $id)->where('lang', $l)->first();
        if (!$data) {
            $data = new Project;
        }
        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'title' => 'required|string',
                'short' => 'nullable|string',
                'image' => 'nullable|string',
                'body' => 'required|string',
                'service_id' => 'required|numeric',
            ]);

            $data->title = $request->title;
            $data->short = $request->short;
            $data->body = $request->body;
            $data->service_id = $request->service_id;
            $data->created_at = $request->created_at;
            $data->updated_at = $request->updated_at;
            $data->image = $request->image;
            $data->lang = $l;
            $data->trans_id = $id;
            $data->save();

            return redirect()->route('aproject')->with('message', 'Проект успешно изменен');
        }

        $categories = Service::where('lang', 'ru')->get();

        return view('admin.pages.project.edit')->withL($l)->withId($id)->withData($data)->withCategories($categories);
    }

    public function delete($id)
    {
        $data = Project::find($id);
        foreach ($data->trans as $item) {
            if ($item->trans_id != $item->id) {
                $item->delete();
            }
        }
        $data->trans_id = NULL;
        $data->save();
        $data->delete();

        return redirect()->back()->with('message', 'Проект успешно удален');
    }
}
