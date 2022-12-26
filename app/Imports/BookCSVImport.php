<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BookCSVImport implements ToArray, WithHeadingRow
{
    public function array(array $array): void
    {
    }
}
