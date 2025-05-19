<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class MarblePredictionController extends Controller
{
    public function predictionInterface(Request $request)
    {
        if ($request->has('reset')) {
            Session::forget(['marble_total', 'marbles_drawn_count', 'yellow_drawn', 'blue_drawn', 'prediction_history']);
            return redirect()->route('marble.prediction.show')->with('status', 'Prediction reset successfully.');
        }

        if ($request->isMethod('post') && $request->has('total_marbles_input')) {
            $validator = Validator::make($request->all(), [
                'total_marbles_input' => 'required|integer|min:1|max:1000',
            ]);

            if ($validator->fails()) {
                return redirect()->route('marble.prediction.show')
                    ->withErrors($validator)
                    ->withInput();
            }

            Session::put('marble_total', (int)$request->input('total_marbles_input'));
            Session::put('marbles_drawn_count', 0);
            Session::put('yellow_drawn', 0);
            Session::put('blue_drawn', 0);
            Session::put('prediction_history', []);

            return redirect()->route('marble.prediction.show');
        }

        if ($request->isMethod('post') && $request->has('drawn_color') && Session::has('marble_total')) {
            $totalMarbles = Session::get('marble_total');
            $marblesDrawnCount = Session::get('marbles_drawn_count', 0);

            if ($marblesDrawnCount >= $totalMarbles) {

                return redirect()->route('marble.prediction.show')->with('error', 'All marbles have been drawn.');
            }

            $validator = Validator::make($request->all(), [
                'drawn_color' => 'required|string|in:k,b',
            ]);

            if ($validator->fails()) {
                return redirect()->route('marble.prediction.show')
                    ->withErrors($validator)
                    ->withInput();
            }

            $drawnColor = $request->input('drawn_color');
            $marblesDrawnCount++;
            Session::put('marbles_drawn_count', $marblesDrawnCount);

            if ($drawnColor === 'k') {
                Session::increment('yellow_drawn');
            } else {
                Session::increment('blue_drawn');
            }
        }

        $predictionData = null;
        if (Session::has('marble_total') && Session::get('marbles_drawn_count', 0) > 0) {
            $totalMarbles = Session::get('marble_total');
            $drawnCount = Session::get('marbles_drawn_count');
            $yellowDrawn = Session::get('yellow_drawn');
            $blueDrawn = Session::get('blue_drawn');

            $predictedYellow = (($yellowDrawn + 1) / ($drawnCount + 2)) * $totalMarbles;
            $predictedBlue = (($blueDrawn + 1) / ($drawnCount + 2)) * $totalMarbles;

            $sumPredicted = $predictedYellow + $predictedBlue;
            if ($sumPredicted > 0 && $sumPredicted != $totalMarbles) {
                $adjustmentFactor = $totalMarbles / $sumPredicted;
                $predictedYellow *= $adjustmentFactor;
                $predictedBlue *= $adjustmentFactor;
            }

            if (round($predictedYellow) == 0 && round($predictedBlue) == 0 && $totalMarbles > 0) {
                if ($yellowDrawn == 0 && $blueDrawn == 0) {
                    $predictedYellow = $totalMarbles / 2;
                    $predictedBlue = $totalMarbles / 2;
                }
            } else if (round($predictedYellow) == 0 && $totalMarbles - round($predictedBlue) > 0) {
                $predictedYellow = $totalMarbles - round($predictedBlue);
            } else if (round($predictedBlue) == 0 && $totalMarbles - round($predictedYellow) > 0) {
                $predictedBlue = $totalMarbles - round($predictedYellow);
            }

            $predictionData = [
                'predicted_yellow_final' => round($predictedYellow),
                'predicted_blue_final' => round($predictedBlue),
            ];

            if ($request->isMethod('post') && $request->has('drawn_color')) {
                $history = Session::get('prediction_history', []);
                $history[] = [
                    'draw_number' => $drawnCount,
                    'drawn_color_input' => $drawnColor,
                    'current_yellow' => $yellowDrawn,
                    'current_blue' => $blueDrawn,
                    'predicted_yellow' => $predictionData['predicted_yellow_final'],
                    'predicted_blue' => $predictionData['predicted_blue_final'],
                ];
                Session::put('prediction_history', $history);
            }
        }

        $viewData = [
            'totalMarbles' => Session::get('marble_total'),
            'marblesDrawnCount' => Session::get('marbles_drawn_count', 0),
            'yellowDrawn' => Session::get('yellow_drawn', 0),
            'blueDrawn' => Session::get('blue_drawn', 0),
            'prediction' => $predictionData,
            'predictionHistory' => Session::get('prediction_history', []),
        ];

        return view('solutions.marble.calculator', $viewData);
    }
}
