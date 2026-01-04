<x-base-layout>
    <h1 class="text-2xl">User</h1>
    <form action="/users" method="POST">
        @csrf
        @method("POST")
        <fieldset class="fieldset">
            <legend class="fieldset-legend">Nama</legend>
            <input type="text" class="input w-full" placeholder="Nama" name="name" value="{{ old('name') }}" />
            @error('name')
            <p class="label text-red-500">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="fieldset ">
            <legend class="fieldset-legend">Email</legend>
            <input type="email" class="input w-full" placeholder="Email" name="email" value="{{ old('email') }}" />
            @error('email')
            <p class="label text-red-500">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="fieldset ">
            <legend class="fieldset-legend">Phone Number</legend>
            <input type="text" class="input w-full" placeholder="Phone Number" name="phone_number"
                value="{{ old('phone_number') }}" />
            @error('phone_number')
            <p class="label text-red-500">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="fieldset ">
            <legend class="fieldset-legend">Role</legend>
            <select name="role_id" class="select w-full">
                <option value="" disabled>Pilih Role</option>
                @foreach ($roles as $role)
                <option value="{{ $role->id }}" {{ old('role_id')==$role->id ? 'selected' : '' }}>
                    {{ $role->name }}</option>
                @endforeach
            </select>
            @error('role_id')
            <p class="label text-red-500">{{ $message }}</p>
            @enderror
        </fieldset>
        <button type="submit" class="btn btn-primary mt-4">Simpan</button>
    </form>
</x-base-layout>