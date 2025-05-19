<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use App\Services\ShortestPathService;

class ShortestPathController extends Controller
{
    public function showPathForm(): View
    {
        return view('solutions.shortestpath.form_rows');
    }

    public function showTriangleInputForm(Request $request): View|RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'num_rows' => 'required|integer|min:1|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->route('shortestpath.form.show')
                ->withErrors($validator)
                ->withInput();
        }

        $numRows = (int) $request->input('num_rows');
        return view('solutions.shortestpath.form_triangle', ['numRows' => $numRows]);
    }

    public function calculateShortestPath(Request $request)
    {
        $numRows = (int) $request->input('num_rows');
        if ($numRows <= 0) {
            return redirect()->route('shortestpath.form.show')->withErrors(['num_rows' => 'Number of rows must be positive.']);
        }

        $rules = ['num_rows' => 'required|integer|min:1'];
        $triangleDataInput = [];

        for ($i = 0; $i < $numRows; $i++) {
            $rules["triangle_data.{$i}"] = 'required|array|size:' . ($i + 1);
            $rules["triangle_data.{$i}.*"] = 'required|integer';


            for ($j = 0; $j <= $i; $j++) {
                $triangleDataInput[$i][$j] = $request->input("triangle_data.{$i}.{$j}");
            }
        }

        $validator = Validator::make($request->all(), $rules, [
            'triangle_data.*.required' => 'All rows must be provided.',
            'triangle_data.*.array' => 'Each row data must be an array.',
            'triangle_data.*.size' => 'Row :attribute must have the correct number of elements.',
            'triangle_data.*.*.required' => 'All triangle numbers are required.',
            'triangle_data.*.*.integer' => 'All triangle numbers must be integers.',
        ]);

        if ($validator->fails()) {

            return redirect()->route('shortestpath.triangle.show_form', ['num_rows' => $numRows])
                ->withErrors($validator)
                ->withInput();
        }

        $triangle = $request->input('triangle_data');

        $validTriangle = [];
        foreach ($triangle as $rowIndex => $row) {
            foreach ($row as $colIndex => $value) {
                $validTriangle[$rowIndex][$colIndex] = (int)$value;
            }
        }

        $pathService = new ShortestPathService($validTriangle);
        $result = $pathService->findShortestPath();

        return view('solutions.shortestpath.form_triangle', [
            'numRows' => $numRows,
            'inputTriangle' => $validTriangle,
            'minimumSum' => $result['sum'],
            'pathString' => $result['path'],
            'pathNodes' => $result['path_nodes'],
            'calculationDone' => true,
        ]);
    }
}
