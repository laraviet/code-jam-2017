<?php

class OversizedPancakeFlipper {
    private $files = [
        __DIR__ . '/input/smallInput.txt',
        //__DIR__ . '/input/largeInput.txt',
    ];

    private function getPancakeSize($pancake) {
        return strlen($pancake);
    }

    private function checkPancakeFullOfHappy($pancake) {
        return strpos($pancake, '-') === false;
    }

    public function run()
    {
        foreach ($this->files as $file) {
            $fn = fopen($file,"r");
            //Read the first line to get the number of trial
            $cases = fgets($fn);

            for($case = 1; $case <= $cases; $case++) {
                $input = fgets($fn);
                [$pancake, $k] = explode(" ", $input);

                //Get the Pancake Flipper's capacity
                $k = intval($k);

                //Pancake size
                $size = $this->getPancakeSize($pancake);

                $numberOfFlip = 0;

                for ($position = 0; $position + $k <= $size; $position++) {
                    if ($pancake[$position] == '-') {
                        for ($flipPosition = $position; $flipPosition < $position + $k; $flipPosition++) {
                            //Flip pancake at specific position
                            $pancake[$flipPosition] = $pancake[$flipPosition] == '+' ? '-' : '+';
                        }
                        $numberOfFlip++;
                    }
                }

                $allHappy = $this->checkPancakeFullOfHappy($pancake);

                echo "Case {$case}: ";
                if ($allHappy) {
                    echo "{$numberOfFlip}\n";
                } else {
                    echo "IMPOSSIBLE\n";
                }
            }
        }
    }
}

$opf = new OversizedPancakeFlipper();
$opf->run();