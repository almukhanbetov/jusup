{{-- resources/views/layouts/guest.blade.php --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EduDev') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* SAME STAKE STYLE AS app.blade.php */
        :root {
            --bg: 12 14 19;
            --panel: 16 19 26;
            --panel2: 18 22 30;
            --border: 38 44 58;
            --text: 226 232 240;
            --muted: 148 163 184;
            --brand: 34 197 94;
            --brand2: 16 185 129;
        }

        .stake-bg {
            background:
                radial-gradient(1200px 600px at 15% 0%, rgba(34, 197, 94, .08), transparent 55%),
                radial-gradient(1000px 500px at 90% 10%, rgba(16, 185, 129, .07), transparent 55%),
                rgb(var(--bg));
        }

        .glass {
            background: rgba(16, 19, 26, .72);
            backdrop-filter: blur(10px);
        }

        .soft-border {
            border-color: rgba(148, 163, 184, .12);
        }

        .ringy {
            box-shadow:
                0 0 0 1px rgba(148, 163, 184, .10),
                0 20px 50px rgba(0, 0, 0, .45);
        }
    </style>
</head>

<body class="h-full stake-bg text-slate-200 font-[Inter]">
    <div class="min-h-full flex flex-col">

        {{-- HEADER (LIGHT VERSION) --}}
        <header class="sticky top-0 z-40 glass border-b soft-border">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="h-16 flex items-center justify-between">

                    {{-- Logo --}}
                    <a href="{{ url('/') }}" class="flex items-center gap-2">
                        <span
                            class="inline-flex h-9 w-9 items-center justify-center rounded-xl
                               bg-emerald-500/15 ring-1 ring-emerald-500/30">
                            ⬡
                        </span>
                        <div>
                            <div class="text-sm font-semibold">{{ config('app.name', 'EduDev') }}</div>
                            <div class="text-[11px] text-slate-400">
                                Coding • DevOps • CI/CD
                            </div>
                        </div>
                    </a>

                    {{-- Actions --}}
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}"
                            class="text-sm px-4 py-2 rounded-xl bg-white/5 hover:bg-white/10 ring-1 ring-white/10 transition">
                            Войти
                        </a>
                        <a href="{{ route('register') }}"
                            class="text-sm px-4 py-2 rounded-xl
                              bg-emerald-500/15 hover:bg-emerald-500/20
                              ring-1 ring-emerald-500/30 text-emerald-200 transition">
                            Регистрация
                        </a>
                    </div>

                </div>
            </div>
        </header>

        {{-- MAIN --}}
        <main class="flex-1 flex items-center justify-center px-4">
            <div class="w-full max-w-[420px]">

                {{-- AUTH CARD --}}
                <div class="rounded-3xl ringy border soft-border bg-[rgb(var(--panel))] p-6 sm:p-8">

                    {{-- Title --}}
                    <div class="mb-6 text-center">
                        <h1 class="text-xl font-bold">
                            @yield('title', 'Добро пожаловать')
                        </h1>
                        <p class="text-sm text-slate-400 mt-1">
                            @yield('subtitle', 'Войдите, чтобы продолжить обучение')
                        </p>
                    </div>

                    {{-- Content --}}
                    @yield('content')

                </div>

                {{-- Footer --}}
                <div class="mt-6 text-center text-xs text-slate-500">
                    © {{ date('Y') }} {{ config('app.name', 'EduDev') }} — Build • Ship • Learn
                </div>

            </div>
        </main>

    </div>
</body>

</html>
