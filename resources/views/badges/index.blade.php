@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-6 text-center">أوسمتي وإنجازاتي 🏆</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @forelse($badges as $badge)
            <div class="bg-white p-6 rounded-lg shadow-lg text-center border-t-4 border-yellow-400">
                <img src="{{ asset('images/badges/' . $badge->image_path) }}" class="w-24 h-24 mx-auto mb-4">
                <h3 class="text-xl font-semibold">{{ $badge->name }}</h3>
                <p class="text-gray-600 text-sm mt-2">{{ $badge->description }}</p>
            </div>
        @empty
            <div class="col-span-3 text-center py-10">
                <p class="text-gray-500 text-lg">لم تحصل على أوسمة بعد، استمر في التحدي! 💪</p>
            </div>
        @endforelse
    </div>
</div>
@endsection