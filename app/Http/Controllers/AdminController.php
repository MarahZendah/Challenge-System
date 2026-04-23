<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\User;

class AdminController extends Controller
{
    // عرض الإحصائيات وقائمة التحديات
    public function index() {
        $challenges = Challenge::all();
        $users_count = User::count();
        return view('admin.dashboard', compact('challenges', 'users_count'));
    }

    // عرض صفحة إضافة تحدي جديد
    public function create() {
        return view('admin.create_challenge');
    }

    // حفظ التحدي الجديد في قاعدة البيانات
 public function store(Request $request) {
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'total_days' => 'required|integer|min:1', // تأكدي من الاسم هنا
    ]);

    $challenge = new Challenge();
    $challenge->title = $request->title;
    $challenge->description = $request->description;
    $challenge->total_days = $request->total_days; // إسناد القيمة للعمود الصحيح
    $challenge->save();

    return redirect()->route('admin.dashboard')->with('success', 'تم إضافة التحدي بنجاح');
}

    public function destroy($id)
{
    $challenge = \App\Models\Challenge::findOrFail($id);
    $challenge->delete();

    return redirect()->route('admin.dashboard')->with('success', 'تم حذف التحدي بنجاح!');
}
}