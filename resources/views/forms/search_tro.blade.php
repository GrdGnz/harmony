@extends('layouts.app')

@section('content')

@include('layouts.topbar')

<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        @include('layouts.sidenav')
    </div>
    <div id="layoutSidenav_content">
        <main class="col-lg-12 px-md-4 p-3">

            <div class="card" id="troForm">

                <div class="card-header marsman-bg-color-secondary">
                    <p class="h6 my-1">{{ __('Travel Request Order') }}</p>
                </div>
                <div class="card-body">

                    <!-- Search Form -->
                    <form id="searchForm">
                        @csrf
                        <div class="form-group">
                            <label for="ebcNo">Travel Request Order No.</label>
                            <input type="text" class="form-control txt-1" id="ebcNo" name="ebcNo" placeholder="Travel Request Order No.">
                        </div>
                        <div class="form-group mb-2">
                            <label for="client">Client</label>
                            <input type="text" class="form-control txt-1" id="client" name="client" placeholder="Enter Client Name">
                        </div>
                        <div class="form-group mb-2">
                            <label for="dateCreated">Date Created</label>
                            <input type="date" class="form-control txt-1" id="dateCreated" name="dateCreated">
                        </div>
                        <div class="form-group mb-2">
                            <label for="status">Status</label>
                            <select class="form-control txt-1" id="status" name="status">
                                <option value="">Select Status</option>
                                <option value="XD">Inactive</option>
                                <option value="AC">Active</option>
                                <option value="OP">Open</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary txt-1 mb-2">Search</button>
                        <button type="button" class="btn btn-secondary txt-1 mb-2" id="clearSearch">Clear</button>
                        <a href="{{ route('forms.tro') }}" class="btn btn-success txt-1 mb-2">Create</a>

                    </form>

                    <!-- DataTables Markup -->
                    <table id="salesFoldersTable" class="table table-striped table-bordered" style="width:100%">
                        <thead class="marsman-bg-color-dark text-white">
                            <tr>
                                <th>TRO No.</th>
                                <th>Client Name</th>
                                <th>Date Created</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>

        </main>
    </div>
</div>

<script>
    $(document).ready(function() {
        var table = $('#salesFoldersTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('sales-folder.data') }}",
                "data": function (d) {
                    d.ebcNo = $('#ebcNo').val();
                    d.client = $('#client').val();
                    d.dateCreated = $('#dateCreated').val();
                    d.status = $('#status').val();
                }
            },
            "pageLength": 30,  // Default number of records per page
            "lengthChange": false,
            "columns": [
                { "data": "SF_NO" },
                { "data": "CLT_NAME" },
                { "data": "SF_DATE" },
                { "data": "STATUS" }
            ]
        });

        // Trigger reload on form submission
        $('#searchForm').on('submit', function(e) {
            e.preventDefault();
            table.ajax.reload();
        });

        // Clear form fields and reload DataTable
        $('#clearSearch').click(function() {
            $('#searchForm').find('input[type=text], input[type=date], select').val('');
            table.ajax.reload();
        });
    });
</script>


@endsection


