<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <h1 class="text-2xl">Jadwal</h1>
    <form action="/schedules/{{ $schedule->id }}" method="POST">
        @csrf
        @method("PUT")
        <div>
            @error('day')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="text" name="day" placeholder="Hari" class="border" value="{{ $schedule->day }}">
        </div>
        <div>
            @error('status')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <select name="status" class="border">
                <option value="" disabled>Pilih Status</option>
                @foreach ($status as $item)
                <option value="{{ $item->name }}" {{ $schedule->status == $item->name ? 'selected' : '' }}>
                    {{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            @error('start_time')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="time" name="start_time" placeholder="Start Time" class="border"
                value="{{ $schedule->start_time }}">
        </div>
        <div>
            @error('end_time')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <input type="time" name="end_time" placeholder="End Time" class="border" value="{{ $schedule->end_time }}">
        </div>
        <div>
            @error('field_id')
            <p class="text-red-500">{{ $message }}</p>
            @enderror
            <select name="field_id" class="border">
                <option value="" disabled>Pilih Lapangan</option>
                @foreach ($fields as $field)
                <option value="{{ $field->id }}" {{ $schedule->field_id == $field->id ? 'selected' : '' }}>
                    {{ $field->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="border">Save</button>
        </div>
    </form>
</body>

</html>