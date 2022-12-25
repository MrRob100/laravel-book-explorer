<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadCSVRequest;
use App\Imports\BookCSVImport;
use App\Interfaces\UploadCSVToS3ServiceInterface;
use App\Interfaces\UploadNotificationServiceInterface;
use App\Models\BookCSV;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class CSVController extends Controller
{
    public function index(Request $request): View
    {
        $bookCSVs = $request->user()->bookCSVs()->paginate(15);

        return view('book-csv.index')->with('bookCSVs', $bookCSVs);
    }

    public function create(): View
    {
        return view('book-csv.create');
    }

    public function store(UploadCSVRequest $request, UploadNotificationServiceInterface $service): RedirectResponse
    {
        $imported = Excel::toArray(new BookCSVImport, $request->csv)[0][0];
        $validator = Validator::make($imported, [
            'book_title' => 'required',
            'book_author' => 'required',
            'date_published' => 'required|date_format:Y-m-d',
            'unique_identifier' => 'required|unique:book_csvs',
            'publisher_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('upload_errors', $validator->errors()->messages());
        }

        $file = $request->csv;
        $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '-' .
            Str::uuid() . '.' . $file->getClientOriginalExtension();
        $filePath = '/' . $name;

        //put this and the Http::post in a service that we can then mock and therefor test
        $uploaded = Storage::disk('s3')->put($filePath, file_get_contents($file));

        if($uploaded) {
            $data = array_merge($imported, ['file_name' => $name]);
            $record = $request->user()->BookCSVs()->create($data);
            $service->notify($record->url);
        } else {
            return redirect()->back()->with('upload_errors', [['Failed to upload file']]);
        }

        return redirect(route('bookcsv.show', $record));
    }

    public function show(BookCSV $bookcsv): View
    {
        return view('book-csv.show')->with('bookCSV', $bookcsv);
    }
}
