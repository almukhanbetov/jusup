{{-- resources/views/layouts/app.blade.php --}}
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EduDev') }} — Dashboard</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    {{-- Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Stake-ish vibe (не ломает Tailwind, просто добавляет красивые цвета) */
        :root {
            --bg: 12 14 19;
            --panel: 16 19 26;
            --panel2: 18 22 30;
            --border: 38 44 58;
            --text: 226 232 240;
            --muted: 148 163 184;
            --brand: 34 197 94;
            /* green */
            --brand2: 16 185 129;
            /* emerald */
            --danger: 239 68 68;
            --warn: 245 158 11;
        }

        .stake-bg {
            background: radial-gradient(1200px 600px at 15% 0%, rgba(34, 197, 94, .08), transparent 55%),
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
            box-shadow: 0 0 0 1px rgba(148, 163, 184, .10), 0 20px 50px rgba(0, 0, 0, .45);
        }
    </style>
</head>

<body class="h-full stake-bg text-slate-200 font-[Inter]">
    <div class="min-h-full">

        {{-- HEADER --}}
        <header class="sticky top-0 z-40 glass border-b soft-border">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex h-16 items-center justify-between gap-3">

                    {{-- Left: Logo + burger --}}
                    <div class="flex items-center gap-3">
                        <button type="button"
                            class="md:hidden inline-flex items-center justify-center rounded-xl border soft-border bg-white/5 hover:bg-white/10 px-3 py-2 transition"
                            onclick="document.documentElement.classList.toggle('sidebar-open')"
                            aria-label="Toggle sidebar">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </button>

                        <a href="{{ url('/') }}" class="flex items-center gap-2">
                            <span
                                class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-emerald-500/15 ring-1 ring-emerald-500/30">
                                <svg class="h-5 w-5 text-emerald-400" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 3l8 5v8l-8 5-8-5V8l8-5Z" stroke="currentColor" stroke-width="2" />
                                    <path d="M12 8v8" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                    <path d="M8.5 10.5h7" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" />
                                </svg>
                            </span>
                            <div class="leading-tight">
                                <div class="text-sm font-semibold tracking-wide">{{ config('app.name', 'EduDev') }}
                                </div>
                                <div class="text-[11px] text-slate-400">Coding • DevOps • CI/CD</div>
                            </div>
                        </a>
                    </div>

                    {{-- Center: Search --}}
                    <div class="hidden md:flex flex-1 justify-center">
                        <form action="{{ url()->current() }}" method="GET" class="w-full max-w-xl">
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 21l-4.3-4.3" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" />
                                        <path d="M10.8 18a7.2 7.2 0 1 1 0-14.4 7.2 7.2 0 0 1 0 14.4Z"
                                            stroke="currentColor" stroke-width="2" />
                                    </svg>
                                </span>
                                <input name="q" value="{{ request('q') }}"
                                    placeholder="Поиск: Docker, GitHub Actions, Linux, Laravel, Go…"
                                    class="w-full rounded-2xl border soft-border bg-white/5 pl-10 pr-4 py-2.5 text-sm text-slate-200 placeholder:text-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/40" />
                            </div>
                        </form>
                    </div>

                    {{-- Right: actions + user --}}
                    <div class="flex items-center gap-2">
                        <a href="{{ url('/docs') }}"
                            class="hidden sm:inline-flex items-center gap-2 rounded-xl border soft-border bg-white/5 hover:bg-white/10 px-3 py-2 text-sm transition">
                            <span class="text-emerald-400">●</span>
                            <span>Docs</span>
                        </a>

                        <a href="{{ url('/status') }}"
                            class="hidden sm:inline-flex items-center gap-2 rounded-xl border soft-border bg-white/5 hover:bg-white/10 px-3 py-2 text-sm transition">
                            <svg class="h-4 w-4 text-slate-300" viewBox="0 0 24 24" fill="none">
                                <path d="M4 19V5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M8 19V9" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M12 19V13" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M16 19V7" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                <path d="M20 19V11" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                            </svg>
                            <span>Status</span>
                        </a>

                        {{-- User dropdown (простая версия) --}}
                        @auth
                            <div class="relative group">
                                <button
                                    class="inline-flex items-center gap-2 rounded-2xl border soft-border bg-white/5 hover:bg-white/10 px-3 py-2 transition">
                                    <span
                                        class="inline-flex h-8 w-8 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/10 text-sm font-semibold">
                                        {{ strtoupper(mb_substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                    </span>
                                    <div class="hidden sm:block text-left leading-tight">
                                        <div class="text-sm font-medium">{{ auth()->user()->name }}</div>
                                        <div class="text-[11px] text-slate-400">{{ auth()->user()->email }}</div>
                                    </div>
                                    <svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none">
                                        <path d="M6 9l6 6 6-6" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" />
                                    </svg>
                                </button>

                                <div
                                    class="invisible opacity-0 group-hover:visible group-hover:opacity-100 transition absolute right-0 mt-2 w-56 rounded-2xl ringy border soft-border bg-[rgb(var(--panel))] p-2">
                                    <a href="{{ url('/profile') }}"
                                        class="block rounded-xl px-3 py-2 text-sm hover:bg-white/5">
                                        Профиль
                                    </a>
                                    <a href="{{ url('/settings') }}"
                                        class="block rounded-xl px-3 py-2 text-sm hover:bg-white/5">
                                        Настройки
                                    </a>
                                    <div class="my-2 h-px bg-white/10"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-left rounded-xl px-3 py-2 text-sm hover:bg-white/5 text-red-300">
                                            Выйти
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center gap-2 rounded-2xl bg-emerald-500/15 ring-1 ring-emerald-500/30 hover:bg-emerald-500/20 px-4 py-2 text-sm font-semibold text-emerald-200 transition">
                                Войти
                            </a>
                        @endauth
                    </div>

                </div>

                {{-- NAVBAR (top links) --}}
                <nav class="hidden md:flex items-center gap-2 pb-3">
                    @php
                        $nav = [
                            ['label' => 'Dashboard', 'url' => url('/dashboard')],
                            ['label' => 'Courses', 'url' => url('/courses')],
                            ['label' => 'Labs', 'url' => url('/labs')],
                            ['label' => 'CI/CD', 'url' => url('/cicd')],
                            ['label' => 'Linux', 'url' => url('/linux')],
                            ['label' => 'Docker', 'url' => url('/docker')],
                            ['label' => 'Kubernetes', 'url' => url('/k8s')],
                        ];
                    @endphp

                    @foreach ($nav as $item)
                        <a href="{{ $item['url'] }}"
                            class="rounded-xl px-3 py-1.5 text-sm text-slate-300 hover:text-white hover:bg-white/5 transition">
                            {{ $item['label'] }}
                        </a>
                    @endforeach

                    <div class="ml-auto flex items-center gap-2">
                        <span class="text-[11px] text-slate-500">ENV:</span>
                        <span class="text-[11px] px-2 py-1 rounded-lg bg-white/5 ring-1 ring-white/10 text-slate-300">
                            {{ app()->environment() }}
                        </span>
                        <span
                            class="text-[11px] px-2 py-1 rounded-lg bg-emerald-500/10 ring-1 ring-emerald-500/20 text-emerald-200">
                            Deploy ready
                        </span>
                    </div>
                </nav>
            </div>
        </header>

        {{-- MAIN --}}
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-6 py-6">

                {{-- SIDEBAR --}}
                <aside class="col-span-12 md:col-span-3 lg:col-span-2">
                    <div class="rounded-3xl ringy border soft-border bg-[rgb(var(--panel))] overflow-hidden">
                        <div class="p-4 border-b soft-border bg-white/3">
                            <div class="text-sm font-semibold">Учебный трек</div>
                            <div class="text-[12px] text-slate-400 mt-1">План: Coding → DevOps → CI/CD</div>
                        </div>

                        <div class="p-2">
                            @php
                                $menu = [
                                    ['icon' => '⚡', 'label' => 'Обзор', 'url' => url('/dashboard')],
                                    ['icon' => '📚', 'label' => 'Курсы', 'url' => url('/courses')],
                                    ['icon' => '🧪', 'label' => 'Практика (Labs)', 'url' => url('/labs')],
                                    ['icon' => '🔧', 'label' => 'Инструменты', 'url' => url('/tools')],
                                    ['icon' => '🐧', 'label' => 'Linux', 'url' => url('/linux')],
                                    ['icon' => '🐳', 'label' => 'Docker', 'url' => url('/docker')],
                                    ['icon' => '☸️', 'label' => 'K8s', 'url' => url('/k8s')],
                                    ['icon' => '🚀', 'label' => 'CI/CD', 'url' => url('/cicd')],
                                    ['icon' => '🧾', 'label' => 'Чек-листы', 'url' => url('/checklists')],
                                    ['icon' => '💬', 'label' => 'Комьюнити', 'url' => url('/community')],
                                ];
                            @endphp

                            @foreach ($menu as $item)
                                <a href="{{ $item['url'] }}"
                                    class="flex items-center gap-3 rounded-2xl px-3 py-2.5 text-sm text-slate-300 hover:text-white hover:bg-white/5 transition">
                                    <span class="text-lg leading-none">{{ $item['icon'] }}</span>
                                    <span class="font-medium">{{ $item['label'] }}</span>
                                </a>
                            @endforeach
                        </div>

                        <div class="p-4 border-t soft-border">
                            <div class="rounded-2xl bg-emerald-500/10 ring-1 ring-emerald-500/20 p-3">
                                <div class="text-sm font-semibold text-emerald-200">DevOps Mission</div>
                                <div class="text-[12px] text-slate-300/80 mt-1">
                                    Собери пайплайн: build → test → dockerize → deploy.
                                </div>
                                <a href="{{ url('/cicd') }}"
                                    class="mt-3 inline-flex w-full items-center justify-center rounded-xl bg-emerald-500/15 hover:bg-emerald-500/20 ring-1 ring-emerald-500/25 px-3 py-2 text-sm font-semibold text-emerald-100 transition">
                                    Открыть CI/CD
                                </a>
                            </div>
                        </div>
                    </div>
                </aside>

                {{-- CONTENT --}}
                <main class="col-span-12 md:col-span-9 lg:col-span-10">
                    {{-- Content header / breadcrumbs --}}
                    <div class="mb-6">
                        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-3">
                            <div>
                                <h1 class="text-xl sm:text-2xl font-bold tracking-tight">
                                    @yield('title', 'Dashboard')
                                </h1>
                                <p class="text-sm text-slate-400 mt-1">
                                    @yield('subtitle', 'Темный обучающий шаблон в стиле Stake для проектов Coding/DevOps/CI/CD.')
                                </p>
                            </div>

                            {{-- quick actions --}}
                            <div class="flex items-center gap-2">
                                <a href="{{ url('/labs/new') }}"
                                    class="inline-flex items-center gap-2 rounded-2xl bg-white/5 hover:bg-white/10 ring-1 ring-white/10 px-4 py-2 text-sm font-semibold transition">
                                    <span class="text-emerald-400">+</span> New Lab
                                </a>

                                <a href="{{ url('/deploy') }}"
                                    class="inline-flex items-center gap-2 rounded-2xl bg-emerald-500/15 hover:bg-emerald-500/20 ring-1 ring-emerald-500/25 px-4 py-2 text-sm font-semibold text-emerald-100 transition">
                                    🚀 Deploy
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- flash messages --}}
                    @if (session('status'))
                        <div
                            class="mb-6 rounded-2xl border soft-border bg-emerald-500/10 ring-1 ring-emerald-500/15 px-4 py-3 text-sm text-emerald-100">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- actual page content --}}
                    <div class="rounded-3xl ringy border soft-border bg-[rgb(var(--panel))] p-4 sm:p-6">
                        @yield('content')
                    </div>

                    {{-- FOOTER --}}
                    <footer class="mt-6 text-xs text-slate-500">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2">
                            <div>
                                © {{ date('Y') }} {{ config('app.name', 'EduDev') }} — Build • Ship • Learn
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="px-2 py-1 rounded-lg bg-white/5 ring-1 ring-white/10">Laravel 12</span>
                                <span class="px-2 py-1 rounded-lg bg-white/5 ring-1 ring-white/10">Tailwind</span>
                                <span class="px-2 py-1 rounded-lg bg-white/5 ring-1 ring-white/10">Vite</span>
                            </div>
                        </div>
                    </footer>
                </main>

            </div>
        </div>

    </div>

    {{-- маленькая мобильная логика (без зависимостей) --}}
    <style>
        /* Sidebar mobile open/close (простая идея): */
        @media (max-width: 767px) {
            /* по умолчанию sidebar сверху, ок */
            /* если захотите делать offcanvas — скажите, дам версию с overlay */
        }
    </style>
</body>

</html>
