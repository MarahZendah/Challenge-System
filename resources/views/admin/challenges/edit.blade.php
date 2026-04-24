@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-10">
    <div class="flex justify-between items-center mb-8">
        <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:text-indigo-800 flex items-center transition">
            <span class="ml-2">←</span> العودة للوحة التحكم
        </a>
        <h1 class="text-2xl font-bold text-gray-800">تعديل بيانات التحدي ✏️</h1>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="p-8">
            <form action="{{ route('admin.challenges.update', $challenge->id) }}" method="POST">
                @csrf
                @method('PUT') 

                <div class="grid grid-cols-1 gap-6">
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">عنوان التحدي</label>
                        <input type="text" name="title" value="{{ $challenge->title }}" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm text-right" 
                            placeholder="مثلاً: تحدي الـ 30 يوماً للقراءة" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">مدة التحدي (بالأيام)</label>
                       <input type="number" name="total_days" value="{{ $challenge->total_days }}"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition shadow-sm text-right" 
                            placeholder="30" required>
                    </div>

                    <div class="pt-4">
                        <button type="submit" 
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl shadow-lg transition duration-300 transform hover:-translate-y-1">
                            حفظ التعديلات الجديدة ✅
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <p class="text-center text-gray-400 mt-6 text-sm">
        تعديل البيانات سيظهر فوراً لجميع المستخدمين المشتركين في هذا التحدي.
    </p>
</div>
@endsection