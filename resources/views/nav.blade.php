<nav class="bg-white shadow-lg mb-8">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center space-x-4 space-x-reverse">
                <span class="font-bold text-indigo-600 text-xl italic">تحدياتي 🎯</span>
                <div class="hidden md:flex items-center space-x-4 space-x-reverse">
                    <a href="/challenges" class="text-gray-600 hover:text-indigo-600 font-medium px-3">كل التحديات</a>
                    <a href="/my-challenges" class="text-gray-600 hover:text-indigo-600 font-medium px-3">تحدياتي</a>
                @if(auth()->check() && auth()->user()->is_admin)
        <a href="{{ route('admin.dashboard') }}" class="text-red-600 hover:text-red-800 font-bold px-3 border-r border-gray-200">
            إدارة الموقع ⚙️
        </a>
    @endif
                </div>
            </div>

            <div class="flex items-center space-x-4 space-x-reverse">
                @if(auth()->check())
                    <span class="text-gray-700 font-semibold border-l pl-4 ml-4">
                        مرحباً، {{ auth()->user()->name }} 👋
                    </span>
                    <form action="/logout" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm font-bold">
                            خروج
                        </button>
                    </form>
                @else
                    <a href="/login" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-bold">
                        تسجيل الدخول
                    </a>
                    <a href="/register" class="bg-indigo-600 text-white px-4 py-2 rounded-lg text-sm font-bold">إنشاء حساب</a>
                @endif
            </div>
        </div>
    </div>
</nav>