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
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- QR Code Section -->
        <div class="lg:col-span-2">
            <div class="card bg-base-100 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-lg mb-4">
                        <i data-lucide="qr-code" class="w-5 h-5"></i>
                        Langkah 1: Scan QR Code
                    </h2>

                    <!-- Instructions -->
                    <div class="alert alert-info mb-4">
                        <i data-lucide="info"></i>
                        <span>Gunakan aplikasi Google Authenticator, Authy, atau Microsoft Authenticator untuk scan QR
                            code di bawah ini.</span>
                    </div>

                    <!-- QR Code Display -->
                    <div class="flex justify-center bg-base-200 p-8 rounded-lg mb-4">
                        <img src="{{ $qrCodeUrl }}" alt="2FA QR Code" class="w-64 h-64">
                    </div>

                    <!-- Manual Key Input -->
                    <div class="divider">atau</div>

                    <div class="mb-4">
                        <p class="text-sm text-base-content/70 mb-2">Jika Anda tidak bisa scan QR code, masukkan kunci
                            manual di bawah ke aplikasi Anda:</p>
                        <div class="flex items-center gap-2">
                            <input type="text" value="{{ $secretKey }}"
                                class="input input-bordered flex-1 font-mono text-sm" readonly>
                            <button type="button" class="btn btn-ghost btn-square" onclick="copyToClipboard()">
                                <i data-lucide="copy" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Verification Form Section -->
        <div>
            <div class="card bg-base-100 shadow-sm sticky top-4">
                <div class="card-body">
                    <h2 class="card-title text-lg mb-4">
                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                        Langkah 2: Verifikasi
                    </h2>

                    <!-- Error Alert -->
                    @if ($errors->any())
                    <div class="alert alert-error mb-4">
                        <i data-lucide="circle-x"></i>
                        <div>
                            @foreach ($errors->all() as $error)
                            <span class="text-sm">{{ $error }}</span><br>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Verification Form -->
                    <form action="/2fa/enable" method="POST" class="space-y-4">
                        @csrf
                        @method("POST")
                        <fieldset class="fieldset">
                            <legend class="fieldset-legend">Kode Verifikasi</legend>
                            <input type="text" name="otp"
                                class="input input-bordered w-full text-center text-2xl tracking-widest font-bold @error('otp') input-error @enderror"
                                placeholder="000000" maxlength="6" pattern="\d{6}" inputmode="numeric" required
                                autofocus />
                            @error('otp')
                            <p class="label text-error text-sm">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-base-content/60 mt-2">Masukkan 6 digit kode dari aplikator Anda</p>
                        </fieldset>

                        <button type="submit" class="btn btn-primary w-full">
                            <i data-lucide="lock" class="w-4 h-4"></i>
                            Aktifkan 2FA
                        </button>
                    </form>

                    <!-- Security Warning -->
                    <div class="alert alert-warning mt-4">
                        <i data-lucide="alert-circle"></i>
                        <span class="text-xs">Simpan backup code Anda yang akan ditampilkan setelah aktivasi.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-base-layout>