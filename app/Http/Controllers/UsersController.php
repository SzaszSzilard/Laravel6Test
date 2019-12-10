<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
          'name'      => ['required', 'string', 'max:191'],
          'email'     => ['required', 'string', 'email', 'max:191', 'unique:users'],
          'password'  => ['required', 'string', 'min:8', 'max:191', 'confirmed', 'regex:/^.*(?=.{8,})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!$#%]).*$/' ],
          'phone'     => ['required', 'string', 'min:8', 'max:12', 'regex:/^.*(?=.{8,12})(?=.*[0-9]).*$/'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    public function user_create() {
      return view('user_create');
    }

    public function add_user(Request $request) {
       // validator($request);

       User::create([
           'name'     => $request->name,
           'email'    => $request->email,
           'phone'    => $request->phone,
           'password' => Hash::make($request->password),
       ]);

       return redirect('/users')->with('success','User added.');
    }

    public function user_edit($id) {
      $user = User::where("id",$id)->first();

      return view('user_edit', $user);
    }

    public function user_update(Request $request) {
      $user = User::find($request->id);

      $user['name']     = $request->name;
      $user['phone']    = $request->phone;
      // $user['email']    = $request->email;
      $user['password'] = $request->password;

      $user->save();

      return redirect('/users')->with('success','User edited.');
    }

    public function user_delete($id) {
        // $id = Auth::user()->id;
        User::find($id)->delete();

        // return array('success' => 'User deleted');
        return response()->json(['success' => 'User deleted']);

        // return redirect('/users')->with('success','User deleted.');
    }

    public function user_unverify($id) {
      $user = User::find($id);

      $user['email_verified_at'] = null;
      $user->save();

      return response()->json(['success' => 'User unverified']);;
    }

    public function users() {
        $users =  User::paginate(5);
        return view('users',compact('users'));
    }

    public function user_search($value) {
      $values = User::where('name', 'like', '%' . $value . '%')
        ->orWhere('email', 'like', '%' . $value . '%')
        ->orWhere('phone', 'like', '%' . $value . '%')
        ->get();

      return $values;
    }
}
