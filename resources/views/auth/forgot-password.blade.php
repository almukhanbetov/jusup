@extends('layouts.guest')

@section('title', 'Восстановление пароля')
@section('subtitle', 'Мы отправим ссылку для сброса пароля')

@section('content')
    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        {{-- Email --}}
        <div>
            <label class="block text-xs text-slate-400 mb-1">
                Email
            </label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full rounded-xl bg-[rgb(var(--panel2))]
                   border soft-border px-4 py-2.5 text-sm
                   text-slate-200 placeholder:text-slate-500
                   focus:outline-none focus:ring-2 focus:ring-emerald-500/40"
                placeholder="you@example.com">
            @error('email')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Status --}}
        @if (session('status'))
            <div
                class="rounded-xl bg-emerald-500/10 ring-1 ring-emerald-500/20
                    px-4 py-2 text-xs text-emerald-200">
                {{ session('status') }}
            </div>
        @endif

        {{-- Submit --}}
        <button type="submit"
            class="w-full mt-2 rounded-xl
               bg-emerald-500/15 hover:bg-emerald-500/20
               ring-1 ring-emerald-500/30
               py-2.5 text-sm font-semibold text-emerald-200 transition">
            Отправить ссылку
        </button>

        {{-- Footer --}}
        <div class="text-center text-xs text-slate-400 pt-2">
            <a href="{{ route('login') }}" class="hover:underline">
                ← Вернуться ко входу
            </a>
        </div>
    </form>
@endsection
