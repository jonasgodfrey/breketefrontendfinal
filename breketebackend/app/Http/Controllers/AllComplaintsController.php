<?php

namespace App\Http\Controllers;
use App\Models\Complaints;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Status;
use App\Models\Activites;
use Illuminate\Support\Facades\DB;
use App\Models\AwaitingReview;
use App\Models\FlaggedComplaints;
use App\Models\ResolvedComplaints;
use App\Models\Testimonial;

class AllComplaintsController extends Controller
{
    public function index()
    {
        $complaints = count(Complaints::all());
        $resolved = count(ResolvedComplaints::all());
        $pending = count(DB::table('complaints')->where('complaint_status', 'pending')->get());
        $testimonial = count(Testimonial::all());
        $awaiting = count(AwaitingReview::all());
        $flagged = count(FlaggedComplaints::all());
        $complaint = DB::select('select * from complaints where not complaint_status = ?', ['flagged']);

        return view('admin.complaints.index')->with([
            'complaint' => $complaint,
            'awaiting' => $awaiting,
            'pending' =>  $pending,
            'resolved' => $resolved,
            'complaints' => $complaints,
            'testimonial' => $testimonial,
            'flagged' => $flagged
        ]);
    }

}
