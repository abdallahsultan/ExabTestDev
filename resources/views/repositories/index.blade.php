@extends('layouts.app')

@section('title', 'GitHub Repositories')

@section('content')
    <div class="container">
        <h1>GitHub Repositories</h1>
        <form id="filterForm">
            <div class="row mb-3">
                <div class="col-3">
                    <input type="date" id="dateSearch" class="form-control" placeholder="Filter by Date" value="2023-01-01">
                </div>
                <div class="col-3">
                    <input type="text" id="languageSearch" class="form-control" placeholder="Filter by Language">
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary">Apply Filter</button>
                </div>
                <div class="col-3">
                    <a id="exportButton" class="btn btn-success offset-5">Export Excel <i class="fa fa-file-excel"></i></a>
                </div>
            </div>
        </form>

        <table id="repositoriesTable" class="display" style="width:100%">
            <thead>
            <tr>
                <th>Repository Name</th>
                <th>Description</th>
                <th>Stars</th>
                <th>Language</th>
                <th>GitHub URL</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
@endsection

@section('script')
    @include('repositories.templates')
@endsection
