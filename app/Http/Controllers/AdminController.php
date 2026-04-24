<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Challenge;
use App\Models\User;

class AdminController extends Controller
{
    
    public function index() {
        $challenges = Challenge::all();
        $users_count = User::count();
        return view('admin.dashboard', compact('challenges', 'users_count'));
    }

    public function create() {
        return view('admin.create_challenge');
    }

 public function store(Request $request) {
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'total_days' => 'required|integer|min:1', 
    ]);

    $challenge = new Challenge();
    $challenge->title = $request->title;
    $challenge->description = $request->description;
    $challenge->total_days = $request->total_days;
    $challenge->save();

    return redirect()->route('admin.dashboard')->with('success', 'تم إضافة التحدي بنجاح');
}
public function edit($id) {
    $challenge = \App\Models\Challenge::findOrFail($id);
    return view('admin.challenges.edit', compact('challenge'));
}


public function update(Request $request, $id)
{
    $challenge = \App\Models\Challenge::findOrFail($id);

    $request->validate([
        'title' => 'required|string|max:255',
        'total_days' => 'required|integer|min:1', 
    ]);

    $challenge->update([
        'title' => $request->title,
        'total_days' => $request->total_days, 
    ]);

    return redirect()->route('admin.dashboard')->with('success', 'تم تحديث التحدي بنجاح! ✅');
}

    public function destroy($id)
{
    $challenge = \App\Models\Challenge::findOrFail($id);
    $challenge->delete();

    return redirect()->route('admin.dashboard')->with('success', 'تم حذف التحدي بنجاح!');
}
}