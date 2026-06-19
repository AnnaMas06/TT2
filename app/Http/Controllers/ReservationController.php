<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role && in_array($user->role->name, ['admin', 'staff'])) {
            $reservations = Reservation::with('user', 'equipment')->get();
        } else {
            $reservations = Reservation::with('equipment')
                ->where('user_id', $user->id)
                ->get();
        }

        return view('reservations.index', compact('reservations'));
    }

    public function create()
    {
        $equipment = Equipment::where('status', 'available')
            ->where('is_public', true)
            ->get();

        return view('reservations.create', compact('equipment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);
        $conflict = Reservation::where('equipment_id', $request->equipment_id)
            ->whereIn('status', ['pending', 'approved'])
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date])
                    ->orWhere(function ($query) use ($request) {
                        $query->where('start_date', '<=', $request->start_date)
                            ->where('end_date', '>=', $request->end_date);
                    });
            })
            ->exists();

        if ($conflict) {
            return back()
                ->withInput()
                ->withErrors(['date' => 'This equipment is already reserved for the selected dates.']);
        }

        Reservation::create([
            'user_id' => auth()->id(),
            'equipment_id' => $request->equipment_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status' => 'pending',
        ]);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation created successfully');
    }

    public function show(Reservation $reservation)
    {
        $this->authorizeReservation($reservation);

        return view('reservations.show', compact('reservation'));
    }

    public function edit(Reservation $reservation)
    {
        $this->authorizeReservation($reservation);

        if ($reservation->status !== 'pending') {
            abort(403);
        }

        $equipment = Equipment::where('status', 'available')
            ->where('is_public', true)
            ->get();

        return view('reservations.edit', compact('reservation', 'equipment'));
    }

    public function update(Request $request, Reservation $reservation)
    {
        $this->authorizeReservation($reservation);

        if ($reservation->status !== 'pending') {
            abort(403);
        }

        $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $reservation->update([
            'equipment_id' => $request->equipment_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation updated successfully');
    }

    public function destroy(Reservation $reservation)
    {
        $this->authorizeReservation($reservation);

        if ($reservation->status !== 'pending') {
            abort(403);
        }

        $reservation->delete();

        return redirect()->route('reservations.index')
            ->with('success', 'Reservation cancelled successfully');
    }

    public function approve(Reservation $reservation)
    {
        if (!in_array(auth()->user()->role->name, ['admin', 'staff'])) {
            abort(403);
        }

        $reservation->update([
            'status' => 'approved',
        ]);

        return back()->with('success', 'Reservation approved');
    }

    public function reject(Reservation $reservation)
    {
        if (!in_array(auth()->user()->role->name, ['admin', 'staff'])) {
            abort(403);
        }

        $reservation->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Reservation rejected');
    }

    private function authorizeReservation(Reservation $reservation)
    {
        $user = auth()->user();

        if ($user->role && in_array($user->role->name, ['admin', 'staff'])) {
            return;
        }

        if ($reservation->user_id !== $user->id) {
            abort(403);
        }
    }
}