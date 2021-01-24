<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class TestimonialsController extends Controller
{

    public function viewTestimonial()    {
        

        return view('user.testimonial')->with([
           
        ]);
    }

 public function storeTestimonial(Request $request)
    {
        $code = rand(100000, 999999);
        
        $testimonial = Testimonial::create([
            'name' => $request->tname,            
            'address' => $request->address,
            'phone_number' => $request->tel,            
            'response' => $request->testimony,
            
        ]);

        
        Session::flash(
            'flash_message',
            'Testimonial was submitted successfully.' 
                
        );
        return redirect(route('home'));
    }

    public function saveTestimonial(Request $request)    {
      
        $auth = Auth::user();
        
        $testimonial = Testimonial::create([
            'name' => $auth->name,            
            'address' => $request->address,
            'phone_number' => $auth->tel_number,            
            'response' => $request->testimony,
            
        ]);

        
        Session::flash(
            'flash_message',
            'Testimonial was submitted successfully.' 
                
        );
        return redirect(route('dashboard.index'));
    }

}
