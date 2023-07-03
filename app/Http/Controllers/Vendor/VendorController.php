<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{

    public function vendorDashboard()
    {
        //

        return view('vendor.index');
    }


     // redirect vendor to vendor login Page

     public function vendorLogin()
     {
         //
 
         return view('vendor.vendor_login');
     }

     // Redirct vendor to vendor Profile
    public function vendorProfile()
    {
        //
        $id = Auth::user()->id;
        $vendorData = User::find($id);
        return view('vendor.vendor_profile')->with('vendorData',$vendorData);
       // return view('admin.admin_profile',compact('adminData'));
    }


    public function vendorProfileUpdate(Request $request){

        // Validation 
       $request->validate([
                'name' => 'required',
                'username' => 'required', 
                'email' => 'required', 
                'phone' => 'required', 
                'address' => 'required', 
                 ]);

        $id = Auth::user()->id;
        $data = User::find($id);

        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->short_description = $request->short_description; 
        $data->website = $request->website;
        $data->facebook = $request->facebook;
        $data->twitter= $request->twitter;
        $data->instagram = $request->instagram;


        if ($request->file('photo')) {
            $file = $request->file('photo');
            //delete Existing image
            @unlink(public_path($data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/vendor_images'),$filename);
            $data['photo'] = 'uploads/vendor_images/'.$filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Vendor Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Mehtod 

    public function vendorChangePassword(){
        return view('vendor.vendor_change_password');
    } // End Mehtod




    public function vendorUpdatePassword(Request $request){

        // Validation 
        $request->validate([
                 'old_password' => 'required',
                 'new_password' => 'required|confirmed', 
                 // both right : 'new_password' => 'required_with:new_password_confirmation|same:new_password_confirmation'
             ]);
  
 
             // Match The Old Password
         if (!Hash::check($request->old_password, auth::user()->password)) {
             return back()->with("error", "Old Password Doesn't Match!!");
         }
 
          // Update The new password 
          User::whereId(auth()->user()->id)->update([
             'password' => Hash::make($request->new_password)
 
         ]);
 
 
         return back()->with("status", " Password Changed Successfully");
       
 
         
     } // End Mehtod 


     public function becomeVendor()
     {
         //
 
         return view('vendor.become_vendor');
     } // End Mehtod

     public function VendorRegister(Request $request) {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'address' => ['required', 'string'],
            'password' => ['required', 'confirmed'],
        ]);

        $user = User::insert([ 
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'status' => 'inactive',
            'created_at'=> now(),
        ]);

          $notification = array(
            'message' => 'Vendor Registered Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.login')->with($notification);

    }// End Mehtod 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        //
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
       
        //return redirect('/') route to login page
        //return redirect()->route('welcome');
       return redirect()->route('vendor.login');
       // return redirect('/vendor/login');
    }
}
