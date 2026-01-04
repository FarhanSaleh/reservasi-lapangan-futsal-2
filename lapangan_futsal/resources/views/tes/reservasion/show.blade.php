<x-base-layout>
    <h1 class="text-2xl">Detail Reservasi</h1>
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
    <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">
        {{-- {{ dd($reservation) }} --}}
        <div class="flex flex-col gap-2">
            <h3 class="font-semibold">Data Reservasi</h3>
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h4 class="card-title">Tanggal Reservasi</h4>
                    <div>{{ $reservation->reservation_date }}</div>
                </div>
            </div>
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h3 class="card-title">Status</h3>
                    <div
                        class="{{ $reservation->status == 'pending' ? 'text-yellow-600' : ($reservation->status == 'canceled' ? 'text-red-500' : 'text-green-500') }}">
                        {{ $reservation->status }}</div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <h3 class="font-semibold">Data Customer</h3>
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h4 class="card-title">Nama Customer</h4>
                    <div>{{ $reservation->user->name }}</div>
                </div>
            </div>
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h4 class="card-title">Phone</h4>
                    <div>{{ $reservation->user->phone_number }}</div>
                </div>
            </div>
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h4 class="card-title">Email</h4>
                    <div>{{ $reservation->user->email }}</div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <h3 class="font-semibold">Data Lapangan</h3>
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h4 class="card-title">Lapangan</h4>
                    <div>{{ $reservation->schedule->field->name }}</div>
                </div>
            </div>
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h4 class="card-title">Tipe Lapangan</h4>
                    <div>{{ $reservation->schedule->field->type }}</div>
                </div>
            </div>
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h4 class="card-title">Harga per jam</h4>
                    <div>{{ $pricePerHour }}</div>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <h3 class="font-semibold">Jadwal</h3>
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h4 class="card-title">Jadwal</h4>
                    <div>{{ $reservation->schedule->day }}</div>
                </div>
            </div>
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h4 class="card-title">Durasi</h4>
                    <div>{{ $reservation->schedule->start_time }} - {{ $reservation->schedule->end_time }}</div>
                    <div>{{ $totalDuration }} jam</div>
                </div>
            </div>
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h4 class="card-title">Total Harga</h4>
                    <div>{{ $totalPrice }}</div>
                </div>
            </div>
        </div>
    </div>
    <br>
    @if ($payment->count() > 0)
    <div class="space-y-2 mb-4">
        <h2 class="text-2xl">Riwayat Pembayaran</h2>
        @foreach ($payment as $item)
        <div class="card bg-base-100 shadow h-96">
            <figure>
                <a href="{{ asset('storage/' . $item->payment_proof) }}" target="_blank">
                    <img src="{{ asset('storage/' . $item->payment_proof) }}" alt="Bukti Pembayaran">
                </a>
            </figure>
            <div class="card-body">
                <div class="grid gap-4 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4">
                    <div>
                        <div class="font-semibold">Metode Pembayaran</div>
                        <div>{{ $item->payment_method }}</div>
                    </div>
                    <div>
                        <div class="font-semibold">Status Pembayaran</div>
                        <div
                            class="{{ $item->status == 'pending' ? 'text-yellow-600' : ($item->status == 'failed' ? 'text-red-500' : 'text-green-500') }}">
                            {{ $item->status }}</div>
                    </div>
                    <div>
                        <div class="font-semibold">Total Bayar</div>
                        <div>{{ $item->amount }}</div>
                    </div>
                    <div>
                        <div class="font-semibold">Tanggal Pembayaran</div>
                        <div>{{ $item->payment_date }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    <br>
    @if (auth()->user()->hasRole('user'))
    @if ($reservation->status == 'pending')
    @if (!$latestPayment || $latestPayment->status == 'failed')
    <div>
        <h2 class="text-2xl">Lanjutkan Pembayaran</h2>
        <form action="/reservations/{{ $reservation->id }}/payments" enctype="multipart/form-data" method="POST">
            @csrf
            @method('POST')
            <fieldset class="fieldset ">
                <legend class="fieldset-legend">Metode Pembayaran</legend>
                <select name="payment_method" class="select w-full">
                    <option value="" disabled>Pilih Metode Pembayaran</option>
                    @foreach ($paymentMethod as $method)
                    <option value="{{ $method->name }}" {{ old('payment_method')==$method->name ? 'selected' : '' }}>
                        {{ $method->name }}</option>
                    @endforeach
                </select>
                @error('payment_method')
                <p class="label text-red-500">{{ $message }}</p>
                @enderror
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Jumlah Pembayaran</legend>
                <input type="number" class="input w-full" placeholder="Jumlah Pembayaran" name="amount"
                    value="{{ $totalPriceNum }}" />
                @error('amount')
                <p class="label text-red-500">{{ $message }}</p>
                @enderror
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Bukti Pembayaran</legend>
                <input type="file" class="file-input w-full" placeholder="Bukti Pembayaran" name="payment_proof" />
                @error('payment_proof')
                <p class="label text-red-500">{{ $message }}</p>
                @enderror
            </fieldset>
            <button type="submit" class="btn btn-primary mt-4">Bayar</button>
        </form>
    </div>
    @endif
    @endif
    @endif

    @if (auth()->user()->hasRole('admin') || auth()->user()->hasRole('pengelola'))
    @if($latestPayment)
    <div>
        <h2 class="text-2xl">Tindak lanjut pembayaran</h2>
        <form action="/reservations/{{ $reservation->id }}/payments/{{ $latestPayment->id }}/status" method="POST">
            @csrf
            @method('PUT')
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Status Pembayaran</legend>
                <select name="status" class="select w-full">
                    <option value="success">Berhasil</option>
                    <option value="pending">Pending</option>
                    <option value="failed">Gagal</option>
                </select>
                @error('status')
                <p class="label text-red-500">{{ $message }}</p>
                @enderror
            </fieldset>
            <button type="submit" class="btn btn-primary mt-2">Tindak Lanjut</button>
        </form>
    </div>
    @endif
    @endif
</x-base-layout>