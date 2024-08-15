<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuickSupport;
use App\Http\Controllers\SEOController;
use App\Http\Controllers\SocialIconController;
use App\Http\Controllers\TestimonialController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\URL;

Route::get('/clear-cache', function() {
    // Clear the cache
    $exitCode = Artisan::call('optimize:clear');

    // Get the main domain name with '/'
    $mainDomain = URL::to('/') . '/';

    // Redirect to the main domain with a Toastr notification
    return redirect($mainDomain)->with('clear-cache', 'Application cache cleared.');
})->middleware('auth');


Route::get('/',[FrontendController::class, 'index'])->name('index');
Route::get('/blog-details/page/{slug}',[FrontendController::class, 'single_blog'])->name('single.blog');
Route::get('/blog-page',[FrontendController::class, 'blog_page'])->name('blog.page');

Route::get('/service-details/page/{slug}',[FrontendController::class, 'single_service'])->name('single.service');
Route::get('/service-page',[FrontendController::class, 'service_page'])->name('service.page');
Route::get('/project-list/page/',[FrontendController::class, 'all_project'])->name('project.page');
Route::get('/project-info/page/{slug}',[FrontendController::class, 'project_info'])->name('project.info');
Route::get('/contact-page', [FrontendController::class, 'contact_page'])->name('contact.page');
Route::get('/about-page',[ FrontendController::class, 'about_page'])->name('about.page');

// Route::get('/blog_info', function () {
//     return view('front-end.blog_details');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ========= users =========//
Route::get('/user/info',[UserController::class, 'userInfo'])->name('userInfo');
Route::get('/user/profile-info',[UserController::class, 'edit_profile'])->name('edit.profile');
Route::post('/user/update-profile',[UserController::class, 'update_profile'])->name('update.profile');
Route::post('/user/update-password',[UserController::class, 'update_password'])->name('update.password');
Route::post('/update-user/profile-img',[UserController::class, 'update_image'])->name('update.image');
Route::post('/delete/user',[UserController::class, 'user_delete'])->name('user.delete');

// ========= Navbar & Banner ===========//
Route::get('/navbar-menu', [NavbarController::class, 'navbar_menu'])->name('navbar.menu');
Route::post('/navbar-menu/store', [NavbarController::class, 'add_menu'])->name('add.menu');
Route::post('/delete/menu', [NavbarController::class, 'delete_menu'])->name('delete.menu');
Route::post('/update/menu', [NavbarController::class, 'update_menu'])->name('update.menu');

Route::get('/menu-logo', [NavbarController::class, 'menu_logo'])->name('menu.logo');
Route::post('/add-logo', [NavbarController::class, 'add_logo'])->name('add.logo');
Route::post('/logo/delete', [NavbarController::class, 'logo_delete'])->name('logo.delete');

// ======= Banner ========//
Route::get('/banner',[NavbarController::class, 'banner'])->name('banner');
// Route::get('/banner/edit/{id}',[NavbarController::class, 'edit_banner'])->name('edit.banner');
Route::post('/banner/update',[NavbarController::class, 'update_banner'])->name('update.banner');

// ======= About =======//
Route::get('/edit/about',[AboutController::class, 'edit_about'])->name('edit.about');
Route::post('/update/about-content',[AboutController::class, 'about_content'])->name('update.about.content');
Route::post('/update/about-image',[AboutController::class, 'about_image'])->name('update.about.image');
Route::get('/brand',[AboutController::class, 'brand'])->name('brand');
Route::post('/add/partner',[AboutController::class, 'add_brand'])->name('add.brand');
Route::post('/add/brand',[AboutController::class, 'delete_brand'])->name('delete.brand');
Route::get('/edit/business-solution',[AboutController::class, 'solution'])->name('solution');
Route::post('/update/business-solution/content',[AboutController::class, 'update_solution'])->name('update.solution');

// ========== Support ===========//
Route::get('/instance/support', [QuickSupport::class, 'support'])->name('support');
Route::get('/support/edit/{id}', [QuickSupport::class, 'support_edit'])->name('support.edit');
Route::post('/instance/support/update', [QuickSupport::class, 'update_support'])->name('support.update');

