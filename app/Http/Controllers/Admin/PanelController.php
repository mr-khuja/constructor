<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Site\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

class PanelController extends Controller
{
    public function home()
    {
        return view('admin.pages.home');
    }

    public function settings(Request $request)
    {

        $data = Settings::first();

        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'sitename' => 'required|string',
                'logo' => 'nullable|string',
                'logo_light' => 'nullable|string',
                'favicon' => 'nullable|string',
            ]);

            $data->sitename = $request->sitename;
            if (isset($request->favicon)) {
                $data->favicon = $request->favicon;
            }
            if (isset($request->logo_light)) {
                $data->logo_light = $request->logo_light;
            }
            if (isset($request->logo)) {
                $data->logo = $request->logo;
            }
            $data->save();

            return redirect()->back()->with('message', 'Настройки сайта успешно обовлены');
        }
        return view('admin.pages.settings')->withData($data);
    }

    public function profile()
    {
        return view('admin.pages.profile');
    }

    public function profile_edit(Request $request)
    {

        $data = auth()->user();
        $data = User::find($data->id);

        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'name' => 'required|string',
                'image' => 'image',
                'email' => 'required|email|unique:users,email,' . $data->id,
                'password' => 'min:6|confirmed|string|nullable',
            ]);

            $data->name = $request->name;
            $data->email = $request->email;
            if ($request->hasFile('image')) {
                $data->image = $this->save_image($request->image);
            }
            if (isset($request->password)) {
                $data->password = Hash::make($request->password);
            }
            $data->save();

            return redirect()->route('profile')->with('message', 'Настройки профиля успешно обовлены');
        }

        return view('admin.pages.profile_edit')->withData($data);
    }

    public function contact(Request $request)
    {

        $this->validate($request, $validation = [
            'phone' => 'required|string|min:19|max:19',
            'mobile' => 'required|string|min:19|max:19',
            'email' => 'required|email',
            'address' => 'required|string',
        ]);

        $data = Settings::first();

        $data->phone = $request->phone;
        $data->mobile = $request->mobile;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->save();

        return redirect()->back()->with('message', 'Контакты успешно обовлены');
    }


    public function save_image($image)
    {
        $img = Image::make($image->getPathName());

        $width = $img->width();
        $height = $img->height();


        /*
        *  canvas
        */
        $dimension = 100;

        $vertical = (($width < $height) ? true : false);
        $horizontal = (($width > $height) ? true : false);
        $square = (($width = $height) ? true : false);

        if ($vertical) {
            $top = $bottom = 5;
            $newHeight = ($dimension) - ($bottom + $top);
            $img->resize(null, $newHeight, function ($constraint) {
                $constraint->aspectRatio();
            });

        } else if ($horizontal) {
            $right = $left = 5;
            $newWidth = ($dimension) - ($right + $left);
            $img->resize($newWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });

        } else if ($square) {
            $right = $left = 5;
            $newWidth = ($dimension) - ($left + $right);
            $img->resize($newWidth, null, function ($constraint) {
                $constraint->aspectRatio();
            });

        }
        $path = "images/profile/" . time() . ".jpg";
        $img->resizeCanvas($dimension, $dimension, 'center', false, '#ffffff');
        $img->save(public_path($path));
        return '/' . $path;
    }
}
