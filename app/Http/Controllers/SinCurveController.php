<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class SinCurveController extends Controller
{
    public function showAreaCalculator(): View
    {
        return view('solutions.sincurve.area_calculator');
    }

    public function calculateArea(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'angle_a' => 'required|numeric|min:0|max:360',
            'angle_b' => 'required|numeric|min:0|max:360',
            'segments' => 'required|integer|min:1|max:100000',
        ]);

        if ($validator->fails()) {
            return redirect()->route('sincurve.calculator.show')
                ->withErrors($validator)
                ->withInput();
        }

        $a_deg = (float) $request->input('angle_a');
        $b_deg = (float) $request->input('angle_b');
        $n = (int) $request->input('segments');


        $a_rad = deg2rad($a_deg);
        $b_rad = deg2rad($b_deg);

        $swapped = false;
        if ($a_rad > $b_rad) {
        }

        $h = ($b_rad - $a_rad) / $n;
        $area = 0;
        $sum_interior = 0;
        for ($i = 1; $i < $n; $i++) {
            $x_i = $a_rad + $i * $h;
            $sum_interior += sin($x_i);
        }

        $area_rad_units = ($h / 2) * (sin($a_rad) + 2 * $sum_interior + sin($b_rad));
        $area_scaled = $area_rad_units * (180 / M_PI);
        $analytical_area_scaled = (cos($a_rad) - cos($b_rad)) * (180 / M_PI);

        return view('solutions.sincurve.area_calculator', [
            'input_a' => $a_deg,
            'input_b' => $b_deg,
            'input_segments' => $n,
            'calculatedArea' => number_format($area_scaled, 1, '.', ''),
            'analyticalArea' => number_format($analytical_area_scaled, 1, '.', ''),
        ]);
    }
}
