@extends('layouts.app')

@section('content')
<div class="container">
    {{ Breadcrumbs::render('bookcsv.index') }}
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card my-3">
                <div class="card-header text-center">Your book CSV uploads</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                        <th>File name</th>
                        <th>Book title</th>
                        <th>Book author</th>
                        <th>Date published</th>
                        <th>Unique identifier</th>
                        <th>Publisher name</th>
                        <th>Date uploaded</th>
                        <th></th>
                        </thead>
                        <tbody>
                        @foreach($bookCSVs as $bookCSV)
                            <tr>
                                <td><a href="{{ route('bookcsv.show', $bookCSV) }}">{{ $bookCSV->file_name }}</a></td>
                                <td>{{ $bookCSV->book_title }}</td>
                                <td>{{ $bookCSV->book_author }}</td>
                                <td>{{ $bookCSV->date_published }}</td>
                                <td>{{ $bookCSV->unique_identifier }}</td>
                                <td>{{ $bookCSV->publisher_name }}</td>
                                <td>{{ $bookCSV->created_at }}</td>
                                <td><a class="btn btn-outline-primary" href="{{ route('bookcsv.show', $bookCSV) }}"><i class="fa fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $bookCSVs->links('pagination::bootstrap-5') }}
                </div>
            </div>
            <a class="btn btn-primary" href="{{ route('bookcsv.create') }}">Upload new</a>
        </div>
    </div>
</div>
@endsection
