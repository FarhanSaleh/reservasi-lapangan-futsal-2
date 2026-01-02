<x-base-layout>
    <h1 class="text-2xl">User</h1>
    <form action="/users" method="POST">
        @csrf
        @method("POST")
        <div>
            @error('name')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="text" name="name" placeholder="Nama" class="border" value="{{ old('name') }}">
        </div>
        <div>
            @error('email')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="text" name="email" placeholder="Email" class="border" value="{{ old('email') }}">
        </div>
        <div>
            @error('phone_number')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="text" name="phone_number" placeholder="Phone Number" class="border"
                value="{{ old('phone_number') }}">
        </div>
        <div>
            @error('role_id')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <select name="role_id" class="border">
                <option value="">Pilih Role</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ old('role_id')==$role->id ? 'selected' : '' }}>
                    {{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="border">Save</button>
        </div>
    </form>
</x-base-layout>