@extends('backend.admin-master')

@section('style')
    <x-media.css/>
@endsection

@section('site-title')
    {{__('Add New User')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
            <div class="col-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <a href="{{route('admin.all.frontend.user')}}" class="btn btn-info pull-right"> {{__('All User')}}</a>
                        <h4 class="header-title">{{__('New User')}}</h4>
                        @include('backend/partials/message')
                        @include('backend/partials/error')
                        <form action="{{route('admin.frontend.new.user')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control"  id="name" name="name" placeholder="{{__('Enter name')}}">
                            </div>
                            <div class="form-group">
                                <label for="username">{{__('Username')}}</label>
                                <input type="text" class="form-control"  id="username" name="username" placeholder="{{__('Username')}}">
                                <small class="text text-danger">{{__('Remember this username, user will login using this username')}}</small>
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('Email')}}</label>
                                <input type="text" class="form-control"  id="email" name="email" placeholder="{{__('Email')}}">
                            </div>
                            <div class="form-group">
                                <label for="phone">{{__('Phone')}}</label>
                                <input type="text" class="form-control"  id="phone" name="phone" placeholder="{{__('Phone')}}">
                            </div>
                            <div class="form-group">
                                <label for="country">{{__('Country')}}</label>
                                {!! get_country_field('country','country','form-control') !!}
                            </div>
                            <div class="form-group">
                                <label for="state">{{__('State')}}</label>
                                <input type="text" class="form-control"  id="state" name="state" placeholder="{{__('State')}}">
                            </div>
                            <div class="form-group">
                                <label for="city">{{__('City')}}</label>
                                <input type="text" class="form-control"  id="city" name="city" placeholder="{{__('City')}}">
                            </div>
                            <div class="form-group">
                                <label for="zipcode">{{__('Zipcode')}}</label>
                                <input type="text" class="form-control"  id="zipcode" name="zipcode" placeholder="{{__('Zipcode')}}">
                            </div>
                            <div class="form-group">
                                <label for="address">{{__('Address')}}</label>
                                <input type="text" class="form-control"  id="address" name="address" placeholder="{{__('Address')}}">
                            </div>
                            
                            <div class="form-group">
                                <label for="email">{{__('Designation')}}</label>
                                <input type="text" class="form-control"  id="designation" name="designation" placeholder="{{__('Designation')}}">
                            </div>

                            <div class="form-group">
                                <label for="email">{{__('Description')}}</label>
                                <textarea class="form-control" cols="5" name="description" id="description"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="email">{{__('Facebook URL')}}</label>
                                <input type="text" class="form-control"  id="facebook_url" name="facebook_url" placeholder="{{__('Facebook URL')}}">
                            </div>

                            <div class="form-group">
                                <label for="email">{{__('Twitter URL')}}</label>
                                <input type="text" class="form-control"  id="twitter_url" name="twitter_url" placeholder="{{__('Twitter URL')}}">
                            </div>

                            <div class="form-group">
                                <label for="email">{{__('Instagram URL')}}</label>
                                <input type="text" class="form-control"  id="instagram_url" name="instagram_url" placeholder="{{__('Instagram URL')}}">
                            </div>

                            <div class="form-group">
                                <label for="email">{{__('Linkedin URL')}}</label>
                                <input type="text" class="form-control"  id="linkedin_url" name="linkedin_url" placeholder="{{__('Linkedin URL')}}">
                            </div>

                            <x-image :name="'image'" :title="'Image'"/>
                            
                            
                            <div class="form-group">
                                <label for="password">{{__('Password')}}</label>
                                <input type="password" class="form-control"  id="password" name="password" placeholder="{{__('Password')}}">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation">{{__('Password Confirm')}}</label>
                                <input type="password" class="form-control"  id="password_confirmation" name="password_confirmation" placeholder="{{__('Password Confirmation')}}">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New User')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection


@section('script')
    <x-media.js/>
@endsection
