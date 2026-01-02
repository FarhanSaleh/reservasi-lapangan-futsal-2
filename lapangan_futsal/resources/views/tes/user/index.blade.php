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
    <a href="/users/create" class="border">Create</a>
    <table class="table-auto">
        <thead>
            <tr>
                <th class="border">Name</th>
                <th class="border">Email</th>
                <th class="border">Phone Number</th>
                <th class="border">Role</th>
                <th class="border">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td class="border p-2">{{ $user->name }}</td>
                <td class="border p-2">{{ $user->email }}</td>
                <td class="border p-2">{{ $user->phone_number }}</td>
                <td class="border p-2">{{ $user->role->name }}</td>
                <td class="border p-2">
                    <a href="/users/{{ $user->id }}/edit" class="border">Edit</a>
                    <form action="/users/{{ $user->id }}" method="POST" class="inline">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="border">Delete</button>
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
</x-base-layout>