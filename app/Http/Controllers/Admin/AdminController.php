<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{

    // log admin to admin Dashboard
    public function adminDashboard()
    {
        //

        return view('admin.index');
    }

    // redirect admin to admin login Page

    public function adminLogin()
    {
        //

        return view('admin.admin_login');
    }

    // Redirct admin to admin Profile
    public function adminProfile()
    {
        //
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile')->with('adminData',$adminData);
       // return view('admin.admin_profile',compact('adminData'));
    }


    public function AdminProfileUpdate(Request $request){

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
        $data->website = $request->website;
        $data->facebook = $request->facebook;
        $data->twitter= $request->twitter;
        $data->instagram = $request->instagram;


        if ($request->file('photo')) {
            $file = $request->file('photo');
            //delete Existing image
            @unlink(public_path($data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('uploads/admin_images'),$filename);
            $data['photo'] = 'uploads/admin_images/'.$filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Mehtod 

    public function adminChangePassword(){
        return view('admin.admin_change_password');
    } // End Mehtod 

    public function adminUpdatePassword(Request $request){

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

    public function getInActiveVendors(Request $request)
    {
        //
        $inActiveVendor = User::where('role','vendor')->where('status','inactive')->latest()->get();
        return view('backend.vendor.inactive_vendor',compact('inActiveVendor'));
    }

    public function getActiveVendors(Request $request)
    {
        //
        $activeVendor = User::where('role','vendor')->where('status','active')->latest()->get();
        return view('backend.vendor.active_vendor',compact('activeVendor'));
    }

    public function InactiveVendorDetails($id){

        $inactiveVendorDetails = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details',compact('inactiveVendorDetails'));

    }// End Mehtod 

    
    public function activateVendor(Request $request){

        $verdor_id = $request->id;
        $user = User::findOrFail($verdor_id)->update([
            'status' => 'active',
        ]);

        $notification = array(
            'message' => 'Vendor Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('active.vendor')->with($notification);

    }// End Mehtod 

    public function activeVendorDetails($id){

        $activeVendorDetails = User::findOrFail($id);
        return view('backend.vendor.active_vendor_details',compact('activeVendorDetails'));

    }// End Mehtod 

    public function deactivateVendor(Request $request){

        $verdor_id = $request->id;
        $user = User::findOrFail($verdor_id)->update([
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Vendor deactivated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('inactive.vendor')->with($notification);

    }// End Mehtod 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
       
        //return redirect('/') route to login page
        //return redirect()->route('welcome');
       return redirect()->route('admin.login');
       // return redirect('/admin/login');
    }
}
