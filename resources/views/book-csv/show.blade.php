@extends('layouts.app')

@section('content')
<div class="container">
    {{ Breadcrumbs::render('bookcsv.show', $bookCSV) }}
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card my-3">
                <div class="card-header text-center">{{ $bookCSV->file_name }}</div>

                <div class="card-body">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td class="text-end"><strong>Book title</strong></td>
                            <td>{{ $bookCSV->book_title }}</td>
                        </tr>
                        <tr>
                            <td class="text-end"><strong>Book author</strong></td>
                            <td>{{ $bookCSV->book_author }}</td>
                        </tr>
                        <tr>
                            <td class="text-end"><strong>Date published</strong></td>
                            <td>{{ \Illuminate\Support\Carbon::parse($bookCSV->date_published)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td class="text-end"><strong>Unique identifier</strong></td>
                            <td>{{ $bookCSV->unique_identifier }}</td>
                        </tr>
                        <tr>
                            <td class="text-end"><strong>Publisher name</strong></td>
                            <td>{{ $bookCSV->publisher_name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <a class="btn btn-primary" href="{{ route('bookcsv.create') }}">Upload new</a>
        </div>
    </div>
</div>
@endsection
