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
        <div id="success-message" class="bg-green-500 text-white p-4 rounded-lg mb-6 text-center shadow-lg animate-bounce">
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
                        $isDone = ($challenge->pivot->status == 'completed');
                        $total = $challenge->total_days > 0 ? $challenge->total_days : 1;
                        $completed = $challenge->pivot->completed_days ?? 0;
                        $percentage = $isDone ? 100 : (($completed / $total) * 100);
                    @endphp

                    <div class="bg-white border-2 {{ $isDone ? 'border-green-400 bg-green-50' : 'border-indigo-100' }} p-6 rounded-2xl relative shadow-sm flex flex-col justify-between transition-all duration-300">
                        <div>
                            @if($isDone)
                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold border border-green-600">
                                    ✅ تحدي مكتمل
                                </span>
                            @else
                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold border border-blue-200">
                                    ⌛ قيد التنفيذ
                                </span>
                            @endif

                            <h3 class="text-xl font-bold mt-3 mb-2 {{ $isDone ? 'text-green-900' : 'text-gray-800' }}">{{ $challenge->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $challenge->description }}</p>
                            
                            <div class="mt-4">
                                <div class="flex justify-between mb-1 text-sm font-medium {{ $isDone ? 'text-green-700' : 'text-indigo-700' }}">
                                    <span>{{ $isDone ? 'تم الإنجاز' : 'تقدمك' }}</span>
                                    <span class="font-bold">{{ round($percentage) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="h-2.5 rounded-full transition-all duration-700 {{ $isDone ? 'bg-green-500' : 'bg-indigo-600' }}" 
                                         style="width: {{ $percentage }}%">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            @if($isDone)
                                <div class="bg-yellow-100 border-2 border-yellow-400 p-4 rounded-xl text-center shadow-inner">
                                    <span class="text-3xl mb-1 block">⭐</span>
                                    <p class="text-yellow-800 font-bold text-sm">أحسنتِ! تحققي من الأوسمة 🏅</p>
                                </div>
                            @else
                                <form action="{{ route('challenges.complete', $challenge->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-lg transition shadow-md active:scale-95">
                                        ✅ تم إنجاز التحدي
                                    </button>
                                </form>
                            @endif
                            
                            @if(!$isDone)
                                <form action="{{ route('challenges.leave', $challenge->id) }}" method="POST" class="mt-2" onsubmit="return confirm('هل أنتِ متأكدة؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full text-red-400 hover:text-red-600 text-xs py-1 transition">
                                        ❌ انسحاب
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div class="mt-4 pt-4 border-t text-xs text-gray-400 flex justify-between items-center">
                            <span>بدأ في: {{ $challenge->pivot->created_at ? $challenge->pivot->created_at->format('Y/m/d') : '-' }}</span>
                            <span class="{{ $isDone ? 'text-green-600' : 'text-indigo-600' }} font-bold text-sm">
                                {{ $isDone ? $total : $completed }} / {{ $total }} يوم
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
                    setTimeout(() => { message.style.display = 'none'; }, 1000);
                }, 3000);
            }
        });
    </script>
</body>
</html>