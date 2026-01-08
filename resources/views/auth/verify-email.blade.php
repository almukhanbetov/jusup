@extends('layouts.guest')

@section('title', 'Подтверждение email')
@section('subtitle', 'Подтвердите адрес электронной почты')

@section('content')
<div class="space-y-5 text-sm">

    {{-- Info --}}
    <p class="text-slate-400 text-center">
        Спасибо за регистрацию!  
        Перед началом работы подтвердите адрес электронной почты,
        перейдя по ссылке, отправленной на ваш email.
    </p>

    {{-- Status --}}
    @if (session('status') === 'verification-link-sent')
        <div
            class="rounded-xl bg-emerald-500/10 ring-1 ring-emerald-500/20
                   px-4 py-2 text-xs text-emerald-200 text-center">
            Новая ссылка для подтверждения отправлена на ваш email.
        </div>
    @endif

    {{-- Resend --}}
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button
            type="submit"
            class="w-full rounded-xl
                   bg-emerald-500/15 hover:bg-emerald-500/20
                   ring-1 ring-emerald-500/30
                   py-2.5 text-sm font-semibold text-emerald-200 transition">
            Отправить письмо повторно
        </button>
    </form>

    {{-- Logout --}}
    <form method="POST" action="{{ route('logout') }}" class="text-center">
        @csrf
        <button
            type="submit"
            class="text-xs text-slate-400 hover:text-red-400 transition">
            Выйти из аккаунта
        </button>
    </form>

</div>
@endsection
