<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-base-200 min-h-screen">
    <div class="drawer sticky top-0 z-50">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <nav class="navbar bg-base-100 shadow-sm">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-2" aria-label="open sidebar" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            class="inline-block h-6 w-6 stroke-current">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16">
                            </path>
                        </svg>
                    </label>
                </div>
                <div class="flex-1">
                    <a class="btn btn-ghost text-xl">Lapangan Futsal</a>
                </div>
                <div class="hidden flex-none lg:block">
                    <ul class="menu menu-horizontal px-1">
                        {{-- ADMIN --}}
                        @if (auth()->user()->hasRole('admin'))
                        <li>
                            <a href="/dashboard"
                                class="{{ request()->is('dashboard') ? 'menu-active' : '' }}">dashboard</a>
                        </li>
                        <li>
                            <a href="/users" class="{{ request()->is('users*') ? 'menu-active' : '' }}">users</a>
                        </li>
                        <li>
                            <a href="/fields" class="{{ request()->is('fields*') ? 'menu-active' : '' }}">lapangan</a>
                        </li>
                        <li>
                            <a href="/schedules"
                                class="{{ request()->is('schedules*') ? 'menu-active' : '' }}">jadwal</a>
                        </li>
                        <li>
                            <a href="/reservations"
                                class="{{ request()->is('reservations*') ? 'menu-active' : '' }}">reservasi</a>
                        </li>
                        <li>
                            <a href="/activity-log"
                                class="{{ request()->is('activity-log') ? 'menu-active' : '' }}">activity
                                log</a>
                        </li>
                        <li>
                            <a href="/profile" class="{{ request()->is('profile') ? 'menu-active' : '' }}">profile</a>
                        </li>
                        @endif

                        {{-- PENGELOLA --}}
                        @if (auth()->user()->hasRole('pengelola'))
                        <li>
                            <a href="/dashboard"
                                class="{{ request()->is('dashboard') ? 'menu-active' : '' }}">dashboard</a>
                        </li>
                        <li>
                            <a href="/fields" class="{{ request()->is('fields*') ? 'menu-active' : '' }}">lapangan</a>
                        </li>
                        <li>
                            <a href="/schedules"
                                class="{{ request()->is('schedules*') ? 'menu-active' : '' }}">jadwal</a>
                        </li>
                        <li>
                            <a href="/reservations"
                                class="{{ request()->is('reservations*') ? 'menu-active' : '' }}">reservasi</a>
                        </li>
                        <li>
                            <a href="/profile" class="{{ request()->is('profile') ? 'menu-active' : '' }}">profile</a>
                        </li>
                        @endif

                        {{-- USER --}}
                        @if (auth()->user()->hasRole('user'))
                        <li>
                            <a href="/dashboard"
                                class="{{ request()->is('dashboard') ? 'menu-active' : '' }}">dashboard</a>
                        </li>
                        <li>
                            <a href="/fields" class="{{ request()->is('fields*') ? 'menu-active' : '' }}">lapangan</a>
                        </li>
                        <li>
                            <a href="/schedules"
                                class="{{ request()->is('schedules*') ? 'menu-active' : '' }}">jadwal</a>
                        </li>
                        <li>
                            <a href="/reservations/my"
                                class="{{ request()->is('reservations*') ? 'menu-active' : '' }}">reservasi</a>
                        </li>
                        <li>
                            <a href="/profile" class="{{ request()->is('profile') ? 'menu-active' : '' }}">profile</a>
                        </li>
                        @endif
                        <form action="/logout" method="POST">
                            <li>
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="hover:bg-red-500 hover:text-white">Logout</button>
                            </li>
                        </form>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="drawer-side">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu bg-base-200 min-h-full w-80 p-4">
                {{-- ADMIN --}}
                @if (auth()->user()->hasRole('admin'))
                <li>
                    <a href="/dashboard" class="{{ request()->is('dashboard') ? 'menu-active' : '' }}">dashboard</a>
                </li>
                <li>
                    <a href="/users" class="{{ request()->is('users*') ? 'menu-active' : '' }}">users</a>
                </li>
                <li>
                    <a href="/fields" class="{{ request()->is('fields*') ? 'menu-active' : '' }}">lapangan</a>
                </li>
                <li>
                    <a href="/schedules" class="{{ request()->is('schedules*') ? 'menu-active' : '' }}">jadwal</a>
                </li>
                <li>
                    <a href="/reservations"
                        class="{{ request()->is('reservations*') ? 'menu-active' : '' }}">reservasi</a>
                </li>
                <li>
                    <a href="/activity-log" class="{{ request()->is('activity-log') ? 'menu-active' : '' }}">activity
                        log</a>
                </li>
                <li>
                    <a href="/profile" class="{{ request()->is('profile') ? 'menu-active' : '' }}">profile</a>
                </li>
                @endif

                {{-- PENGELOLA --}}
                @if (auth()->user()->hasRole('pengelola'))
                <li>
                    <a href="/dashboard" class="{{ request()->is('dashboard') ? 'menu-active' : '' }}">dashboard</a>
                </li>
                <li>
                    <a href="/fields" class="{{ request()->is('fields*') ? 'menu-active' : '' }}">lapangan</a>
                </li>
                <li>
                    <a href="/schedules" class="{{ request()->is('schedules*') ? 'menu-active' : '' }}">jadwal</a>
                </li>
                <li>
                    <a href="/reservations"
                        class="{{ request()->is('reservations*') ? 'menu-active' : '' }}">reservasi</a>
                </li>
                <li>
                    <a href="/profile" class="{{ request()->is('profile') ? 'menu-active' : '' }}">profile</a>
                </li>
                @endif

                {{-- USER --}}
                @if (auth()->user()->hasRole('user'))
                <li>
                    <a href="/dashboard" class="{{ request()->is('dashboard') ? 'menu-active' : '' }}">dashboard</a>
                </li>
                <li>
                    <a href="/fields" class="{{ request()->is('fields*') ? 'menu-active' : '' }}">lapangan</a>
                </li>
                <li>
                    <a href="/schedules" class="{{ request()->is('schedules*') ? 'menu-active' : '' }}">jadwal</a>
                </li>
                <li>
                    <a href="/reservations/my"
                        class="{{ request()->is('reservations*') ? 'menu-active' : '' }}">reservasi</a>
                </li>
                <li>
                    <a href="/profile" class="{{ request()->is('profile') ? 'menu-active' : '' }}">profile</a>
                </li>
                @endif
                <form action="/logout" method="POST">
                    <li>
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="hover:bg-red-500 hover:text-white">Logout</button>
                    </li>
                </form>
            </ul>
        </div>
    </div>
    <main class="container mx-auto my-6 px-2 space-y-4">
        {{ $slot }}
    </main>
</body>

</html>