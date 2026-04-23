<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب جديد | تحدياتي</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Cairo', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-indigo-600">انضم إلينا 🎯</h1>
            <p class="text-gray-500 mt-2">ابدأ رحلة التحدي والالتزام اليوم</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border-r-4 border-red-500 text-red-700 p-3 mb-4 rounded">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/register" method="POST" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-gray-700 font-bold mb-2">الاسم الكامل</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border focus:border-indigo-500 focus:bg-white focus:outline-none transition duration-200"
                    placeholder="أدخل اسمك">
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border focus:border-indigo-500 focus:bg-white focus:outline-none transition duration-200"
                    placeholder="example@mail.com">
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">كلمة المرور</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border focus:border-indigo-500 focus:bg-white focus:outline-none transition duration-200"
                    placeholder="********">
            </div>

            <div>
                <label class="block text-gray-700 font-bold mb-2">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-3 rounded-lg bg-gray-50 border focus:border-indigo-500 focus:bg-white focus:outline-none transition duration-200"
                    placeholder="********">
            </div>

            <button type="submit" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg shadow-lg transition duration-300 transform hover:-translate-y-1">
                إنشاء حساب
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">لديك حساب بالفعل؟ 
                <a href="/login" class="text-indigo-600 font-bold hover:underline">تسجيل الدخول</a>
            </p>
        </div>
    </div>

</body>
</html>