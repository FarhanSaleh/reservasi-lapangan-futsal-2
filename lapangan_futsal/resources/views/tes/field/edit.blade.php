<x-base-layout>
    <body>
        <h1 class="text-2xl">Lapangan</h1>
        <form action="/fields/{{ $field->id }}" method="POST">
            @csrf
            @method("PUT")
            <div>
                @error('name')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <input type="text" name="name" placeholder="Nama" class="border" value="{{ $field->name }}">
            </div>
            <div>
                @error('type')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <select name="type" class="border">
                    <option value="" disabled>Pilih Jenis Lapangan</option>
                    @foreach ($field_types as $field_type)
                    <option value="{{ $field_type->name }}" {{ $field->type == $field_type->name ? 'selected' : '' }}>
                        {{ $field_type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                @error('price_per_hour')
                <p class="text-red-500">{{ $message }}</p>
                @enderror
                <input type="number" name="price_per_hour" placeholder="Price Per Hour" class="border"
                    value="{{ $field->price_per_hour }}">
            </div>
            <div>
                <button type="submit" class="border">Save</button>
            </div>
        </form>
    </body>
</x-base-layout>