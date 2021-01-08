<div class="leftbar">
    <a href="/admin"><img src="/images/panel.png" alt=""></a>
    <a id="seobut"><img src="/images/seo.png" alt=""></a>
</div>
<div class="seobg">
    <div class="seocenter">
        <form action="/seo" method="post">
            @csrf
            <button type="button" id="closeseo">x</button>
            <input type="hidden" name="url" value="{{Request::url()}}">
            <input type="hidden" name="lang" value="{{app()->getLocale()}}">
            <input type="text" name="title" placeholder="Title" value="{{$title}}">
            <input type="text" name="description" placeholder="Description" value="{{$description}}">
            <textarea name="keywords" rows="4" placeholder="Keywords">{!! $keywords !!}</textarea>
            <input class="saveseo" type="submit" value="Save">
        </form>
    </div>
</div>
