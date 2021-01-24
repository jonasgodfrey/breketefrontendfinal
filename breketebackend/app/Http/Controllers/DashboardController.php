<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\AwaitingReview;
use App\Models\Complaints;
use App\Models\FlaggedComplaints;
use App\Models\ResolvedComplaints;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $auth = Auth::user();
        $role = implode(' ', $auth->roles->pluck('name')->toArray());
        $complaints = count(Complaints::all());
        $resolved = count(ResolvedComplaints::all());
        $pending = count(DB::table('complaints')->where('complaint_status', 'pending')->get());
        $testimonial = count(Testimonial::all());
        $awaiting = count(AwaitingReview::all());
        $flagged = count(FlaggedComplaints::all());

        if ($role === ("SuperAdmin") || $role === ("Admin")) {
             return view('admin.home')->with([
            'awaiting' => $awaiting,
            'pending' =>  $pending,
            'resolved' => $resolved,
            'complaints' => $complaints,
            'testimonial' => $testimonial,
            'flagged' => $flagged
            ]);
        }
        elseif ($role === "ComplaintAttendant"){
            return view('admin.dashboards.complaint')->with([
            'awaiting' => $awaiting,
            'complaints' => $complaints,
            ]);
        }
        elseif ($role === "ResolutionAttendant"){
            return view('admin.dashboards.resolve')->with([
            'pending' =>  $pending,
            'resolved' => $resolved,
            'complaints' => $complaints,
            ]);

        }else{
            return redirect(route('home'));
        }

    }
}
