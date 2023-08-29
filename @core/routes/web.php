<?php
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

Route::feeds();

//Blogs
Route::group(['prefix'=>'admin-home'],function() {

    Route::group(['prefix'=>'blog'],function() {
        Route::get('/', 'BlogController@index')->name('admin.blog');
        Route::get('/new', 'BlogController@new_blog')->name('admin.blog.new');
        Route::post('/new', 'BlogController@store_new_blog');
        Route::get('/get/tags','BlogController@get_tags_by_ajax')->name('admin.get.tags.by.ajax');
        Route::get('/edit/{id}', 'BlogController@edit_blog')->name('admin.blog.edit');
        Route::post('/update/{id}', 'BlogController@update_blog')->name('admin.blog.update');
        Route::post('/clone', 'BlogController@clone_blog')->name('admin.blog.clone');
        Route::post('/delete/all/lang/{id}', 'BlogController@delete_blog_all_lang')->name('admin.blog.delete.all.lang');
        Route::post('/bulk-action', 'BlogController@bulk_action_blog')->name('admin.blog.bulk.action');
        Route::get('/view/analytics/{id}', 'BlogController@view_analytics')->name('admin.blog.view.analytics');
        Route::post('/view/data/monthly', 'BlogController@view_data_monthly')->name('admin.blog.view.data.monthly');
        Route::get('/comment/approve/{id}', 'BlogController@comment_approve')->name('admin.blog.comment.approve');

        //Blog Comments Route
        Route::get('/comments/view/{id}', 'BlogController@view_comments')->name('admin.blog.comments.view');
        Route::post('/comments/delete/all/lang/{id}', 'BlogController@delete_all_comments')->name('admin.blog.comments.delete.all.lang');
        Route::post('/comments/bulk-action', 'BlogController@bulk_action_comments')->name('admin.blog.comments.bulk.action');
        
        //Blog Status Approve
        Route::get('/blog/approve/{id}', 'BlogController@approveBlog')->name('admin.blog.approve');

        //Trashed & Restore
        Route::get('/trashed', 'BlogController@trashed_blogs')->name('admin.blog.trashed');
        Route::get('/trashed/restore/{id}', 'BlogController@restore_trashed_blog')->name('admin.blog.trashed.restore');
        Route::post('/trashed/delete/{id}', 'BlogController@delete_trashed_blog')->name('admin.blog.trashed.delete');
        Route::post('/trashed/bulk-action', 'BlogController@trashed_bulk_action_blog')->name('admin.blog.trashed.bulk.action');

        //Single Page Settings
        Route::get('/single-settings', 'BlogController@blog_single_page_settings')->name('admin.blog.single.settings');
        Route::post('/single-settings', 'BlogController@update_blog_single_page_settings');

        //Others Page Settings
        Route::get('/others-settings', 'BlogController@blog_others_page_settings')->name('admin.blog.others.settings');
        Route::post('/others-settings', 'BlogController@update_blog_others_page_settings');
        Route::post('/blog-approve', 'BlogController@blog_approve')->name('admin.blog.approve');
        //Details Page Variant
        Route::get('/details-variant-settings', 'BlogController@details_variant')->name('admin.blog.details.variant.settings');
        Route::post('/details-variant-settings', 'BlogController@update_details_variant');
    });


    Route::group(['prefix' => 'rss'],function(){

        //ALL RSS FEED INFO
        Route::get('/feed-all-info','BlogController@rss_feed_all_info')->name('admin.blog.rss.feed.all.info');
        Route::post('/feed-all-info','BlogController@add_new_rss_feed');
        Route::post('/feed-all-info-update','BlogController@update_rss_feed')->name('admin.blog.rss.feed.all.info.update');
        Route::post('/feed-all-info-delete/{id}','BlogController@rss_feed_delete')->name('admin.blog.rss.feed.all.info.delete');
        Route::post('/feed-all-info-bulk-action','BlogController@rss_feed_bulk_action')->name('admin.blog.rss.feed.all.info.bulk.action');

        //RSS FEED IMPORT ROUTES SINGLE
        Route::group(['prefix'=>'import'],function(){
            Route::get('/rss-feed','BlogController@rss_feed_page')->name('admin.blog.import.rss.feed');
            Route::post('/rss-feed','BlogController@rss_feed_store');
        });
    });


    //BACKEND BLOG CATEGORY AREA
    Route::group(['prefix'=>'blog-category'],function(){
        Route::get('/','BlogCategoryController@index')->name('admin.blog.category');
        Route::post('/store','BlogCategoryController@new_category')->name('admin.blog.category.store');
        Route::post('/update','BlogCategoryController@update_category')->name('admin.blog.category.update');
        Route::post('/delete/all/lang/{id}','BlogCategoryController@delete_category_all_lang')->name('admin.blog.category.delete.all.lang');
        Route::post('/bulk-action', 'BlogCategoryController@bulk_action')->name('admin.blog.category.bulk.action');
    });

    //BACKEND BLOG TAGS
    Route::group(['prefix'=>'blog-tags'],function(){
        Route::get('/','BlogTagsController@index')->name('admin.blog.tags');
        Route::post('/store','BlogTagsController@new_tags')->name('admin.blog.tags.store');
        Route::post('/update','BlogTagsController@update_tags')->name('admin.blog.tags.update');
        Route::post('/delete/all/lang/{id}','BlogTagsController@delete_tags_all_lang')->name('admin.blog.tags.delete.all.lang');
        Route::post('/bulk-action', 'BlogTagsController@bulk_action')->name('admin.blog.tags.bulk.action');
    });

});


