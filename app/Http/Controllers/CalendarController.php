<?php

namespace App\Http\Controllers;

use App\bookings;
use App\Event_bookings;
use App\packages;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use function Symfony\Component\String\b;

class CalendarController extends Controller
{
    public function index()
    {
        $events = array();
        $bookings = Event_bookings::all();

        //to send event details to calendar
        foreach ($bookings as $booking) {
            $color = '#3788d8'; // default blue

            if (Str::contains($booking->event_code, 'DLX')) {
                $color = '#e74c3c'; // red for DLX
            }
            if (Str::contains($booking->event_code, 'PRE')) {
                $color = '#ccb803ff'; // red for DLX
            }

            // Split event_code by "-" and get the 3rd part (0001)
            $parts = explode('-', $booking->event_code);
            $codeNumber = $parts[2] ?? '';

            $events[] = [
                "id"    => $booking->id,
                "title" =>  $codeNumber . '-' . $booking->event_type,
                "start" => $booking->event_date,
                "color" => $color, // FullCalendar will use this
                "venue" => $booking->venue_address,
                "event_code" => $booking->event_code,
                "bookings_id" => $booking->bookings_id,
            ];
        }

        // load a Blade template instead of redirect
        return view('calendar', ['events' => $events]);
    }

    public function update(Request $request, $id)
    {
        // 🔍 Debug
        // dd($id, $request->all());

        $booking = Event_bookings::find($id); // ✅ if you used $booking->id in events

        if (!$booking) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        $booking->update([
            'event_date' => $request->event_date,
        ]);

        return response()->json(['status' => 'success']);
    }



    public function packages()
    {
        // Fetch only visible packages
        $packages = Packages::where('visibility', true)->get();

        return view('home', compact('packages'));
    }


    public function archivedPackages()
    {
        // Only get packages that are not visible (archived)
        $packages = Packages::where('visibility', false)->get();

        return view('archived-packages', compact('packages'));
    }

    public function createPackage(Request $request)
    {
        try {
            Packages::create([
                'name' => $request->name,
                'short_code' => $request->short_code,
                'events_included' => json_encode($request->events_included),
                'price' => $request->price,
                'description' => $request->description,
                'visibility' => $request->visibility ?? 1,
                'archived' => $request->archived ?? 0,

            ]);

            // ✅ redirect to packages route which already has $packages
            return redirect()->route('packages')->with('success', 'Package created successfully!');
        } catch (\Throwable $e) {
            return redirect()->back()->withErrors(['db_error' => $e->getMessage()]);
        }
    }





    public function viewPackageById($id)
    {
        $package = Packages::findOrFail($id); // findOrFail throws 404 if not found
        return view('edit-package', compact('package'));
    }

    public function updatePackage(Request $request, $id)
    {
        $package = Packages::findOrFail($id);

        $package->update([
            'name' => $request->name,
            'short_code' => $request->short_code,
            'events_included' => json_encode($request->events_included), // ✅ save as JSON
            'price' => $request->price,
            'description' => $request->description,
            'visibility' => $request->visibility ?? $package->visibility,
            'archived' => $request->archived ?? $package->archived,

        ]);
         $packages = Packages::where('visibility', true)->get();

        return view('home', compact('packages'));
    }



    public function viewDetails(Request $request, $bookings_id)
    {
        $booking = Bookings::with('event_bookings')->findOrFail($bookings_id);
        return view('customerDetails', compact('booking'));
    }


    public function editDetails($bookings_id)
    {
        $booking = Bookings::with(['event_bookings', 'package'])->findOrFail($bookings_id);
        $packages = Packages::all(); // fetch all packages
        return view('customerEditDetails', compact('booking', 'packages'));
    }


    public function updateDetails(Request $request, $bookings_id)
    {

        $booking = Bookings::find($bookings_id);
        $booking->bride_name = $request->bride_name;
        $booking->bride_phone = $request->bride_phone;
        $booking->bride_email = $request->bride_email;
        $booking->groom_name = $request->groom_name;
        $booking->groom_phone = $request->groom_phone;
        $booking->groom_email = $request->groom_email;
        $booking->package_id = $request->package_id;
        $booking->notes = $request->notes;

        $booking->status = $request->status;
        $booking->status = $request->status;
        $booking->save();


        foreach ($request->event_id as $index => $eventId) {
            $event = Event_bookings::findOrFail($eventId);
            $event->update([
                'event_type'     => $request->event_type[$index],
                'event_date'     => $request->event_date[$index],
                'venue_type'     => $request->venue_type[$index],
                'venue_address'  => $request->venue_address[$index],
            ]);
        }
        // ✅ Redirect to details page with fresh data
        return redirect()
            ->route('calendar.viewDetails', $booking->id)
            ->with('success', 'Booking updated successfully!');
    }

    public function deleteBooking($id)
    {
        $booking = Bookings::findOrFail($id);
        $booking->delete();

        return redirect()->route('calendar') // or wherever your calendar route is
            ->with('success', 'Booking deleted successfully!');
    }

    public function customerList()
    {
        $bookings = bookings::with(['event_bookings', 'package'])->get();
        return view('customerList', compact('bookings'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $bookings = bookings::with('package')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q) use ($search) {
                    $q->where('bride_name', 'like', "%{$search}%")
                        ->orWhere('groom_name', 'like', "%{$search}%")
                        ->orWhere('booking_code', 'like', "%{$search}%");
                });
            })
            ->get();

        return view('partials.customer-table', compact('bookings'))->render();
    }
}
