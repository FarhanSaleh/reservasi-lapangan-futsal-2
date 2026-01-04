<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function Pest\Laravel\call;

class ScheduleController extends Controller
{
    private function getScheduleStatus()
    {
        return collect([['name' => 'available'], ['name' => 'unavailable']])
            ->map(fn($item) => (object)$item);
    }
    public function index()
    {
        $schedules = Schedule::with('field')->get();
        return view('tes.schedule.index', ['schedules' => $schedules]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fields = Field::all();
        $status = $this->getScheduleStatus();
        return view('tes.schedule.create', ['fields' => $fields, 'status' => $status]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
            'field_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        Schedule::create([
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
            'field_id' => $request->field_id,
        ]);
        catat_log('create', 'Membuat jadwal baru');
        return redirect('/schedules')->with('success', 'Jadwal baru berhasil dibuat');
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
        $schedule = Schedule::findOrFail($id);
        $fields = Field::all();
        $status = $this->getScheduleStatus();
        return view('tes.schedule.edit', ['schedule' => $schedule, 'fields' => $fields, 'status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'day' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'status' => 'required',
            'field_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $schedule = Schedule::findOrFail($id);
        $schedule->update([
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'status' => $request->status,
            'field_id' => $request->field_id,
        ]);
        catat_log('update', 'Mengubah jadwal');
        return redirect('/schedules')->with('success', 'Jadwal berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        catat_log('delete', 'Menghapus jadwal');
        return redirect('/schedules')->with('success', 'Jadwal berhasil dihapus');
    }
}
