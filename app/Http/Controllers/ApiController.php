<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\userDetailModel;

class ApiController extends Controller
{
    function registerNewUSer(Request $request)
    {
        //Vaildate the Request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'type' => 'required',
            'status' => 'required',
            'phone' => 'required',
            'city' => 'required',
            'address' => 'required',
            'zip' => 'required',
            'state' => 'required',
            'country' => 'required'
        ]);
        
        // This Execute if Validation Fails
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()]);
        } 

        // This Execute to create the user and then pass the id of newly created user to the userDetailsRegistration 
        // function for creating user detail record
        else {
            $userObj = new User();

            $user_id = $userObj::insertGetId([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $request->password,
                'type' => $request->type,
            ]);

            if ($user_id) {
                return $this->userDetailsRegistration($user_id, $request);
            }
        }
    }

    function userDetailsRegistration($id, $request)
    {
        // This Checks that a user_id already exists in user Detials table
        $user_details_obj = new userDetailModel();
        $user = $user_details_obj::where('user_id','=',$id)->exists();
        // IF it does not exists then we will Carry on our work and create record in user Detail tables
        if(!$user){
            $usere_details = $user_details_obj::insertGetId([
                'user_id' => $id,
                'netsuite_id' => '456',
                'status' => $request->status,
                'phone' => $request->phone,
                'city' => $request->city,
                'address' => $request->address,
                'zip' => $request->zip,
                'state' => $request->state,
                'country' => $request->country,
                'is_company' => 0
            ]);
            if ($usere_details) {
                return response()->json([
                    'message' => 'User Created Successfully with Detials!',
                ]);
            } else {
                //If because of any error the user detail record don't get created then we are deleting the user record from the users tables
                $userObj = new User();
                $user_delete =  $userObj::where('id', '=', $id)->delete();
            }
        
        }
        else{
            return response()->json([
                'message' => 'User Alreday Exists!',
            ]);
        }
    }
}
