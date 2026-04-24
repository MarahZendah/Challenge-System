<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام التحديات - لوحة التحكم</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Cairo', sans-serif; } </style>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm p-4 mb-6">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="font-bold text-xl text-indigo-600">تحدياتي 🎯</a>
            <div>
                <a href="/challenges" class="mx-2 text-gray-600 hover:text-indigo-600">التحديات</a>
                <a href="/my-badges" class="mx-2 text-gray-600 hover:text-indigo-600">أوسمتي 🏆</a>
                
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="/admin/dashboard" class="mx-2 text-red-600 hover:text-red-800 font-bold border-r pr-2">لوحة التحكم ⚙️</a>
                    @endif
                    
                    <span class="text-indigo-600 font-bold mr-4">مرحباً، {{ auth()->user()->name }}</span>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4">
        @yield('content')
    </main>

</body>
</html>