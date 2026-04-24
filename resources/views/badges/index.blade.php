@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-2xl font-bold mb-6">أوسمتي 🏅</h1>
    <div class="grid grid-cols-3 gap-4">
        @foreach($userBadges as $badge)
            <div class="bg-white p-4 rounded shadow text-center">
                <img src="{{ asset('images/' . $badge->image_path) }}" class="w-20 mx-auto">
                <p class="mt-2 font-bold">{{ $badge->name }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection