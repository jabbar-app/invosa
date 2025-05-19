<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use App\Services\LiftAssignmentService;

class LiftController extends Controller
{
    public function showControlPanel(): View
    {
        $defaultLifts = [
            ['id' => 1, 'floor' => old('lifts.0.floor', 7)],
            ['id' => 2, 'floor' => old('lifts.1.floor', 5)],
            ['id' => 3, 'floor' => old('lifts.2.floor', 3)],
        ];
        $defaultPeople = [
            ['id' => 'A', 'floor' => old('people.0.floor', 2), 'direction' => old('people.0.direction', 'n')],
            ['id' => 'B', 'floor' => old('people.1.floor', 2), 'direction' => old('people.1.direction', 't')],
            ['id' => 'C', 'floor' => old('people.2.floor', 6), 'direction' => old('people.2.direction', 't')],
            ['id' => 'D', 'floor' => old('people.3.floor', 5), 'direction' => old('people.3.direction', 'n')],
        ];

        return view('solutions.lift.control_panel', [
            'lifts' => $defaultLifts,
            'people' => $defaultPeople,
        ]);
    }

    public function processAssignments(Request $request)
    {
        $rules = [
            'lifts' => 'required|array|size:3',
            'lifts.*.floor' => 'required|integer|min:1|max:8',
            'people' => 'required|array|size:4',
            'people.*.floor' => 'required|integer|min:1|max:8',
            'people.*.direction' => 'required|string|in:n,t',
        ];
        $messages = [
            'lifts.*.floor.required' => 'Lift :attribute floor is required.',
            'lifts.*.floor.integer' => 'Lift :attribute floor must be a number.',
            'lifts.*.floor.min' => 'Lift :attribute floor must be between 1 and 8.',
            'lifts.*.floor.max' => 'Lift :attribute floor must be between 1 and 8.',
            'people.*.floor.required' => 'Person :attribute floor is required.',
            'people.*.direction.required' => 'Person :attribute direction is required.',
            'people.*.direction.in' => 'Person :attribute direction must be "n" (up) or "t" (down).',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('lift.control.show')
                ->withErrors($validator)
                ->withInput();
        }

        $inputLiftsData = $request->input('lifts');
        $inputPeopleData = $request->input('people');

        $initialLifts = [];
        foreach ($inputLiftsData as $idx => $lift) {
            $initialLifts[] = ['id' => $idx + 1, 'floor' => (int)$lift['floor']];
        }

        $peopleRequests = [];
        $personIds = ['A', 'B', 'C', 'D'];
        foreach ($inputPeopleData as $idx => $person) {
            $peopleRequests[] = [
                'id' => $personIds[$idx],
                'floor' => (int)$person['floor'],
                'direction' => $person['direction'],
                'destination' => ($person['direction'] === 'n') ? 8 : 1,
            ];
        }

        $assignmentService = new LiftAssignmentService($initialLifts, $peopleRequests);
        $result = $assignmentService->findOptimalAssignment();


        $submittedLifts = [];
        foreach ($inputLiftsData as $idx => $lift) {
            $submittedLifts[] = ['id' => $idx + 1, 'floor' => $lift['floor']];
        }
        $submittedPeople = [];
        foreach ($inputPeopleData as $idx => $person) {
            $submittedPeople[] = ['id' => $personIds[$idx], 'floor' => $person['floor'], 'direction' => $person['direction']];
        }

        return view('solutions.lift.control_panel', [
            'lifts' => $submittedLifts,
            'people' => $submittedPeople,
            'result' => $result,
            'calculationDone' => true,
        ]);
    }
}
