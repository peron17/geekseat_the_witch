<?php
namespace App\Helpers;

class Math 
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;    
    }

    public function getAverage() : float
    {
        if (!$this->isNegative())
            return -1;

        // calculate difference
        $diffPerson1 = $this->data['p1_yod'] - $this->data['p1_aod'];
        $diffPerson2 = $this->data['p2_yod'] - $this->data['p2_aod'];
        
        $killedWhenPerson1Birth = $this->getKilledVillager($diffPerson1);
        $killedWhenPerson2Birth = $this->getKilledVillager($diffPerson2);

        // get the average
        return ($killedWhenPerson1Birth + $killedWhenPerson2Birth) / 2;
    }

    /**
     * count killed villager
     */
    public function getKilledVillager(int $difference) : int
    {
        $killed = 0;
        $n = 1;
        $p = 0;
        // repeat as long as the 'difference' value
        for ($i=0; $i < $difference; $i++) { 
            // sum the killed value with n value from previouse loop
            $killed += $n;

            $sum = $p + $n;
            // set p value as n value. because we need the value of n for the sum in the next loop
            $p = $n;
            // set the value of n as the result of the sum. we need the result of the sum to add to the value of n in the next loop.
            $n = $sum;
        }
        return $killed;
    }

    private function isNegative()
    {
        foreach ($this->data as $key => $value) {
            if ($value < 0) 
                return false;
        }

        return true;
    }
}