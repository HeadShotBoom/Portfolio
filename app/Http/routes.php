<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');

Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

Route::get('/MyProjects', 'HomeController@ShowAllProjects');
Route::get('/MyPortfolio', 'HomeController@ShowAllPortfolio');
Route::get('/Portfolio/{name}', 'HomeController@ShowGallery');
Route::get('/Projects/{name}', 'HomeController@ShowProjects');
Route::get('/Motion', 'HomeController@ShowMotion');
Route::get('/Client', 'HomeController@ShowClientLinks');
Route::get('/FAQ', 'HomeController@ShowFAQ');
Route::get('/Contact', 'HomeController@ShowContactMe');
Route::get('/ServiceRequest', 'HomeController@ServiceRequest');

Route::get('/FAQ/edit', 'FAQController@ShowFAQEdit');
Route::get('/Portfolio/{name}/edit', 'GalleryController@ShowGalleryEdit');
Route::get('/Portfolio/{name}/delete/{id}', 'GalleryController@delete');
Route::get('/MyPortfolio/edit', 'GalleryController@showGalleryNames');
Route::get('/gallery/delete/{id}', 'GalleryController@deleteGallery');
Route::get('/add_main_gal/{id}', 'GalleryController@AddMainGal');
Route::get('/rem_main_gal/{id}', 'GalleryController@RemoveMainGal');
Route::get('/add_main_proj_gal/{id}', 'ProjectController@AddMainProjectGal');
Route::get('/rem_main_proj_gal/{id}', 'ProjectController@RemoveMainProjectGal');
Route::get('/add_home_page_gal/{id}', 'GalleryController@AddHomePageGal');
Route::get('/rem_home_page_gal/{id}', 'GalleryController@RemHomePageGal');
Route::get('/proj_add_home_page_gal/{id}', 'ProjectController@AddHomePageGal');
Route::get('/proj_rem_home_page_gal/{id}', 'ProjectController@RemHomePageGal');
Route::get('/project/delete/{id}', 'ProjectController@deleteGallery');
Route::get('/Projects/{name}/edit', 'ProjectController@ShowGalleryEdit');
Route::get('/Projects/{name}/delete/{id}', 'ProjectController@delete');
Route::get('/MyProjects/edit', 'ProjectController@showGalleryNames');
Route::get('/position/{id}/{direction}', 'GalleryController@editGalleryPosition');
Route::get('/project_position/{id}/{direction}', 'ProjectController@editGalleryPosition');
Route::get('/Motion/edit', 'MotionController@show');
Route::get('/Motion/delete/{id}', 'MotionController@delete');
Route::get('move_this_image_down/{id}', 'GalleryController@moveImageDown');
Route::get('move_this_image_up/{id}', 'GalleryController@moveImageUp');
Route::get('move_this_project_down/{id}', 'ProjectController@moveImageDown');
Route::get('move_this_project_up/{id}', 'ProjectController@moveImageUp');
Route::get('move_this_video_down/{id}', 'MotionController@moveVideoDown');
Route::get('move_this_video_up/{id}', 'MotionController@moveVideoUp');

Route::post('/FAQ/edit', 'FAQController@create');
Route::post('/add_cat', 'FAQController@addCat');
Route::post('/edit_faq', 'FAQController@editFaq');
Route::post('/delete_faq', 'FAQController@deleteFaq');
Route::post('/delete_cat', 'FAQController@deleteCat');
Route::post('/edit_cat', 'FAQController@editCat');
Route::post('/Contact', 'MailController@contact');
Route::post('/ServiceRequest', 'MailController@SendServiceRequest');
Route::post('/Portfolio/{name}/upload', 'GalleryController@upload');
Route::post('/Projects/{name}/upload', 'ProjectController@upload');
Route::post('/MyPortfolio/edit', 'GalleryController@editGalleryNames');
Route::post('/MyProjects/edit', 'ProjectController@editGalleryNames');
Route::post('/add_gal', 'GalleryController@addGalleryName');
Route::post('/add_project', 'ProjectController@addGalleryName');
Route::post('/add_iframe', 'MotionController@addiframe');

Route::post('/ClientLinks', 'ClientGalleryUploadController@makeGallery');

Route::get('/Client/{name}/login', 'HomeController@clientLogin');
Route::post('/ClientLoginAttempt', 'HomeController@clientLoginAttempt');
Route::get('/ClientGallery/{name}', 'HomeController@showClientGallery');

Route::post('/ClientGallery/{name}/upload', 'ClientGalleryUploadController@upload');

Route::get('/pickThisImage/{id}', 'HomeController@pickThis');
Route::get('/unPickThisImage/{id}', 'HomeController@unPickThis');
Route::get('/submitClientOrder/{id}', 'HomeController@clientOrderProcessor');
Route::get('/placeGroupOrder/{id}', 'HomeController@groupOrderProcessor');

Route::get('/Money', 'MoneyController@makeForm');
Route::post('/Money', 'MoneyController@chargeCustomer');