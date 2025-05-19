<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;

class EncodingController extends Controller
{
    public function showEncoder(): View
    {
        return view('solutions.encoding.encoder');
    }

    public function processEncode(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'input_string' => 'nullable|string|max:2000',
        ]);

        if ($validator->fails()) {
            return redirect()->route('encoding.show')
                ->withErrors($validator)
                ->withInput();
        }

        $inputString = $request->input('input_string', '');
        $uppercasedString = strtoupper($inputString);

        $originalAlphabet = '@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_';

        $part1 = substr($originalAlphabet, 0, 16);
        $part2 = substr($originalAlphabet, 16, 16);

        $encodedAlphabet = $part2 . $part1;

        $encodedString = strtr($uppercasedString, $originalAlphabet, $encodedAlphabet);

        return view('solutions.encoding.encoder', [
            'inputString' => $inputString,
            'uppercasedInput' => $uppercasedString,
            'encodedString' => $encodedString
        ]);
    }
}
