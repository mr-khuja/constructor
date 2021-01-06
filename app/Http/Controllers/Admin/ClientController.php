<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function list()
    {
        $data = Client::orderBy('order', 'ASC')->get();

        return view('admin.pages.client.list')->withData($data);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'title' => 'required|string',
                'image' => 'required|string',
                'order' => 'required|numeric',
            ]);

            $data = new Client;
            $data->image = $request->image;
            $data->title = $request->title;
            $data->order = $request->order;
            $data->save();

            return redirect()->route('aclient')->with('message', 'Клиент успешно создан');
        }
        return view('admin.pages.client.create');
    }

    public function edit(Request $request, $id)
    {
        $data = Client::find($id);

        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'title' => 'required|string',
                'image' => 'required|string',
                'order' => 'required|numeric',
            ]);

            $data->image = $request->image;
            $data->title = $request->title;
            $data->order = $request->order;
            $data->save();


            return redirect()->route('aclient')->with('message', 'Клиент успешно обновлен');
        }
        return view('admin.pages.client.edit')->withData($data)->withId($id);
    }

    public function delete($id)
    {
        $data = Client::destroy($id);

        return redirect()->back()->with('message', 'Клиент успешно удалена');
    }
}
