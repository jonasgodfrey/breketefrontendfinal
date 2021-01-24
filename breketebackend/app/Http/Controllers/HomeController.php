<?php

namespace App\Http\Controllers;
use App\Models\Complaints;
use App\Models\Country;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\State;
use App\Models\Activites;
use App\Models\ComplaintType;
use App\Models\AwaitingReview;
use App\Http\Requests\UploadRequest;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\ComplaintUploads;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $countries = Country::all();
       $states = State::all();
       $complaint_types = ComplaintType::all();

        return view('index')->with([
            'countries' => $countries,
            'states' => $states,
            'complaint_types' => $complaint_types,
        ]);
    }



    public function store(Request $request)
    {
        $code = rand(100000,999999);
        $complaints = Complaints::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'state' => $request->state,
            'country' => $request->country,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'complaint_type' => $request->complaint_type,
            'complaint' => $request->complaint,
            'tracking_code' => $code,
            'complaint_status' => 'awaiting',
            'staff_assigned' => 'nil',
            'user_id' => 'nil',
            'year' => date('Y'),
            'month' => date('m')
        ]);

        $affidavit = $request->affidavit;
        $affidavit->store('photos/affidavit');
        $passport = $request->passport;
        $passport->store('photos/passport');
        $others = '';

        foreach ($request->others as $photo) {
            $others .= $photo.',';
            $photo->store('photos/other');
        }


        ComplaintUploads::create([
            'complaint_id' => $complaints->id,
            'passport' => $passport,
            'affidavit' => $affidavit,
            'others' => $others,
            'year' => date('Y'),
            'month' => date('m')
        ]);

        $awaiting_r = AwaitingReview::create([
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'state' => $request->state,
            'country' => $request->country,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'complaint_type' => $request->complaint_type,
            'complaint' => $request->complaint,
            'tracking_code' => $code,
            'complaint_status' => 'awaiting',
            'staff_assigned' => 'nil',
            'user_id' => 'nil',
            'year' => date('Y'),
            'month' => date('m')
        ]);
    Session::flash('flash_message', 'Complaint was submitted successfully \r\n
        your complaint tracking code is '.$code.'');
        return redirect(route('home'));
        
       
    }

    public function storeTestimonial(Request $request)
    {
        $testimonial = Testimonial::create([
            'name' => $request->name,
            'state' => $request->state,
            'phone_number' => $request->phone_number,
            'response' => $request->response,

        ]);

        if($testimonial){
        Session::flash('flash_message', 'Testimonial submitted successfully!!');
        return redirect(route('home'));
        }else{
        Session::flash('error_message', 'An error occured!!');
        return redirect(route('home'));
        }

      }
}
