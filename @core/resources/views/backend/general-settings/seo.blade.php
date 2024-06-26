@extends('backend.admin-master')
@section('style')
<x-media.css/>
<link rel="stylesheet" href="{{asset('assets/backend/css/bootstrap-tagsinput.css')}}">
@endsection
@section('site-title')
    {{__('SEO Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-2">
               <x-msg.success/>
               <x-msg.error/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("SEO Settings")}}</h4>
                        <form action="{{route('admin.general.seo.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @include('backend.partials.languages-nav')
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="site_meta_{{$lang->slug}}_tags">{{__('Site Meta Tags')}}</label>
                                            <input type="text" name="site_meta_{{$lang->slug}}_tags"  class="form-control" data-role="tagsinput" value="{{get_static_option('site_meta_'.$lang->slug.'_tags')}}" id="site_meta_{{$lang->slug}}_tags">
                                        </div>
                                        <div class="form-group">
                                            <label for="site_meta_{{$lang->slug}}_description">{{__('Site Meta Description')}}</label>
                                            <textarea name="site_meta_{{$lang->slug}}_description"  class="form-control" id="site_meta_{{$lang->slug}}_description">{{get_static_option('site_meta_'.$lang->slug.'_description')}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="og_meta_{{$lang->slug}}_title">{{__('Og Meta Title')}}</label>
                                            <input type="text" name="og_meta_{{$lang->slug}}_title"  class="form-control"  value="{{get_static_option('og_meta_'.$lang->slug.'_title')}}" id="og_meta_{{$lang->slug}}_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="og_meta_{{$lang->slug}}_description">{{__('Og Meta Description')}}</label>
                                            <textarea name="og_meta_{{$lang->slug}}_description"  class="form-control" id="og_meta_{{$lang->slug}}_description">{{get_static_option('og_meta_'.$lang->slug.'_description')}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="og_meta_{{$lang->slug}}_site_name">{{__('Og Meta Site Name')}}</label>
                                            <input type="text" name="og_meta_{{$lang->slug}}_site_name"  class="form-control"  value="{{get_static_option('og_meta_'.$lang->slug.'_site_name')}}" id="og_meta_{{$lang->slug}}_site_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="og_meta_{{$lang->slug}}_url">{{__('Og Meta URL')}}</label>
                                            <input type="text" name="og_meta_{{$lang->slug}}_url"  class="form-control"  value="{{get_static_option('og_meta_'.$lang->slug.'_url')}}" id="og_meta_{{$lang->slug}}_url">
                                        </div>
                                        <div class="form-group">
                                            <label for="og_meta_{{$lang->slug}}_image">{{__('Og Meta Image Image')}}</label>
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    @php
                                                        $og_meta_image = get_attachment_image_by_id(get_static_option('og_meta_'.$lang->slug.'_image'),null,true);
                                                        $og_meta_image_btn_label =__( 'Upload Image');
                                                    @endphp
                                                    @if (!empty($og_meta_image))
                                                        <div class="attachment-preview">
                                                            <div class="thumbnail">
                                                                <div class="centered">
                                                                    <img class="avatar user-thumb" src="{{$og_meta_image['img_url']}}" alt="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php  $site_breadcrumb_bg_btn_label = __('Change Image'); @endphp
                                                    @endif
                                                </div>
                                                <input type="hidden" id="og_meta_{{$lang->slug}}_image" name="og_meta_{{$lang->slug}}_image" value="{{get_static_option('og_meta_'.$lang->slug.'_image')}}">
                                                <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                                    {{__($site_breadcrumb_bg_btn_label)}}
                                                </button>
                                            </div>
                                            <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png, Recommended image size 1920x600')}}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button id="update" type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection
@section('script')
<script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
<x-media.js/>
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    <script>
        <x-btn.update/>
    </script>
@endsection
