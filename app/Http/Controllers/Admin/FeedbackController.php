<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function list()
    {
        $data = Feedback::orderBy('order', 'ASC')->get();

        return view('admin.pages.feedback.list')->withData($data);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'title' => 'required|string',
                'image' => 'required|string',
                'position' => 'required|string',
                'comment' => 'required|string',
                'order' => 'required|numeric',
            ]);

            $data = new Feedback;
            $data->image = $request->image;
            $data->title = $request->title;
            $data->position = $request->position;
            $data->comment = $request->comment;
            $data->order = $request->order;
            $data->save();

            return redirect()->route('afeedback')->with('message', 'Отзыв успешно создан');
        }
        return view('admin.pages.feedback.create');
    }

    public function edit(Request $request, $id)
    {
        $data = Feedback::find($id);

        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'title' => 'required|string',
                'image' => 'required|string',
                'order' => 'required|numeric',
                'position' => 'required|string',
                'comment' => 'required|string',
            ]);

            $data->image = $request->image;
            $data->title = $request->title;
            $data->position = $request->position;
            $data->comment = $request->comment;
            $data->order = $request->order;
            $data->save();


            return redirect()->route('afeedback')->with('message', 'Отзыв успешно обновлен');
        }
        return view('admin.pages.feedback.edit')->withData($data)->withId($id);
    }

    public function delete($id)
    {
        $data = Feedback::destroy($id);

        return redirect()->back()->with('message', 'Клиент успешно удалена');
    }
}
