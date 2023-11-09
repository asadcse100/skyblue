@extends('backend.admin-master')

@section('site-title')
    {{__('All Blogs')}}
@endsection

@section('style')
<x-datatable.css/>
<x-media.css/>
@endsection

@section('content')
  <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
        <div class="col-lg-12 margin-top-20">
              <x-msg.success/>
              <x-msg.error/>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <!-- <h4 class="header-title">{{__('All Blog Items')}}   </h4> -->
                                @can('blog-delete')
                                    <x-bulk-action/>
                                @endcan
                            </div>
                            <div class="header-title d-flex">
                                <div class="btn-wrapper-inner">                                    
                                    @can('blog-create')
                                         <a href="{{route('admin.blog.new')}}" class="btn btn-info m-1"> {{__('Add New')}}</a>
                                         <a href="{{route('admin.blog.trashed')}}" class="btn btn-danger m-1"> {{__('Trashed Blogs')}}</a>
                                     @endcan
                                    <form action="{{route('admin.blog.laravel')}}" method="get" id="langauge_change_select_get_form">
                                        <x-lang.select :name="'lang'" :selected="$default_lang" :id="'langchange'"/>
                                    </form>
                                </div>
                            </div>
                        </div>

                                  <div class="table-wrap table-responsive">
                                    <table class="table table-default" id="all_blog_table">
                                        <thead>
                                          <th class="no-sort">
                                           <div class="mark-all-checkbox">
                                               <input type="checkbox" class="all-checkbox">
                                           </div>
                                        </th>
                                        <th>{{__('ID')}}</th>
                                        <th>{{__('Author')}}</th>
                                        <th>{{__('Views')}}</th>
                                        <th>{{__('Title')}}</th>
                                        <th>{{__('Image')}}</th>
                                        <th>{{__('Category')}}</th>
                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Date')}}</th>
                                        <th>{{__('Action')}}</th>
                                        </thead>
                                        
                                        @foreach($blog as $key=>$info)
                                        
                                        <tbody>
                                            <td></td>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$info->author}}</td>
                                            <td>{{$info->views}}</td>
                                            <td>{{$info->getTranslation('title',$default_lang,true)}}</td>
                                            <td>{!! App\Helpers\DataTableHelpers\General::image($info->image) !!}</td>
                                            <td>{!! App\Helpers\DataTableHelpers\General::category($info->category_id,$default_lang) !!}</td>
                                            <td>{!! App\Helpers\DataTableHelpers\General::statusSpan($info->status) !!}</td>
                                            <td>{{$info->created_at}}</td>
                                            <td>
                                                @if(!empty($info->slug))
                                                    {!! App\Helpers\DataTableHelpers\General::viewIcon(route('frontend.blog.single',$info->slug)) !!}
                                                @endif
                                                @php
                                                    $admin = auth()->guard('admin')->user();
                                                @endphp
                                                @if ($admin->can('blog-delete'))
                                                    {!! App\Helpers\DataTableHelpers\General::deletePopover(route('admin.blog.delete.all.lang',$info->id)) !!}
                                                @endif
                                                @if ($admin->can('blog-edit'))
                                                    {!! App\Helpers\DataTableHelpers\General::editIcon(route('admin.blog.edit',$info->id).'?lang='.$default_lang) !!}
                                                    {!! App\Helpers\DataTableHelpers\General::cloneIcon(route('admin.blog.clone'),$info->id) !!}
                                                @endif
                                                    {!! App\Helpers\DataTableHelpers\General::viewAnalytics(route('admin.blog.view.analytics',$info->id)) !!}
                                                @if(!empty($info->comment_status))
                                                    {!! App\Helpers\DataTableHelpers\General::viewComments(route('admin.blog.comments.view',$info->id),$info->id) !!}
                                                @endif
                                                @if ($info->created_by == 'user' && $info->status == 'pending')
                                                {!! App\Helpers\DataTableHelpers\General::blogApprove($info->id) !!}
                                                @endif
                                            </td>
                                        </tbody>
                                        @endforeach
                                    </table>

                                    {!! $blog->links() !!}
                             </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('backend.partials.datatable.script-enqueue',['only_js' => true])
<x-media.js/>
<script>
(function ($){
    "use strict";
    $(document).ready(function () {
        <x-bulk-action-js :url="route('admin.blog.bulk.action')" />
        $(document).on('change','#langchange',function(e){
            $('#langauge_change_select_get_form').trigger('submit');
        });

    });
})(jQuery)
</script>
@endsection
