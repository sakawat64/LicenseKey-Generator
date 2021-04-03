<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web',['except' => ['login','checkLogin','create','store','logout']]);
    }
    public function login()
    {
        $data['title'] = "Login";
        return view('auth.login',$data);
    }
    public function checkLogin(Request $request)
    {
        $this->validate($request,[
            'mobile_number'=>'required',
            'password'=>'required',
        ]);
        $credential=[
            'mobile_number'=>$request->mobile_number,
            'password'=>$request->password,
        ];
        if(Auth::guard('web')->attempt($credential)){
            return redirect()->intended(route('home'));
        }
        return redirect()->back()->withInput($request->only('mobile_number'));
    }
    public function home()
    {
        $data['title'] = "Home";
        return view('home',$data);
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect(route('login'));
    }
    public function create()
    {
        $data['title'] = "Register";
        return view('auth.register',$data);
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'first_name' => 'bail|required|max:191',
            'last_name' => 'bail|required|max:191',
            'organization_name' => 'bail|required|max:191',
            'street' => 'bail|required|max:191',
            'city' => 'bail|required|max:191',
            'mobile_number' => 'bail|required|max:191|unique:users',
            'email'=> 'bail|required|email|unique:users',
            'password' => 'bail|required|confirmed|min:4',
        ]);
        $data = $request->all();
        if(User::create($data))
        {
            $this->SetSuccessMessage('Registration Successfully');
            return redirect()->route('login');
        }
        $this->SetErrorMessage('Something Went Wrong!');
        return redirect()->route('register');
    }
}
