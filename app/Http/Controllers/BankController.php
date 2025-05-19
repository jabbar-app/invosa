<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
{
    public function showInterestCalculator(): View
    {
        return view('solutions.bank.interest_calculator');
    }

    public function calculateInterest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'months' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('bank.interest.show')
                ->withErrors($validator)
                ->withInput();
        }

        $months = (int) $request->input('months');
        $initialBalance = 1000000;
        $monthlyInterestRate = 0.01;
        $currentBalance = $initialBalance;

        for ($i = 0; $i < $months; $i++) {
            $currentBalance += $currentBalance * $monthlyInterestRate;
        }

        return view('solutions.bank.interest_calculator', [
            'balance' => number_format($currentBalance, 2, ',', '.'),
            'inputMonths' => $months
        ]);
    }

    public function showInterestCalculatorNoLoop(): View
    {
        return view('solutions.bank.interest_calculator_no_loop');
    }

    public function calculateInterestNoLoop(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'months' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->route('bank.interest-no-loop.show')
                ->withErrors($validator)
                ->withInput();
        }

        $months = (int) $request->input('months');
        $initialBalance = 1000000;
        $monthlyInterestRate = 0.01;

        $finalBalance = $initialBalance * pow((1 + $monthlyInterestRate), $months);

        return view('solutions.bank.interest_calculator_no_loop', [
            'balance' => number_format($finalBalance, 2, ',', '.'),
            'inputMonths' => $months
        ]);
    }
}
