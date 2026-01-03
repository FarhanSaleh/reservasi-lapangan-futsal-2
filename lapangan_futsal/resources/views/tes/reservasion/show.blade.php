<x-base-layout>
    <h1 class="text-2xl">Jadwal</h1>
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
    <div class="flex gap-2">
        {{-- {{ dd($reservation) }} --}}
        <div class="border">
            <div>Tanggal Reservasi</div>
            <div>{{ $reservation->reservation_date }}</div>
        </div>
        <div class="border">
            <div>Status</div>
            <div>{{ $reservation->status }}</div>
        </div>
        <div class="border">
            <div>Customer</div>
            <div>{{ $reservation->user->name }}</div>
        </div>
        <div class="border">
            <div>Phone</div>
            <div>{{ $reservation->user->phone_number }}</div>
        </div>
        <div class="border">
            <div>Email</div>
            <div>{{ $reservation->user->email }}</div>
        </div>
        <div class="border">
            <div>Lapangan</div>
            <div>{{ $reservation->schedule->field->name }}</div>
        </div>
        <div class="border">
            <div>Tipe Lapangan</div>
            <div>{{ $reservation->schedule->field->type }}</div>
        </div>
        <div class="border">
            <div>Jadwal</div>
            <div>{{ $reservation->schedule->day }}</div>
        </div>
        <div class="border">
            <div>Durasi</div>
            <div>{{ $reservation->schedule->start_time }} - {{ $reservation->schedule->end_time }}</div>
            <div>{{ $totalDuration }} jam</div>
        </div>

        <div class="border">
            <div>Harga per jam</div>
            <div>{{ $pricePerHour }}</div>
        </div>
        <div class="border">
            <div>Total Harga</div>
            <div>{{ $totalPrice }}</div>
        </div>
    </div>
    <br>
    @if ($payment->count() > 0)
    <div class="space-y-2 mb-4">
        <h2 class="text-2xl">Riwayat Pembayaran</h2>
        @foreach ($payment as $item)
        <div class="border">
            <img src="{{ asset('storage/' . $item->payment_proof) }}" alt="Bukti Pembayaran" class="w-64 h-96">
        </div>
        <div class="border">
            <div>Metode Pembayaran</div>
            <div>{{ $item->payment_method }}</div>
        </div>
        <div class="border">
            <div>Status Pembayaran</div>
            <div>{{ $item->status }}</div>
        </div>
        <div class="border">
            <div>Total Bayar</div>
            <div>{{ $item->amount }}</div>
        </div>
        <div class="border">
            <div>Tanggal Pembayaran</div>
            <div>{{ $item->payment_date }}</div>
        </div>
        @endforeach
    </div>
    @endif
    <br>
    @if ($reservation->status == 'pending')
    @if (!$latestPayment || $latestPayment->status == 'failed')
    <div>
        <h2 class="text-2xl">Lanjutkan Pembayaran</h2>
        <form action="/reservations/{{ $reservation->id }}/payments" enctype="multipart/form-data" method="POST">
            @csrf
            @method('POST')
            <div>
                @error('payment_method')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <select name="payment_method" class="border">
                    <option value="" disabled selected>Pilih Metode Pembayaran</option>
                    @foreach ($paymentMethod as $method)
                    <option value="{{ $method->name }}">{{ $method->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                @error('amount')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <input type="number" name="amount" placeholder="Jumlah Pembayaran" class="border"
                    value="{{ $totalPriceNum }}">
            </div>
            <div>
                @error('payment_proof')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <input type="file" name="payment_proof" placeholder="Bukti Pembayaran" class="border">
            </div>
            <button type="submit" class="border">Bayar</button>
        </form>
    </div>
    @endif
    @endif
</x-base-layout>