/*----------------------------------------------------------------------------------------------------------------------------
|                                                      FRONTEND ROUTES
|----------------------------------------------------------------------------------------------------------------------------*/

//Blogs
$blog_page_slug = get_page_slug(get_static_option('blog_page'),'blog');

Route::group(['prefix' => $blog_page_slug,'namespace' => 'Frontend', 'middleware' => ['setlang','globalVariable','maintains_mode','banned']],function (){
    Route::get('/search','BlogController@blog_search_page')->name('frontend.blog.search');
    Route::get('/get/search','BlogController@blog_get_search')->name('frontend.blog.get.search');
    Route::get('/{slug}','BlogController@blog_single')->name('frontend.blog.single');
    Route::get('/category/{id}/{title?}','BlogController@category_wise_blog_page')->name('frontend.blog.category');
    Route::get('/tags/{any}','BlogController@tags_wise_blog_page')->name('frontend.blog.tags.page');
    Route::get('blog/autocomplete-search','BlogController@autocompleteSearch')->name('frontend.blog.autocomplete.search');
    Route::get('blog/autocomplete-search','BlogController@autocompleteSearch')->name('frontend.blog.autocomplete.search');
    Route::get('blog/archive-search','BlogController@archive_search')->name('frontend.blog.archive.search');
    Route::get('/get/tags','BlogController@get_tags_by_ajax')->name('frontend.get.tags.by.ajax');
    Route::get('/get/blog/by/ajax','BlogController@get_blog_by_ajax')->name('frontend.get.blogs.by.ajax');

    Route::get('/gallery/category/{id}/{any?}','ImageGalleryController@category_wise_gallery_page')->name('frontend.gallery.category');
    Route::get('author/profile/{id}','BlogController@author_profile')->name('frontend.author.profile');
    Route::get('blog-by-{user}/{id}','BlogController@user_created_blogs')->name('frontend.user.created.blog');
    Route::get('user/blg-password','BlogController@user_blog_password')->name('frontend.user.blog.password');

    Route::post('/blog/comment/store','BlogController@blog_comment_store')->name('blog.comment.store');
    Route::post('blog/all/comment','BlogController@load_more_comments')->name('frontend.load.blog.comment.data');

});



