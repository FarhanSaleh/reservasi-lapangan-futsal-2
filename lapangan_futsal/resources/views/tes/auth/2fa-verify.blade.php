<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="h-screen flex items-center justify-center">
        <form action="/2fa/verify" method="POST">
            <div class="card w-auto sm:w-96 bg-base-100 shadow-sm">
                <div class="card-body">
                    <h1 class="text-2xl font-bold">2FA Verify</h1>
                    <p class="text-red-500 font-bold">
                        @session('error')
                        {{ session('error') }}
                        @endsession
                    </p>
                    @csrf
                    @method("POST")
                    <fieldset class="fieldset">
                        <legend class="fieldset-legend">Kode OTP</legend>
                        <input type="text" class="input w-full" placeholder="Kode OTP" name="otp"
                            value="{{ old('otp') }}" />
                        @error('otp')
                        <p class="label text-red-500">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-base-content/60 mt-2">Masukkan 6 digit kode dari aplikasi
                            authenticator Anda</p>
                    </fieldset>
                    <button type="submit" class="btn btn-primary">Verifikasi</button>
                    <div class="text-xs self-center">
                        <form action="/logout" method="POST">
                            @csrf
                            @method("POST")
                            <button type="submit" class="cursor-pointer text-primary font-bold">Kembali ke Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>