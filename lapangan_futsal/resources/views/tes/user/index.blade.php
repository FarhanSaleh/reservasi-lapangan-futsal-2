<x-base-layout>
    <h1 class="text-2xl">User</h1>
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
    <a href="/users/create" class="btn btn-primary">Create</a>
    <div class="overflow-x-auto bg-base-100 border border-base-300 rounded">
        <table class="table table-zebra">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone_number }}</td>
                    <td>{{ $user->role->name }}</td>
                    <td>
                        <a href="/users/{{ $user->id }}/edit" class="btn btn-warning">Edit</a>
                        <form action="/users/{{ $user->id }}" method="POST" class="inline">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-error"
                                onclick="return confirm('Apa kamu yakin?')">Delete</button>
                        </form>
                    </td>
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