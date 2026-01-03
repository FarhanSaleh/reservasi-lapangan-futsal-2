<x-base-layout>
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
    <a href="/schedules" class="border">Reservasi</a>
    <table class="table-auto">
        <thead>
            <tr>
                <th class="border">Tanggal Reservasi</th>
                <th class="border">Status</th>
                <th class="border">Customer</th>
                <th class="border">Lapangan</th>
                <th class="border">Jadwal Hari</th>
                <th class="border">Waktu Mulai</th>
                <th class="border">Waktu Selesai</th>
                <th class="border">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
            <tr>
                <td class="border p-2">{{ $reservation->reservation_date }}</td>
                <td class="border p-2">{{ $reservation->status }}</td>
                <td class="border p-2">{{ $reservation->user->name }}</td>
                <td class="border p-2">{{ $reservation->schedule->field->name }}</td>
                <td class="border p-2">{{ $reservation->schedule->day }}</td>
                <td class="border p-2">{{ $reservation->schedule->start_time }}</td>
                <td class="border p-2">{{ $reservation->schedule->end_time }}</td>
                <td class="border p-2">
                    @if ($reservation->status == 'pending')
                    <form action="/reservations/{{ $reservation->id }}" method="POST" class="inline">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="border">Batal</button>
                    </form>
                    @endif
                    <a href="/reservations/{{ $reservation->id }}" class="border">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">No data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</x-base-layout>