<?php

namespace App\Http\Controllers\WEB;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('auth.login', [
            'title' => 'Login',
        ]);
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
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Get the authenticated user
            $user = Auth::user();

            // Check if the user type is 'hmo'
            if ($user->user_type === 'admin') {
                Alert::success('Success', 'Login success!');
                return redirect()->intended('/dashboard');
            } else {
                Auth::logout(); // Logout if not an HMO user
                Alert::error('Error', 'Only Admin users are allowed to login.');
                return redirect('/login');
            }
        } else {
            Alert::error('Error', 'Login failed!');
            return redirect('/login');
        }
    }

        public function register()
        {
            return view('auth.register', [
                'title' => 'Register',
            ]);
        }

        public function process(Request $request)
        {
            $validated = $request->validate([
                'user_name' => ['required', 'string'],
                'email' => ['required', 'email'],
                'address' => ['required', 'string'],
                'username' => ['required', 'string'],
                'password' => 'required',
                'passwordConfirm' => 'required|same:password'
            ]);
            $validated['password'] = Hash::make($validated['password']);
            $validated['user_type'] = 'admin';
            $user = User::create($validated);

            Alert::success('Success', 'Register user has been successfully!');
            return redirect('/login');
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function logout(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();
        Alert::success('Success', 'Log out success !');
        return redirect('/login');
    }
}
