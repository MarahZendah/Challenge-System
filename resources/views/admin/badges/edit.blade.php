@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-8">
    <div class="bg-white p-8 rounded-xl shadow-md border">
        <h2 class="text-2xl font-bold mb-6 text-indigo-900 text-right">تعديل الوسام ✏️</h2>
        
        <form action="{{ route('admin.badges.update', $badge->id) }}" method="POST" enctype="multipart/form-data" class="text-right">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block mb-2">اسم الوسام</label>
                <input type="text" name="name" value="{{ $badge->name }}" class="w-full border p-2 rounded text-right">
            </div>

            <div class="mb-4">
                <label class="block mb-2">الوصف</label>
                <textarea name="description" class="w-full border p-2 rounded text-right">{{ $badge->description }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block mb-2">الصورة الحالية</label>
                <img src="{{ asset('images/' . $badge->image_path) }}" class="w-20 mb-2 mr-auto ml-0">
                <input type="file" name="image" class="w-full border p-2 rounded">
            </div>

            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded font-bold">حفظ التغييرات</button>
        </form>
    </div>
</div>
@endsection