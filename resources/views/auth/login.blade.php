<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>تسجيل الدخول - دخول المتحدين</title>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md mx-4">
        
        {{-- قسم العنوان --}}
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">دخول المتحدين 🛡️</h2>
            <p class="text-gray-500 mt-2 text-sm">أهلاً بك مجدداً، استكمل تحدياتك الآن</p>
        </div>

        {{-- رسالة نجاح إنشاء الحساب --}}
        @if(session('success'))
            <div id="registration-success" class="bg-green-50 border-r-4 border-green-500 text-green-700 px-4 py-3 rounded-lg relative mb-6 shadow-sm transition-all duration-500">
                <div class="flex items-center">
                    <span class="text-xl ml-2">🥳</span>
                    <p class="text-sm font-bold">{{ session('success') }}</p>
                </div>
            </div>

            <script>
                setTimeout(function() {
                    const alert = document.getElementById('registration-success');
                    if (alert) {
                        alert.style.opacity = "0";
                        setTimeout(() => alert.remove(), 600);
                    }
                }, 4000);
            </script>
        @endif

        {{-- فورم تسجيل الدخول --}}
        <form action="{{ route('login') }}" method="POST" autocomplete="off">
            @csrf
            <div class="mb-5">
                <label class="block mb-2 text-sm font-semibold text-gray-700">البريد الإلكتروني</label>
                <input type="email" name="email" autocomplete="off" 
                       class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" 
                       placeholder="example@mail.com" required>
            </div>

            <div class="mb-6">
                <label class="block mb-2 text-sm font-semibold text-gray-700">كلمة المرور</label>
                <input type="password" name="password" autocomplete="new-password" 
                       class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition" 
                       placeholder="••••••••" required>
            </div>

            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-bold text-lg shadow-lg transform active:scale-95 transition duration-200">
                دخول
            </button>
        </form>

        {{-- رابط إنشاء حساب --}}
        <div class="mt-8 text-center border-t pt-6">
            <p class="text-sm text-gray-600">
                ليس لديك حساب؟ 
                <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:text-indigo-800 transition duration-200 underline decoration-indigo-200 underline-offset-4">
                    إنشاء حساب جديد
                </a>
            </p>
        </div>
    </div>

</body>
</html>