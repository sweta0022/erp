<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\State;
use App\Models\City;
use App\Models\Zone;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $role = Role::where('name','like','ADMIN')->first();
        $users = User::where('role_id','!=', $role->id)->get();
        return view('admin.users.index');
    }

    public function create()
    {
        $role = new Role;
        $allRole = $role->getAllRoleExceptAdmin();

        $state = new State;
        $allState = $state->getAllState();
       
        return view('admin.users.create',compact('allRole','allState'));
    }

    public function store(Request $request  )
    {
        // dd($request->role);
         $validatedData = $request->validate([
            'name' => 'required',
            'password' => 'min:8|required_with:cpassword|same:cpassword',
            'cpassword' => 'min:8',
            'email' => 'required|email|unique:users',
            'phone' => 'required|digits:10',
            'role' => 'required',
            'senior' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zone' => 'required',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'E-mail is required'
            // 'password.required' => 'Password is required'
        ]);

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $phone = $request->phone;
        $role = $request->role;
        $senior = $request->senior;
        $state = $request->state;
        $city = $request->city;
        $zone = $request->zone;

        $sqlCreate = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'phone_no' => $phone,
            'role_id' => $role,
            'state_id' => $state,
            'city_id' => $city,
            'zone_id' => $zone
        ]);

        if( $sqlCreate )
        {

        }
        
    }

    public function getCities(Request $request)
    {
        $city = new City;
        $allCity = $city->getCities($request->stateId);
        
        if (count($allCity) > 0) {
            return response()->json($allCity);
        }
    }

    public function getZones(Request $request)
    {
        $zone = new Zone;
        $allZone = $zone->getZones($request->city_id);
        
        if (count($allZone) > 0) {
            return response()->json($allZone);
        }
    }

    public function getSeniors(Request $request)
    {
        $role = new Role;
        $allSeniors = $role->getSeniors($request->role_id);
        
        if (count($allSeniors) > 0) {
            return response()->json($allSeniors);
        }
    }

    
}