/*----------------------------------------------------------------------------------------------------------------------------
| FRONTEND
|----------------------------------------------------------------------------------------------------------------------------*/
Route::group(['middleware' =>['setlang','globalVariable','maintains_mode','banned']],function (){
/*----------------------------------------------------------------------------------------------------------------------------
| FRONTEND ROUTES
|----------------------------------------------------------------------------------------------------------------------------*/
Route::get('/','FrontendController@index')->name('homepage');
Route::get('/dark-mode-toggle', 'FrontendController@dark_mode_toggle')->name('frontend.dark.mode.toggle');
Route::post('poll/vote/store','FrontendController@poll_vote_store')->name('frontend.poll.vote.store');
Route::get('home/advertisement/click/store','FrontendController@home_advertisement_click_store')->name('frontend.home.advertisement.click.store');
Route::get('home/advertisement/impression/store','FrontendController@home_advertisement_impression_store')->name('frontend.home.advertisement.impression.store');

//Newsletter
Route::get('/subscriber/email-verify/{token}','FrontendController@subscriber_verify')->name('subscriber.verify');
Route::post('/subscribe-newsletter','FrontendController@subscribe_newsletter')->name('frontend.subscribe.newsletter');

/*------------------------------
    SOCIAL LOGIN CALLBACK
------------------------------*/
    Route::group(['prefix' => 'facebook','namespace'=>'Frontend'],function (){
        Route::get('callback','SocialLoginController@facebook_callback')->name('facebook.callback');
        Route::get('redirect','SocialLoginController@facebook_redirect')->name('login.facebook.redirect');
    });
    Route::group(['prefix' => 'google','namespace'=>'Frontend'],function (){
        Route::get('callback','SocialLoginController@google_callback')->name('google.callback');
        Route::get('redirect','SocialLoginController@google_redirect')->name('login.google.redirect');
    });

/*----------------------------------------
  FRONTEND: CUSTOM FORM BUILDER ROUTES
-----------------------------------------*/
Route::post('submit-custom-form', 'FrontendFormController@custom_form_builder_message')->name('frontend.form.builder.custom.submit');
    /*----------------------------------------------------------------------------------------------------------------------------
    | USER DASHBOARD
    |----------------------------------------------------------------------------------------------------------------------------*/
    Route::prefix('user-home')->middleware(['userEmailVerify','setlang','globalVariable','banned'])->group(function (){

    Route::get('/', 'UserDashboardController@user_index')->name('user.home')->middleware('user_post');
    Route::get('/download/file/{id}', 'UserDashboardController@download_file')->name('user.dashboard.download.file');
    Route::get('/change-password', 'UserDashboardController@change_password')->name('user.home.change.password');
    Route::get('/edit-profile', 'UserDashboardController@edit_profile')->name('user.home.edit.profile');
    Route::post('/profile-update', 'UserDashboardController@user_profile_update')->name('user.profile.update');
    Route::post('/password-change', 'UserDashboardController@user_password_change')->name('user.password.change');

    // media upload routes for User
    Route::group(['namespace'=>'User'],function(){
        Route::post('/media-upload/all','MediaUploadController@all_upload_media_file')->name('web.upload.media.file.all');
        Route::post('/media-upload','MediaUploadController@upload_media_file')->name('web.upload.media.file');
        Route::post('/media-upload/alt','MediaUploadController@alt_change_upload_media_file')->name('web.upload.media.file.alt.change');
        Route::post('/media-upload/delete','MediaUploadController@delete_upload_media_file')->name('web.upload.media.file.delete');
        Route::post('/media-upload/loadmore', 'MediaUploadController@get_image_for_loadmore')->name('web.upload.media.file.loadmore');
    });


    //User Blog Post
    Route::group(['namespace'=>'User','prefix'=>'user-posts', 'middleware'=>'user_post'],function(){
        
//        Route::group(['middleware' => 'demo' ],function(){
            Route::get('/', 'UserPostController@user_index')->name('user.blog');
            Route::get('/new', 'UserPostController@user_new_blog')->name('user.blog.new');
            Route::get('/edit/{id}', 'UserPostController@user_edit_blog')->name('user.blog.edit');
            Route::post('/update/{id}', 'UserPostController@user_update_blog')->name('user.blog.update');
//        });
       
        
        Route::post('/new', 'UserPostController@user_store_new_blog');
        
        Route::post('/clone', 'UserPostController@user_clone_blog')->name('user.blog.clone');
        Route::post('/delete/all/lang/{id}', 'UserPostController@user_delete_blog_all_lang')->name('user.blog.delete.all.lang');
        //Trashed & Restore
        Route::get('/trashed', 'UserPostController@trashed_blogs')->name('user.blog.trashed');
        Route::get('/trashed/restore/{id}', 'UserPostController@user_restore_trashed_blog')->name('user.blog.trashed.restore');
        Route::post('/trashed/delete/{id}', 'UserPostController@user_delete_trashed_blog')->name('user.blog.trashed.delete');

        Route::group(['prefix' => 'comments' ],function(){
            Route::get('/{id}', 'UserPostController@all_comments')->name('user.blog.comments');
            Route::post('/delete/{id}', 'UserPostController@user_blog_comment_delete')->name('user.blog.comment.delete');
            Route::get('/approve/{id}', 'UserPostController@user_blog_comment_approve')->name('user.blog.comment.approve');
        });

    });

});

    /*----------------------------------------------------------------------------------------------------------------------------
    | USER LOGIN - REGISTRATION
    |----------------------------------------------------------------------------------------------------------------------------*/
    Route::get('/login','Auth\LoginController@showLoginForm')->name('user.login');
    Route::post('/ajax-login','FrontendController@ajax_login')->name('user.ajax.login');
    Route::post('/login','Auth\LoginController@login');
    Route::get('/login/forget-password','FrontendController@showUserForgetPasswordForm')->name('user.forget.password');
    Route::get('/login/reset-password/{user}/{token}','FrontendController@showUserResetPasswordForm')->name('user.reset.password');
    Route::post('/login/reset-password','FrontendController@UserResetPassword')->name('user.reset.password.change');
    Route::post('/login/forget-password','FrontendController@sendUserForgetPasswordMail');
    Route::post('/logout','Auth\LoginController@logout')->name('user.logout');
    Route::get('/user-logout','FrontendController@user_logout')->name('frontend.user.logout');
    //user register
    Route::post('/register','Auth\RegisterController@register');
    Route::get('/register','Auth\RegisterController@showRegistrationForm')->name('user.register');
    //user email verify
    Route::get('/user/email-verify','UserDashboardController@user_email_verify_index')->name('user.email.verify');
    Route::get('/user/resend-verify-code','UserDashboardController@reset_user_email_verify_code')->name('user.resend.verify.mail');
    Route::post('/user/email-verify','UserDashboardController@user_email_verify');
    Route::post('/package-user/generate-invoice','FrontendController@generate_package_invoice')->name('frontend.package.invoice.generate');

});


/*----------------------------------------------------------------------------------------------------------------------------
| LANGUAGE CHANGE
|----------------------------------------------------------------------------------------------------------------------------*/
Route::get('/lang','FrontendController@lang_change')->name('frontend.langchange');
Route::get('/subscriber/email-verify/{token}','FrontendController@subscriber_verify')->name('subscriber.verify');

/*----------------------------------------------------------------------------------------------------------------------------
| ADMIN LOGIN
|----------------------------------------------------------------------------------------------------------------------------*/
Route::middleware(['setlang'])->group(function (){
    Route::get('/login/admin','Auth\LoginController@showAdminLoginForm')->name('admin.login');
    Route::get('/login/admin/forget-password','FrontendController@showAdminForgetPasswordForm')->name('admin.forget.password');
    Route::get('/login/admin/reset-password/{user}/{token}','FrontendController@showAdminResetPasswordForm')->name('admin.reset.password');
    Route::post('/login/admin/reset-password','FrontendController@AdminResetPassword')->name('admin.reset.password.change');
    Route::post('/login/admin/forget-password','FrontendController@sendAdminForgetPasswordMail');
    Route::get('/logout/admin','AdminDashboardController@adminLogout')->name('admin.logout');
    Route::post('/login/admin','Auth\LoginController@adminLogin');
});

Route::group(['middleware' =>['setlang','globalVariable','maintains_mode','banned']],function () {
    Route::get('/{slug}', 'FrontendController@dynamic_single_page')->name('frontend.dynamic.page');
});