// ========= Category ===========//
Route::get('/category-page', [CatalogueController::class, 'category'])->name('category');
Route::post('/add/category', [CatalogueController::class, 'add_category'])->name('add.category');
Route::post('/category/delete', [CatalogueController::class, 'delete_category'])->name('delete.category');
Route::get('/category/{slug}/{id}/edit', [CatalogueController::class, 'edit_category'])->name('category.edit');
Route::post('/category/update/', [CatalogueController::class, 'update_category'])->name('update.category');
Route::post('/category/status/update/', [CatalogueController::class, 'update_status'])->name('update.status');


// ========= project ===========//
Route::get('/project',[ProjectController::class, 'project'])->name('project');
Route::post('/add/project',[ProjectController::class, 'add_project'])->name('add.project');
Route::post('/delete/project',[ProjectController::class, 'delete_project'])->name('delete.project');


// ========= Blog ===========//
Route::get('/blog',[BlogController::class, 'blog'])->name('blog');
Route::post('/add/blog',[BlogController::class, 'add_blog'])->name('add.blog');
Route::get('/blog/{slug}/{id}/edit',[BlogController::class, 'blog_edit'])->name('blog.edit');
Route::post('/update/blog-information',[BlogController::class, 'update_blog'])->name('update.blog');
Route::post('/delete/blog-info',[BlogController::class, 'delete_blog'])->name('delete.blog');

// ======= Notification ========//
Route::get('/request/message', [ContactController::class, 'request_message'])->name('request.message');
Route::post('/send/user/message/dominy-tech', [ContactController::class, 'request_form'])->name('request.form');
Route::post('/notifications/clear',[ContactController::class, 'clearAll'])->name('notifications.clear');
Route::get('/notifications/view', [ContactController::class, 'notifications_view'])->name('notifications.view');
Route::post('delete/notifications/message', [ContactController::class, 'delete_notifications'])->name('delete.notification.message');
Route::post('/sending/user-mail', [ContactController::class, 'send_mail'])->name('send.mail');

Route::post('/send/user-message', [ContactController::class, 'send_message'])->name('send.message');
Route::post('/clear/user-message', [ContactController::class, 'message_clear'])->name('message.clear');
Route::get('/view/user-message', [ContactController::class, 'view_message'])->name('view.message');
Route::post('/reply/user-message', [ContactController::class, 'reply_message'])->name('reply.message');
Route::get('/view/all-contact/message', [ContactController::class, 'contact_message'])->name('contact.message');
Route::post('/delete/contact/message',[ContactController::class, 'delelte_message'])->name('delete.contact.message');

// ======= Social Icon ========//
Route::get('/social/icon',[SocialIconController::class, 'social'])->name('social');
Route::post('/add-icon', [SocialIconController::class, 'add_icon'])->name('add.icon');
Route::get('/update-icon/status/{id}', [SocialIconController::class, 'update_status'])->name('update.status');
Route::post('/delete-icon', [SocialIconController::class, 'delete_icon'])->name('delete.icon');

// ====== Testimonial=======//
Route::get('/testimonial/page', [TestimonialController::class, 'testimonial'])->name('testimonial');
Route::post('add/testimonial', [TestimonialController::class, 'add_review'])->name('add.review');
Route::post('delete/testimonial', [TestimonialController::class, 'delete_review'])->name('delete.review');


// ====== Footer =======//
Route::get('/footer-information',[FooterController::class, 'footer'])->name('footer');
Route::post('/update-footer', [FooterController::class, 'update_footer'])->name('update.footer');

// ======== Contact =====//
Route::get('/contact',[ContactController::class, 'contact'])->name('contact');
Route::post('/update/contact/text',[ContactController::class, 'update_content'])->name('update.content');

// ========== SEO ==========//
Route::get('/seo', [SEOController::class, 'seo'])->name('seo');
Route::post('store/seo', [SEOController::class, 'add_seo'])->name('add.seo');
