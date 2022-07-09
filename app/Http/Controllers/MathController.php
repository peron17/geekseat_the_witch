<?php

namespace App\Http\Controllers;

use App\Helpers\Math;
use Illuminate\Http\Request;

class MathController extends Controller
{
    private $request;

    private $math;

    public function __construct(Request $request)
    {
        $this->request = $request;    

        $this->math = new Math( $request->input() );  

    }

    public function counter()
    {
        $rule = [
            'p1_aod' => 'required|numeric',
            'p1_yod' => 'required|numeric',
            'p2_aod' => 'required|numeric',
            'p2_yod' => 'required|numeric',
        ];

        $message = [
            'p1_aod.required' => 'age of death is required.',
            'p1_aod.numeric' => 'value is not number.',
            'p1_yod.required' => 'year of death is required.',
            'p1_yod.numeric' => 'value is not number.',
            'p2_aod.required' => 'age of death is required.',
            'p2_aod.numeric' => 'value is not number.',
            'p2_yod.required' => 'year of death is required.',
            'p2_yod.numeric' => 'value is not number.',
        ];

        $this->request->validate($rule, $message);

        return redirect()->route('home')->with('result', $this->math->getAverage());
    }
}
