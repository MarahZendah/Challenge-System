@extends('layouts.app') 

@section('content')
<div class="p-8">
    <h1 class="text-2xl font-bold mb-8 text-right">إدارة أوسمة النظام ⚙️</h1>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        
        <div class="bg-indigo-50 p-6 rounded-2xl border border-indigo-100 shadow-sm h-fit">
            <h2 class="text-lg font-bold mb-4 text-right">أضف وساماً جديداً</h2>
            <form action="{{ route('admin.badges.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                
                <input type="text" name="name" placeholder="اسم الوسام (مثلاً: بطل الاستمرارية)" class="w-full p-2 rounded-lg border shadow-sm text-right" required>
                
                <textarea name="description" placeholder="وصف الاستحقاق" class="w-full p-2 rounded-lg border shadow-sm text-right" required></textarea>

                <div class="text-right">
                    <label class="block text-sm font-bold mb-1 text-indigo-900">نوع الشرط المستهدف:</label>
                    <select name="criteria_type" class="w-full p-2 rounded-lg border shadow-sm text-right" required>
                        <option value="count">بناءً على عدد التحديات المنجزة</option>
                        <option value="days">بناءً على مجموع الأيام الكلي</option>
                    </select>
                </div>

                <div class="text-right">
                    <label class="block text-sm font-bold mb-1 text-indigo-900">القيمة المطلوبة (الهدف):</label>
                    <input type="number" name="criteria_value" placeholder="مثلاً: 5" class="w-full p-2 rounded-lg border shadow-sm text-right" required min="1">
                </div>

                <div class="text-right">
                    <label class="block text-sm font-bold mb-1 text-indigo-900">أيقونة الوسام:</label>
                    <input type="file" name="image" class="w-full text-sm" required>
                </div>

               
                <button type="submit" onclick="this.disabled=true;this.form.submit();" class="w-full bg-indigo-600 text-white py-2 rounded-lg font-bold hover:bg-indigo-700 transition">
                    حفظ ونشر الوسام 🏅
                </button>
            </form>
        </div>

   
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-lg font-bold mb-4 text-right">الأوسمة الحالية</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="border-b text-gray-400 text-sm">
                            <th class="pb-3 text-right">الوسام</th>
                            <th class="pb-3 text-right">الاسم</th>
                            <th class="pb-3 text-right">الشرط</th>
                            <th class="pb-3 text-right">القيمة</th>
                            <th class="pb-3 text-center">الإجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($badges as $badge)
                            <tr class="border-b last:border-0 hover:bg-gray-50 transition">
                                <td class="py-4">
                                    <img src="{{ asset('images/' . $badge->image_path) }}" class="w-10 h-10 rounded-lg object-cover shadow-sm">
                                </td>
                                <td class="py-4 font-medium text-gray-800">{{ $badge->name }}</td>
                                <td class="py-4 text-sm text-gray-600">
                                    {{ $badge->criteria_type == 'count' ? 'عدد تحديات' : 'عدد أيام' }}
                                </td>
                                <td class="py-4 font-bold text-indigo-600 text-center">{{ $badge->criteria_value }}</td>
                                <td class="py-4">
                                    <div class="flex items-center justify-center gap-3">
                                       
                                        <a href="{{ route('admin.badges.edit', $badge->id) }}" class="text-blue-600 font-bold hover:underline text-sm">
                                            تعديل
                                        </a>

                                       
                                        <form action="{{ route('admin.badges.destroy', $badge->id) }}" method="POST" onsubmit="return confirm('هل أنتِ متأكدة من حذف هذا الوسام؟')">
                                            @csrf
                                            @method('DELETE') 
                                            <button type="submit" class="text-red-500 font-bold hover:text-red-700 transition text-sm">
                                                حذف
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($badges->isEmpty())
                <p class="text-center text-gray-500 py-10">لا يوجد أوسمة مضافة حالياً.</p>
            @endif
        </div>

    </div>
</div>
@endsection