<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function list()
    {
        $data = Slider::where('lang', 'ru')->get();
        return view('admin.pages.slider.list')->withData($data);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'title' => 'required|string',
                'order' => 'required|numeric',
                'subtitle' => 'nullable|string',
                'image' => 'nullable|string',
                'path' => 'nullable|string',
            ]);

            $data = new Slider;
            $data->title = $request->title;
            $data->order = $request->order;
            $data->subtitle = $request->subtitle;
            $data->image = $request->image;
            $data->path = $request->path;
            $data->lang = 'ru';
            $data->save();
            $data->trans_id = $data->id;
            $data->save();

            return redirect()->route('aslider')->with('message', 'Слайд успешно создан');
        }
        return view('admin.pages.slider.create');
    }

    public function edit(Request $request, $id, $l)
    {
        $data = Slider::where('trans_id', $id)->where('lang', $l)->first();
        if (!$data) {
            $data = new Slider;
        }
        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'title' => 'required|string',
                'order' => 'required|numeric',
                'subtitle' => 'nullable|string',
                'image' => 'nullable|string',
                'path' => 'nullable|string',
            ]);

            $data->title = $request->title;
            $data->order = $request->order;
            $data->subtitle = $request->subtitle;
            $data->image = $request->image;
            $data->path = $request->path;
            $data->lang = $l;
            $data->trans_id = $id;
            $data->save();

            return redirect()->route('aslider')->with('message', 'Слайд успешно изменен');
        }
        return view('admin.pages.slider.edit')->withL($l)->withId($id)->withData($data);
    }

    public function delete($id)
    {
        $data = Slider::find($id);
        foreach ($data->trans as $item) {
            if ($item->trans_id != $item->id) {
                $item->delete();
            }
        }
        $data->trans_id = NULL;
        $data->save();
        $data->delete();

        return redirect()->back()->with('message', 'Слайд успешно удален');
    }
}
