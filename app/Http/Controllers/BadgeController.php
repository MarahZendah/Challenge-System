<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   
public function index()
{
    
    $badges = \App\Models\Badge::all();
    return view('admin.badges.index', compact('badges'));
}


public function myBadges()
{
    
    $userBadges = auth()->user()->badges; 
    
    
    return view('badges.index', compact('userBadges'));
}


public function store(Request $request)
{
    
    $request->validate([
        'name' => 'required',
        'image' => 'required|image',
        'criteria_type' => 'required',
        'criteria_value' => 'required',
    ]);

    
    $imageName = time().'.'.$request->image->extension();  
    $request->image->move(public_path('images'), $imageName);

   
    \App\Models\Badge::create([
        'name' => $request->name,
        'description' => $request->description,
        'image_path' => $imageName,
        'criteria_type' => $request->criteria_type,
        'criteria_value' => $request->criteria_value,
    ]);

    return redirect()->back()->with('success', 'تم إضافة الوسام بنجاح!');
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
        $badge = \App\Models\Badge::findOrFail($id);
    return view('admin.badges.edit', compact('badge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $badge = \App\Models\Badge::findOrFail($id);
    
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $badge->name = $request->name;
    $badge->description = $request->description;

    if ($request->hasFile('image')) {
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $badge->image_path = $imageName;
    }

    $badge->save();
    return redirect()->route('admin.badges.index')->with('success', 'تم تحديث الوسام بنجاح! ✨');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $badge = \App\Models\Badge::findOrFail($id);
    $badge->delete();
    return back()->with('success', 'تم حذف الوسام بنجاح! 👋');
    }
}
