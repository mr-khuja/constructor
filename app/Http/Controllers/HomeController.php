<?php

namespace App\Http\Controllers;

use App\Models\Content\Basic;
use App\Models\Content\Category;
use App\Models\Content\News;
use App\Models\Content\Product;
use App\Models\Content\Project;
use App\Models\Content\Service;
use App\Models\Site\Callme;
use App\Models\Site\Contact;
use App\Models\Site\Seo;
use App\Models\Site\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function home()
    {
        $lang = App::getLocale();
        return view('pages.home');
    }

    public function category($id = 0)
    {
        $lang = App::getLocale();
        if ($id == 0) {
            $data = Category::where('lang', $lang)->paginate(12);
            return view('pages.category_list')->withData($data);
        }
        $data = Category::find($id);
        if ($data && $data->lang != $lang) {
            $data = Category::where('trans_id', $data->trans_id)->where('lang', $lang)->first();
        }
        if (!$data) {
            $data = new Category;
        }
        return view('pages.category')->withData($data);
    }

    public function project($slug = '')
    {
        $lang = App::getLocale();
        if ($slug == '') {
            $data = Project::where('lang', $lang)->paginate(12);
            return view('pages.project_list')->withData($data);
        }
        $data = Project::where('slug', $slug)->first();
        if ($data && $data->lang != $lang) {
            $data = Project::where('trans_id', $data->trans_id)->where('lang', $lang)->first();
        }
        if (!$data) {
            $data = new Project;
        }
        return view('pages.project')->withData($data);
    }

    public function product($slug = '')
    {
        $lang = App::getLocale();
        if ($slug == '') {
            $data = Product::where('lang', $lang)->paginate(12);
            return view('pages.product_list')->withData($data);
        }
        $data = Product::where('slug', $slug)->first();
        if ($data && $data->lang != $lang) {
            $data = Product::where('trans_id', $data->trans_id)->where('lang', $lang)->first();
        }
        if (!$data) {
            $data = new Product;
        }
        return view('pages.product')->withData($data);
    }

    public function service($slug = '')
    {
        $lang = App::getLocale();
        if ($slug == '') {
            $data = Service::where('lang', $lang)->paginate(12);
            return view('pages.service_list')->withData($data);
        }
        $data = Service::where('slug', $slug)->first();
        if ($data && $data->lang != $lang) {
            $data = Service::where('trans_id', $data->trans_id)->where('lang', $lang)->first();
        }
        if (!$data) {
            $data = new Service;
        }
        return view('pages.service')->withData($data);
    }

    public function news($slug = '')
    {
        $lang = App::getLocale();
        if ($slug == '') {
            $data = News::where('lang', $lang)->paginate(12);
            return view('pages.news_list')->withData($data);
        }
        $data = News::where('slug', $slug)->first();
        if ($data && $data->lang != $lang) {
            $data = News::where('trans_id', $data->trans_id)->where('lang', $lang)->first();
        }
        if (!$data) {
            $data = new News;
        }
        return view('pages.news')->withData($data);
    }

    public function page($slug)
    {
        $lang = App::getLocale();
        $data = Basic::where('slug', $slug)->first();
        if ($data && $data->lang != $lang) {
            $data = Basic::where('trans_id', $data->trans_id)->where('lang', $lang)->first();
        }
        if (!$data) {
            $data = new Basic;
        }
        return view('pages.page')->withData($data);
    }

    public function contact(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, $validation = [
                'name' => 'required|string',
                'email' => 'required|string',
                'phone' => 'required|string',
                'message' => 'required|string',
            ]);

            $data = new Contact;
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->email = $request->email;
            $data->message = $request->message;
            $data->save();

            return redirect()->back()->withMessage('Ваше сообщение успешно отправлено');
        }
        return view('pages.contact');
    }

    public function callme(Request $request)
    {
        $this->validate($request, $validation = [
            'name' => 'required|string',
            'phone' => 'required|string',
        ]);

        $data = new Callme;
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->save();

        return redirect()->back()->withMessage('Ваша заявка успешно принята, ожидайте звонка');
    }

    public function subscribe(Request $request)
    {
        $this->validate($request, $validation = [
            'email' => 'required|string',
        ]);

        $data = new Subscribe;
        $data->email = $request->email;
        $data->save();

        return redirect()->back()->withMessage('Вы успешно подписались на новости');
    }

    public function seo(Request $request)
    {
        $validation = [
            'title' => 'required|string',
            'keywords' => 'required|string',
            'description' => 'required|string',
            'url' => 'required|string',
            'lang' => 'required|string',
        ];
        $this->validate($request, $validation);

        $data = new Seo;
        $data->title = $request->title;
        $data->keywords = $request->keywords;
        $data->description = $request->description;
        $data->url = $request->url;
        $data->lang = $request->lang;
        $data->save();

        return redirect()->back();
    }

    public function language($locale)
    {
        if (in_array($locale, \Config::get('app.locales'))) {
            Session::put('locale', $locale);
        } else {
            $lang = app()->getLocale();
            Session::put('locale', $lang);
        }
        return redirect()->back();
    }
}
