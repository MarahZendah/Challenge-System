<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   
    public function showLogin() {
        return view('auth.login');
    }

    
    public function login(Request $request)
{
   
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    
    if (auth()->attempt($credentials)) {
       
        $request->session()->regenerate();
        return redirect()->intended('/challenges');
    }

    
    return back()->withErrors([
        'email' => 'خطأ في البريد الإلكتروني أو كلمة المرور.',
    ]);
}

    
    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
    
public function showRegister() {
    return view('auth.register');
}


public function register(Request $request)
{
    
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ], [
        
        'email.unique' => 'هذا البريد الإلكتروني مسجل مسبقاً!',
        'password.confirmed' => 'كلمتا المرور غير متطابقتين.',
        'password.min' => 'يجب أن تكون كلمة المرور 8 أحرف على الأقل.',
    ]);

    
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), 
    ]);

    
    return redirect()->route('login')->with('success', 'تم إنشاء حسابك بنجاح! يمكنك الآن تسجيل الدخول.');
}
}
