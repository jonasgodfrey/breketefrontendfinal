<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\AwaitingReview;
use App\Models\Complaints;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;
use App\Models\ComplaintUploads;
use Illuminate\Support\Facades\Session;
use App\Models\Country;
use App\Models\State;
use App\Models\ComplaintType;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{

    public function index()
    {
        $auth = Auth::user();
        $complaints = count(DB::table('complaints')->where('user_id', $auth->id)->get());
        $complaint = DB::table('complaints')->where('user_id', $auth->id)->get();
        $pending = count(DB::table('complaints')->where('user_id', $auth->id )->where('complaint_status', 'pending')->get());
        $testimonial = count(Testimonial::all());
        $awaiting = count(AwaitingReview::all());
        $resolved = count(DB::table('resolved_complaints')->where('user_id', $auth->id )->get());

        return view('user.dashboard')->with([
        'awaiting' => $awaiting,
        'pending' =>  $pending,
        'complaints' => $complaints,
        'resolved' => $resolved,
        'complaint' => $complaint,    

        ]);

    }

    public function complaint_submit_view()
    {
        $countries = Country::all();
        $states = State::all();
        $complaint_types = ComplaintType::all();

        return view('user.add_complaints')->with([
            'countries' => $countries,
            'states' => $states,
            'complaint_types' => $complaint_types,
        ]);
    }

    public function complaint_view()
    {
                $auth = Auth::user();

                $complaint = DB::table('complaints')->where('user_id', $auth->id)->get();

        return view('user.complaints')->with([  
            
            'complaint' => $complaint,    
        ]);
    }
}
