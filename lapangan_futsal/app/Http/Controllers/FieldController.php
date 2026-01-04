<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FieldController extends Controller
{
    private function getFieldType()
    {
        return collect([['name' => 'vinyl'], ['name' => 'sintetik']])
            ->map(fn($item) => (object)$item);
    }


    public function index()
    {
        $fields = Field::all();
        // $pricePerHour = Number::currency($reservation->schedule->field->price_per_hour, in: 'IDR',  locale: 'id-ID');
        return view('tes.field.index', ['fields' => $fields]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tes.field.create', ['field_types' => $this->getFieldType()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required',
            'price_per_hour' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $field = Field::create([
            'name' => $request->name,
            'type' => $request->type,
            'price_per_hour' => $request->price_per_hour,
        ]);
        catat_log('create', 'Membuat lapangan baru');
        return redirect("/fields")->with('success', 'Lapangan berhasil ditambahkan');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $field = Field::findOrFail($id);
        return view('tes.field.edit', ['field' => $field, 'field_types' => $this->getFieldType()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'type' => 'required',
            'price_per_hour' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $field = Field::findOrFail($id);
        $field->update([
            'name' => $request->name,
            'type' => $request->type,
            'price_per_hour' => $request->price_per_hour,
        ]);
        catat_log('update', 'Mengubah lapangan');
        return redirect("/fields")->with('success', 'Lapangan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $field = Field::findOrFail($id);
        $field->delete();
        catat_log('delete', 'Menghapus lapangan');
        return redirect('/fields')->with('success', 'Lapangan berhasil dihapus');
    }
}
