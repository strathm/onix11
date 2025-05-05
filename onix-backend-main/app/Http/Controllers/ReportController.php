<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportDoctor(Request $request)
{
    $request->validate([
        'doctor_id' => 'required|exists:doctors,id',
        'reason' => 'required|string|max:255',
    ]);

    $report = new Report;
    $report->doctor_id = $request->doctor_id;
    $report->reason = $request->reason;
    $report->user_id = auth()->user()->id;
    $report->save();

    return response()->json(['message' => 'Doctor reported successfully']);
}

}
