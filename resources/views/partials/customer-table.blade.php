@forelse($bookings as $booking)
<tr>
  <td>{{ $booking->id }}</td>
  <td>{{ $booking->booking_code }}</td>
  <td>{{ $booking->bride_name }}</td>
  <td>{{ $booking->groom_name }}</td>
  <td>{{ $booking->package ? $booking->package->name : 'N/A' }}</td>
  <td>
    <a href="{{ route('calendar.viewDetails', $booking->id) }}" class="btn btn-primary btn-sm">
      View Details
    </a>
  </td>
</tr>
@empty
<tr>
  <td colspan="6" class="text-center">No bookings found.</td>
</tr>
@endforelse
