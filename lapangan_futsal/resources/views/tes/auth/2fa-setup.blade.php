<x-base-layout>
    <h1 class="text-2xl">2 Faktor Autentikasi</h1>
    @if ($isTwoFactorEnabled)
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div class="stats shadow">
            <div class="stat bg-base-100">
                <div class="stat-title">Status</div>
                <div class="stat-value text-success">2FA Aktif</div>
                <div class="stat-desc">Akun telah diamankan dengan autentikasi 2 faktor</div>
            </div>
        </div>
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <form action="/2fa/disable" method="POST">
                    @csrf
                    @method("POST")
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Password</legend>
                        <input type="password" name="current_password" id="current_password"
                            placeholder="masukkan password anda untuk menonaktifkan 2fa" class="input w-full">
                        @error('current_password')
                        <p class="label text-red-500">{{ $message }}</p>
                        @enderror
                    </fieldset>
                    <button type="submit" class="btn btn-sm btn-error self-end mt-4">Nonaktifkan</button>
                </form>
            </div>
        </div>
    </div>
    @else

    @endif
</x-base-layout>