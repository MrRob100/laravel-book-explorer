@extends('layouts.app')

@section('content')
<div class="container">
    {{ Breadcrumbs::render('bookcsv.create') }}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload CSV of book information</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('bookcsv.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="alert alert-warning d-flex align-items-center justify-content-between" role="alert">
                            <div class="flex-fill mr-3">
                                <p class="mb-0">
                                    Here are the expected columns for your CSV file:
                                    'book_title, book_author, date_published (Y-m-d), unique_identifier, publisher_name'.
                                </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="csv" class="col-md-4 col-form-label text-md-end">CSV of book information</label>

                            <div class="col-md-6">
                                <input
                                    id="csv"
                                    type="file"
                                    class="form-control @error('csv') is-invalid @enderror @if(Session::has('upload_errors')) is-invalid @endif"
                                    name="csv"
                                    accept="csv"
                                    required
                                >
                            </div>

                            @error('csv')
                                <p class="text-danger mt-2 mb-0">{{ $errors->get('csv')[0] }}</p>
                            @enderror

                            @if(Session::has('upload_errors'))
                                @foreach(Session::get('upload_errors') as $failure)
                                    <p class="text-danger mt-2 mb-0">{{ $failure[0] }}</p>
                                @endforeach
                            @endif

                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Upload
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
