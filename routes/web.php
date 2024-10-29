<?php

use App\Models\Page;
use Illuminate\Support\Facades\Route;
// URL::forcescheme('https');
use App\Http\Controllers\TestimonialController;
Route::get('/', [App\Http\Controllers\LoginController::class, 'login']);
Route::post('/ajax', [App\Http\Controllers\Admin\AjaxController::class, 'ajax'])->name('ajax')->middleware('isAdmin');

Route::get('/lang/{lang}', [App\Http\Controllers\LangController::class, 'lang'])->name('lang');

Route::post('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::get('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'loginCheck'])->name('login.check');
// Route::get('/register', [App\Http\Controllers\LoginController::class, 'registerUser'])->name('register.user');
// Route::post('/register', [App\Http\Controllers\LoginController::class, 'register'])->name('register');   

Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function () {

    Route::get('/category/gallery/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('gallery.category');
    Route::get('/category/gallery/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('gallery.category.create');
    Route::get('/category/newsevents/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('newsevents.category');
    Route::get('/category/newletter/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('newsevents.category.create');
    Route::get('/category/newletter/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('newletter.category');
    Route::get('/category/newsevents/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('newletter.category.create');
    Route::get('/category/parish/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('parish.category');
    Route::get('/category/parish/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('parish.category.create');
    Route::get('/category/priest/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('priest.category');
    Route::get('/category/priest/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('priest.category.create');
    Route::get('/category/features/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('features.category');
    Route::get('/category/features/create', [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('features.category.create');


    Route::get('/home', [App\Http\Controllers\LoginController::class, 'admin'])->name('home');
    Route::post('/media/storeMedia', [App\Http\Controllers\Admin\FileController::class, 'storeMedia'])->name('media.storeMedia');
    Route::post('/gallery/storeMedia', [App\Http\Controllers\Admin\GalleryController::class, 'storeMedia'])->name('gallery.storeMedia');
    Route::resource('/media', 'App\Http\Controllers\Admin\FileController');
    Route::resource('/gallery', 'App\Http\Controllers\Admin\GalleryController');
    Route::resource('/category', 'App\Http\Controllers\Admin\CategoryController');
    Route::resource('/slide', 'App\Http\Controllers\Admin\SlideController');
    Route::post('admin/slide/updateOrder', 'App\Http\Controllers\Admin\SlideController@updateOrder')->name('slide.updateOrder');

    Route::post('/gallery/filter', [App\Http\Controllers\Admin\GalleryController::class, 'galleryfilter'])->name('dropdown.change');
    Route::get('/article/switch', [App\Http\Controllers\Admin\ArticleController::class, 'switch'])->name('article.switch');
    Route::get('/article/trash', [App\Http\Controllers\Admin\ArticleController::class, 'trash'])->name('article.trash');
    Route::get('/article/delete/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'delete'])->name('article.delete');
    Route::get('/article/recover/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'recover'])->name('article.recover');
    Route::resource('/article', 'App\Http\Controllers\Admin\ArticleController');


    Route::get('/newsletter/switch', [App\Http\Controllers\Admin\NewsletterController::class, 'switch'])->name('newsletter.switch');
    Route::get('/newsletter/trash', [App\Http\Controllers\Admin\NewsletterController::class, 'trash'])->name('newsletter.trash');
    Route::get('/newsletter/delete/{id}', [App\Http\Controllers\Admin\NewsletterController::class, 'delete'])->name('newsletter.delete');
    Route::get('/newsletter/recover/{id}', [App\Http\Controllers\Admin\NewsletterController::class, 'recover'])->name('newsletter.recover');

    Route::get('/social/Addmedia', [App\Http\Controllers\Admin\SocialmediaController::class, 'index'])->name('social.index');
    Route::get('/social/Editmedia', [App\Http\Controllers\Admin\SocialmediaController::class, 'edit'])->name('social.edit');


    Route::post('/socialmediastore', [App\Http\Controllers\Admin\SocialmediaController::class, 'socialStore'])->name('socialStore');

    Route::post('/socialupdate', [App\Http\Controllers\Admin\SocialmediaController::class, 'socialupdate'])->name('socialupdate');


    Route::resource('/newletter', 'App\Http\Controllers\Admin\NewsletterController');

    Route::resource('/resource', 'App\Http\Controllers\Admin\ResourceController');

    Route::get('/resource/switch', [App\Http\Controllers\Admin\ResourceController::class, 'show'])->name('resource.switch');

    Route::get('/resource/get/trash', [App\Http\Controllers\Admin\ResourceController::class, 'gettrash'])->name('resource.trash');

    Route::get('/resource/delete/{id}', [App\Http\Controllers\Admin\ResourceController::class, 'delete'])->name('resource.delete');
    Route::get('/resource/recover/{id}', [App\Http\Controllers\Admin\ResourceController::class, 'recover'])->name('resource.recover');

    Route::get('/ourteam/switch', [App\Http\Controllers\Admin\OurteamController::class, 'switch'])->name('ourteam.switch');
    Route::get('/ourteam/trash', [App\Http\Controllers\Admin\OurteamController::class, 'trash'])->name('ourteam.trash');
    Route::get('/ourteam/delete/{id}', [App\Http\Controllers\Admin\OurteamController::class, 'delete'])->name('ourteam.delete');
    Route::get('/ourteam/recover/{id}', [App\Http\Controllers\Admin\OurteamController::class, 'recover'])->name('ourteam.recover');
    Route::resource('/ourteam', 'App\Http\Controllers\Admin\OurteamController');

    Route::get('/parish/switch', [App\Http\Controllers\Admin\ParishController::class, 'switch'])->name('parish.switch');
    Route::get('/parish/trash', [App\Http\Controllers\Admin\ParishController::class, 'trash'])->name('parish.trash');
    Route::get('/parish/delete/{id}', [App\Http\Controllers\Admin\ParishController::class, 'delete'])->name('parish.delete');
    Route::get('/parish/recover/{id}', [App\Http\Controllers\Admin\ParishController::class, 'recover'])->name('parish.recover');
    Route::resource('/parish', 'App\Http\Controllers\Admin\ParishController');
    Route::get('/parish/getpriest', [App\Http\Controllers\Admin\ParishController::class, 'show'])->name('parish.priestget');

    Route::get('/priest/switch', [App\Http\Controllers\Admin\PriestController::class, 'switched'])->name('update.switch');
    Route::get('/priest/trash', [App\Http\Controllers\Admin\PriestController::class, 'trash'])->name('priest.trash');
    Route::get('/priest/delete/{id}', [App\Http\Controllers\Admin\PriestController::class, 'delete'])->name('priest.delete');
    Route::get('/priest/recover/{id}', [App\Http\Controllers\Admin\PriestController::class, 'recover'])->name('priest.recover');
    Route::resource('/priest', 'App\Http\Controllers\Admin\PriestController');

    Route::get('/religio/switch', [App\Http\Controllers\Admin\ReligioController::class, 'switched'])->name('religio.switch');
    Route::get('/religio/trash', [App\Http\Controllers\Admin\ReligioController::class, 'trash'])->name('religio.trash');
    Route::get('/religio/delete/{id}', [App\Http\Controllers\Admin\ReligioController::class, 'delete'])->name('religio.delete');
    Route::get('/religio/recover/{id}', [App\Http\Controllers\Admin\ReligioController::class, 'recover'])->name('religio.recover');
    Route::resource('/religio', 'App\Http\Controllers\Admin\ReligioController');



    Route::get('/page/switch', [App\Http\Controllers\Admin\PageController::class, 'switch'])->name('page.switch');
    Route::get('/page/trash', [App\Http\Controllers\Admin\PageController::class, 'trash'])->name('page.trash');
    Route::get('/page/delete/{id}', [App\Http\Controllers\Admin\PageController::class, 'delete'])->name('page.delete');
    Route::get('/page/recover/{id}', [App\Http\Controllers\Admin\PageController::class, 'recover'])->name('page.recover');
    Route::resource('/page', 'App\Http\Controllers\Admin\PageController');

    Route::get('/comment/switch', [App\Http\Controllers\Admin\CommentController::class, 'switch'])->name('comment.switch');
    Route::get('/comment/trash', [App\Http\Controllers\Admin\CommentController::class, 'trash'])->name('comment.trash');
    Route::get('/comment/delete/{id}', [App\Http\Controllers\Admin\CommentController::class, 'delete'])->name('comment.delete');
    Route::get('/comment/recover/{id}', [App\Http\Controllers\Admin\CommentController::class, 'recover'])->name('comment.recover');
    Route::resource('/comment', 'App\Http\Controllers\Admin\CommentController');
    Route::resource('/contact', 'App\Http\Controllers\ContactController');
    Route::get('/contact/delete/{id}', [App\Http\Controllers\ContactController::class, 'delete'])->name('contact.delete');
    Route::get('/contact/trash', [App\Http\Controllers\ContactController::class, 'trashed'])->name('contact.trash');
    Route::get('/contact/sendmail/{id}', [App\Http\Controllers\ContactController::class, 'sendmail'])->name('contact.sendmail');
    Route::get('/contact/recover/{id}', [App\Http\Controllers\ContactController::class, 'recover'])->name('contact.recover');


    Route::get('/user/trash', [App\Http\Controllers\Admin\UserController::class, 'trash'])->name('user.trash');
    Route::get('/user/delete/{id}', [App\Http\Controllers\Admin\UserController::class, 'delete'])->name('user.delete');
    Route::get('/user/recover/{id}', [App\Http\Controllers\Admin\UserController::class, 'recover'])->name('user.recover');
    Route::resource('/user', 'App\Http\Controllers\Admin\UserController');

    Route::get('/vicariate/switch', [App\Http\Controllers\Admin\VicariateController::class, 'switched'])->name('vicariate.switch');
    Route::get('/vicariate/trash', [App\Http\Controllers\Admin\VicariateController::class, 'trash'])->name('vicariate.trash');
    Route::get('/vicariate/delete/{id}', [App\Http\Controllers\Admin\VicariateController::class, 'delete'])->name('vicariate.delete');
    Route::get('/vicariate/recover/{id}', [App\Http\Controllers\Admin\VicariateController::class, 'recover'])->name('vicariate.recover');
    Route::resource('/vicariate', 'App\Http\Controllers\Admin\VicariateController');

    Route::prefix('/tutor')->name('tutor.')->group(function () {
        Route::resource('/category', 'App\Http\Controllers\Admin\TutorCategoryController');
        Route::resource('/course', 'App\Http\Controllers\Admin\TutorCourseController');
        Route::resource('/student', 'App\Http\Controllers\Admin\TutorStudentController');
        Route::resource('/announcement', 'App\Http\Controllers\Admin\TutorAnnouncementController');
        Route::get('/course/{course}/delete}', [App\Http\Controllers\Admin\TutorCourseController::class, 'destroy'])->name('course.delete');
        Route::get('/course/{course}/topic/{topic}', [App\Http\Controllers\Admin\TutorLessonController::class, 'create'])->name('lesson.create');
        Route::get('/lesson/{lesson}', [App\Http\Controllers\Admin\TutorLessonController::class, 'edit'])->name('lesson.edit');
        Route::post('/lesson/{lesson}', [App\Http\Controllers\Admin\TutorLessonController::class, 'update'])->name('lesson.update');
        Route::get('/lesson/{lesson}/delete', [App\Http\Controllers\Admin\TutorLessonController::class, 'delete'])->name('lesson.delete');
        Route::post('/course/{course}/topic/{topic}', [App\Http\Controllers\Admin\TutorLessonController::class, 'store'])->name('lesson.store');
        Route::get('/course/{course}/topic/{topic}/zoom', [App\Http\Controllers\Admin\TutorZoomController::class, 'create'])->name('zoom.create');
        Route::get('/zoom', [App\Http\Controllers\Admin\TutorZoomController::class, 'index'])->name('zoom.index');
        Route::get('/zoom/{lesson}', [App\Http\Controllers\Admin\TutorZoomController::class, 'edit'])->name('zoom.edit');
        Route::post('/zoom/{lesson}', [App\Http\Controllers\Admin\TutorZoomController::class, 'update'])->name('zoom.update');
        Route::get('/zoom/{lesson}/delete', [App\Http\Controllers\Admin\TutorZoomController::class, 'delete'])->name('zoom.delete');
        Route::post('/course/{course}/topic/{topic}/zoom', [App\Http\Controllers\Admin\TutorZoomController::class, 'store'])->name('zoom.store');
    });

    Route::prefix('/option')->name('option.')->group(function () {
        Route::get('/index', [App\Http\Controllers\Admin\OptionController::class, 'index'])->name('index');
        Route::post('/update', [App\Http\Controllers\Admin\OptionController::class, 'update'])->name('update');

        Route::get('/contact', [App\Http\Controllers\Admin\OptionController::class, 'contact'])->name('contact');
        Route::post('/contactUpdate', [App\Http\Controllers\Admin\OptionController::class, 'contactUpdate'])->name('contactUpdate');

        Route::get('/social', [App\Http\Controllers\Admin\OptionController::class, 'social'])->name('social');
        Route::post('/socialUpdate', [App\Http\Controllers\Admin\OptionController::class, 'socialUpdate'])->name('socialUpdate');

        Route::get('/menu/position', [App\Http\Controllers\Admin\MenuController::class, 'position'])->name('menu.position');
        Route::get('/menu/delete/{menu}', [App\Http\Controllers\Admin\MenuController::class, 'delete'])->name('menu.delete');
        Route::post('/menu/menu-name', [App\Http\Controllers\Admin\MenuController::class, 'menuName'])->name('menu.menuName');
        Route::resource('/menu', 'App\Http\Controllers\Admin\MenuController');

        Route::get('/widget', [App\Http\Controllers\Admin\OptionController::class, 'widget'])->name('widget');
        Route::post('/widgetUpdate', [App\Http\Controllers\Admin\OptionController::class, 'widgetUpdate'])->name('widgetUpdate');

        Route::resource('/redirect', 'App\Http\Controllers\Admin\RedirectController');
        Route::resource('/link', 'App\Http\Controllers\Admin\LinkController');
    });


    Route::resource('/activitie', 'App\Http\Controllers\Admin\ActivitieController');
    Route::get('/activitie/delete/{id}', [App\Http\Controllers\Admin\ActivitieController::class, 'delete'])->name('activitie.delete');
    Route::get('/activitie/trash', [App\Http\Controllers\Admin\ActivitieController::class, 'trashed'])->name('activitie.trashed');
    Route::get('/activitie/recover/{id}', [App\Http\Controllers\Admin\ActivitieController::class, 'recover'])->name('activitie.recover');
    Route::get('/switch/activity', [App\Http\Controllers\Admin\ActivitieController::class, 'switchdata'])->name('activitie.statusdata');

    Route::resource('/role', 'App\Http\Controllers\Admin\RoleController');
    Route::get('/editrole', [App\Http\Controllers\Admin\RoleController::class, 'editrole'])->name('role.editrole');
    Route::get('/role/status', [App\Http\Controllers\Admin\RoleController::class, 'switchdata'])->name('role.statusdata');
    Route::get('/role/delete/{id}', [App\Http\Controllers\Admin\RoleController::class, 'delete'])->name('role.delete');

    Route::resource('/mainmenu', 'App\Http\Controllers\Admin\MainMenuController');
    Route::get('/mainmenu/delete/{id}', [App\Http\Controllers\Admin\MainMenuController::class, 'delete'])->name('mainmenu.delete');
    Route::get('/mainmenu/trash', [App\Http\Controllers\Admin\MainMenuController::class, 'show'])->name('mainmenu.trashed');
    Route::get('/editmainmenu', [App\Http\Controllers\Admin\MainMenuController::class, 'editmainmenu'])->name('mainmenu.editmain');

    Route::get('/status', [App\Http\Controllers\Admin\MainMenuController::class, 'switch'])->name('mainmenu.statusupdate');
    Route::get('/mainmenu/recover/{id}', [App\Http\Controllers\Admin\MainMenuController::class, 'recover'])->name('mainmenu.recover');
    Route::post('/mainmenu/updateorder', [App\Http\Controllers\Admin\MainMenuController::class, 'updateorder'])->name('mainmenu.updateorder');

    Route::resource('/submenu', 'App\Http\Controllers\Admin\SubmenuController');
    Route::get('/submenu/delete/{id}', [App\Http\Controllers\Admin\SubmenuController::class, 'delete'])->name('submenu.delete');
    Route::get('/submenu/trash', [App\Http\Controllers\Admin\SubmenuController::class, 'show'])->name('submenu.trashed');
    Route::get('/editsubmenu', [App\Http\Controllers\Admin\SubmenuController::class, 'editsubmenu'])->name('submenu.editmain');
    Route::get('/status/switch', [App\Http\Controllers\Admin\SubmenuController::class, 'switch'])->name('submenu.switch');
    Route::get('/submenu/recover/{id}', [App\Http\Controllers\Admin\SubmenuController::class, 'recover'])->name('submenu.recover');
    Route::post('/submenu/updateorder', [App\Http\Controllers\Admin\SubmenuController::class, 'updateorder'])->name('submenu.updateorder');

    Route::resource('/childsubmenu', 'App\Http\Controllers\Admin\ChildSubmenuController');
    Route::get('/childsubmenu/delete/{id}', [App\Http\Controllers\Admin\ChildSubmenuController::class, 'delete'])->name('childsubmenu.delete');
    Route::get('/childsubmenu/trash', [App\Http\Controllers\Admin\ChildSubmenuController::class, 'show'])->name('childsubmenu.trashed');
    Route::get('/editchildsubmenu', [App\Http\Controllers\Admin\ChildSubmenuController::class, 'editsubmenu'])->name('childsubmenu.editmain');
    Route::get('/childsubmenu/switch', [App\Http\Controllers\Admin\ChildSubmenuController::class, 'switch'])->name('childsubmenu.switch');
    Route::get('/childsubmenu/recover/{id}', [App\Http\Controllers\Admin\ChildSubmenuController::class, 'recover'])->name('childsubmenu.recover');
    Route::post('/childsubmenu/updateorder', [App\Http\Controllers\Admin\ChildSubmenuController::class, 'updateorder'])->name('childsubmenu.updateorder');


    Route::resource('testimonial', TestimonialController::class);
    Route::get('/testimonial/delete/{id}', [TestimonialController::class, 'show'])->name('testimonial.delete');
    Route::get('/trash/testimonial', [TestimonialController::class, 'trashed'])->name('testimonial.trash');
    Route::get('/testimonial/recover/{id}', [TestimonialController::class, 'recover'])->name('testimonial.recover');
    Route::get('/changestatus', [TestimonialController::class, 'switch'])->name('testimonial.dataswitch');

    // Bishop Monthly Programme Routes
    Route::resource('/events', 'App\Http\Controllers\Admin\EventController');

    // Bishop Messages Routes
    Route::resource('/messages', 'App\Http\Controllers\Admin\MessageController');
    Route::get('/switchstatus', [App\Http\Controllers\Admin\MessageController::class, 'switch'])->name('messages.dataswitch');

    // Bishop Profile Routes
    Route::resource('/profile', 'App\Http\Controllers\Admin\BishopProfileController');
    Route::get('/profilestatus', [App\Http\Controllers\Admin\BishopProfileController::class, 'switch'])->name('profile.dataswitch');
});

Route::get('/{url}/{url2?}/{url3?}/', [App\Http\Controllers\RouteController::class, 'route'])->middleware('slashes')->middleware('redirect')->name('route');


