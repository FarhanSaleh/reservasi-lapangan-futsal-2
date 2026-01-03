<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Reservation;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Number;

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

        $startTime = Carbon::parse($reservation->schedule->start_time);
        $endTime = Carbon::parse($reservation->schedule->end_time);
        $totalDuration = $startTime->diffInHours($endTime);

        $pricePerHour = Number::currency($reservation->schedule->field->price_per_hour, in: 'IDR',  locale: 'id-ID');

        $totalPrice = Number::currency($totalDuration * $reservation->schedule->field->price_per_hour, in: 'IDR',  locale: 'id-ID');
        $totalPriceNum = $totalDuration * $reservation->schedule->field->price_per_hour;

        $paymentMethod = (new PaymentController())->getPaymentMethod();

        $payment = Payment::where('reservation_id', $id)->orderBy('payment_date', 'asc')->get();
        $latestPayment = Payment::where('reservation_id', $id)->orderBy('payment_date', 'desc')->first();

        return view('tes.reservasion.show', [
            'reservation' => $reservation,
            'totalDuration' => $totalDuration,
            'pricePerHour' => $pricePerHour,
            'totalPrice' => $totalPrice,
            'paymentMethod' => $paymentMethod,
            'totalPriceNum' => $totalPriceNum,
            'payment' => $payment,
            'latestPayment' => $latestPayment,
        ]);
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
        // $reservation->delete();
        // catat_log('delete', 'Menghapus reservasi');
        $reservation->update([
            'status' => 'canceled',
        ]);
        Schedule::where('id', $reservation->schedule_id)->update([
            'status' => 'available',
        ]);
        catat_log('update', 'Membatalkan reservasi');
        return redirect('/reservations/my');
    }
}
