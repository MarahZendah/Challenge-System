<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // وظيفتها: عرض صفحة الدخول
    public function showLogin() {
        return view('auth.login');
    }

    // وظيفتها: التحقق من البيانات
    public function login(Request $request)
{
    // 1. استلام البيانات من الفورم
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // 2. محاولة تسجيل الدخول بالبيانات المدخلة (أياً كانت)
    if (auth()->attempt($credentials)) {
        // إذا البيانات صحيحة وموجودة بجدول users
        $request->session()->regenerate();
        return redirect()->intended('/challenges');
    }

    // 3. إذا البيانات غلط
    return back()->withErrors([
        'email' => 'خطأ في البريد الإلكتروني أو كلمة المرور.',
    ]);
}

    // وظيفتها: تسجيل الخروج
    public function logout() {
        Auth::logout();
        return redirect('/login');
    }
    // وظيفتها: عرض صفحة إنشاء حساب جديد
public function showRegister() {
    return view('auth.register');
}

// وظيفتها: استقبال البيانات وحفظ المستخدم الجديد
public function register(Request $request)
{
    // 1. التحقق من صحة البيانات المدخلة
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ], [
        // رسائل خطأ اختيارية بالعربي (لتحسين تجربة المستخدم)
        'email.unique' => 'هذا البريد الإلكتروني مسجل مسبقاً!',
        'password.confirmed' => 'كلمتا المرور غير متطابقتين.',
        'password.min' => 'يجب أن تكون كلمة المرور 8 أحرف على الأقل.',
    ]);

    // 2. إنشاء المستخدم الجديد في قاعدة البيانات
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // تشفير كلمة المرور ضروري جداً
    ]);

    // 3. التوجيه لصفحة تسجيل الدخول مع رسالة نجاح (بدون تسجيل دخول تلقائي)
    return redirect()->route('login')->with('success', 'تم إنشاء حسابك بنجاح! يمكنك الآن تسجيل الدخول.');
}
}
