<?php

namespace App\Http\Controllers;

use App\Models\ResolvedComplaints;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Status;
use App\Models\Activites;
use App\Models\AwaitingReview;
use App\Models\Complaints;
use App\Models\FlaggedComplaints;
use App\Models\Testimonial;
use Illuminate\Support\Facades\DB;

class ResolvedComplaintsController extends Controller
{
     public function index()
    {
        $complaints = count(Complaints::all());
        $resolved = count(ResolvedComplaints::all());
        $pending = count(DB::table('complaints')->where('complaint_status', 'pending')->get());
        $testimonial = count(Testimonial::all());
        $awaiting = count(AwaitingReview::all());
        $flagged = count(FlaggedComplaints::all());
        $resolvedt = ResolvedComplaints::all();
        
        return view('admin.resolved_complaints.index')->with([
            'resolvedt' => $resolvedt,
            'awaiting' => $awaiting,
            'pending' =>  $pending,
            'resolved' => $resolved,
            'complaints' => $complaints,
            'testimonial' => $testimonial,
            'flagged' => $flagged
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email_address' => 'sometimes|required|email|unique:users',
            'role_id' => '',
            'status_id' => '',
            'gender' => [],
        ]);

        $validator->validate();

        // if (Gate::denies('add')) {
        //     return redirect(route('users.view'));
        // }

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'status_id' => $request->status_id,
        ]);

        DB::table('role_user')
            ->where('id', $id)
            ->update([
                'role_id' => $request->role_id,
            ]);


            $auth = Auth::user();
            Activites::create([
                'description' =>$auth->name.' updated user '. $request->name .' details',
                'username' => $auth->name,
                'privilage' => implode(' ', $auth->roles->pluck('name')->toArray()),
                'status' => 'pending'


            ]);


        Session::flash('flash_message', 'User updated successfully!');
        return redirect(route('users.view'));
    }

}
