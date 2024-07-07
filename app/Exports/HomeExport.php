<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class HomeExport implements FromView
{
    protected $home;

    public function __construct($home)
    {
        $this->home = $home;
    }

    public function view(): View
    {
        return view('export.home_excel', [
            'home' => $this->home
        ]);
    }
}
