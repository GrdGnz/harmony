@extends('layouts.app')

@section('content')

@include('layouts.topbar')

<div id="layoutSidenav">

    <div id="layoutSidenav_nav">
        @include('layouts.sidenav')
    </div>

    <div id="layoutSidenav_content">

        <!-- Main content area -->
        <main class="col-lg-12 px-md-4 p-3">

            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Select Client
                </div>
                <div class="card-body">
                    <!-- DataTables Markup -->
                    <table id="clientsTable" class="table table-bordered" style="width:100%">
                        <thead class="marsman-bg-color-primary text-white">
                            <tr class="no-wrap">
                                <th>Client type</th>
                                <th>Status</th>
                                <th>Client Code</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Address</th>
                                <th>Phone No.</th>
                                <th>Fax No.</th>
                            </tr>
                        </thead>
                        <tbody class="hover-color">
                            <!-- Records will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>

        </main>

    </div>
</div>


<style>
.no-wrap td, .no-wrap th {
    white-space: nowrap;
}
.hover-color tr:hover {
    background-color: #FFD700; /* Change to desired hover color */
    cursor: pointer;
    text-decoration: none;
}
.hover-color tr:hover a {
    color: #fff;
}
tr td a {
    color: #3d3d3d;
}
</style>

<script>
$(document).ready(function() {
    var table = $('#clientsTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('clients') }}",
        },
        "pageLength": 30,  // Default number of records per page
        "lengthChange": false,
        "columns": [
            { "data": "CLT_TYPE" },
            { "data": "STATUS" },
            { "data": "CLT_CODE" },
            {
                // Include a link to the client detail page
                "data": "FULL_NAME",
                "render": function(data, type, row, meta) {
                    // Extract CLT_CODE from the row data
                    var clientid = row.CLT_ID;
                    // Generate the URL with the CLT_CODE parameter
                    var url = "{{ route('forms.tro.client', ':clientId') }}".replace(':clientId', clientid);
                    // Create the anchor tag with the generated URL
                    return '<a href="' + url + '">' + data + '</a>';
                }
            },
            { "data": "CATEGORY" },
            { "data": "MAIL_ADDRESS" },
            { "data": "PHONE_NO_1" },
            { "data": "FAX_NO_1" },
        ]
    });

    // Adjust styling for hover effect
    $('#clientsTable tbody tr').css('cursor', 'pointer');
});
</script>


@endsection
