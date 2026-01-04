<x-base-layout>
    <h1 class="text-2xl">Jadwal</h1>
    <form action="/schedules/{{ $schedule->id }}" method="POST">
        @csrf
        @method("PUT")
        <fieldset class="fieldset">
            <legend class="fieldset-legend">Hari</legend>
            <input type="text" class="input w-full" placeholder="Nama hari (misal: Senin, Selasa, dll)" name="day"
                value="{{ $schedule->day }}" />
            @error('day')
            <p class="label text-red-500">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="fieldset ">
            <legend class="fieldset-legend">Status</legend>
            <select name="status" class="select w-full">
                <option value="" disabled>Pilih Status</option>
                @foreach ($status as $item)
                <option value="{{ $item->name }}" {{ $schedule->status == $item->name ? 'selected' : '' }}>
                    {{ $item->name }}</option>
                @endforeach
            </select>
            @error('status')
            <p class="label text-red-500">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="fieldset">
            <legend class="fieldset-legend">Waktu Mulai</legend>
            <input type="time" class="input w-full" placeholder="Waktu mulai (misal: 10:00)" name="start_time"
                value="{{ $schedule->start_time }}" />
            @error('start_time')
            <p class="label text-red-500">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="fieldset">
            <legend class="fieldset-legend">Waktu Selesai</legend>
            <input type="time" class="input w-full" placeholder="Waktu selesai (misal: 10:00)" name="end_time"
                value="{{ $schedule->end_time }}" />
            @error('end_time')
            <p class="label text-red-500">{{ $message }}</p>
            @enderror
        </fieldset>
        <fieldset class="fieldset">
            <legend class="fieldset-legend">Lapangan</legend>
            <select name="field_id" class="select w-full">
                <option value="" disabled>Pilih Lapangan</option>
                @foreach ($fields as $field)
                <option value="{{ $field->id }}" {{ $schedule->field_id == $field->id ? 'selected' : '' }}>
                    {{ $field->name }}</option>
                @endforeach
            </select>
            @error('field_id')
            <p class="label text-red-500">{{ $message }}</p>
            @enderror
        </fieldset>
        <button type="submit" class="btn btn-primary mt-4">Save</button>
    </form>
</x-base-layout>