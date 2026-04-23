@extends('layouts.app') {{-- هنا نخبر لارافيل أن يستخدم التصميم الأساسي --}}

@section('content') {{-- هنا نضع المحتوى الذي سيظهر مكان @yield --}}
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        @if(session('success'))
    <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-center shadow-md">
        <strong class="font-bold">تم!</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>

    <script>
        // كود ليختفي التنبيه تلقائياً بعد 3 ثوانٍ
        setTimeout(function() {
            let alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000);
    </script>
@endif
@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-center">
        {{ session('error') }}
    </div>
@endif
        <h1 class="text-3xl font-bold text-gray-800">لوحة التحكم 🛠️</h1>
        <a href="{{ route('admin.challenges.create') }}" class="bg-indigo-600 text-white px-6 py-2 rounded-lg shadow-md hover:bg-indigo-700 transition">
            إضافة تحدي جديد +
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border-r-4 border-indigo-500">
            <h3 class="text-gray-500">إجمالي المستخدمين</h3>
            <p class="text-4xl font-bold text-indigo-600">{{ $users_count }}</p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border-r-4 border-green-500">
            <h3 class="text-gray-500">إجمالي التحديات</h3>
            <p class="text-4xl font-bold text-green-600">{{ $challenges->count() }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden border">
        <table class="w-full text-right border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 border-b text-gray-700">اسم التحدي</th>
                    <th class="px-6 py-3 border-b text-gray-700">المدة</th>
                    <th class="px-6 py-3 border-b text-gray-700">العمليات</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($challenges as $challenge)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium">{{ $challenge->title }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $challenge->total_days }} يوم</td>
                    <td class="px-6 py-4">
                       <form action="{{ route('admin.challenges.destroy', $challenge->id) }}" method="POST" class="inline" onsubmit="return confirm('هل أنت متأكد من حذف هذا التحدي؟')">
    @csrf
    @method('DELETE') {{-- هذا السطر ضروري جداً لإخبار لارافيل أنها عملية حذف --}}
    <button type="submit" class="text-red-500 hover:text-red-700 font-bold">
        حذف
    </button>
</form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection