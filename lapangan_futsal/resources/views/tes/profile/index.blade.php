<x-base-layout>
    @session('success')
    <div class="text-green-500">
        {{ session('success') }}
    </div>
    @endsession
    @session('error')
    <p class="text-red-500">{{ session('error') }}</p>
    @endsession
    <h1 class="text-2xl">Profile</h1>
    <div class="space-y-2">
        <h2 class="text-lg font-bold">Role: {{ $user->role->name }}</h2>
        <a href="/2fa/setup" class="btn btn-sm btn-outline btn-primary">Atur 2FA</a>
    </div>
    <form action="/profile" method="POST" class="space-y-4">
        @csrf
        @method("PUT")
        <div>
            <fieldset class="fieldset ">
                <legend class="fieldset-legend">Nama</legend>
                <input type="text" class="input w-full" placeholder="Nama" name="name" value="{{ $user->name }}" />
                @error('name')
                <p class="label text-red-500">{{ $message }}</p>
                @enderror
            </fieldset>
            <fieldset class="fieldset ">
                <legend class="fieldset-legend">Email</legend>
                <input type="email" class="input w-full" placeholder="Email" name="email" value="{{ $user->email }}" />
                @error('email')
                <p class="label text-red-500">{{ $message }}</p>
                @enderror
            </fieldset>
            <fieldset class="fieldset ">
                <legend class="fieldset-legend">Phone Number</legend>
                <input type="text" class="input w-full" placeholder="Phone Number" name="phone_number"
                    value="{{ $user->phone_number }}" />
                @error('phone_number')
                <p class="label text-red-500">{{ $message }}</p>
                @enderror
            </fieldset>
            <fieldset class="fieldset ">
                <legend class="fieldset-legend">Password Lama</legend>
                <input type="password" class="input w-full" placeholder="Password Lama" name="old_password" />
                @error('old_password')
                <p class="label text-red-500">{{ $message }}</p>
                @enderror
            </fieldset>
            <fieldset class="fieldset ">
                <legend class="fieldset-legend">Password Baru</legend>
                <input type="password" class="input w-full" placeholder="Password Baru" name="new_password" />
                @error('new_password')
                <p class="label text-red-500">{{ $message }}</p>
                @enderror
            </fieldset>
            <fieldset class="fieldset ">
                <legend class="fieldset-legend">Konfirmasi Password Baru</legend>
                <input type="password" class="input w-full" placeholder="Konfirmasi Password Baru"
                    name="password_confirmation" />
                @error('password_confirmation')
                <p class="label text-red-500">{{ $message }}</p>
                @enderror
            </fieldset>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</x-base-layout>