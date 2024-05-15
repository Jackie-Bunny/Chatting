<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required | email',
            'password' => 'required | min:8',
            // 'profile' => 'required | image|mimes:png,jpg|max:100'
        ]);
        // dd($request->all());
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if ($request->hasFile('profile')) {
            $file = $request->file('profile');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/users/', $fileName);
            $user->profile = $fileName;
        }
        $user->status = '1';
        $user->save();
        Auth::login($user);
        if (Auth::user()) {
            return redirect()->route('chat.get');
        }
        return redirect()->back();
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required | email | exists:users',
            'password' => 'required'
        ]);
        // dd($request->all());
        if (Auth::attempt($credentials)) {
            $user = User::where('email', auth()->user()->email)->first();
            $user->status = '1';
            $user->update();
            return redirect()->route('chat.get');
        }
        return back();
    }

    public function logout()
    {
        $user = User::where('email', auth()->user()->email)->first();
        $user->status = '0';
        $user->update();
        Auth::logout();
        return redirect()->route('login.get');
    }
}
