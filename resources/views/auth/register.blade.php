@extends('layouts.guest')

@section('title', 'Регистрация')
@section('subtitle', 'Создайте аккаунт для доступа к платформе')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        {{-- Name --}}
        <div>
            <label class="block text-xs text-slate-400 mb-1">
                Имя
            </label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus
                class="w-full rounded-xl bg-[rgb(var(--panel2))]
                   border soft-border px-4 py-2.5 text-sm
                   text-slate-200 placeholder:text-slate-500
                   focus:outline-none focus:ring-2 focus:ring-emerald-500/40"
                placeholder="Ваше имя">
            @error('name')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div>
            <label class="block text-xs text-slate-400 mb-1">
                Email
            </label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full rounded-xl bg-[rgb(var(--panel2))]
                   border soft-border px-4 py-2.5 text-sm
                   text-slate-200 placeholder:text-slate-500
                   focus:outline-none focus:ring-2 focus:ring-emerald-500/40"
                placeholder="you@example.com">
            @error('email')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
            @enderror
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
            @error('password')
                <p class="mt-1 text-xs text-red-400">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm password --}}
        <div>
            <label class="block text-xs text-slate-400 mb-1">
                Повторите пароль
            </label>
            <input type="password" name="password_confirmation" required
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
               py-2.5 text-sm font-semibold text-emerald-200 transition">
            Зарегистрироваться
        </button>

        {{-- Footer --}}
        <div class="text-center text-xs text-slate-400 pt-2">
            Уже есть аккаунт?
            <a href="{{ route('login') }}" class="text-emerald-400 hover:underline">
                Войти
            </a>
        </div>
    </form>
@endsection
