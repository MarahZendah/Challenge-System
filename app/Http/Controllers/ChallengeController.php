<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $challenges = \App\Models\Challenge::all(); 
    return view('challenges.index', compact('challenges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
   public function join($id)
{
    $challenge = \App\Models\Challenge::findOrFail($id);
    $user = auth()->user();

    if (!$user->challenges->contains($challenge->id)) {
        // نرسل رقم التحدي، ومعاه مصفوفة [اسم العمود => القيمة]
        $user->challenges()->attach($challenge->id, [
            'start_date' => now(), // دالة now() بتجيب تاريخ وساعة اللحظة الحالية
            'status' => 'active'   // بالمرة خلينا نخلي الحالة "نشط"
        ]);
        
        return back()->with('success', 'تم الاشتراك بنجاح! ابدأ رحلتك الآن.');
    }

    return back()->with('info', 'أنت مشترك بالفعل.');
}
public function myChallenges()
{
    // وظيفة الكود: بنطلب من لارافيل يجيب "تحديات" المستخدم اللي عامل login حالياً فقط
    $myChallenges = auth()->user()->challenges;

    // بنرسل التحديات لصفحة جديدة رح نسميها 'my_challenges'
    return view('challenges.my_challenges', compact('myChallenges'));
}

public function completeDay($id)
{
    $user = auth()->user();
    $challenge = $user->challenges()->findOrFail($id);

    $currentDays = $challenge->pivot->completed_days ?? 0;
    $totalDays = $challenge->total_days;

    // الشرط: إذا كان المستخدم لسه ما وصل للحد الأقصى
    if ($currentDays < $totalDays) {
        $newCount = $currentDays + 1;
        
        $user->challenges()->updateExistingPivot($id, [
            'completed_days' => $newCount
        ]);

        // إذا كان هاد آخر يوم، نرسل رسالة تهنئة خاصة
        if ($newCount == $totalDays) {
            return back()->with('success', '🏆 مبروك! لقد أتممت التحدي بنجاح، أنت بطل!');
        }

        return back()->with('success', 'كفو! استمر، تم تسجيل إنجاز اليوم.');
    }

    // إذا حاول يزيد وهو مخلص أصلاً
    return back()->with('info', 'أنت ختمت هذا التحدي بالفعل! 🌟');
}

public function leave($id)
{
    $user = auth()->user();
    
    // استخدام دالة detach لحذف السجل من جدول الربط (challenge_user)
    $user->challenges()->detach($id);

    return back()->with('success', 'تم إلغاء الاشتراك في التحدي بنجاح.');
}

}
