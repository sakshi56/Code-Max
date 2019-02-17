<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
  //  protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'store']);
    }

    public function showlogin(Request $request)
    {

        if (Session::has('username')) {
            return Redirect::to('/dashboard');} else {
            return view('login');
        }
        

    }

    public function login(Request $request)
    {

        $rules = array(
            'username' => 'required|email', // make sure the email is an actual email
            'password' => 'required|min:3', // password can only be alphanumeric and has to be greater than 3 characters
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {

            if ($request->wantsJson()) {
                return response()->json(array('status' => 'error', 'msg' => 'invalid username or password'));
            } else {
                return Redirect::to('/')
                    ->withErrors($validator) // send back all errors to the login form
                    ->withInput(Input::except('password'));
            }
            // send back the input (not the password) so that we can repopulate the form
        } else {

            if (Auth::attempt(['email' => $request->username, 'password' => $request->password])) {

                $user = Auth::user();

                $username = $user->name;
                $email = $user->email;
                $strtup_id = $user->strtup_id;
                $mem_cat='';
                try
                {
                    if($strtup_id<1){
                        $mem_cat='Incubator';
                    }else{

                        $data=DB::table('startups')->select('name')->where('id',$strtup_id)->get();
                        foreach ($data as $item) {
                            $mem_cat=$item->name;
                        }
                        
                    }


                    Session::put('username', $username);
                    Session::put('mem_cat', $mem_cat);
                    Session::put('useremail', $email);
                    Session::put('strt_up_id',$strtup_id);

                    Log::info($username . " Login Successfully") . '<br>';
                    return Redirect::to('dashboard');

                } catch (QueryException $e) {
                    if ($request->wantsJson()) {
                        return response()->json(array('status' => 'failure', 'msg' => $e->getMessage()));
                    }

                    Log::error("Database Query Error! [" . $e->getMessage() . " ]") . '<br>';
                    return redirect()->back()->with('failure', "Database Query Error! [" . $e->getMessage() . " ]");
                } catch (Exception $e) {
                    if ($request->wantsJson()) {
                        return response()->json(array('status' => 'failure', 'msg' => $e->getMessage()));
                    }

                    Log::error($e->getMessage());
                    return redirect()->back()->with('alert-danger', $e->getMessage());
                }
            } else {
                if ($request->wantsJson()) {
                    return response()->json(array('status' => 'failure', 'msg' => 'Invalid Username or Password'));
                }

                Log::error('Invalid Username or Password') . '<br>';
                return redirect()->back()->with('status', 'Invalid Username or Password.');
            }

        }
    }

    public function logout(Request $request)
    {
        
        $username=session('username');
        Log::info($username." Logout Successfully").'<br>';   
        Auth::logout();
        \Cache::flush();
        Session::forget('username');
        Session::forget('email');
        Session::forget('password');
        Session::flush();
       
            return redirect('/')->withCookie(\Cookie::forget('laravel_token'))->with('action','Successfully Logout');
    }
  
}
