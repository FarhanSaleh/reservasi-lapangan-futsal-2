<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <h1 class="text-2xl">Jadwal</h1>
    @session('success')
    <div class="text-green-500">
        {{ session('success') }}
    </div>
    @endsession
    @session('error')
    <div class="text-red-500">
        {{ session('error') }}
    </div>
    @endsession
    <a href="/schedules/create" class="border">Create</a>
    <table class="table-auto">
        <thead>
            <tr>
                <th class="border">Hari</th>
                <th class="border">Waktu Mulai</th>
                <th class="border">Waktu Selesai</th>
                <th class="border">Lapangan</th>
                <th class="border">Tipe Lapangan</th>
                <th class="border">Harga per jam</th>
                <th class="border">Status</th>
                <th class="border">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schedules as $schedule)
            <tr>
                <td class="border p-2">{{ $schedule->day }}</td>
                <td class="border p-2">{{ $schedule->start_time }}</td>
                <td class="border p-2">{{ $schedule->end_time }}</td>
                <td class="border p-2">{{ $schedule->field->name }}</td>
                <td class="border p-2">{{ $schedule->field->type }}</td>
                <td class="border p-2">{{ $schedule->field->price_per_hour }}</td>
                <td class="border p-2">{{ $schedule->status }}</td>
                <td class="border p-2">
                    <a href="/schedules/{{ $schedule->id }}/edit" class="border">Edit</a>
                    <form action="/schedules/{{ $schedule->id }}" method="POST" class="inline">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="border">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>

</html>