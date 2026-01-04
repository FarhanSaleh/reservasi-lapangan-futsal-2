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
    <a href="/schedules/create" class="btn btn-primary">Create</a>
    <div class="overflow-x-auto bg-base-100 border border-base-300 rounded">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>Hari</th>
                    <th>Waktu Mulai</th>
                    <th>Waktu Selesai</th>
                    <th>Lapangan</th>
                    <th>Tipe Lapangan</th>
                    <th>Harga per jam</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($schedules as $schedule)
                <tr>
                    <td>{{ $schedule->day }}</td>
                    <td>{{ $schedule->start_time }}</td>
                    <td>{{ $schedule->end_time }}</td>
                    <td>{{ $schedule->field->name }}</td>
                    <td>{{ $schedule->field->type }}</td>
                    <td>{{ Number::currency($schedule->field->price_per_hour, in: 'IDR', locale: 'id-ID') }}</td>
                    <td class="{{ $schedule->status == 'available' ? 'text-success' : 'text-error' }}">{{
                        $schedule->status }}</td>
                    <td>
                        @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pengelola'))
                        <a href="/schedules/{{ $schedule->id }}/edit" class="btn btn-warning">Edit</a>
                        <form action="/schedules/{{ $schedule->id }}" method="POST" class="inline">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-error"
                                onclick="return confirm('Apa kamu yakin?')">Delete</button>
                        </form>
                        @endif
                        @if (auth()->user()->hasRole('user'))
                        <form action="/reservations" method="POST" class="inline">
                            @csrf
                            @method("POST")
                            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                            <button type="submit" class="btn btn-primary">Pesan</button>
                        </form>
                        @endif
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