<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div>
        <nav>
            <ul class="flex gap-2">
                {{-- ADMIN --}}
                @if (auth()->user()->hasRole('admin'))
                <li class="border p-1">
                    <a href="/dashboard">dashboard</a>
                </li>
                <li class="border p-1">
                    <a href="/users">users</a>
                </li>
                <li class="border p-1">
                    <a href="/fields">lapangan</a>
                </li>
                <li class="border p-1">
                    <a href="/schedules">jadwal</a>
                </li>
                <li class="border p-1">
                    <a href="/reservations">reservasi</a>
                </li>
                <li class="border p-1">
                    <a href="/profile">profile</a>
                </li>
                @endif

                {{-- PENGELOLA --}}
                @if (auth()->user()->hasRole('pengelola'))
                <li class="border p-1">
                    <a href="/dashboard">dashboard</a>
                </li>
                <li class="border p-1">
                    <a href="/fields">lapangan</a>
                </li>
                <li class="border p-1">
                    <a href="/schedules">jadwal</a>
                </li>
                <li class="border p-1">
                    <a href="/reservations">reservasi</a>
                </li>
                <li class="border p-1">
                    <a href="/profile">profile</a>
                </li>
                @endif

                {{-- USER --}}
                @if (auth()->user()->hasRole('user'))
                <li class="border p-1">
                    <a href="/dashboard">dashboard</a>
                </li>
                <li class="border p-1">
                    <a href="/fields">lapangan</a>
                </li>
                <li class="border p-1">
                    <a href="/schedules">jadwal</a>
                </li>
                <li class="border p-1">
                    <a href="/reservations/my">reservasi</a>
                </li>
                <li class="border p-1">
                    <a href="/profile">profile</a>
                </li>
                @endif
            </ul>
        </nav>
        <br>
        {{ $slot }}
    </div>
</body>

</html>