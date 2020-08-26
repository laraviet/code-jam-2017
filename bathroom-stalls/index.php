<?php

class BathroomStalls {
    private $files = [
        __DIR__ . '/input/smallInput.txt',
    ];

    private function nextMove($number) {
        if($number % 2 == 0){
            return $number / 2;
        }
        return ($number - 1) / 2;
    }

    private function calculateBathroomStalls($numberOfStalls, $numberOfPeople) {
        //we can reduce the problem by the following rules (N >= 0, K >= 0):
        //    - calculateBathroomStalls(2N+2, 2K+2) = calculateBathroomStalls(N+1, K+1)
        //    - calculateBathroomStalls(2N+3, 2K+2) = calculateBathroomStalls(N+1, K+1)
        //    - calculateBathroomStalls(2N+2, 2K+3) = calculateBathroomStalls(N,   K+1)
        //    - calculateBathroomStalls(2N+3, 2K+3) = calculateBathroomStalls(N+1, K+1)
        //    - calculateBathroomStalls(2N+2,    1) = (N+1, N)
        //    - calculateBathroomStalls(2N+1,    1) = (N,   N)
        if($numberOfPeople == 1){
            if($numberOfStalls % 2 == 0){
                return [$numberOfStalls / 2, ($numberOfStalls / 2) - 1];
            }
            return [($numberOfStalls - 1) / 2, ($numberOfStalls - 1) / 2 ];
        }
        return $this->calculateBathroomStalls($this->nextMove($numberOfStalls), $this->nextMove($numberOfPeople));
    }

    public function run()
    {
        foreach ($this->files as $file) {
            $fn = fopen($file,"r");
            //Read the first line to get the number of trial
            $cases = fgets($fn);

            for($case = 1; $case <= $cases; $case++) {
                $input = fgets($fn);
                [$numberOfStalls, $numberOfPeople] = explode(" ", $input);
                $result = $this->calculateBathroomStalls(intval($numberOfStalls), intval($numberOfPeople));
                echo "Case {$case}: {$result[0]} {$result[1]}\n";
            }
        }
    }
}

$bs = new BathroomStalls();
$bs->run();