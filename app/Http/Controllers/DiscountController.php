<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class DiscountController extends Controller
{
    private const INITIAL_PRICE = 100000;

    public function showDiscountCalculator(): View
    {
        return view('solutions.discount.calculator', [
            'initialPrice' => self::INITIAL_PRICE,
            'initialPriceFormatted' => 'Rp ' . number_format(self::INITIAL_PRICE, 0, ',', '.'),
        ]);
    }

    public function calculateDiscount(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'num_discounts' => 'required|integer|min:1',
            'discounts' => 'required|array|min:' . $request->input('num_discounts', 1),
            'discounts.*' => 'required|numeric|min:0|max:100',
        ], [
            'discounts.*.required' => 'Each discount percentage is required.',
            'discounts.*.numeric' => 'Each discount percentage must be a number.',
            'discounts.*.min' => 'Each discount percentage must be at least 0.',
            'discounts.*.max' => 'Each discount percentage must be at most 100.',
            'discounts.min' => 'Please provide all discount percentages for the specified number of levels.',
        ]);

        if ($validator->fails()) {
            return redirect()->route('discount.calculator.show')
                ->withErrors($validator)
                ->withInput();
        }

        $numDiscounts = (int) $request->input('num_discounts');
        $discounts = $request->input('discounts');

        $actualDiscountsToApply = array_slice($discounts, 0, $numDiscounts);

        $currentPrice = self::INITIAL_PRICE;

        foreach ($actualDiscountsToApply as $discountPercentage) {
            $discountAmount = $currentPrice * ($discountPercentage / 100);
            $currentPrice -= $discountAmount;
        }

        $inputDiscounts = [];
        foreach ($discounts as $key => $value) {
            $inputDiscounts[$key] = $value;
        }

        return view('solutions.discount.calculator', [
            'initialPrice' => self::INITIAL_PRICE,
            'initialPriceFormatted' => 'Rp ' . number_format(self::INITIAL_PRICE, 0, ',', '.'),
            'finalPrice' => 'Rp ' . number_format($currentPrice, 0, ',', '.'),
            'inputNumDiscounts' => $numDiscounts,
            'inputDiscounts' => $inputDiscounts,
            'appliedDiscounts' => $actualDiscountsToApply,
        ]);
    }
}
