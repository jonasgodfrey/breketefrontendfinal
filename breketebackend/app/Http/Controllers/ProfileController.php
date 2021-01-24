<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Status;
use App\Models\Activites;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\AwaitingReview;
use App\Models\Complaints;
use App\Models\FlaggedComplaints;
use App\Models\ResolvedComplaints;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function viewProfile()
    {
        $complaints = count(Complaints::all());
        $resolved = count(ResolvedComplaints::all());
        $pending = count(DB::table('complaints')->where('complaint_status', 'pending')->get());
        $testimonial = count(Testimonial::all());
        $awaiting = count(AwaitingReview::all());
        $flagged = count(FlaggedComplaints::all());

        $user = Auth::user();
        return view('admin.profile.index')->with(
            [
                'user' => $user,
                'awaiting' => $awaiting,
                'pending' =>  $pending,
                'resolved' => $resolved,
                'complaints' => $complaints,
                'testimonial' => $testimonial,
                'flagged' => $flagged
            ]
        );
    }

    //dashboard profile page
    public function index()
    {

        if (Gate::denies('manage')) {
            return redirect(route('profile'));
        }

        $user = Auth::user();
        return view('backend.profile.index')->with(['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->get(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => 'required',
            'gender' => ['required','string','max:20'],
            'image' => 'required',
            'dob' => 'required',
            'role_id' => '',
            'status_id' => '',
        ]);

        $validator->validate();

        $user = User::create([
            'name' => $request->name,

        ]);

        $role_id = $request->role_id;
        $user->roles()->attach($role_id);
        $auth = Auth::user();

        Activites::create([
            'description' =>$auth->name.' Added ' . $request->name . ' to the users table',
            'username' => $auth->name,
            'privilage' => implode(' ', $auth->roles->pluck('name')->toArray()),
            'status' => 'pending'

        ]);

        Session::flash('flash_message', 'New User successfully added!');
        return redirect()->back();
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
        if (Gate::denies('manage-user')) {
            return redirect(route('profile'));
        }

        $user = User::findOrFail($id);

        return view('backend.profile.edit')->with([
            'user' => $user,


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
        validator(
            [
                'name' => ['required', 'string', 'max:255'],
                'phone_number' => 'required',
                'gender' => ['rewuired','string','max:20'],
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'date_of_birth' => 'required',

            ]);
        $img_url = User::findOrFail($id)->image;

        //if image isn't changed

        if ($request->image == '' ) {
            $update = User::where('id', $id)->update(
                [
                    'name' => $request->name,
                    'phone_number' => $request->phone_number,
                    'gender' => $request->gender,
                    //'image' => $base_url. '/uploads'. '/'. $imageName,
                    'date_of_birth' => $request->date_of_birth,
                ]

            );

            $auth = Auth::user();
            if ($update) {
                Activites::create([
                    'description' => $auth->name.' edited user profile '.$request->name.' details',
                    'username' => $auth->name,
                    'privilage' => implode(' ', $auth->roles->pluck('name')->toArray()),
                    'status' => 'pending'
                ]);
                Session::flash('flash_message', ' user profile details edited successfully!');
                return redirect(route('profile'));
            } else {
                Session::flash('error_message', 'User profile was not edited!');
                return redirect()->back();
            }
        }
        $base_url = \URL::to('/');
        //replace spaces with dash in shortname
        $name = preg_replace('/[[:space:]]+/', '-', $request->name);

        //upload picture

        $imageName = $name .time().'.'
            .$request->image->getClientOriginalExtension();

        $upload = $request->image->move('uploads', $imageName);

        if ($upload) {
            $update= User::where('id', $id)->update(
                [
                    'name' => $request->name,
                    'phone_number' => $request->phone_number,
                    'gender' => $request->gender,
                    'image' => $base_url. '/uploads'. '/'. $imageName,
                    'date_of_birth' => $request->date_of_birth,


                ]
            );
            $auth = Auth::user();

            if ($update) {

                Activites::create([
                    'description' => $auth->name.' edited user profile with '.$request->name.' details',
                    'username' => $auth->name,
                    'privilage' => implode(' ', $auth->roles->pluck('name')->toArray()),
                    'status' => 'pending'
                ]);
                Session::flash('flash_message', ' user profile details edited successfully!');
                return redirect(route('profile'));
            } else {
                Session::flash('error_message', ' user profile was not edited!');
                return redirect()->back();
            }
        } else {
            Session::flash('error_message', ' Image was not uploaded!');
            return redirect()->back();
        }


    }

    public function updatePassword(Request $request, $id)
    {
        if (Gate::denies('add')) {
            return redirect(route('profile'));
        }

        $validator = Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $validator->validate();
        $update = User::where('id', $id)->update([
            'password' => Hash::make($request->password),
        ]);
        Session::flash('flash_message', 'User has Successfully changed password!');
        return redirect()->back();
    }
}
