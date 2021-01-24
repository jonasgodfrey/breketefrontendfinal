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
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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

    public function status(Request $request)
    {
        $key = trim($request->get('code'));
        $tracking_code =  DB::table('complaints')->where('tracking_code', $key)->get();

        return view('status')->with([
            'details' => $tracking_code,
        ]);
    }

    public function store(Request $request)
    {
        function generate_string($input, $strength = 16)
        {
            $input_length = strlen($input);
            $random_string = '';
            for ($i = 0; $i < $strength; $i++) {
                $random_character = $input[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }

            return $random_string;
        }
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code =  generate_string($permitted_chars, 7);
        $affidavit = $request->file('affidavit')->store('photos/affidavit');
        $passport = $request->file('passport')->store('photos/passport');
   

        $others = '';
        foreach ($request->others as $photo) {
            $other = $photo->store('photos/other');
            $others .= $other . ',';

        }

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
            'passport' => $passport,
            'affidavit' => $affidavit,
            'others' => $others,
            'year' => date('Y'),
            'month' => date('m'),
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
            'passport' => $passport,
            'affidavit' => $affidavit,
            'others' => $others,
            'year' => date('Y'),
            'month' => date('m'),
        ]);
        Session::flash(
            'flash_message',
            'Complaint was submitted successfully. Your complaint tracking code is ' .
                $code .
                '. Please copy and Keep your complaint tracking code safe.'
        );
        return redirect(route('home'));
    }



    public function complaint_submit_store(Request $request){
        
        function generate_string($input, $strength = 16)
        {
            $input_length = strlen($input);
            $random_string = '';
            for ($i = 0; $i < $strength; $i++) {
                $random_character = $input[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }

            return $random_string;
        }
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code =  generate_string($permitted_chars, 7);
        $affidavit = $request->file('affidavit')->store('photos/affidavit');
        $passport = $request->file('passport')->store('photos/passport');
   

        $others = '';
        foreach ($request->others as $photo) {
            $other = $photo->store('photos/other');
            $others .= $other . ',';


        }
        $auth = Auth::user();

        $complaints = Complaints::create([
            'name' => $auth->name,
            'email' => $auth->email,
            'gender' => $request->gender,
            'state' => $request->state,
            'country' => $request->country,
            'address' => $request->address,
            'phone_number' => $auth->tel_number,
            'complaint_type' => $request->complaint_type,
            'complaint' => $request->complaint,
            'tracking_code' => $code,
            'complaint_status' => 'awaiting',
            'staff_assigned' => 'nil',
            'user_id' => $auth->id,
            'passport' => $passport,
            'affidavit' => $affidavit,
            'others' => $others,
            'year' => date('Y'),
            'month' => date('m'),
        ]);


        $awaiting_r = AwaitingReview::create([
           'name' => $auth->name,
            'email' => $auth->email,
            'gender' => $request->gender,
            'state' => $request->state,
            'country' => $request->country,
            'address' => $request->address,
            'phone_number' => $auth->tel_number,
            'complaint_type' => $request->complaint_type,
            'complaint' => $request->complaint,
            'tracking_code' => $code,
            'complaint_status' => 'awaiting',
            'staff_assigned' => 'nil',
            'user_id' => $auth->id,
            'passport' => $passport,
            'affidavit' => $affidavit,
            'others' => $others,
            'year' => date('Y'),
            'month' => date('m'),
        ]);

        Session::flash('flash_message','Success. Complaint Tracking Code:'.$code.'.');
        return redirect(route('complaint.submit'));    

    }


    public function storeTestimonial(Request $request)
    {
        $testimonial = Testimonial::create([
            'name' => $request->name,
            'state' => $request->state,
            'phone_number' => $request->phone_number,
            'response' => $request->response,
        ]);

        if ($testimonial) {
            Session::flash(
                'flash_message',
                'Testimonial submitted successfully!!'
            );
            return redirect(route('home'));
        } else {
            Session::flash('error_message', 'An error occured!!');
            return redirect(route('home'));
        }
    }
}
