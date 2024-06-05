<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    protected $choices = ['rock', 'paper', 'scissors', 'lizard', 'spock'];
    protected $rules = [
        'rock' => ['scissors', 'lizard'],
        'paper' => ['rock', 'spock'],
        'scissors' => ['paper', 'lizard'],
        'lizard' => ['spock', 'paper'],
        'spock' => ['scissors', 'rock'],
    ];

    public function play(Request $request)
    {
        $userChoice = strtolower($request->input('choice'));

        if (!in_array($userChoice, $this->choices)) {
            return response()->json([
                'error' => 'Invalid choice. Valid choices are: rock, paper, scissors, lizard, spock.'
            ], 400);
        }

        $computerChoice = $this->choices[array_rand($this->choices)];
        $result = $this->determineResult($userChoice, $computerChoice);

        return response()->json([
            'user_choice' => $userChoice,
            'computer_choice' => $computerChoice,
            'result' => $result
        ]);
    }

    protected function determineResult($userChoice, $computerChoice)
    {
        if ($userChoice === $computerChoice) {
            return 'draw';
        }

        if (in_array($computerChoice, $this->rules[$userChoice])) {
            return 'win';
        }

        return 'lose';
    }
}
