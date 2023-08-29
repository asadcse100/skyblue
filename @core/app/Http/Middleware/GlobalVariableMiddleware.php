<?php

namespace App\Http\Middleware;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Helpers\HomePageStaticSettings;
use App\Helpers\LanguageHelper;
use App\Models\Language;
use App\Models\Menu;
use App\Models\Page;
use App\Models\SocialIcon;
use App\Models\StaticOption;
use App\Models\Tag;
use App\Models\TopbarInfo;
use Closure;
use Illuminate\Support\Facades\Request;
use App\Facades\GlobalLanguage;


class GlobalVariableMiddleware
{

    public function handle($request, Closure $next)
    {
        $lang = GlobalLanguage::user_lang_slug();
        $all_language = Language::select('id','name','slug')->where('status', 'publish')->get();

        $primary_menu = Menu::select('id','title','content','status')->where(['status' => 'default'])->first();

        $all_topbar_infos = TopbarInfo::select('title','url')->get();
        $all_social_icons = SocialIcon::select('icon','url')->get();


        //For Leftbar
        $blogs_for_leftbar = Blog::where('status','publish')->orderBy('id','DESC')->take(get_static_option('leftbar_blog_item_show'))->get();
        $tags_for_leftbar = Tag::take(get_static_option('leftbar_tag_item_show'))->get();
        $social_icons_for_leftbar = SocialIcon::take(get_static_option('leftbar_social_item_show'))->get();

        view()->share([
            'all_language' => $all_language,
            'user_select_lang_slug' => $lang,

            'primary_menu' => $primary_menu->id,
            'all_topbar_infos' => $all_topbar_infos,
            'all_social_icons' => $all_social_icons,

            'social_icons_for_leftbar' => $social_icons_for_leftbar,
            'blogs_for_leftbar' => $blogs_for_leftbar,
            'tags_for_leftbar' => $tags_for_leftbar,
        ]);

        return $next($request);
    }
}
