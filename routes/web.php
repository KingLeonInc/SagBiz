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
/*use Illuminate\Support\Facades\Storage;
Route::get('samp', function(){
	//$files = Storage::disk('gallery')->files('events');
	$sal = array('one', 'two', 'three');
	return implode(',', $sal);
});*/
Route::get('/', 'SiteController@welcome');

Route::get('services', function () {
    return view('services');
});
Route::get('services/public_park_development', function () {
	$serv_title = 'Public Park Development';
	$serv_img = 'images/assets/public_park1.JPG';
	$serv_desc = 'we strive to create vibrant socially active parks for the society by collaboratlly working hand in hand with the government, the society, business and NGOs to make Addis Ababa one of the greenest and cleanest cities in the world.';
    return view('services', compact('serv_title', 'serv_img', 'serv_desc'));
});
Route::get('services/land_scape_managment', function () {
	$serv_title = 'Landscape Managment';
	$serv_img = 'images/assets/landscape_manag1.jpg';
	$serv_desc = 'We offer a fully comprehensive one stop shop for all aspects of landscape maintenance. Our services extend from the smallest house lawn care to the very complicated public parks and recreational centers. We have a "no job is too small" approach to providing a service with high standard; taking in to consideration the wants and needs of our clients.';
    return view('services', compact('serv_title', 'serv_img', 'serv_desc'));
});
Route::get('services/textile_and_stationary_product', function () {
	$serv_title = 'Textile and Stationary Products';
	$serv_img = 'images/assets/textile3.jpg';
	$serv_desc = 'Our foundation is laid in providing superior quality products at a competitive price delivered by unmatched customer service. we offer a large product range of textile and stationary supplies.';
    return view('services', compact('serv_title', 'serv_img', 'serv_desc'));
});
Route::get('services/cleaning_supplies', function () {
	$serv_title = 'Cleaning Supplies';
	$serv_img = 'images/assets/cleaning2.JPG';
	$serv_desc = 'we are a company that is attentive to the needs of our customers and dedicate to providing a complete range of high quality cleaning products and cleaning services at a reasonable price for buildings, hotels, hospitals, offices, house hold, etc...';
    return view('services', compact('serv_title', 'serv_img', 'serv_desc'));
});

Route::get('our-events', 'SiteController@sagEvents');
Route::get('event/{event_slug}', 'SiteController@showEvent');
Route::get('tradeshows', 'SiteController@sagTradeshow');
Route::get('tradeshow/{event_slug}', 'SiteController@showEvent');
/*Route::get('tradeshow/sample', function(){
	$page_title = "Tradeshow";
	return view('sample_event', compact('page_title'));
});*/
Route::post('register-for-an-event', 'SiteController@registerForAnEvent');
Route::post('newsletter-subscription', 'SiteController@newsletterSubscription');
Route::get('gallery', 'SiteController@sagGallery');
Route::get('contact', function(){
	return view('contact');
});
Route::post('contact', 'SiteController@contactSag');

// LOGIN AN ADMIN
Route::get('login', function(){
	return redirect('/');
});
Route::post('login', ['as'=>'login', 'uses'=>'Auth\LoginController@authenticate']);
Route::get('logout', function(){
	if (Auth::check()) {
		Auth::logout();
		return redirect('/');
	}else{
		return redirect('/');
	}
});
Route::get('json/get-all-events', function(){
	return response()->json(App\Event::where('event_type', 1)->where('enabled', '1')->latest()->get());
});
Route::get('json/get-all-tradeshows', function(){
	return response()->json(App\Event::where('event_type', 2)->where('enabled', '1')->latest()->get());
});
Route::group(['middleware' => 'auth'], function(){
	Route::get('home', 'AdminController@index');
	Route::get('admin/events', 'AdminController@events');
	Route::get('admin/tradeshows', 'AdminController@tradeshows');
	Route::get('admin/event/create', 'AdminController@createEventIndex');
	Route::get('admin/tradeshow/create', 'AdminController@createTradeshowIndex');
	Route::post('admin/event/create', 'AdminController@createOrUpdateEvent');
	Route::get('admin/event/{event_slug?}', 'AdminController@showEvent');
	Route::get('admin/event/{event_slug}/{registrations}', 'AdminController@showEvent');
	Route::get('admin/tradeshow/{event_slug?}', 'AdminController@showTradeshow');
	Route::get('admin/tradeshow/{event_slug}/{registrations}', 'AdminController@showTradeshow');
	// ADS
	Route::get('admin/ads', 'AdminController@ads');
	Route::get('admin/ad/create', 'AdminController@createAdsIndex');
	Route::post('admin/ad/create', 'AdminController@createOrUpdateAd');
	Route::get('admin/ad/{add}', 'AdminController@showAd');
	// SUBSCRIPTIONS
	Route::get('admin/subscribers', 'AdminController@subscribers');

	// GALLERY
	Route::get('admin/gallery', 'AdminController@gallery');
	Route::post('admin/event/{event_slug}/images', 'AdminController@storeEventImages');
	Route::post('admin/create-host', 'AdminController@createNewHost');
	Route::post('admin/search', 'AdminController@searchSAG');
	Route::post('admin/upload-gallery-images', 'AdminController@uploadGalleryImages');
	Route::post('admin/mass-email', 'AdminController@sendMassEmail');

	// DELETE
	Route::post('admin/delete-event-image', 'AdminController@deleteEventImage');
	Route::post('admin/delete-gallery-image', 'AdminController@deleteGalleryImage');
	Route::get('delete-event-registred-member/{regId}', 'AdminController@deleteEventReg');
	Route::get('admin/delete-event/{eventId}', 'AdminController@deleteEvent');
	Route::get('admin/delete-ad/{ad_id}', 'AdminController@deleteSagAd');
	Route::get('admin/delete-subscriber/{sub_id}', 'AdminController@deleteSubscriber');

	// DATATABLES
	Route::get('datatables/get-all-events/{ev_type}', 'AdminController@dtGetAllEvents');
	Route::get('datatables/get-all-ads', 'AdminController@dtGetAllAds');
	Route::get('datatables/get-all-event-registred-members/{event_id}', 'AdminController@dtEventRegs');
	Route::get('datatables/get-all-subscribers', 'AdminController@dtSubscribers');
});

