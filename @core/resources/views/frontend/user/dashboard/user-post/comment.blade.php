@extends('frontend.user.dashboard.user-master')
@section('site-title')
    {{__('All Blog Comments')}}
@endsection

@section('page-title')
    <li class="list-item"><a href="#">{{__('User Dashboard')}}</a></li>
    <li class="list-item"><a href="#">{{__(' Blog Comments')}}</a></li>
@endsection

@section('style')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/custom-dashboard.css')}}">
<x-datatable.css/>
    <x-media.css/>

    <style>
        .table-wrap .alert-primary {
            padding: 6px 8px;
        }

    </style>
@endsection

@section('section')
  <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">

                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">  {{__('All Blog Comments')}}   </h4>

                            </div>
                                <div class="header-title d-flex">
                                    <div class="btn-wrapper-inner">
                                             <a href="{{route('user.blog')}}" class="btn btn-info mb-3"> {{__('Go Back')}}</a>
                                    </div>
                                </div>
                            </div>

                                  <div class="table-wrap table-responsive">
                                    <table class="table table-default" id="all_blog_table">
                                        <thead>
                                        <th>{{__('ID')}}</th>
                                        <th>{{__('Commented By')}}</th>
                                        <th>{{__('Comment')}}</th>
                                        <th>{{__('Status')}}</th>
                                        <th>{{__('Action')}}</th>
                                        </thead>
                                        <tbody>
                                        @foreach($all_comments->comments as $data)
                                            <tr>

                                                <td>{{$data->id}}</td>
                                                <td>{{$data->commented_by}}</td>
                                                <td>{{$data->comment_content}}</td>
                                                <td><x-status-span :status="$data->comment_approve_status"/></td>

                                                <td>
                                                    @if($data->comment_approve_status == 0)
                                                        <a href="{{route('user.blog.comment.approve',$data->id)}}" class="btn btn-success btn-sm mb-3">{{__('Approve')}}</a>
                                                    @endif
                                                    <x-delete-popover-all-lang :url="route('user.blog.comment.delete',$data->id)"/>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                             </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<x-datatable.js />
<script>
(function ($){
    "use strict";
    $(document).ready(function () {
        $(document).on('change','#langchange',function(e){
            $('#langauge_change_select_get_form').trigger('submit');
        });

        $(document).on('click','.swal_delete_all_lang_data_button',function(e){
            e.preventDefault();
            Swal.fire({
                title: '{{__("Are you sure?")}}',
                text: '{{__("It will delete All language data Permanently!")}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.swal_form_submit_btn').trigger('click');
                }
            });
        });
    });
})(jQuery)
</script>
@endpush
