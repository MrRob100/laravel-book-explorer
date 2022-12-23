<?php

namespace App\Imports;

use App\Models\BookCSV;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BookCSVImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {

//        dd($row);

//        foreach ($rows as $row)
//        {
//            User::create([
//                'name' => $row[0],
//            ]);
//        }
    }

    public function rules(): array
    {
        return [
            'ghost' => 'required',
            'book_title' => 'required',
            'book_author' => 'required',
            'date_published' => 'required',
            'unique_identifier' => 'required|unique:book_csv_uploads',
            'publisher_name' => 'required',
        ];
    }
}
