<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadCSVRequest;
use App\Imports\BookCSVImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;

class CSVController extends Controller
{
    public function index(): View
    {
        return view('book-csv.index');
    }

    public function create(): View
    {
        return view('book-csv.create');
    }

    public function store(UploadCSVRequest $request): RedirectResponse
    {
        try{
            $data = Excel::import(new BookCSVImport, $request->csv);
            dd($data);
        } catch(ValidationException $e) {
            return redirect()->back()->with('import_errors', $e->failures());
        }

        return redirect('bookcsv.index');
    }

    public function show($id): View
    {
//        return view('bookcsv.view')->with()
    }
}
