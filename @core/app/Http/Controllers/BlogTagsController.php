<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Helpers\FlashMsg;
use App\Helpers\LanguageHelper;
use Illuminate\Routing\Controller;
use App\Models\Language;
use App\Models\Tag;
use Illuminate\Http\Request;
use Validator;

class BlogTagsController extends Controller
{
    public $languages = null;
    private const BASE_PATH = 'backend.';
    public function __construct()
    {
        if ($this->languages === null){
            $this->languages =  $all_languages = Language::all();
        }
        //Blog Tags
        $this->middleware('auth:admin');
        $this->middleware('permission:blog-tag-list|blog-tag-create|blog-tag-edit|blog-tag-delete',['only' => ['index']]);
        $this->middleware('permission:blog-tag-create',['only' => ['new_tags']]);
        $this->middleware('permission:blog-tag-edit',['only' => ['update_tags']]);
        $this->middleware('permission:blog-tag-delete',['only' => ['bulk_action','delete_tags_all_lang']]);
    }

    public function index(Request $request){
        $all_tags = Tag::select(['id','name','status'])->get();
        return view(self::BASE_PATH.'.blog.tags')->with([
            'all_tags' => $all_tags,
            'default_lang' => $request->lang ?? LanguageHelper::default_slug(),
        ]);
    }

    public function new_tags(Request $request){
        Validator::make($request->all(),[
            'name' => 'required|string|max:191|unique:tags',
            'status' => 'required|string|max:191',
        ]);

        $tags = new Tag();
        $tags
            ->setTranslation('name',$request->lang, purify_html($request->name));
        $tags->status = $request->status;
        $tags->save();
        return redirect()->back()->with(FlashMsg::item_new('Blog Tags Added'));
    }

    public function update_tags(Request $request){
        Validator::make($request->all(),[
            'name' => 'required|string|max:191|unique:tags',
            'status' => 'required|string|max:191',
        ]);

        $tags =  Tag::findOrFail($request->id);
        $tags
            ->setTranslation('name',$request->lang, purify_html($request->name));
        $tags->status = $request->status;
        $tags->save();

        return back()->with(FlashMsg::item_update());
    }


    public function delete_tags_all_lang(Request $request,$id){

        if (Blog::where('tag_id',$id)->first()){
            return redirect()->back()->with([
                'msg' => __('You can not delete this tag, It already associated with a post...'),
                'type' => 'danger'
            ]);
        }
        $tags =  Tag::where('id',$id)->first();
        $tags->delete();

        return back()->with(FlashMsg::item_delete());
    }


    public function bulk_action(Request $request){
        Tag::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
