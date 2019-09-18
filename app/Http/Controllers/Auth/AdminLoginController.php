<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('adminLogout');
    }
    public function ShowLoginForm()
    {
    	return view('auth.adminlogin');
    }
    public function login(Request $request)
    {
    	// validate the form data
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required|min:6'
    	]);

    	//Attempt to log the user in
    	if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
    		//If successful
    		return redirect()->intended(route('admin.dashboard'));
    	}

    	//If unsuccessful
    	return redirect()->back()->withInput($request->only('email', 'remember', $this->sendFailedLoginResponse($request)));
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    public function username()
    {
        return 'email';
    }

    public function adminLogout()
    {
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
