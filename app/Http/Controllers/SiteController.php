<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Event;
use App\EventReg;
use App\EventHost;
use App\Subscription;
use Carbon\Carbon;
use Yajra\Datatables\Datatables;
use App\Mail\EventRegistration;
use App\Mail\ContactSag;
use Mail;

class SiteController extends Controller
{
    public function returnEventsOrTradeshows($id)
    {
        $results = [
            'events' => Event::where('event_type', $id)->where('enabled', '1')->latest()->get(),
            'ongoing' => Event::where('event_type', $id)->where('enabled', '1')
                         ->where('start_date', '<=', Carbon::now())
                         ->where('end_date', '>=', Carbon::now())
                         ->latest()->get(),
            'upcoming' => Event::where('event_type', $id)->where('enabled', '1')
                         ->where('start_date', '>', Carbon::now())
                         ->where('end_date', '>', Carbon::now())
                         ->latest()->get(),
            'past' => Event::where('event_type', $id)->where('enabled', '1')
                         ->where('start_date', '<', Carbon::now())
                         ->where('end_date', '<', Carbon::now())
                         ->latest()->get(),
        ];
        return $results;
    }
    public function returnaSingleEventOrTradeshow($event_id, $type)
    {
    	// determine if event is ongoing/upcoming/past
        $event = Event::find($event_id);
        $status = '';
        $related_events = array();
        $now = Carbon::now();
        if ($now->gte(Carbon::parse($event->start_date)) && $now->lte(Carbon::parse($event->end_date))){
            $status = 'ongoing';
            $related_events = Event::where('event_type', $type)->where('event_id', '!=', $event_id)->where('enabled', '1')
                             ->where('start_date', '<=', $now)
                             ->where('end_date', '>=', $now)
                             ->latest()->get();
        }   
        if ($now->lt(Carbon::parse($event->start_date))&& $now->lt(Carbon::parse($event->end_date))){
         $status = 'upcoming';
         $related_events = Event::where('event_type', $type)->where('event_id', '!=', $event_id)->where('enabled', '1')
                         ->where('start_date', '>', $now)
                         ->where('end_date', '>', $now)
                         ->latest()->get();
        }
        if ($now->gt(Carbon::parse($event->start_date)) && $now->gt(Carbon::parse($event->end_date))){
            $status = 'past';
            $related_events = Event::where('event_type', $type)->where('event_id', '!=', $event_id)->where('enabled', '1')
                             ->where('start_date', '<', $now)
                             ->where('end_date', '<', $now)
                             ->latest()->get();
        } 
        $d1 = explode(" ", $event->start_date);
        $d2 = explode(" ", $event->end_date);
        $registered_so_far = EventReg::where('event_id', $event_id)->count(); // people registred for this event/tradeshow
        $results = [
            'type' => ($type == 1) ? 'event' : 'tradeshow',
            'event' => $event,
            'event_status' => $status,
            'registered_so_far' => $registered_so_far,
            'show_reg_form' => (($event->availability == 'unlimited' || $registered_so_far < $event->max_guest) && $status!='past') ? true : false,
			'related_events' => $related_events,
            'date_range' => Carbon::parse($d1[0])->format('M d, Y')." - ".Carbon::parse($d2[0])->format('M d, Y'),
            'event_images' => Storage::disk('events')->files($event_id.'/images/')
		];
		return $results;
    }
    public function returnLatestEvents($limit)
    {
        $results = [
            'total' => Event::where('enabled', '1')->count(),
            'latest_events' => Event::where('event_type', 1)->where('enabled', '1')->latest()->limit($limit)->get(),
            'latest_tradeshows' => Event::where('event_type', 2)->where('enabled', '1')->latest()->limit($limit)->get()
        ];
        return $results;
    }
    public function welcome()
    {
        if (Auth::check()) {
            return redirect('home');
        }
        $results = $this->returnLatestEvents(3);
        return view('welcome', compact('results'));
    }
    public function sagEvents()
    {
		$page_title = "Event";
		//$allEvents = Event::latest()->get();
		$results = $this->returnEventsOrTradeshows(1);
		return view('events', compact('page_title', 'results'));
    }
    public function sagTradeshow()
    {
		$page_title = "Tradeshow";
		$results = $this->returnEventsOrTradeshows(2);
		return view('events', compact('page_title', 'results'));
    }
    public function sagGallery()
    {
        $galleries = [
            'events' => Storage::disk('gallery')->files('events'),
            'tradeshows' => Storage::disk('gallery')->files('tradeshows'),
            'public_parks' => Storage::disk('gallery')->files('public-parks'),
            'txt_and_stationary' => Storage::disk('gallery')->files('textile-and-stationary-products')
        ];
        $no_gallery_photo = count($galleries['events']) + count($galleries['tradeshows']) + count($galleries['public_parks']) + count($galleries['txt_and_stationary']);
        return view('gallery', compact('galleries', 'no_gallery_photo'));
    }
    public function showEvent($slug)
    {
        $page_title = "";
        $event = Event::findBySlug($slug);
        if (is_null($event)) {
            abort(404);
        }else{
            $page_title = ($event->event_type == 1) ? 'Event':'Tradeshow';
            $events = Event::where('event_type', $event->event_type)->latest()->get();
            $eventHosts = EventHost::latest()->get();
            $results = $this->returnaSingleEventOrTradeshow($event->event_id, $event->event_type);
            return view('event', compact('page_title', 'results'));
        }
    }
    public function contactSag(Request $request)
    {
        $message = [
            'subject' => 'Contact SAG Biz',
            'contacted_by' => $request->input('senderName'),
            'contact_email' => $request->input('senderEmail'),
            'body' => $request->input('message')
        ];
        //Mail::to('kingleon2015@gmail.com')->send(new ContactSag($message));

        $to = "kingleon2015@gmail.com";
        $subject = "Contact SAG Biz";
        $txt = $request->input('message');
        $headers = "From: ". $request->input('senderEmail') . "\r\n";// .
        //"BCC: kingleoninc@gmail.com, libtesfaye@yahoo.com";
        
        mail($to,$subject,$txt,$headers);
        return redirect('contact')->with('success', 'Thanks for contacting us. We\'ve recieved your message.');
    }
    public function registerForAnEvent(Request $request)
    {
        $response = array();
        $event = Event::find($request->input('event_id'));

        if (is_null($event)) {
            $response = [
                'success' => false,
                'type' => $request->input('event_type'),
                'msg' => 'Such '.$request->input('event_type').' doesnot exist.'
            ];
        }
        $checkReg = EventReg::where('event_id', $request->input('event_id'))->where('email', $request->input('senderEmail'))->count();
        if ($checkReg) {
            // trying to register twice for the same event.
            $response = [
                'success' => false,
                'type' => $request->input('event_type'),
                'msg' => 'It looks like someone with the same email address "'.$request->input('senderEmail').'" has registered for this '.$request->input('event_type').'.'
            ];
        }else{
            // REGISTER USER
            $register = EventReg::create([
                'event_id' => $request->input('event_id'), 
                'name' => $request->input('senderName'),
                'gender' => $request->input('gender'), 
                'email' => $request->input('senderEmail'),
                'phone' => $request->input('senderPhone'),
                'bdate' => Carbon::now(),
                'company'  => ($request->input('senderCompany') == "") ? "" : $request->input('senderCompany'),         
                'enabled' => 1,
            ]);
            // SUBSCRIBE USER
            $subscription = Subscription::where('email', $register->email)->count();
            if ($subscription == 0) {
                // NEW SUBSCRIBER
                $subscribe = Subscription::create([
                    'name' => $register->name, 
                    'email' => $register->email, 
                    'status' => 'subscribed', 
                    'enabled' => 1
                ]);
            }
            $response = [
                'success' => true,
                'msg' => 'You have registered for this '.$request->input('event_type').' successfully.',
                'event' => $event,
                'type' => $request->input('event_type'),
                'registred_by' => $register,
                'registered_so_far' => EventReg::where('event_id', $event->event_id)->count(),
                'date_range' => Carbon::parse($event->start_date)->format('M d, Y')." - ".Carbon::parse($event->end_date)->format('M d, Y')
            ];
            //Mail::to($register->email)->queue(new EventRegistration($event));
            $to = $register->email;
            $subject = $request->input('event_type')." Registration.";

            $message = '
            <html>
                <head>
                    <title>'.$subject.'</title>
                    <style>
                        table {
                            border-collapse: collapse;
                            width: 100%;
                        }
                        
                        th, td {
                            padding: 8px;
                            text-align: left;
                            border-bottom: 1px solid #ddd;
                        }
                    </style>
                </head>
                <body>
                    <p>Thanks for registering to this '.$request->input('event_type').'!</p>
                    <table>
                        <tr>
                            <th>'.$request->input('event_type').'</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Price</th>
                        </tr>
                        <tr>
                            <td>'.$event->title.'</td>
                            <td>'.Carbon::parse($event->start_date)->format('m/d/Y').'</td>
                            <td>'.Carbon::parse($event->end_date)->format('m/d/Y').'</td>
                            <td>ETB '.$event->price.'</td>
                        </tr>
                    </table>
                </body>
            </html>
            ';

            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

            // More headers
            $headers .= 'From: info@sag-biz.com' . "\r\n";
            //$headers .= 'Cc: myboss@example.com' . "\r\n";

            mail($to,$subject,$message,$headers);
        }

        return view('registrations', compact('response'));
    }
    public function newsletterSubscription(Request $request)
    {
        //return $request->all();
        $exists = Subscription::where('email', $request->input('email'))->first();
        if (is_null($exists)) {
            // NEW SUBSCRIBER
            Subscription::create([
                'name' => ($request->input('name') == "") ? "" : $request->input('name'), 
                'email' => $request->input('email'), 
                'status' => 'subscribed', 
                'enabled' => 1
            ]);        
        }else{
            // UPDATE ALREADY EXISTING SUBSCRIBER
            $exists->update([
                'name' => ($request->input('name') == "") ? "" : $request->input('name'), 
                'email' => $request->input('email'), 
                'status' => 'subscribed', 
                'enabled' => 1
            ]);
        }
        return response()->json([
            'success' => true,
            'msg' => 'Thanks for subscribing, You will have instant messages and notification right to your inbox.'
        ]);
    }
}
