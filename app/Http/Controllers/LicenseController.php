<?php

namespace App\Http\Controllers;

use App\Models\License;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LicenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web');
    }
    public function userDetails(Request $request)
    {
        $user = User::where('id',$request->user_id)->first();
        $licenses = License::get();
        $license_key = array();
        foreach ($licenses as $license)
        {
            if($license->user_id == $request->user_id)
            {
                $license_key = array (
                    'license_key' => $license->license_key
                );
            }
        }
        //dd($license_key);
        $json_array = array(
            "user" => $user,
             "license" => $license_key,
        );
        if($user)
        {
            return json_encode($json_array);
        }
    }
    public function createLicenseKey(Request $request)
    {
        $user = User::where('id',$request->user_id)->first();
        if($user)
        {
          $license_key = Str::random(4)."-".Str::random(4)."-".Str::random(4)."-".Str::random(4);
          $request->session()->put('license', $license_key);
          $request->session()->put('duration', $request->duration);
          $request->session()->put('user_id', $request->user_id);
          return $license_key;
        }
        else
        {
            return false;
        }
    }
    public function activeKey()
    {
        $data['title'] = "Title";
        return view('active_key',$data);
    }
    public function activeKeyStore(Request $request)
    {
       // dd($request->session()->get('user_id'));
        if($request->session()->get('license') == $request->license_key)
        {
            $duration = "+".$request->session()->get('duration')."months";
            $start_date = date('Y-m-d');
            $data['expire_date'] = date('Y-m-d', strtotime($duration, strtotime($start_date)));
            $data['user_id'] = $request->session()->get('user_id');
            $data['license_key'] = $request->session()->get('license');
            if(License::create($data))
            {
                $request->session()->forget('license');
                $request->session()->forget('duration');
                $request->session()->forget('user_id');
                return $data['expire_date'];
            }
        }
        else
        {
            return false;
        }
    }
}
