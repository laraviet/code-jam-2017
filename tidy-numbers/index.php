<?php

class TidyNumber {
    private $files = [
        __DIR__ . '/input/smallInput.txt',
    ];

    public function run()
    {
        foreach ($this->files as $file) {
            $fn = fopen($file,"r");
            //Read the first line to get the number of trial
            $cases = fgets($fn);

            for($case = 1; $case <= $cases; $case++) {

                $lastCountNumber = intval(fgets($fn));

                $tidyNumber = strval($lastCountNumber);
                $size = strlen($tidyNumber);

                for($position = $size - 1; $position > 0; $position--) {
                    // if number in previous position greater than current position (mean not tidy)
                    // then we must set all number from current position to '9' and decrease the number in pre position by 1
                    if ($tidyNumber[$position - 1] > $tidyNumber[$position]) {
                        $tidyNumber[$position - 1] = intval($tidyNumber[$position - 1]) - 1;
                        for ($nextPosition = $position; $nextPosition < $size; $nextPosition++) {
                            $tidyNumber[$nextPosition] = '9';
                        }
                    }
                }

                echo "Case {$case}: {$tidyNumber}\n";
            }
        }
    }
}

$tn = new TidyNumber();
$tn->run();