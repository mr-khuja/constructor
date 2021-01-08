<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Content\Homepage;
use App\Models\Site\Log;
use App\Models\Site\SeoDefault;
use App\Models\Site\Settings;
use App\Models\Site\Social;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;

class PanelController extends Controller
{
    public function home()
    {
        return view('admin.pages.home');
    }

    public function homepage(Request $request, $l)
    {
        $data = Homepage::where('lang', $l)->first();
        if (!$data) {
            $data = new Homepage;
        }
        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'about_title' => 'nullable|string',
                'about_text' => 'nullable|string',
                'figures_title' => 'nullable|string',
                'figures_text' => 'nullable|string',
                'figures_title_first' => 'nullable|string',
                'figures_value_first' => 'nullable|string',
                'figures_title_second' => 'nullable|string',
                'figures_value_second' => 'nullable|string',
                'figures_title_third' => 'nullable|string',
                'figures_value_third' => 'nullable|string',
                'figures_title_fourth' => 'nullable|string',
                'figures_value_fourth' => 'nullable|string',
                'footer' => 'nullable|string',
            ]);

            $data->about_title = $request->about_title;
            $data->about_text = $request->about_text;
            $data->figures_title = $request->figures_title;
            $data->figures_text = $request->figures_text;
            $data->figures_title_first = $request->figures_title_first;
            $data->figures_value_first = $request->figures_value_first;
            $data->figures_title_second = $request->figures_title_second;
            $data->figures_value_second = $request->figures_value_second;
            $data->figures_title_third = $request->figures_title_third;
            $data->figures_value_third = $request->figures_value_third;
            $data->figures_title_fourth = $request->figures_title_fourth;
            $data->figures_value_fourth = $request->figures_value_fourth;
            $data->footer = $request->footer;
            $data->lang = $l;
            $data->save();

            return redirect()->route('abasic')->with('message', 'Страница успешно создана');
        }
        return view('admin.pages.homepage')->withL($l)->withData($data);
    }

    public function seosocial($l)
    {
        $data = SeoDefault::where('lang', $l)->first();
        if (!$data) {
            $data = new SeoDefault;
        }
        $socs = Social::first();
        if (!$socs) {
            $socs = new Social;
        }
        return view('admin.pages.seo')->withL($l)->withData($data)->withSocs($socs);
    }

    public function seo(Request $request, $l)
    {
        $this->validate($request, $validation = [
            'title' => 'nullable|string',
            'description' => 'nullable|string',
            'keywords' => 'nullable|string',
        ]);

        $data = SeoDefault::where('lang', $l)->first();
        if (!$data) {
            $data = new SeoDefault;
        }
        $data->lang = $l;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->keywords = $request->keywords;
        $data->save();

        return redirect()->back()->withMessage('Настройки SEO успешно обновлены');
    }

    public function social(Request $request)
    {
        $this->validate($request, $validation = [
            'facebook' => 'nullable|string',
            'telegram' => 'nullable|string',
            'youtube' => 'nullable|string',
            'instagram' => 'nullable|string',
            'twitter' => 'nullable|string',
        ]);

        $data = Social::first();
        if (!$data) {
            $data = new Social;
        }
        $data->facebook = $request->facebook;
        $data->telegram = $request->telegram;
        $data->youtube = $request->youtube;
        $data->instagram = $request->instagram;
        $data->twitter = $request->twitter;
        $data->save();

        return redirect()->back()->withMessage('Настройки соц. сетей успешно обновлены');
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
        $logs = auth()->user()->logs()->paginate(5);
        return view('admin.pages.profile')->withLogs($logs);
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


    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
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
