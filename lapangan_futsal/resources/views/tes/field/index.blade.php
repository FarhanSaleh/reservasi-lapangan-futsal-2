<x-base-layout>
    <h1 class="text-2xl">Lapangan</h1>
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
    <a href="/fields/create" class="btn btn-primary">Create</a>
    <div class="overflow-x-auto bg-base-100 border border-base-300 rounded">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Price Per Hour</th>
                    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pengelola'))
                    <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($fields as $field)
                <tr>
                    <td>{{ $field->name }}</td>
                    <td>{{ $field->type }}</td>
                    <td>{{ Number::currency($field->price_per_hour, in: 'IDR', locale: 'id-ID') }}</td>
                    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pengelola'))
                    <td>
                        <a href="/fields/{{ $field->id }}/edit" class="btn btn-warning">Edit</a>
                        <form action="/fields/{{ $field->id }}" method="POST" class="inline">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-error"
                                onclick="return confirm('Apa kamu yakin?')">Delete</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="4">No data</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-base-layout>