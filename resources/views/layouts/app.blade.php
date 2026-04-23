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
        <div class="container mx-auto flex justify-between">
            <a href="/" class="font-bold text-indigo-600">تحدياتي 🎯</a>
            <div>
                <a href="/admin/dashboard" class="mx-2 text-gray-600">لوحة التحكم</a>
                <a href="/challenges" class="mx-2 text-gray-600">التحديات</a>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

</body>
</html>