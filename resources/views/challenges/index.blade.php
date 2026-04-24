<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>كل التحديات</title>
</head>
<body class="bg-gray-100">

    @include('nav')

    <div class="max-w-6xl mx-auto px-4 py-8">
        
        @if(session('success'))
            <div id="success-alert" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-center">
                {{ session('success') }}
            </div>

            <script>
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

        <h1 class="text-3xl font-bold text-center text-indigo-800 mb-10">التحديات المتاحة</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($challenges as $challenge)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $challenge->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4">{{ $challenge->description }}</p>
                        
                       
                        <div class="flex items-center text-indigo-600 font-bold text-sm mb-4 bg-indigo-50 p-2 rounded-lg inline-block">
                            <span>📅 مدة التحدي: {{ $challenge->total_days }} يوم</span>
                        </div>
                    </div>

                    <div class="mt-4">
                        @if(auth()->user()->challenges->contains($challenge->id))
                            
                            <button disabled type="button" class="w-full bg-gray-300 text-gray-600 font-bold py-2 rounded-lg cursor-not-allowed mb-2">
                                أنت مشترك بالفعل
                            </button>
                            
                            
                            <form action="{{ route('challenges.leave', $challenge->id) }}" method="POST" class="mt-2" onsubmit="return confirm('هل تريد فعلاً إلغاء الاشتراك؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-2 rounded-lg transition shadow-md">
                                    إلغاء الاشتراك ❌
                                </button>
                            </form>
                        @else
                            
                            <form action="{{ route('challenges.join', $challenge->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 rounded-lg transition shadow-md">
                                    اشتراك الآن
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>