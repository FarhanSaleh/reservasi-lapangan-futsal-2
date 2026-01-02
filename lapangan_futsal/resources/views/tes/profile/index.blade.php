<x-base-layout>
    @if (session('error'))
    <p class="text-red-500">{{ session('error') }}</p>
    @endif
    <h1 class="text-2xl">Profile</h1>
    <h1 class="text-xl">Role: {{ $user->role->name }}</h1>
    <form action="/profile" method="POST">
        @csrf
        @method("PUT")
        <div>
            @error('name')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="text" name="name" placeholder="Nama" class="border" value="{{ $user->name }}">
        </div>
        <div>
            @error('email')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="text" name="email" placeholder="Email" class="border" value="{{ $user->email }}">
        </div>
        <div>
            @error('phone_number')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="text" name="phone_number" placeholder="Phone Number" class="border"
                value="{{ $user->phone_number }}">
        </div>
        <hr>
        <div>
            @error('old-password')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="password" name="old-password" placeholder="Old Password" class="border">
        </div>
        <div>
            @error('new-password')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="password" name="new-password" placeholder="New Password" class="border">
        </div>
        <div>
            @error('password_confirmation')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="border">
        </div>
        <div>
            <button type="submit" class="border">Save</button>
        </div>
    </form>
</x-base-layout>