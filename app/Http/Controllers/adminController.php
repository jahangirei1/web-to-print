<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\userDetailModel;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    // function showDashboard(){
    //     return view('admin.adminDashboard');
    // }

    function adminLogout(){
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }

    //Anas
    // function showAdminsList(){
    //     $data = User::where('type', '0')->orWhere('type', '1')->get(['id','first_name', 'last_name', 'email', 'type'])->toArray();
    //     return view('admin.adminsList', compact('data'));
    // }
    function showAdminsList(){
        $superAdminId = auth()->user()->id; // Get the ID of the currently logged-in super admin
        $data = User::where(function ($query) use ($superAdminId) {
            $query->where('type', '0') // Exclude super admins
                ->orWhere(function ($query) use ($superAdminId) {
                    $query->where('type', '1') // Include admins
                        ->where('id', '!=', $superAdminId); // Exclude the currently logged-in super admin
                });
        })->get(['id', 'first_name', 'last_name', 'email', 'type'])->toArray();
    
        return view('admin.adminsList', compact('data'));
    }
    

    //Anas
    // function showUsersList(){
    //     $data = User::where('type', '2')->orWhere('type', '3')->get(['first_name', 'last_name', 'email', 'type'])->toArray();
    //     return view('admin.usersList', compact('data'));
    // }

    function showApprovedUsersList(){
        $data = DB::table('user_details')
            ->join('users', function ($join) {
                $join->on('user_details.user_id', '=', 'users.id')
                    ->where('users.type', '!=', 0)  // Exclude super admin (type = 0)
                    ->where('users.type', '!=', 1)  // Exclude admin (type = 1)
                    ->where('user_details.status', '=', 1); // Approved status
            })
            ->get([
                'users.first_name',
                'users.last_name',
                'users.email',
                'users.type',
                'user_details.status',
                'user_details.phone',
                'user_details.city',
                'user_details.address',
                'user_details.zip',
                'user_details.state',
                'user_details.country',
            ])->toArray();
        
        $noApprovedUsers = empty($data);
        
        return view('admin.usersList', compact('data', 'noApprovedUsers'));
    }

    //Anas
    // function showPendingUsersList(){
    //     $data = userDetailModel::where('status', '0')->get(['user_details_id', 'user_id', 'netsuite_id', 'status', 'phone', 'city', 'address'])->toArray();
    //     return view('admin.adminDashboard', compact('data'));
    // }

    function showPendingUsersList(){
        $data = DB::table('user_details')
        ->join('users', function ($join) {
            $join->on('user_details.user_id', '=', 'users.id')
                 ->where('users.type', '!=', 0)  // Exclude super admin (type = 0)
                 ->where('users.type', '!=', 1); // Exclude admin (type = 1)
        })
        ->where('user_details.status', '0') // Pending status
        ->get([
            'user_details.user_details_id',
            'user_details.user_id',
            'user_details.netsuite_id',
            'user_details.status',
            'user_details.phone',
            'user_details.city',
            'user_details.address'
        ])->toArray();
        $noPendingUsers = empty($data);
        return view('admin.adminDashboard', compact('data', 'noPendingUsers'));
    }

    public function approveUser($id)
    {
        DB::table('user_details')->where('user_details_id', $id)->update(['status' => 1]);
        // You may want to add additional logic or notifications here.

        //return redirect()->route('admin.dashboard')->with('success', 'User approved successfully.');
        return view('admin.approveDashboard')->with('success', 'User approved successfully.');
    }

    public function rejectUser($id)
    {
        DB::table('user_details')->where('user_details_id', $id)->update(['status' => 2]);
        // You may want to add additional logic or notifications here.

        //return redirect()->route('admin.dashboard')->with('success', 'User rejected successfully.');
        return view('admin.rejectDashboard')->with('success', 'User approved successfully.');
    }

    function adminProfile(){
        return view('admin.adminProfile');
    }

    function addAdminForm(){
        return view('admin.addAdminForm');
    }

    //Anas
    function addAdmin(Request $request)
    {
        $credentials = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|bail|email:rfc,dns|unique:users,email',
            'password' => 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/|confirmed',
            //'password_confirmation' => 'required|min:8|max:16|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
            'role' => 'required'
        ]);

        // if ($credentials) {
        //     return back()->withErrors([
        //         'email' => 'The provided credentials do not match our records.',
        //     ])->onlyInput('email');
        // }

         //I have created a new User model instance and filled it with the necessary attributes (fields) from the form.
         //The password is hashed using bcrypt before storing it in the database.
         //I haveve saved the user record using the save method
         // Create a new user record
         $user = new User([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'type' => $request->input('role'),
        ]);

        $user->save();

        return redirect()->route('admin-add-form')->with('success', 'Admin added successfully.');
    }

    function deleteAdmin($id)
    {
    // Delete admin by ID
    User::where('id', $id)->delete();
    //DB::table('users')->where('users_id', $id)->delete();

    //return redirect()->route('admin-list')->with('success', 'Admin deleted successfully.');
    return redirect()->route('admin-list')->with('success', 'Admin deleted successfully.');
    }

    public function updateAdminRole(Request $request, $id)
{
    $request->validate([
        'role' => 'required', // Add any additional validation rules if needed
    ]);

    // Update the role field
    User::where('id', $id)->update(['type' => $request->input('role')]);

    return redirect()->route('admin-list')->with('success', 'Admin role updated successfully.');
}
}
