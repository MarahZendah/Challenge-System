<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>تحدياتي الخاصة</title>
</head>
<body class="bg-gray-50">

    @include('nav')

    @if(session('success'))
        <div id="success-message" class="bg-green-500 text-white p-4 rounded-lg mb-6 text-center shadow-lg animate-bounce opacity-100 transition-opacity duration-1000">
            {{ session('success') }}
        </div>
    @endif

    <div class="max-w-6xl mx-auto px-4 p-8">
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-bold text-indigo-900">تحدياتي التي أشترك بها 🚀</h1>
        </div>

        @if($myChallenges->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl shadow-sm border">
                <p class="text-gray-500 text-xl">لم تشترك في أي تحدي بعد. ابدأ الآن!</p>
                <a href="/challenges" class="text-indigo-600 mt-4 inline-block hover:underline">تصفح التحديات من هنا</a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($myChallenges as $challenge)
                    @php
                        $total = $challenge->total_days > 0 ? $challenge->total_days : 30;
                        $completed = $challenge->pivot->completed_days ?? 0;
                        $percentage = ($completed / $total) * 100;
                    @endphp

                    <div class="bg-white border-2 {{ $percentage >= 100 ? 'border-green-400 shadow-md' : 'border-indigo-100' }} p-6 rounded-2xl relative shadow-sm flex flex-col justify-between transition-all duration-300">
                        <div>
                            {{-- عرض حالة التحدي --}}
                            @if($percentage >= 100)
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-200">
                                    ✅ تحدي مكتمل
                                </span>
                            @else
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold border border-blue-200">
                                    ⌛ قيد التنفيذ
                                </span>
                            @endif

                            <h3 class="text-xl font-bold mt-3 mb-2 text-gray-800">{{ $challenge->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $challenge->description }}</p>
                            
                            {{-- شريط التقدم --}}
                            <div class="mt-4">
                                <div class="flex justify-between mb-1 text-sm font-medium text-indigo-700">
                                    <span>تقدمك في التحدي</span>
                                    <span class="{{ $percentage >= 100 ? 'text-green-600 font-bold' : '' }}">{{ round($percentage) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="h-2.5 rounded-full transition-all duration-500 {{ $percentage >= 100 ? 'bg-green-500' : 'bg-indigo-600' }}" 
                                         style="width: {{ $percentage > 100 ? 100 : $percentage }}%">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- منطقة الأكشن (زر أو كأس) --}}
                        <div class="mt-6">
                            @if($percentage >= 100)
                                <div class="bg-yellow-50 border-2 border-yellow-400 p-4 rounded-xl text-center shadow-inner">
                                    <span class="text-3xl mb-2 block">🏆</span>
                                    <p class="text-yellow-700 font-bold italic">أحسنت! لقد أتممت الهدف</p>
                                </div>
                            @else
                                <form action="{{ route('challenges.complete', $challenge->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 rounded-lg transition shadow-md active:scale-95">
                                        ✅ تم إنجاز اليوم
                                    </button>
                                </form>
                            @endif
                            {{-- زر إلغاء الاشتراك --}}
<form action="{{ route('challenges.leave', $challenge->id) }}" method="POST" class="mt-2" onsubmit="return confirm('هل أنت متأكد أنك تريد إلغاء الاشتراك في هذا التحدي؟ سيتم حذف تقدمك.')">
    @csrf
    @method('DELETE')
    <button type="submit" class="w-full text-red-500 hover:text-red-700 text-sm font-medium py-1 rounded transition">
        ❌ إلغاء الاشتراك
    </button>
</form>
                        </div>

                        
                        {{-- تذييل البطاقة --}}
                        <div class="mt-4 pt-4 border-t text-xs text-gray-500 flex justify-between items-center">
                            <span>بدأت في: {{ $challenge->pivot->start_date }}</span>
                            <span class="{{ $percentage >= 100 ? 'text-green-600' : 'text-indigo-600' }} font-bold italic text-sm">
                                {{ $completed }} من {{ $total }} يوم
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const message = document.getElementById('success-message');
            if (message) {
                setTimeout(() => {
                    message.style.opacity = '0'; 
                    setTimeout(() => {
                        message.style.display = 'none';
                    }, 1000);
                }, 3000);
            }
        });
    </script>
</body>
</html>
