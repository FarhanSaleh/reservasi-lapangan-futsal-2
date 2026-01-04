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
    @if (auth()->user()->hasRole('user'))
    <a href="/schedules" class="btn btn-primary">Reservasi</a>
    @endif
    <div class="overflow-x-auto bg-base-100 border border-base-300 rounded">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>Tanggal Reservasi</th>
                    <th>Status</th>
                    <th>Customer</th>
                    <th>Lapangan</th>
                    <th>Jadwal Hari</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->reservation_date }}</td>
                    <td
                        class="{{ $reservation->status == 'pending' ? 'text-yellow-600' : ($reservation->status == 'canceled' ? 'text-red-500' : 'text-green-500') }}">
                        {{ $reservation->status }}</td>
                    <td>{{ $reservation->user->name }}</td>
                    <td>{{ $reservation->schedule->field->name }}</td>
                    <td>{{ $reservation->schedule->day }}</td>
                    <td>{{ $reservation->schedule->start_time }}</td>
                    <td>{{ $reservation->schedule->end_time }}</td>
                    <td>
                        @if (auth()->user()->hasRole('user'))
                        @if ($reservation->status == 'pending')
                        <form action="/reservations/{{ $reservation->id }}" method="POST" class="inline">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-error" onclick="return confirm('Apa anda yakin?')">Batal</button>
                        </form>
                        @endif
                        @endif
                        <a href="/reservations/{{ $reservation->id }}" class="btn btn-info">Detail</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-base-layout>