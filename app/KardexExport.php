<?php

namespace App;
use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;


class KardexExport implements FromView
{
    public function view(): View
    {
        return view('UsersViews.colecturia.kardex.kardex');
    }
}