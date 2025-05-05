<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('hospital');
            $table->string('phone');
            $table->string('working_hours');
            $table->integer('years_of_experience');
            $table->float('rating', 2, 1)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function search(Request $request)
    {
        $query = Doctor::query();

        if ($request->has('area')) {
            $query->where('hospital', 'like', "%{$request->area}%");
        }

        if ($request->has('specialization')) {
            $query->where('specialization', 'like', "%{$request->specialization}%");
    }
    $doctors = $query->get();
    return response()->json($doctors);
}
};
