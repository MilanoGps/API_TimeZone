<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TimezoneController extends Controller
{

    private $apiKey = 'BWXLX3TQEYCM';

    public function index()
    {
        $zones = [];

        try {
            $response = Http::get('http://api.timezonedb.com/v2.1/list-time-zone', [
                'key'    => $this->apiKey,
                'format' => 'json',
            ]);

            if ($response->successful() && isset($response->json()['zones'])) {
                $zones = collect($response->json()['zones'])->pluck('zoneName')->toArray();
            }
        } catch (\Throwable $e) {

        }


        if (empty($zones)) {
            $zones = \DateTimeZone::listIdentifiers();
        }

        return view('welcome', compact('zones'));
    }

    public function convert(Request $request)
    {
        $request->validate([
            'time' => 'required',
            'from' => 'required',
            'to'   => 'required',
        ]);

        $timeInput = $request->input('time');
        $from = $request->input('from');
        $to = $request->input('to');

        $today = date('Y-m-d');
        $dateTimeString = $today . ' ' . $timeInput . ':00';
        $timestamp = strtotime($dateTimeString);

        $data = null;
        try {
            $response = Http::get('http://api.timezonedb.com/v2.1/convert-time-zone', [
                'key'    => $this->apiKey,
                'format' => 'json',
                'from'   => $from,
                'to'     => $to,
                'time'   => $timestamp,
            ]);

            if ($response->successful()) {
                $data = $response->json();
            }
        } catch (\Throwable $e) {
            $data = null;
        }

        $zones = [];
        try {
            $resp2 = Http::get('http://api.timezonedb.com/v2.1/list-time-zone', [
                'key'    => $this->apiKey,
                'format' => 'json',
            ]);
            if ($resp2->successful() && isset($resp2->json()['zones'])) {
                $zones = collect($resp2->json()['zones'])->pluck('zoneName')->toArray();
            }
        } catch (\Throwable $e) {

        }
        if (empty($zones)) {
            $zones = \DateTimeZone::listIdentifiers();
        }

        return view('converter', [
            'data'      => $data,
            'input'     => [
                'time' => $timeInput,
                'from' => $from,
                'to'   => $to,
            ],
            'timestamp' => $timestamp,
            'zones'     => $zones,
        ]);
    }
}
