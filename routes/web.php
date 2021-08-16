<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::feeds();

Route::group(['namespace' => 'Pages'], function() {
    Route::get('/', 'PagesController@index')->name('home');
    Route::post('/comentario', 'PagesController@comments')->name('comentario');
    Route::post('/noticias/busca', 'PagesController@news')->name('buscar_noticias');
    Route::get('/noticias', 'PagesController@news')->name('news');
    Route::get('/noticia/{slug}', 'PagesController@news_detail')->name('news_detail');
    Route::get('/banner/{slug}', 'PagesController@banner_hit')->name('banner_hit');
    Route::get('/paginas/{slug}', 'PagesController@pages')->name('pages');
    Route::post('/newsletter', 'PagesController@newsletter')->name('newsletter');
    Route::post('/resposta', 'PagesController@response')->name('resposta');
    Route::get('/videos', 'PagesController@videos')->name('videos');
    Route::get('/enquete', 'PagesController@enquete')->name('enquete');
    Route::post('/enquete', 'PagesController@enquete_send')->name('enquete_send');
});

Route::group(['middleware' => ['auth', 'log'], 'namespace' => 'Admin', 'prefix' => 'admin'], function () {

    Route::get('/', function() {
        return redirect(route('admin.home'));
    });

    Route::get('/home', 'HomeController@index')->name('admin.home');
    
    Route::get('/home2', 'HomeController@index2')->name('admin.home2');

    Route::resource('contacts', 'ContactController')->middleware('can:read_contacts');

    Route::resource('newsletters', 'NewsletterController')->middleware('can:read_newsletters');
    Route::get('/export_news', 'NewsletterController@export')->middleware('can:read_newsletters')->name('news.export');

    Route::resource('pages', 'PageController')->middleware('can:read_pages');
    Route::post('pages/ativo/{id}', 'PageController@ativo')->name('pages.ativo')->middleware('can:update_pages');
    
    Route::resource('persons', 'PersonController')->middleware('can:read_persons');

    Route::resource('news', 'NewController')->middleware('can:read_news');
    Route::post('news/destaque/{id}', 'NewController@destaque')->name('news.destaque')->middleware('can:update_news');
    Route::post('news/ativo/{id}', 'NewController@ativo')->name('news.ativo')->middleware('can:update_news');

    Route::resource('partners', 'PartnerController')->middleware('can:read_partners');
    Route::post('partners/ativo/{id}', 'PartnerController@ativo')->name('partners.ativo')->middleware('can:update_partners');

    Route::resource('tags', 'TagController')->middleware('can:read_tags');

    Route::resource('videos_gallery', 'VideoGalleryController')->middleware('can:read_videos_gallery');
    Route::delete('videos_gallery/removeVideo/{id}', 'VideoGalleryController@removeVideo')->name('videos_gallery.removeVideo')->middleware('can:delete_videos_gallery');

    Route::resource('gallery', 'GalleryController')->middleware('can:read_gallery');
    Route::delete('gallery/removePhoto/{id}', 'GalleryController@removePhoto')->name('gallery.removePhoto')->middleware('can:delete_gallery');

    Route::resource('copyrights', 'CopyrightController')
    ->middleware('can:read_copyrights') 
    ;

    Route::resource('downloads', 'DownloadController')->middleware('can:read_downloads');

    Route::resource('arquivos', 'FileController')->middleware('can:read_files');

    //Route::resource('public_utilities', 'PublicUtilityController')->middleware('can:read_public_utilities');

    //Route::resource('photos', 'PhotosController')->middleware('can:read_photos');

    Route::resource('videos', 'VideoController')->middleware('can:read_videos');

    Route::resource('posts', 'PostController')->middleware('can:read_posts');
    Route::post('posts/ativo/{id}', 'PostController@ativo')->name('posts.ativo')->middleware('can:update_posts');

    Route::resource('polls', 'PollsController')->middleware('can:read_polls');

    Route::resource('polls', 'PollsController')->middleware('can:read_polls');
    Route::get('/polls/{id}/show', 'PollsController@show');

    Route::post('/polls/active/{id}', 'PollsController@active')->middleware('can:update_polls')->name('polls.active');

    Route::resource('banners', 'BannerController')->middleware('can:read_banners');
    Route::post('banners/ativo/{id}', 'BannerController@ativo')->name('banners.ativo')->middleware('can:update_banners');

    Route::resource('settings', 'SettingController');

    Route::resource('users', 'UserController')->middleware('can:read_users');
    Route::post('/users/{id}', 'UserController@update');

    Route::resource('tips', 'TipController')->middleware('can:read_tips');
    //Route::post('/tips/{id}', 'TipController@update');

    Route::resource('roles', 'RoleController')->middleware('can:read_roles');
    Route::post('/roles/{id}', 'RoleController@update');

    Route::resource('categories', 'CategoryController')->middleware('can:read_categories');
    Route::post('/categories/{id}', 'CategoryController@update');


    Route::resource('products', 'ProductController')->middleware('can:read_products');
    Route::get('/products/{id}/photos', 'ProductController@photos')->name('products.photos');
    Route::post('/products/{id}/photos', 'ProductController@storephotos');
    Route::delete('/products/{id}/photos', 'ProductController@deletephotos')->name('photo.destroy');

    Route::resource('work_with_us', 'WorkWithUsController')->middleware('can:read_work_with_us');

    Route::resource('logs', 'LogController')->middleware('can:read_logs');

    Route::resource('modules', 'ModuleController')->middleware('can:read_modules');
    Route::post('/modules/{id}', 'ModuleController@update');

    //Route::resource('partners', 'PartnerController')->middleware('can:read_partners');

});

Route::group(['middleware' => 'auth'], function () {
    Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

    Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');
});
Auth::routes();

