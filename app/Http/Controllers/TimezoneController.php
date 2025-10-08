<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class TimeZoneController extends Controller
{
    public function index()
    {
        return view('converter', [
            'timezones' => timezone_identifiers_list(),
        ]);
    }

    public function convert(Request $request)
    {
        $request->validate([
            'datetime' => 'required',
            'from_timezone' => 'required',
            'to_timezone' => 'required',
        ]);

        $datetime = $request->input('datetime');
        $from = $request->input('from_timezone');
        $to = $request->input('to_timezone');

        // Convert input time
        $dtFrom = Carbon::createFromFormat('Y-m-d\TH:i', $datetime, $from);
        $input_display = $dtFrom->format('Y-m-d H:i:s');

        // Convert to target timezone
        $dtConverted = (clone $dtFrom)->setTimezone($to);
        $result_display = $dtConverted->format('Y-m-d H:i:s');

        // Redirect (PRG) with flash session
        return redirect()
            ->route('timezone.index')
            ->with([
                'input_datetime' => $input_display,
                'from' => $from,
                'to' => $to,
                'result' => $result_display,
            ]);
    }
}
