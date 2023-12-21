<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\userDetailModel; // Import the UserDetails model


class authController extends Controller
{
    function showLoginForm(){
        return view('login');
    }

    //Anas
    // function authenticateUser(Request $request){
    //     $credentials = $request->validate([
    //         'email' => 'required|bail|email:rfc,dns',
    //         'password' => 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
    //     ]);

    //     if(Auth::attempt($credentials)){
    //         $user = Auth::user();

    //         if($user->type == 0 || $user->type == 1){
    //             $request->session()->regenerate();
    //             return redirect()->route('admin-dashboard');
    //         }
    //         else{
    //             $request->session()->regenerate();
    //             return redirect()->route('user-dashboard');
    //         }
    //     }
        
    //     else if (!Auth::attempt($credentials)){
    //         return back()->withErrors([
    //             'email' => 'The provided credentials do not match our records.',
    //         ])->onlyInput('email');
    //     }

    // }

    function authenticateUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|bail|email:rfc,dns',
            'password' => 'required|min:8|max:16|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            //the $userDetails variable contains the details associated with the currently authenticated user, if any. The subsequent code checks whether the user is an admin or super admin. If the user is a regular user, it checks if their details are present in the user_details table and if the status is approved (1). If the status is not approved, it logs the user out and shows an error
            $userDetailModel = userDetailModel::where('user_id', $user->id)->first();

            if ($user->type == 0 || $user->type == 1) {
                // Admin or Super Admin
                $request->session()->regenerate();
                return redirect()->route('admin-dashboard');
            } else {
                // User
                if ($userDetailModel && $userDetailModel->status == 1) {
                    // Check if the user status is approved
                    $request->session()->regenerate();
                    return redirect()->route('user-dashboard');
                } else {
                    // If the user status is not approved, log them out and show an error
                    Auth::logout();
                    return back()->withErrors([
                        'email' => 'Your account is not approved.',
                    ])->onlyInput('email');
                }
            }
        } else {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
    }
}
