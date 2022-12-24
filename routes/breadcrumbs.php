<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('bookcsv.index', function (BreadcrumbTrail $trail) {
    $trail->push('Book CSVs', route('bookcsv.index'));
});

Breadcrumbs::for('bookcsv.create', function(BreadcrumbTrail $trail) {
    $trail->parent('bookcsv.index');
    $trail->push('Upload Book CSV', route('bookcsv.create'));
});

Breadcrumbs::for('bookcsv.show', function(BreadcrumbTrail $trail, $bookCSV) {
    $trail->parent('bookcsv.index');
    $trail->push($bookCSV->file_name, route('bookcsv.show', $bookCSV));
});
