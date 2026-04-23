@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg mt-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-4">إضافة تحدي جديد 🎯</h2>
    
    <form action="{{ route('admin.challenges.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">عنوان التحدي</label>
            <input type="text" name="title" required class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 outline-none">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">الوصف</label>
            <textarea name="description" required class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 outline-none" rows="4"></textarea>
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">المدة (بالأيام)</label>
            <input type="number" name="total_days" required class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-indigo-400 outline-none">
        </div>
        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-lg transition shadow-lg">
            حفظ التحدي في القاعدة
        </button>
    </form>
</div>
@endsection