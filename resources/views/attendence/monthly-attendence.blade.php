@foreach ($monthly_record as $record)
    <tr>
        <td>{{ $record->date }}</td>
        <td>{{ $record->sign_in }}</td>
        <td>{{ $record->sign_out }}</td>
        <td>{{ $record->total_time }}</td>
        <td>{{ $record->attendance_status }}</td>
    </tr>
@endforeach

