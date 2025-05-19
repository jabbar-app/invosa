<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class RomanNumeralController extends Controller
{
    private const ROMAN_MAP = [
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1,
    ];

    public function showConverter(): View
    {
        return view('solutions.roman.converter');
    }

    public function convertToArabic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'roman_numeral' => [
                'required',
                'string',
                'max:50',
                'regex:/^[MDCLXVI]+$/i'
            ],
        ], [
            'roman_numeral.regex' => 'The Roman numeral contains invalid characters. Only M, D, C, L, X, V, I are allowed.'
        ]);

        if ($validator->fails()) {
            return redirect()->route('roman.converter.show')
                ->withErrors($validator)
                ->withInput();
        }

        $roman = strtoupper($request->input('roman_numeral'));
        $arabic = 0;
        $i = 0;
        $len = strlen($roman);
        $error_message = null;

        while ($i < $len) {

            if ($i + 1 < $len && array_key_exists(substr($roman, $i, 2), self::ROMAN_MAP)) {
                $arabic += self::ROMAN_MAP[substr($roman, $i, 2)];
                $i += 2;
            } elseif (array_key_exists(substr($roman, $i, 1), self::ROMAN_MAP)) {
                $arabic += self::ROMAN_MAP[substr($roman, $i, 1)];
                $i += 1;
            } else {
                $error_message = "Invalid Roman numeral sequence: '" . substr($roman, $i, 1) . "'.";
                break;
            }
        }

        if (!$error_message && ($arabic > 3999 || $this->arabicToRoman($arabic) !== $roman)) {
            if ($arabic > 3999) {
                $error_message = "The Roman numeral represents a number greater than 3999.";
            } else {
                $error_message = "Invalid Roman numeral format. For example, 'IIII' should be 'IV', 'VV' should be 'X'. The input '$roman' seems to be an invalid representation.";
            }
            $arabic = null;
        }

        if ($error_message) {
            return redirect()->route('roman.converter.show')
                ->withErrors(['roman_numeral' => $error_message])
                ->withInput();
        }

        return view('solutions.roman.converter', [
            'inputRoman' => $request->input('roman_numeral'),
            'processedRoman' => $roman,
            'arabicResult' => $arabic,
        ]);
    }

    private function arabicToRoman(int $number): string
    {
        if ($number < 1 || $number > 3999) {
            return "";
        }

        $roman = "";
        $map = [
            1000 => "M",
            900 => "CM",
            500 => "D",
            400 => "CD",
            100 => "C",
            90 => "XC",
            50 => "L",
            40 => "XL",
            10 => "X",
            9 => "IX",
            5 => "V",
            4 => "IV",
            1 => "I"
        ];

        foreach ($map as $value => $numeral) {
            while ($number >= $value) {
                $roman .= $numeral;
                $number -= $value;
            }
        }
        return $roman;
    }
}
