<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site\Log;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function list()
    {
        $data = User::get();
        return view('admin.pages.users.list')->withData($data);
    }

    public function logs($id)
    {
        $user = User::find($id);
        $data = $user->logs()->paginate(10);
        return view('admin.pages.users.logs')->withData($data)->withUser($user);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'name' => 'required|string',
                'role' => 'required|numeric',
                'image' => 'required|image',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|confirmed|string|nullable',
            ]);

            $data = new User;
            $data->name = $request->name;
            $data->email = $request->email;
            $data->role = $request->role;
            $data->image = $this->save_image($request->image);
            $data->password = Hash::make($request->password);
            $data->save();

            return redirect()->route('ausers')->with('message', 'Пользователь успешно создан');
        }
        return view('admin.pages.users.create');
    }

    public function edit(Request $request, $id)
    {
        $data = User::find($id);
        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'name' => 'required|string',
                'role' => 'required|numeric',
                'image' => 'image',
                'email' => 'required|email|unique:users,email,' . $data->id,
                'password' => 'min:6|confirmed|string|nullable',
            ]);

            $data->name = $request->name;
            $data->email = $request->email;
            $data->role = $request->role;
            if ($request->hasFile('image')) {
                $data->image = $this->save_image($request->image);
            }
            if (isset($request->password)) {
                $data->password = Hash::make($request->password);
            }
            $data->save();

            return redirect()->route('ausers')->with('message', 'Пользователь успешно изменен');
        }
        return view('admin.pages.users.edit')->withData($data);
    }

    public function delete($id)
    {
        Log::where('user_id', $id)->delete();
        User::destroy($id);
        return redirect()->back()->with('message', 'Пользователь успешно удален');
    }
}
