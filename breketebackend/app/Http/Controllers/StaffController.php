<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Status;
use App\Models\Activites;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AwaitingReview;
use App\Models\Complaints;
use App\Models\FlaggedComplaints;
use App\Models\ResolvedComplaints;
use App\Models\Testimonial;
use App\Models\Staffs;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints = count(Complaints::all());
        $resolved = count(ResolvedComplaints::all());
        $pending = count(DB::table('complaints')->where('complaint_status', 'pending')->get());
        $testimonial = count(Testimonial::all());
        $awaiting = count(AwaitingReview::all());
        $flagged = count(FlaggedComplaints::all());
        $testimonials = Testimonial::all();

        $recent_activites = Activites::where('status', 'pending')->orderBY('id', 'DESC')
        ->limit(7)
        ->get();

        $total_activity = count(Activites::all()->where('status', 'pending'));
        $staffs = Staffs::all();


        return view('admin.staffs.index')->with([
            'staffs' => $staffs,
            'recent_activites' => $recent_activites,
            'total_activity' => $total_activity,
            'awaiting' => $awaiting,
            'pending' =>  $pending,
            'resolved' => $resolved,
            'complaints' => $complaints,
            'testimonial' => $testimonial,
            'flagged' => $flagged
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('manage-users')) {
            return redirect(route('staffs.view'));
        }

        return view('admin.staffs.create')->with([

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:staffs',
            ],
            'phonenumber' => ['required', 'string', 'min:10',],
            'position' => ['required', 'string', 'max:255'],
        ]);
        $validator->validate();

        $user = Staffs::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phonenumber,
            'position' => $request->position,

        ]);
        $auth = Auth::user();

        Activites::create([
            'description' =>$auth->name.' Added ' . $request->name . ' to the staffs table',
                'username' => $auth->name,
                'privilage' => implode(' ', $auth->roles->pluck('name')->toArray()),
                'status' => 'pending'

        ]);

        Session::flash('flash_message', 'New Staff successfully added!');
        return redirect(route('staffs.view'));
      }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//         if (Gate::denies('manage-user')) {
//             return redirect(route('users.view'));
//         }

        $staff = Staffs::findOrFail($id);

        return view('admin.staffs.edit')->with([
            'staff' => $staff,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

        Staffs::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phonenumber,
            'position' => $request->position,
        ]);

            $auth = Auth::user();
            Activites::create([
                'description' =>$auth->name.' updated staff '. $request->name .' details',
                'username' => $auth->name,
                'privilage' => implode(' ', $auth->roles->pluck('name')->toArray()),
                'status' => 'pending'
            ]);


        Session::flash('flash_message', 'Staff updated successfully!');
        return redirect(route('staffs.view'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //checkcsd
        // if (Gate::denies('delete')) {
        //     return redirect(route('users.view'));
        // }
        $username = DB::table('staffs')
            ->where('id', $id)
            ->pluck('name')
            ->toArray();
        $name = implode(' ', $username);
        $auth = Auth::user();
        Activites::create([
            'description' => $auth->name.' removed '.$name.' from the staffs table',
            'username' => $auth->name,
            'privilage' => implode(' ', $auth->roles->pluck('name')->toArray()),
            'status' => 'pending'
        ]);

        $staff = Staffs::findOrFail($id);
        $staff->delete();
        Session::flash('flash_message', 'Staff Deleted successfully');
        return redirect()->back();
    }


}
