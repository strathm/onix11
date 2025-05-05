<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function rateDoctor(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $rating = new Rating;
        $rating->doctor_id = $request->doctor_id;
        $rating->rating = $request->rating;
        $rating->comment = $request->comment;
        $rating->user_id = auth()->user()->id;  // Assuming user is logged in
        $rating->save();

        // Update doctor's average rating
        $doctor = Doctor::find($request->doctor_id);
        $doctor->rating = $doctor->ratings()->avg('rating');
        $doctor->save();

        return response()->json(['message' => 'Rating submitted successfully']);
    }

}
