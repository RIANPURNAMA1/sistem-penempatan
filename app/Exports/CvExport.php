<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CvExport implements FromView
{
    public $cv;

    public function __construct($cv)
    {
        $this->cv = $cv;
    }

    public function view(): View
    {
        return view('exports.cv', [
            'cv' => $this->cv
        ]);
    }
}

