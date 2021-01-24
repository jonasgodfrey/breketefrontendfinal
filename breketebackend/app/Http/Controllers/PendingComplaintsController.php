<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaints;
use App\Models\Activites;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\AwaitingReview;
use App\Models\FlaggedComplaints;
use App\Models\ResolvedComplaints;
use App\Models\Staffs;
use App\Models\Testimonial;


class PendingComplaintsController extends Controller
{
     public function index()
    {
        $complaint = Complaints::where('complaint_status', 'pending')->orderBY('id', 'DESC')->get();
        $staffs = Staffs::all();

        $complaints = count(Complaints::all());
        $resolved = count(ResolvedComplaints::all());
        $pending = count(DB::table('complaints')->where('complaint_status', 'pending')->get());
        $testimonial = count(Testimonial::all());
        $awaiting = count(AwaitingReview::all());
        $flagged = count(FlaggedComplaints::all());

        return view('admin.pending_complaints.index')->with([
            'complaint' => $complaint,
            'awaiting' => $awaiting,
            'pending' =>  $pending,
            'resolved' => $resolved,
            'complaints' => $complaints,
            'testimonial' => $testimonial,
            'flagged' => $flagged,
            'staffs' => $staffs
        ]);
    }

    public function assign_staff(Request $request, $id)
    {
        Complaints::where('id', $id)->update(['staff_assigned' => $request->staff_name]);

        $auth = Auth::user();

        Activites::create([
            'description' =>$auth->name.' Assigned staff to a complaint.',
            'username' => $auth->name,
            'privilage' => implode(' ', $auth->roles->pluck('name')->toArray()),
            'status' => 'pending'
        ]);

        Session::flash('flash_message', 'staff added to complaint');
        return redirect(route('pending'));
    }

    public function resolve(Request $request, $id)
    {
        $complaint = Complaints::where('id', $id)->get();
        Complaints::where('id', $id)->update(['complaint_status' => 'resolved']);
        Complaints::find($id)->replicate()->setTable('resolved_complaints')->save();

        $code = implode('', $complaint->pluck('tracking_code')->toArray());
        $auth = Auth::user();

        Activites::create([
            'description' =>$auth->name.' Resolved a complaint, Complaint Tracking code:'. $code,
            'username' => $auth->name,
            'privilage' => implode(' ', $auth->roles->pluck('name')->toArray()),
            'status' => 'pending'
        ]);

        Session::flash('flash_message', 'Complaint has been resolved');
        return redirect(route('pending'));
    }
    public function flagged(Request $request, $id)
    {


        $complaint = Complaints::where('id', $id)->get();

        DB::table('complaints')->where('id', $id)
            ->update(['complaint_status' => 'flagged',]);

        Complaints::find($id)->replicate()->setTable('flagged_complaints')->save();
        $code = implode('', $complaint->pluck('tracking_code')->toArray());
        $auth = Auth::user();
        Activites::create([
            'description' =>$auth->name.' flagged a complaint, Complaint Tracking code:'. $code,
            'username' => $auth->name,
            'privilage' => implode(' ', $auth->roles->pluck('name')->toArray()),
            'status' => 'pending'
        ]);

        Session::flash('flash_message', 'Complaint has been flagged');
        return redirect(route('awaiting'));
    }
}
