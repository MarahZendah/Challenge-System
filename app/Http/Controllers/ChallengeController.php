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
        
        $user->challenges()->attach($challenge->id, [
            'start_date' => now(), 
            'status' => 'active'   
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

public function complete($id)
{
    $user = auth()->user();
    
    
   $user->challenges()->updateExistingPivot($id, ['status' => 'completed']);

    
    $completedCount = $user->challenges()->wherePivot('status', 'completed')->count(); // عدد التحديات
    $totalDays = $user->challenges()->wherePivot('status', 'completed')->sum('total_days'); // مجموع الأيام

    
    $availableBadges = \App\Models\Badge::whereNotIn('id', $user->badges->pluck('id'))->get();

    foreach ($availableBadges as $badge) {
        $awarded = false;

        
        if ($badge->criteria_type == 'count' && $completedCount >= $badge->criteria_value) {
            $awarded = true;
        } 
        elseif ($badge->criteria_type == 'days' && $totalDays >= $badge->criteria_value) {
            $awarded = true;
        }

        
        if ($awarded) {
            $user->badges()->attach($badge->id);
        }
    }

    return back()->with('success', 'أحسنتِ! تم إكمال التحدي وفحص الأوسمة المستحقة 🏆');
}

public function leave($id)
{
    auth()->user()->challenges()->detach($id);
    return back()->with('success', 'تم إلغاء الاشتراك في التحدي بنجاح.');
}
}
