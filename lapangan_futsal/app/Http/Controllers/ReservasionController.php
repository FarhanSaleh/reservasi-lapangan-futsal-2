<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReservasionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with('user', 'schedule.field')->get();
        return view('tes.reservasion.index', ['reservations' => $reservations]);
    }

    public function findByUser()
    {
        $reservations = Reservation::with('user', 'schedule.field')->where('user_id', Auth::id())->get();
        return view('tes.reservasion.index', ['reservations' => $reservations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $reservations = Reservation::with('user', 'schedule.field')->get();
        return view('tes.reservasion.create', ['reservations' => $reservations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'schedule_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $schedule = Schedule::findOrFail($request->schedule_id);

        if ($schedule->status == 'unavailable') {
            return redirect()->back()->with('error', 'Lapangan sudah tidak tersedia');
        }

        Reservation::create([
            'reservation_date' => now(),
            'user_id' => Auth::id(),
            'schedule_id' => $request->schedule_id,
        ]);

        $schedule->update([
            'status' => 'unavailable',
        ]);

        catat_log('create', 'Membuat reservasi');
        return redirect('/reservations/my');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $reservation = Reservation::with('user', 'schedule.field')->find($id);
        return view('tes.reservasion.show', ['reservation' => $reservation]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $reservation = Reservation::with('user', 'schedule.field')->find($id);
        return view('tes.reservasion.edit', ['reservation' => $reservation]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $reservation = Reservation::findOrFail($id);
        $reservation->update([
            'status' => $request->status,
        ]);
        catat_log('update', 'Mengubah reservasi');
        return redirect('/reservations');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reservation = Reservation::findOrFail($id);
        Schedule::where('id', $reservation->schedule_id)->update([
            'status' => 'available',
        ]);
        $reservation->delete();
        catat_log('delete', 'Menghapus reservasi');
        return redirect('/reservations/my');
    }
}
