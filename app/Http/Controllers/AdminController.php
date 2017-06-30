<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Event;
use App\EventHost;
use App\EventReg;
use App\Subscription;
use App\Ad;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use App\Mail\MassMail;
use Mail;
/**
 * @resource Admin Controller
 *
 * By accessing the endpoints on this API you can 
 * - Access the admin dashboard 
 * - Create/Update/Delete Events/Tradeshows
 * - Create/Update/Delete Photo/Video Ads
 * - Upload/Delete Gallery Images
 */
class AdminController extends Controller
{
    public function getDashboardData()
    {
        $results = [
            'page' => 'home',
            'title' => 'Dashboard',
            'events' => [
                'total' => Event::where('event_type', 1)->count(),
                'ongoing' => Event::where('event_type', 1)
                                     ->where('start_date', '<=', Carbon::now())
                                     ->where('end_date', '>=', Carbon::now())
                                     ->count(),
                'upcoming' => Event::where('event_type', 1)
                                     ->where('start_date', '>', Carbon::now())
                                     ->where('end_date', '>', Carbon::now())
                                     ->count(),
                'past' => Event::where('event_type', 1)
                                 ->where('start_date', '<', Carbon::now())
                                 ->where('end_date', '<', Carbon::now())
                                 ->count(),
            ],
            'tradeshows' => [
                'total' => Event::where('event_type', 2)->count(),
                'ongoing' => Event::where('event_type', 2)
                                     ->where('start_date', '<=', Carbon::now())
                                     ->where('end_date', '>=', Carbon::now())
                                     ->count(),
                'upcoming' => Event::where('event_type', 2)
                                     ->where('start_date', '>', Carbon::now())
                                     ->where('end_date', '>', Carbon::now())
                                     ->count(),
                'past' => Event::where('event_type', 2)
                                 ->where('start_date', '<', Carbon::now())
                                 ->where('end_date', '<', Carbon::now())
                                 ->count(),
            ],
            'subscribers' => [
                'total' => Subscription::count(),
                'last_week' => Subscription::where('created_at', '>=', Carbon::today()->subWeek())->count(),
                'last_month' => Subscription::where('created_at', '>=', Carbon::today()->subMonth())->count(),
                'last_year' => Subscription::where('created_at', '>=', Carbon::today()->subYear())->count()
            ],
            'ads' => [
                'total' => Ad::count(),
                'photo_ads' => Ad::where('ad_type', 'photo')->count(),
                'video_ads' => Ad::where('ad_type', 'video')->count()
            ]
        ];
        return $results;
    }
    public function getEvents($event_type)
    {
        //$results = array();
        $results = [
            'event_type' => $event_type,
            'title' => ($event_type == 1 ) ? 'Events' : 'Tradeshows',
            'counts' => [
                'total'   => Event::where('event_type', (int)$event_type )->count(),
                'ongoing' => Event::where('event_type', (int)$event_type )
                             ->where('start_date', '<=', Carbon::now())
                             ->where('end_date', '>=', Carbon::now())
                             ->count(),
                'upcoming' => Event::where('event_type', (int)$event_type )
                             ->where('start_date', '>', Carbon::now())
                             ->where('end_date', '>', Carbon::now())
                             ->count(),
                'past' => Event::where('event_type', (int)$event_type )
                             ->where('start_date', '<', Carbon::now())
                             ->where('end_date', '<', Carbon::now())
                             ->count()
            ]
        ];
        if ($results['counts']['total'] == 0) {
            //$results['counts']['total'] = 1;
        }
        return $results;
    }
    public function getRecentEvents($event_type)
    {
        $results = [
            'event_type' => $event_type,
            'title' => ($event_type == 1) ? 'Event' : 'Tradeshow',
            'recent_events' => Event::where('event_type', $event_type)->latest()->limit(8)->get(),
            'hosts' => EventHost::latest()->get()
        ];
        return $results;
    }
    public function getRecentAds()
    {
        $results = [
            'title' => 'Ads',
            'create_or_update' => 'Create',
            'recent_ads' => Ad::latest()->get(),
        ];
        return $results;
    }
    public function getSingleEvent($event_type, $event_id, $show_tab)
    {
        $event = Event::find($event_id);
        $dateRange = Carbon::parse($event->start_date)->format('m/d/Y h:m A')." - ".Carbon::parse($event->end_date)->format('m/d/Y h:m A');
        //$event_imgs = explode(',', $event->images);
        $results = [
            'event_type' => $event_type,
            'title' => ($event_type == 1) ? 'Event' : 'Tradeshow',
            'event' => Event::find($event_id),
            'date_range' => $dateRange,
            'tab' => $show_tab,
            'images' => Storage::disk('events')->files($event_id.'/images'),
            'event_regs' => EventReg::where('event_id', $event_id)->count(),
            'recent_events' => Event::where('event_type', $event_type)->latest()->limit(8)->get(),
            'hosts' => EventHost::latest()->get()
        ];
        return $results;
    }
    public function getAds()
    {
        //$results = array(); 0935324616
        $results = [
            //'event_type' => $event_type,
            'title' => 'Ads',
            'counts' => [
                'total'   => Ad::count(),
                'photo_ads' => [
                    'total' => Ad::where('ad_type', 'photo')->count(),
                    'ongoing' => Ad::where('ad_type', 'photo')
                                     ->where('ad_start_date', '<=', Carbon::now())
                                     ->where('ad_end_date', '>=', Carbon::now())
                                     ->count(),
                    'upcoming' => Ad::where('ad_type', 'photo')
                                     ->where('ad_start_date', '>', Carbon::now())
                                     ->where('ad_end_date', '>', Carbon::now())
                                     ->count(),
                    'past' => Ad::where('ad_type', 'photo')
                                     ->where('ad_start_date', '<', Carbon::now())
                                     ->where('ad_end_date', '<', Carbon::now())
                                     ->count()
                ],
                'video_ads' => [
                    'total' => Ad::where('ad_type', 'video')->count(),
                    'ongoing' => Ad::where('ad_type', 'video')
                                     ->where('ad_start_date', '<=', Carbon::now())
                                     ->where('ad_end_date', '>=', Carbon::now())
                                     ->count(),
                    'upcoming' => Ad::where('ad_type', 'video')
                                     ->where('ad_start_date', '>', Carbon::now())
                                     ->where('ad_end_date', '>', Carbon::now())
                                     ->count(),
                    'past' => Ad::where('ad_type', 'video')
                                     ->where('ad_start_date', '<', Carbon::now())
                                     ->where('ad_end_date', '<', Carbon::now())
                                     ->count()
                ]
            ]
        ];
        return $results;
    }
    public function getASingleAd($ad_id)
    {
        $ad = Ad::find($ad_id);
        $dateRange = Carbon::parse($ad->ad_start_date)->format('m/d/Y h:m A')." - ".Carbon::parse($ad->ad_end_date)->format('m/d/Y h:m A');
        
        $results = [
            'title' => 'Ad',
            'create_or_update' => 'Update',
            'ad' => $ad,
            'recent_ads' => Ad::latest()->limit(10)->get()
        ];
        return $results;
    }
    /**
     * Admin Dashboard
     *
     * Admin Dashboard(Landing page).
     */
    public function index()
    {
    	$page = "home";
    	$title = "Dashboard";
        $sagEvents = [
            'evnts' => Event::where('event_type', 1)->count(),
            'ongoing' => Event::where('event_type', 1)
                         ->where('start_date', '<=', Carbon::now())
                         ->where('end_date', '>=', Carbon::now())
                         ->count(),
            'upcoming' => Event::where('event_type', 1)
                         ->where('start_date', '>', Carbon::now())
                         ->where('end_date', '>', Carbon::now())
                         ->count(),
            'past' => Event::where('event_type', 1)
                         ->where('start_date', '<', Carbon::now())
                         ->where('end_date', '<', Carbon::now())
                         ->count(),
        ];
        $results = $this->getDashboardData();
    	return view('admin.dashboard', compact('results'));
    }
    /**
     * Admin Events
     *
     * Returns a Page containing <strong><u>all</u></strong> published(enabled) events.
     */
    public function events()
    {
        $results = $this->getEvents(1);
        return view('admin.events', compact('results'));
    }
    /**
     * Admin Tradeshows
     *
     * Returns a Page containing <strong><u>all</u></strong> published(enabled) tradeshows.
     */
    public function tradeshows()
    {
    	$results = $this->getEvents(2);
        return view('admin.events', compact('results'));
    }
    /**
     * Admin Ads
     *
     * Returns a Page containing all sag ads.
     */
    public function ads()
    {
        $results = $this->getAds();
        return view('admin.ads', compact('results'));
    }
    /**
     * Admin Gallery
     *
     * Returns a Page containing all sag gallery photos.
     */
    public function gallery()
    {
        $galleries = [
            'events' => Storage::disk('gallery')->files('events'),
            'tradeshows' => Storage::disk('gallery')->files('tradeshows'),
            'public_parks' => Storage::disk('gallery')->files('public-parks'),
            'txt_and_stationary' => Storage::disk('gallery')->files('textile-and-stationary-products')
        ];
        return view('admin.gallery', compact('galleries'));
    }
    /**
     * Subscribers
     *
     * Returns a Page containing all sag subscribers.
     */
    public function subscribers()
    {
        $results = $this->getDashboardData();
        return view('admin.subscribers', compact('results'));
    }
    /**
     * Create Event Page
     *
     * Returns a Page(with recently created events) where you can create a new event.
     */
    public function createEventIndex()
    {
        $results = $this->getRecentEvents(1);
        return view('admin.event.create_event', compact('results'));
    }
    /**
     * Create Tradeshow Page
     *
     * Returns a Page(with recently created tradeshows) where you can create a new tradeshow.
     */
    public function createTradeshowIndex()
    {
        $results = $this->getRecentEvents(2);
        return view('admin.event.create_event', compact('results'));
    }
    /**
     * Create Ads Page
     *
     * Returns a Page(with recently created ads) where you can create a new photo or video ad.
     */
    public function createAdsIndex()
    {
        $results = $this->getRecentAds();
        return view('admin.ad.create_or_update_ad', compact('results'));
    }
    /**
     * Create or Update Event/Tradeshow
     *
     * Create a New Event/Tradeshow or Update Existing One
     * \@param      Request      $request <br>
     * \@return     void
     * ### Parameters
     * Parameter | Type | Status | Description 
     * --------- | ------- | ------- | ------- 
     * create_or_update | string | required | `create` Or `update`  
     * title | string | required | Event or Tradeshow Title  
     * summary | string | required | A brief summary/overview of Event or Tradeshow  
     * description | string | required | A complete description of Event or Tradeshow  
     * event_type | string | required | `1` Or `2` , `1` => Event, `2` => Tradeshow  
     * new_event_image | image | optional | Must be an image (jpeg, png, bmp, gif, or svg)
     * event_host | integer | required
     * event_start_and_end_date | string | required | eg `06/24/2017 12:00 AM - 06/30/2017 11:59 PM`
     * price | integer | required
     * availability | string | required | `limited` or `unlimited`
     * max_guest | integer | required | Required if availability is `limited` 
     * 
     */
    public function createOrUpdateEvent(Request $request)
    {
        //return $request->all();
        $type = $request->input('type');
        $check = ['title', 'summary', 'description'];
        // CHECK FOR FIELDS
        if ($request->input('title') == "") {
            return redirect()->back()->with('response', [
                'success' => false,
                'msg' => "Please Specify title of the ".$type."!"
            ]);
        }if ($request->input('summary') == "") {
            return redirect()->back()->with('response', [
                'success' => false,
                'msg' => "Please Specify summary field!"
            ]);
        }if ($request->input('description') == "") {
            return redirect()->back()->with('response', [
                'success' => false,
                'msg' => "Please Specify/give a full description of the ".$type."!"
            ]);
        }
        $date = explode(' - ', $request->input('event_start_and_end_date'));
        $results = [
            'title' => $request->input('title'),
            'summary' => $request->input('summary'),
            'description' => $request->input('description'),
            'event_img' => '',
            'event_type' => $request->input('event_type'),
            'event_host' => $request->input('event_host'),
            'start_date' => Carbon::parse(trim($date[0])), 
            'end_date' => Carbon::parse(trim($date[1])),
            'price' => $request->input('price'),
            'availability' => $request->input('availability'),
            'max_guest' => $request->input('max_guest'),
            'enabled' => ($request->has('enabled')) ? '1' : '0'
        ];
        // CREATE OR UPDATE
        $event = ($request->input('create_or_update') == 'create') ? Event::create($results) : Event::findBySlug($request->input('event_slug'));

        if ($request->input('create_or_update') == 'update') {
            Event::find($event->event_id)->update([
                'title' => $request->input('title'),
                'summary' => $request->input('summary'),
                'description' => $request->input('description'),
                'event_type' => $request->input('event_type'),
                'event_host' => $request->input('event_host'),
                'start_date' => Carbon::parse(trim($date[0])), 
                'end_date' => Carbon::parse(trim($date[1])),
                'price' => $request->input('price'),
                'availability' => $request->input('availability'),
                'max_guest' => $request->input('max_guest'),
                'enabled' => ($request->has('enabled')) ? '1' : '0'
            ]);
        }
        // IF IMAGE IS UPLOADED
        if ($request->hasFile('new_event_image')) {
            $file = $request->file('new_event_image');
            $fileName = $file->getClientOriginalName();
            //$fileBaseName = $file->getClientBaseName();
            $fileType = $file->getClientMimeType();
            // CHECK FOR IMAGE FILE
            $checkFile = explode('.', $fileName);
            if (strtolower(end($checkFile)) == 'jpg' || strtolower(end($checkFile)) == 'jpeg' || strtolower(end($checkFile)) == 'png' || strtolower(end($checkFile)) == 'gif') {
                $fileBaseName = basename($fileName, '.'.end($checkFile)).'.'.end($checkFile);
                //dd($event);
                $path = public_path('/sag-events/'.$event->event_id.'/');
                $file_path = public_path('/sag-events/'.$event->event_id.'/'.$fileBaseName);

                // MOVE FILE to ITS DIRECTORY
                if (! file_exists($file_path)) {
                    if($file->move($path, $fileName)){
                      // UPDATE EVENT
                      $event->event_img = $fileBaseName;
                      $event->save();
                    }
                }else{
                    return redirect()->back()->with('response', [
                        'success' => false,
                        'msg' => "The file ".$fileBaseName." already exists, Please rename your file and try agian!"
                    ]);
                }
            }else{
                return redirect()->back()->with('response', [
                    'success' => false,
                    'msg' => 'Please Upload Only Image Files. "'.end($checkFile).'" is not an image file'
                ]);
            }
        }
        return redirect()->back()->with('response', [
            'success' => true,
            'create_or_update' => $request->input('create_or_update'),
            'msg' => $type." ". $request->input('create_or_update') ."d Successfully.",
            //'event' => $created_event
        ]);
    }
    /**
     * Create or Update Ads
     *
     * Create a New Photo/Video Ad or Update Existing One <br>
     * \@param      Request      $request <br>
     * \@return     void
     * ### Parameters
     * Parameter | Type | Status | Description 
     * --------- | ------- | ------- | ------- 
     * create_or_update | string | required | `create` Or `update`  
     * ad_title | string | required | Photo or Video Ad Title  
     * ad_type | string | required | `photo` Or `video` , Photo Ad or Video Ad  
     * ad_link | string | required | Complete Ad Link eg. `https://example.com/ads`  
     * ad_background_image | image | required | Ad Background Image. Must be an image (jpeg, png, bmp, gif, or svg)  
     * add_start_and_end_date | string | required | Ad start date - Ad end date. eg `06/24/2017 12:00 AM - 06/30/2017 11:59 PM`
     * ad_video_link | string | optional | Video Ad Link, required if `ad_type` is `video` eg. `https://www.youtube.com/watch?v=ahjSt68Rtvc`  
     * ad_id | integer | optional | Ad ID. Required if `create_or_update` is `update`  
     */
    public function createOrUpdateAd(Request $request)
    {
        if ($request->input('create_or_update') == 'create') {
            if($request->hasFile('ad_background_image')){
                $ad_back_img = $request->file('ad_background_image');
                $fileName = $ad_back_img->getClientOriginalName();
                //$fileBaseName = $file->getClientBaseName();
                $fileType = $ad_back_img->getClientMimeType();
                // CHECK FOR IMAGE FILE
                $checkFile = explode('.', $fileName);
                if (strtolower(end($checkFile)) == 'jpg' || strtolower(end($checkFile)) == 'jpeg' || strtolower(end($checkFile)) == 'png' || strtolower(end($checkFile)) == 'gif' || strtolower(end($checkFile)) == 'bmp' || strtolower(end($checkFile)) == 'svg') {
                    
                    // IF VIDEO AD THEN CHECK FOR VIDEO LINK
                    if ($request->input('ad_type') == 'video') {
                        if ($request->input('ad_video_link') == "") {
                            return redirect()->back()->with('response', [
                                'success' => false,
                                'msg' => 'Please state video link for your video ad.!'
                            ]);
                        }
                    }
                    // CREATE THE AD NOW
                    $ad_date = explode(' - ', $request->input('add_start_and_end_date'));
                    $ad = Ad::create([
                        'ad_title' => $request->input('ad_title'),
                        'ad_type'  => $request->input('ad_type'), // ['photo', 'video']
                        'ad_link'  => $request->input('ad_link'),
                        'ad_background_photo' => '', // AD BACKGROUND IMAGE
                        'ad_video_file' => '', // nullable(); // VIDEO FILE OR LINK 
                        'ad_video_link' => ($request->input('ad_video_link') == '') ? '' : $request->input('ad_video_link'), // nullable();
                        'ad_start_date'  => Carbon::parse($ad_date[0]),
                        'ad_end_date' => Carbon::parse($ad_date[1]),
                        'enabled' => ($request->has('enabled')) ? '1' : '0'
                    ]);
                    $fileBaseName = basename($fileName, '.'.end($checkFile));
                    
                    $path = public_path('sag-ads/'.$ad->ad_id.'/');
                    $file_path = public_path('sag-ads/'.$ad->ad_id.'/'.$fileBaseName);

                    // MOVE FILE to ITS DIRECTORY
                    //if (! file_exists(public_path('excel-files/'.$fileBaseName))) {
                    /*if (! file_exists($file_path)) {*/
                        if($ad_back_img->move($path, $fileName)){
                          // UPDATE DB ADD IMAGE TO DB
                          $ad->ad_background_photo = $fileBaseName.'.'.end($checkFile);
                          $ad->save(); 
                          return redirect()->back()->with('response',[
                            'success' => true,
                            'msg' => strtoupper($request->input('ad_type'))." AD successfully created!"
                          ]);
                        }
                    /*}else{
                        return response()->json([
                            'success' => false,
                            'msg' => "The file ".$fileBaseName." already exists, Please rename your file and try agian!"
                        ]);
                    }*/
                }
                return redirect()->back()->with('response', [
                    'success' => false,
                    'msg' => 'Please upload only an Image File for the ad!'
                ]);
            }
            return redirect()->back()->with('response', [
                'success' => false,
                'msg' => 'Please Upload an Image for your Ad?'
            ]);
        }elseif ($request->input('create_or_update') == 'update') {
            //return $request->all();
            $ad = Ad::find($request->input('ad_id'));
            if (is_null($ad)) {
                return redirect()->back()->with('response', [
                    'success' => false,
                    'msg' => 'Ad not Found!!'
                ]);
            }
            $ad_date = explode(' - ', $request->input('add_start_and_end_date'));
            $ad->update([
                'ad_title' => $request->input('ad_title'),
                'ad_type'  => $request->input('ad_type'), // ['photo', 'video']
                'ad_link'  => $request->input('ad_link'),
                //'ad_background_photo' => '', // AD BACKGROUND IMAGE
                //'ad_video_file' => '', // nullable(); // VIDEO FILE OR LINK 
                'ad_video_link' => ($request->input('ad_video_link') == '') ? '' : $request->input('ad_video_link'), // nullable();
                'ad_start_date'  => Carbon::parse($ad_date[0]),
                'ad_end_date' => Carbon::parse($ad_date[1]),
                'enabled' => ($request->has('enabled')) ? '1' : '0'
            ]);
            if($request->hasFile('ad_background_image')){
                $ad_back_img = $request->file('ad_background_image');
                $fileName = $ad_back_img->getClientOriginalName();
                //$fileBaseName = $file->getClientBaseName();
                $fileType = $ad_back_img->getClientMimeType();
                // CHECK FOR IMAGE FILE
                $checkFile = explode('.', $fileName);
                if (strtolower(end($checkFile)) == 'jpg' || strtolower(end($checkFile)) == 'jpeg' || strtolower(end($checkFile)) == 'png' || strtolower(end($checkFile)) == 'gif') {
                    
                    // IF VIDEO AD THEN CHECK FOR VIDEO LINK
                    if ($request->input('ad_type') == 'video') {
                        if ($request->input('ad_video_link') == "") {
                            return redirect()->back()->with('response', [
                                'success' => false,
                                'msg' => 'Please state video link for your video ad.!'
                            ]);
                        }
                    }
                    $fileBaseName = basename($fileName, '.'.end($checkFile));
                    
                    $path = public_path('sag-ads/'.$ad->ad_id.'/');
                    $file_path = public_path('sag-ads/'.$ad->ad_id.'/'.$fileBaseName);

                    // MOVE FILE to ITS DIRECTORY
                    //if (! file_exists(public_path('excel-files/'.$fileBaseName))) {
                    if (! file_exists($file_path)) {
                        if($ad_back_img->move($path, $fileName)){
                          // UPDATE DB AD IMAGE TO DB
                          $ad->ad_background_photo = $fileBaseName.'.'.end($checkFile);
                          $ad->save(); 
                          return redirect()->back()->with('response', [
                            'success' => true,
                            'msg' => strtoupper($request->input('ad_type'))." AD successfully updated!"
                          ]);
                        }
                    }else{
                        return redirect()->back()->with('response', [
                            'success' => false,
                            'msg' => "The file ".$fileBaseName." already exists, Please rename your file and try agian!"
                        ]);
                    }
                }
                return redirect()->back()->with('response', [
                    'success' => false,
                    'msg' => 'Please upload only an Image File for the ad!'
                ]);
            }
            return redirect()->back()->with('response', [
                'success' => true,
                'msg' => strtoupper($request->input('ad_type'))." AD successfully updated!"
            ]);
        }
        return redirect()->back()->with('response', [
            'success' => false,
            'msg' => "Can't update ad now!. Please try again later"
        ]);
    }
    /**
     * View particular Event
     *
     * Show details of a single event <br>
     * \@param      string      $event_slug <br>
     * \@param      string      $show_tab <br>
     * \@return     void
     */
    public function showEvent($event_slug, $show_tab='event')
    {
        $event = Event::findBySlug($event_slug);
        if (is_null($event)) {
            //abort(404);
            return redirect()->back();
        }else{
            $results = $this->getSingleEvent(1, $event->event_id, $show_tab);
            return view('admin.event.update_event', compact('results'));
        }
    }
    /**
     * View particular Tradeshow
     *
     * Show details of a single tradeshow <br>
     * \@param      string      $event_slug <br>
     * \@param      string      $show_tab <br>
     * \@return     void
     */
    public function showTradeshow($event_slug, $show_tab = 'event')
    {
        $event = Event::findBySlug($event_slug);
        if (is_null($event)) {
            return redirect()->back();
        }else{
            $results = $this->getSingleEvent(2, $event->event_id, $show_tab);
            return view('admin.event.update_event', compact('results'));
        }
    }
    /**
     * View particular Ad
     *
     * Show details of a single ad <br>
     * \@param      string      $event_slug <br>
     * \@param      string      $show_tab <br>
     * \@return     void
     */
    public function showAd($ad_id)
    {
        $ad = Ad::find($ad_id);
        if (is_null($ad)) {
            return redirect()->back();
        }else{
            $results = $this->getASingleAd($ad_id);
            return view('admin.ad.create_or_update_ad', compact('results'));
        }
    }
    /**
     * Upload Event/Tradeshow Images
     *
     * Upload new images for an existing events/tradeshows <br>
     * \@param      Request      $request <br>
     * \@param      String      $event_slug <br>
     * \@return     void
     * ### Parameters
     * Parameter | Type | Status | Description 
     * --------- | ------- | ------- | ------- 
     * sag_event_id | integer | required | Event/Tradeshow Id for which this image is going to be uploaded  
     * file | image | required | Event/Tradeshow Photo. Must be an image (jpeg, png, bmp, gif, or svg) 
     */
    public function storeEventImages(Request $request, $event_slug)
    {
        //return $event_slug;
        $event = Event::find($request->input('sag_event_id'));
        if (is_null($event)) {
            return response()->json([
                'success' => false,
                'msg' => "Event not found!"
            ]);
        }else{
            //return $request->all();
            $file = $request->file('file');
            $fileName = $file->getClientOriginalName();
            //$fileBaseName = $file->getClientBaseName();
            $fileType = $file->getClientMimeType();
            // CHECK FOR EXCEL FILE
            $checkFile = explode('.', $fileName);
            if (strtolower(end($checkFile)) == 'jpg' || 
                strtolower(end($checkFile)) == 'jpeg' || 
                strtolower(end($checkFile)) == 'png' || 
                strtolower(end($checkFile)) == 'bmp' || 
                strtolower(end($checkFile)) == 'svg' || 
                strtolower(end($checkFile)) == 'gif') {
                $fileBaseName = basename($fileName, '.'.end($checkFile)).'.'.end($checkFile);
                
                $path = public_path('/sag-events/'.$event->event_id.'/images/');
                $file_path = public_path('/sag-events/'.$event->event_id.'/images/'.$fileBaseName);
                // MOVE FILE to ITS DIRECTORY
                if (! file_exists($file_path)) {
                    if($file->move($path, $fileName)){
                      return response()->json([
                            'success' => true,
                            'msg' => 'Image uploaded and saved on database!.<br> <a style="color: blue;" href="'.url('admin/event/'.$event->slug.'/uploaded-images').'">Refresh Page</a> to see Images'
                      ]);
                    }
                }else{
                    return response()->json([
                        'success' => false,
                        'msg' => "The file ".$fileBaseName." already exists, Please rename your file and try agian!"
                    ]);
                }
            }
            return response()->json([
                'success' => false,
                'msg' => "Please Choose Image files only!"
            ]);
        }
    }
    /**
     * Upload Gallery Images
     *
     * Upload new images to Photo Gallery <br>
     * \@param      Request      $request <br>
     * \@return     void
     * ### Parameters
     * Parameter | Type | Status | Description 
     * --------- | ------- | ------- | ------- 
     * gallery_type | string | required | `events` or `tradeshows` or `public-parks` or `textile-and-stationary-products`  
     * file | image | required | Photo. Must be an image (jpeg, png, bmp, gif, or svg) 
     */
    public function uploadGalleryImages(Request $request)
    {
        //return $request->all();
        $gallery_type = $request->input('gallery_type');
        // JUST UPLOAD THIS IMAGES TO sag-galleries FOLDER UNDER THEIR OWN SUBFOLDERS($gallery_type)
        $file = $request->file('file');
        $fileName = $file->getClientOriginalName();
        //$fileBaseName = $file->getClientBaseName();
        $fileType = $file->getClientMimeType();
        // CHECK FOR EXCEL FILE
        $checkFile = explode('.', $fileName);
        if (strtolower(end($checkFile)) == 'jpg' || 
            strtolower(end($checkFile)) == 'jpeg' || 
            strtolower(end($checkFile)) == 'png' || 
            strtolower(end($checkFile)) == 'bmp' || 
            strtolower(end($checkFile)) == 'svg' || 
            strtolower(end($checkFile)) == 'gif') {
            $fileBaseName = basename($fileName, '.'.end($checkFile));
            
            $path = public_path('/sag-galleries/'.$gallery_type.'/');
            $file_path = public_path('/sag-galleries/'.$gallery_type.'/'.$fileBaseName);

            // MOVE FILE to ITS DIRECTORY
            if (! file_exists($file_path)) {
                if($file->move($path, $fileName)){
                  return response()->json([
                        'success' => true,
                        'msg' => "Image uploaded to gallery!."
                  ]);
                }
            }else{
                return response()->json([
                    'success' => false,
                    'msg' => "The file ".$fileBaseName." already exists, Please rename your file and try agian!"
                ]);
            }
        }
        return response()->json([
            'success' => false,
            'msg' => "Please Choose Image files only!"
        ]);
    }
    /**
     * Create Event/Tradeshow Host
     *
     * Create A Host for an event/tradeshow. This represents `hosted by` sections on the website. <br>
     * \@param      Request      $request <br>
     * \@return     void
     * ### Parameters
     * Parameter | Type | Status | Description 
     * --------- | ------- | ------- | ------- 
     * name | string | required | Host Name  
     * company | string | required | Host's Company Name  
     * phone | string | required | Phone number of the host  
     * email | email | required | Email of the host  
     * address | text | optional | Address of the host  
     * additional_info | text | optional | Any other information about the host 
     */
    public function createNewHost(Request $request)
    {
        //return ($request->input('address') == "") ? "ya" : $request->all();
        $check = EventHost::where('name', $request->input('name'))->orWhere('company', $request->input('company'))->count();
        if ($check) {
            return response()->json([
                'success' => false,
                'msg' => 'Host already exists!.'
            ]);
        }else{
            $fields = [
                'name' => $request->input('name'),
                'company'  => $request->input('company'),
                'phone'  => $request->input('phone'),
                'email'  => $request->input('email'),
                'address' => ($request->input('address') == "") ? "" : $request->input('address'),
                'additional_info' => ($request->input('additional_info') == "") ? "" : $request->input('additional_info'),
                'enabled' => "1"
            ];
            $host = EventHost::create($fields);
            return response()->json([
                'success' => true,
                'msg' => 'New Event/Tradeshow host created and assigned.',
                'new_host' => $host->event_host_id,
                'hosts' => EventHost::latest()->get()
            ]);
        }
    }
    // DELETE
    /**
     * Delete Event/Tradeshow Image
     *
     * Delete an image for an existing event/tradeshow <br>
     * \@param      Request      $request <br>
     * \@return     void
     * ### Parameters
     * Parameter | Type | Status | Description 
     * --------- | ------- | ------- | ------- 
     * event | integer | required | Event/Tradeshow Id  
     * img2delete | string | required | Name of Event/Tradeshow Image that's is going to be removed  
     */
    public function deleteEventImage(Request $request)
    {
        //return $request->all();
        $event = Event::find($request->input('event'));
        if (!is_null($event)) {
            // DELETE IMAGE IF EXISTS
            $exists = Storage::disk('events')->exists($request->input('img2delete'));
            if ($exists) {
                Storage::disk('events')->delete($request->input('img2delete'));
                return response()->json([
                    'success' => true,
                    'msg' => 'Image Successfully Deleted.'
                ]);
            }
            return response()->json([
                'success' => false,
                'msg' => 'Image Not Found.'
            ]);
        }
        return response()->json([
            'success' => false,
            'msg' => 'Cannot delete Image. Event not found.'
        ]);
    }
    /**
     * Delete Gallery Images
     *
     * Delete Photo Gallery Images <br>
     * \@param      Request      $request <br>
     * \@return     void
     * ### Parameters
     * Parameter | Type | Status | Description 
     * --------- | ------- | ------- | ------- 
     * img2delete | string | required | Name of the Image that's is going to be removed  
     */
    public function deleteGalleryImage(Request $request)
    {
        $img2delete = $request->input('img2delete');
        $exists = Storage::disk('gallery')->exists($img2delete);
        if ($exists) {
            Storage::disk('gallery')->delete($img2delete);
            return response()->json([
                'success' => true,
                'msg' => 'Image Permanently Deleted!'
            ]);
        }
        return response()->json([
            'success' => false,
            'msg' => 'Image Not Found!'
        ]);
    }
    /**
     * Delete Users Registered for an Event/Tradeshow
     *
     * Delete Event/Tradeshow Registred Members <br>
     * \@param      integer      $reg_id <br>
     * \@return     json 
     */
    public function deleteEventReg($reg_id)
    {
        $reg = EventReg::find($reg_id);
        if (is_null($reg)) {
            return response()->json([
                'success' => false,
                'msg' => 'Member not found.'
            ]);
        }
        EventReg::destroy($reg_id);
        return response()->json([
            'success' => true,
            'msg' => 'Member deleted.'
        ]);
    }
    /**
     * Delete an Event/Tradeshow
     *
     * Permanently Delete Event/Tradeshow <br>
     * \@param      integer      $event_id <br>
     * \@return     json 
     */
    public function deleteEvent($event_id)
    {
        $event = Event::find($event_id);
        if (is_null($event)) {
            return response()->json([
                'success' => false,
                'msg' => 'Event not found.'
            ]);
        }
        Event::destroy($event_id);
        $ev_regs = EventReg::where('event_id', $event_id)->delete();
        $exists = Storage::disk('events')->exists($event_id);
        if ($exists) {
            Storage::disk('events')->deleteDirectory($event_id);
        }
        return response()->json([
            'success' => true,
            'msg' => 'Event deleted.'
        ]);
    }
    /**
     * Delete Ad
     *
     * Permanently Delete Photo or Video Ads <br>
     * \@param      integer      $ad_id <br>
     * \@return     json 
     */
    public function deleteSagAd($ad_id)
    {
        $ad = Ad::find($ad_id);
        if (is_null($ad)) {
            return response()->json([
                'success' => false,
                'msg' => 'Ad not found!'
            ]);
        }
        $ad->delete();
        $exists = Storage::disk('ads')->exists($ad_id);
        if ($exists) {
            Storage::disk('ads')->deleteDirectory($ad_id);
        }
        return response()->json([
            'success' => true,
            'msg' => 'Ad successfully deleted!'
        ]);
    }
    /**
     * Delete Subscribers
     *
     * Permanently Delete Subscriber <br>
     * \@param      integer      $sub_id <br>
     * \@return     json 
     */
    public function deleteSubscriber($sub_id)
    {
        $subscriber = Subscription::find($sub_id);
        if (is_null($subscriber)) {
            return response()->json([
                'success' => false,
                'msg' => 'Subscriber not found!'
            ]);
        }
        $subscriber->delete();
        return response()->json([
            'success' => true,
            'msg' => 'Subscriber successfully deleted!'
        ]);
    }
    // SEARCH
     /**
     * Search For an Event/Tradeshow 
     *
     * Search for an event/tradeshow using keywords. <br>
     * \@param      Request      $request <br>
     * \@return     void
     * ### Parameters
     * Parameter | Type | Status | Description 
     * --------- | ------- | ------- | ------- 
     * search | string | required | Search Keyword  
     */
    public function searchSAG(Request $request)
    {
        $keyword = $request->input('search');
        $results = [
            'searchFor' => $keyword,
            'totalFound' => count(Event::searchEvent($keyword)) + count(EventHost::searchEventHost($keyword)),
            'eventsFound' => Event::searchEvent($keyword),
            'hostsFound' => EventHost::searchEventHost($keyword)
        ];
        return view('admin.search', compact('results'));
    }
    // DATATABLES
    /**
     * Datatables - Get All Event/Tradeshows 
     *
     * Fetch all event/tradeshows in a table. <br>
     * \@param      integer      $event_type <br>
     * \@return     json 
     */
    public function dtGetAllEvents($ev_type)
    {
        $events = Event::where('event_type', $ev_type)->get();
        return Datatables::of($events)
                ->editColumn('event_host', function($ev){
                    $host = EventHost::find($ev->event_host);
                    if (is_null($host)) {
                        return $ev->event_host;
                    }
                    return $host->name. ' | '.$host->company;
                })
                ->editColumn('title', function($ev){
                    $evOrTrade = ($ev->event_type == 1 || $ev->event_type == "1") ? 'event' : 'tradeshow';
                    return '<a href="'.$evOrTrade.'/'.$ev->slug.'">'.$ev->title.'</a>';
                })
                ->addColumn('date_range', function($ev){
                    return '<center>'.Carbon::parse($ev->start_date)->format('d M Y').' <br> to <br> '.Carbon::parse($ev->end_date)->format('d M Y').'</center>';
                })
                ->addColumn('status', function($ev){
                    $now = Carbon::now();
                    $sd = Carbon::parse($ev->start_date);
                    $ed = Carbon::parse($ev->end_date);
                    if($sd->lte($now) && $ed->gte($now)){
                        return '<span class="label label-success">Ongoing</span>';
                    }elseif ($sd->gt($now) && $ed->gt($now)) {
                        return '<span class="label label-primary">Upcoming</span>';
                    }elseif ($sd->lt($now) && $ed->lt($now)) {
                        return '<span class="label label-danger">Past</span>';
                    }
                })
                ->addColumn('action', function($ev){
                    $evOrTrade = ($ev->event_type == 1 || $ev->event_type == "1") ? 'event' : 'tradeshow';
                    $regs = EventReg::where('event_id', $ev->event_id)->count();
                    
                    return '<center><a href="'.$evOrTrade.'/'.$ev->slug.'" class="btn btn-app" title="Edit '.$evOrTrade.'"><i class="fa fa-edit"></i>Edit</a>
                            <a href="'.$evOrTrade.'/'.$ev->slug.'/registrations" class="btn btn-app" title="Show Registered Users"><span class="badge bg-purple">'.$regs.'</span><i class="fa fa-users"></i>Users</a>
                            <a href="#" onclick="deleteSagEvent('.$ev->event_id.')" class="btn btn-app" title="Delete '.$evOrTrade.'"><i class="fa fa-trash"></i>Delete</a></center>';
                })
                ->rawColumns(['title', 'status', 'date_range', 'action'])
                ->make(true);
    }
    /**
     * Datatables - Get All Ads 
     *
     * Fetch all Photo and Video Ads in a table. <br>
     * \@return     json 
     */
    public function dtGetAllAds()
    {
        $ads = Ad::latest()->get();
        return Datatables::of($ads)
                            ->editColumn('ad_title', function($ad){
                                return '<a href="'.url('admin/ad/'.$ad->ad_id).'">'.$ad->ad_title.'<a>';
                            })
                            ->addColumn('date_range', function($ad){
                                return '<center>'.Carbon::parse($ad->ad_start_date)->format('M d, Y').'<br> to <br>'.Carbon::parse($ad->ad_end_date)->format('M d, Y').'</center>';
                            })
                            ->addColumn('status', function($ad){
                                $now = Carbon::now();
                                $sd = Carbon::parse($ad->ad_start_date);
                                $ed = Carbon::parse($ad->ad_end_date);
                                if($sd->lte($now) && $ed->gte($now)){
                                    return '<span class="label label-success">Ongoing</span>';
                                }elseif ($sd->gt($now) && $ed->gt($now)) {
                                    return '<span class="label label-primary">Upcoming</span>';
                                }elseif ($sd->lt($now) && $ed->lt($now)) {
                                    return '<span class="label label-danger">Past</span>';
                                }
                            })
                            ->addColumn('action', function($ad){                                
                                return '<center><a href="'.url('admin/ad/'.$ad->ad_id).'" class="btn btn-app" title="Edit Ad"><i class="fa fa-edit"></i>Edit</a>
                                        <a href="#" onclick="deleteAd('.$ad->ad_id.')" class="btn btn-app" title="Delete Ad"><i class="fa fa-trash"></i>Delete</a></center>';
                            })
                            ->rawColumns(['ad_title', 'date_range', 'status', 'action'])
                            ->make(true);
    }
    /**
     * Datatables - Get All Event/Tradeshow Registred members
     *
     * Fetch all users registred for a particular event in a table. <br>
     * \@param      integer      $event_id <br>
     * \@return     json 
     */
    public function dtEventRegs($event_id)
    {
        $regs = EventReg::where('event_id', $event_id)->latest()->get();
        return Datatables::of($regs)
                            ->editColumn('created_at', function($reg){
                                return $reg->created_at->format('M d, Y');
                            })
                            ->addColumn('action', function($reg){
                                return '<button class="btn btn-danger" onclick="deleteEventReg('.$reg->event_reg_id.')"><i class="fa fa-trash"></i></button>';
                            })
                            ->rawColumns(['action'])
                            ->make(true);
    }
    /**
     * Datatables - Get All Subscribers 
     *
     * Fetch all event/tradeshows in a table. <br>
     * \@return     json 
     */
    public function dtSubscribers()
    {
        $subscribers = Subscription::all();
        return Datatables::of($subscribers)
                            ->editColumn('created_at', function($sub){
                                return $sub->created_at->format('M d, Y');
                            })
                            ->editColumn('status', function($sub){
                                return ($sub->status == 'subscribed') ? '<label class="label label-success">Subscribed</label>' : '<label class="label label-danger">Unsubscribed</label>';
                            })
                            ->addColumn('action', function($sub){
                                return '<center><button class="btn btn-danger" onclick="deleteSagSubscriber('.$sub->sid.')"><i class="fa fa-trash"></i></button></center>';
                            })
                            ->rawColumns(['status', 'action'])
                            ->make(true);
    }
    // EMAILS
    /**
     * Send Mass Mail
     *
     * Mass Mail to event/tradeshow registred users
     * \@param      Request      $request <br>
     * \@return     void
     * ### Parameters
     * Parameter | Type | Status | Description 
     * --------- | ------- | ------- | ------- 
     * event_id | integer | required | Event or Tradehsow Id  
     * subject | string | required | Mail Subject
     * message | text | required | Mail Body 
     * 
     */
    public function sendMassEmail(Request $request)
    {
        $mail_to = EventReg::where('event_id', $request->input('event_id'))->first();
        $emails = EventReg::where('event_id', $request->input('event_id'))->get(['email']);
        $bcc = "";
        $massmail = [
            'subject' => $request->input('subject'),
            'message' => $request->input('message'),
        ];
        //return $massmail;
        // SEND MASS EMAIL
        foreach ($emails as $key => $value) {
            //Mail::to($value->email)->queue(new MassMail($massmail));
            if (! is_null($mail_to)) {
                if ($mail_to->email != $value->email) {
                    $bcc .= $value->email.', ';
                }
            }
        }
        $to = $mail_to->email;
        $subject = $request->input('subject');
        $txt = $request->input('message');
        $headers = "From: info@sag-biz.com \r\n" .
        "BCC: ".$bcc;
        
        mail($to,$subject,$txt,$headers);

        //Mail::to($massmail['to'])->bcc($massmail['bcc'])->send(new MassMail($massmail));
        return response()->json([
            'success' => true,
            'msg' => 'Email Sent to users.'
        ]);
    }
}
