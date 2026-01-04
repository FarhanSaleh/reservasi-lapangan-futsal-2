<x-base-layout>

    <body>
        <h1 class="text-2xl">Lapangan</h1>
        <form action="/fields/{{ $field->id }}" method="POST">
            @csrf
            @method("PUT")
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Nama Lapangan</legend>
                <input type="text" class="input w-full" placeholder="Nama Lapangan" name="name"
                    value="{{ $field->name }}" />
                @error('name')
                <p class="label text-red-500">{{ $message }}</p>
                @enderror
            </fieldset>
            <fieldset class="fieldset ">
                <legend class="fieldset-legend">Jenis Lapangan</legend>
                <select name="type" class="select w-full">
                    <option value="" disabled>Pilih Jenis Lapangan</option>
                    @foreach ($field_types as $field_type)
                    <option value="{{ $field_type->name }}" {{ $field->type == $field_type->name ? 'selected' : '' }}>
                        {{ $field_type->name }}</option>
                    @endforeach
                </select>
                @error('type')
                <p class="label text-red-500">{{ $message }}</p>
                @enderror
            </fieldset>
            <fieldset class="fieldset">
                <legend class="fieldset-legend">Harga Lapangan</legend>
                <input type="number" class="input w-full" placeholder="Harga Lapangan" name="price_per_hour"
                    value="{{ $field->price_per_hour }}" />
                @error('price_per_hour')
                <p class="label text-red-500">{{ $message }}</p>
                @enderror
            </fieldset>
            <button type="submit" class="btn btn-primary mt-4">Simpan</button>
        </form>
    </body>
</x-base-layout>