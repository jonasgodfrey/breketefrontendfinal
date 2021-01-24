<?php
namespace App\Http\Controllers;
use App\Models\AwaitingReview;
use Illuminate\Http\Request;
use App\Models\Activites;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Complaints;
use App\Models\ComplaintUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\ResolvedComplaints;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;
use App\Models\FlaggedComplaints;


class AwaitingReviewController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $complaints = count(Complaints::all());
        $resolved = count(ResolvedComplaints::all());
        $pending = count(DB::table('complaints')->where('complaint_status', 'pending')->get());
        $testimonial = count(Testimonial::all());
        $awaiting = count(AwaitingReview::all());
        $flagged = count(FlaggedComplaints::all());

         $complaint = AwaitingReview::orderBY('id', 'DESC')->get();;
            return view('admin.awaiting_review.view')->with([
            'complaint' => $complaint,
            'awaiting' => $awaiting,
            'pending' =>  $pending,
            'resolved' => $resolved,
            'complaints' => $complaints,
            'testimonial' => $testimonial,
            'flagged' => $flagged
        ]);
    }

    public function valid($id)
    {
        // $pending = AwaitingReview::where('id', $id)->get()->toArray();
        // foreach ($pending as $item)
        // {
        //     PendingComplaints::insert($item);
        // }

        AwaitingReview::where('id', $id)->delete();
        Complaints::where('id', $id)->update(['complaint_status' => 'pending']);

        $complaint = Complaints::select('tracking_code')->where('id', $id)->get();
        $code = implode(' ', $complaint->pluck('tracking_code')->toArray()) ;
        $auth = Auth::user();

        Activites::create([
                'description' =>$auth->name.' updated complaint status, Complaint tracking code:' . $code,
                'username' => $auth->name,
                'privilage' => implode(' ', $auth->roles->pluck('name')->toArray()),
                'status' => 'pending'
        ]);

        Session::flash('flash_message', 'Complaint is now valid');
        return redirect(route('awaiting'));
    }
    public function invalid(Request $request, $id)
    {

        $images = ComplaintUploads::where('complaint_id', $id)->get();
        foreach($images as $image){
            if(Storage::delete($image->filename)){
                Complaints::where('id', $id)->delete();
                AwaitingReview::where('id', $id)->delete();
            };
        }
        $track = Complaints::where('id', $id)->get();
        $code = implode(' ', $track->pluck('tracking_code')->toArray());
        $auth = Auth::user();
        Activites::create([
                'description' =>$auth->name.' declared complaint invalid,Complaint Tracking code:'. $code,
                'username' => $auth->name,
                'privilage' => implode(' ', $auth->roles->pluck('name')->toArray()),
                'status' => 'pending'
        ]);

        Session::flash('flash_message', 'Complaint is invalid');
        return redirect(route('awaiting'));
    }

    public function flagged(Request $request, $id)
    {




        Complaints::where('id', $id)->update(['complaint_status' => 'flagged']);
        $complaint = Complaints::where('id', $id)->get();
        Complaints::find($id)->replicate()->setTable('flagged_complaints')->save();
        AwaitingReview::where('id', $id)->delete();
        $track = Complaints::where('id', $id)->get();
        $code = implode(' ', $track->pluck('tracking_code')->toArray());
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
