@extends('layouts.guest')

@section('title', 'Вход')
@section('subtitle', 'Доступ к платформе обучения')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="space-y-5">
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
        </div>

        {{-- Password --}}
        <div>
            <label class="block text-xs text-slate-400 mb-1">
                Пароль
            </label>
            <input type="password" name="password" required
                class="w-full rounded-xl bg-[rgb(var(--panel2))]
                   border soft-border px-4 py-2.5 text-sm
                   text-slate-200 placeholder:text-slate-500
                   focus:outline-none focus:ring-2 focus:ring-emerald-500/40"
                placeholder="••••••••">
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full mt-2 rounded-xl
               bg-emerald-500/15 hover:bg-emerald-500/20
               ring-1 ring-emerald-500/30
               py-2.5 text-sm font-semibold text-emerald-200
               transition">
            Войти
        </button>
        <div class="text-center text-xs text-slate-400 pt-3">
            <a href="{{ route('password.request') }}" class="hover:underline hover:text-emerald-400 transition">
                Забыли пароль?
            </a>
        </div>

        {{-- Footer links --}}
        <div class="text-center text-xs text-slate-400 pt-2">
            Нет аккаунта?
            <a href="{{ route('register') }}" class="text-emerald-400 hover:underline">
                Зарегистрироваться
            </a>
        </div>
    </form>
@endsection
