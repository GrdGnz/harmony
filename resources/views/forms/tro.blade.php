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

            <!-- Form for Stored Procedure (Stock Supply) :: START -->
            <form action="{{ url('add/stock') }}" method="post">
                @csrf

            <div class="card" id="troForm">

                <div class="card-header marsman-bg-color-secondary">
                    <p class="h6 my-1">{{ __('Travel Request Order') }}</p>
                </div>
                <div class="card-body">

                    @if(session('success'))
                        <div style="color: green;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div style="color: red;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="d-flex flex-wrap row"> <!-- Added flex-wrap -->

                        <!-- TRANSACTION REFERENCE -->
                        <div class="card col-lg-6 col-md-12 mb-3"> <!-- Adjusted column width for mobile -->
                            <div class="card-header marsman-bg-color-darkgray text-white">
                                <span class="txt-1">Transaction Reference</span>
                            </div>
                            <div class="card-body marsman-bg-color-lightgray">
                                <div class="form-group">
                                    <label for="ebcNumber" class="form-label my-1 px-1">eBC No.</label>
                                    <input type="text" id="ebcNumber" name="ebcNumber" class="form-control txt-1" disabled>
                                    <div class="m-2"></div>
                                    <label for="ebcDate" class="form-label my-1 px-1">Date</label>
                                    <input type="date" id="ebcDate" name="ebcDate" class="form-control txt-1" disabled>
                                    <div class="m-2"></div>
                                    <label for="mnlEbcNumber" class="form-label my-1 px-1">Mnl. eBC No.</label>
                                    <input type="text" id="mnlEbcNumber" name="mnlEbcNumber" class="form-control txt-1" disabled>
                                    <div class="m-2"></div>
                                    <label for="tripDate" class="form-label my-1 px-1">Date</label>
                                    <input type="date" id="tripDate" name="tripDate" class="form-control txt-1" disabled>
                                </div>
                            </div>
                        </div>

                        <!-- CLIENT -->
                        <div class="card col-lg-6 col-md-12 mb-3"> <!-- Adjusted column width for mobile -->
                            <div class="card-header marsman-bg-color-darkgray text-white">
                                <span class="txt-1">Client</span>
                            </div>
                            <div class="card-body marsman-bg-color-lightgray">
                                <div class="form-group">
                                    <button class="btn btn-primary txt-1" id="selectClientBtn">Select Client</button>
                                    <div class="m-2"></div>
                                    <label for="clientType" class="form-label my-1 px-1">*Type</label>
                                    <select id="clientType" name="clientType" class="form-control txt-1">
                                        @foreach($clientTypes as $types)
                                            <option value="{{ $types->code }}">{{ $types->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="m-2"></div>
                                    <label for="clientCode" class="form-label my-1 px-1">Code</label>
                                    <input type="text" id="clientCode" name="clientCode" class="form-control txt-1">
                                    <div class="m-2"></div>
                                    <label for="clientName" class="form-label my-1 px-1">*Name</label>
                                    <input type="text" id="clientName" name="clientName" class="form-control txt-1">
                                    <div class="m-2"></div>
                                    <label for="clientAddress" class="form-label my-1 px-1">Address</label>
                                    <textarea id="clientAddress" name="clientAddress" class="form-control txt-1"></textarea>
                                    <div class="m-2"></div>
                                    <label for="category" class="form-label my-1 px-1">*Category</label>
                                    <select name="category" id="category" class="form-control txt-1">
                                        @foreach ($clientCategories as $category)
                                            <option value="{{ $category->code }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="d-flex flex-wrap row">

                        <!-- CONTACT -->
                        <div class="card mb-3"> <!-- Adjusted column width for mobile -->
                            <div class="card-header marsman-bg-color-darkgray text-white">
                                <span class="txt-1">Contact</span>
                            </div>
                            <div class="card-body marsman-bg-color-lightgray">
                                <div class="form-group">
                                    <label for="contactPhoneNo" class="form-label txt-1">Phone No.</label>
                                    <input type="text" id="contactPhoneNo" name="contactPhoneNo" class="form-control txt-1">
                                    <div class="m-2"></div>
                                    <label for="contactFaxNo" class="form-label txt-1">Fax No.</label>
                                    <input type="text" id="contactFaxNo" name="contactFaxNo" class="form-control txt-1">
                                    <div class="m-2"></div>
                                    <label for="contactEmail" class="form-label txt-1">Email</label>
                                    <input type="text" id="contactEmail" name="contactEmail" class="form-control txt-1">
                                    <div class="m-2"></div>
                                    <label for="contactName" class="form-label txt-1">Name</label>
                                    <input type="text" id="contactName" name="contactName" class="form-control txt-1">
                                </div>
                            </div>
                        </div>

                        <!-- PRODUCTION -->
                        <div class="card mb-3"> <!-- Adjusted column width for mobile -->
                            <div class="card-header marsman-bg-color-darkgray text-white">
                                <span class="txt-1">Production</span>
                            </div>
                            <div class="card-body marsman-bg-color-lightgray">
                                <div class="form-group">
                                    <label for="salesAgentName" class="form-label txt-1">*Sales Agent</label>
                                    <select id="salesAgentName" name="salesAgentName" class="form-control txt-1">
                                        @foreach ($agents as $agent)
                                            <option value="{{ $agent->EMP_ID }}">{{ $agent->FULL_NAME }}</option>
                                        @endforeach
                                    </select>
                                    <div class="m-2"></div>
                                    <label for="salesType" class="form-label txt-1">Sales Type</label>
                                    <select id="salesType" name="salesType" class="form-control txt-1">
                                        @foreach ($salesTypes as $salesType)
                                            <option value="{{ $salesType->SALES_TYPE }}">{{ $salesType->SALES_DESCR }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-md-end">
                            <button class="btn btn-success txt-1">Save Changes</button>
                        </div>
                    </div>

                </div>
            </div>

            </form>

        </main>

    </div>
</div>

<div id="clientListLightbox" class="lightbox" style="display: none;">
    <!-- Preloader -->
    <div id="preloader" style="display: none;">
        <div>Loading Data...</div>
    </div>
    <div class="tableList">
        <div class="card">
            <div class="card-header">
                <p class="h3">Select Client</p>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="clientListTable" class="table table-bordered txt-1"></table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('selectClientBtn').addEventListener('click', function() {
        // Show the lightbox with fading effect
        fadeIn(document.getElementById('clientListLightbox'));

        // Show the preloader
        document.getElementById('preloader').style.display = 'block';

        // Fetch client data
        fetch('{{ route('clients') }}')
            .then(response => response.json())
            .then(data => {
                // Call a function to populate the table with the fetched data
                populateClientTable(data);

                 // Hide the preloader once data is loaded
                 document.getElementById('preloader').style.display = 'none';
            })
            .catch(error => {
                console.error('Error fetching client data:', error);

                // Hide the preloader in case of error too
                document.getElementById('preloader').style.display = 'none';
            });
    });

    // Close lightbox when clicking outside of it
    document.getElementById('clientListLightbox').addEventListener('click', function(event) {
        if (event.target === this) {
            fadeOut(this);
        }
    });

    function populateClientTable(data) {
        $(document).ready(function() {
            // Check if DataTable is already initialized
            if (!$.fn.DataTable.isDataTable('#clientListTable')) {
                // Initialize DataTable
                var dataTable = $('#clientListTable').DataTable({
                    data: data,
                    columns: [
                        { title: 'Full Name', data: 'FULL_NAME' },
                        { title: 'Client Code', data: 'CLT_CODE' },
                        { title: 'Client Type', data: 'CLT_TYPE' },
                        { title: 'Mail Address', data: 'MAIL_ADDRESS' },
                        { title: 'Category', data: 'CATEGORY' },
                        { title: 'Phone No.', data: 'PHONE_NO' },
                        { title: 'Fax No.', data: 'FAX_NO' },
                        { title: 'Email', data: 'EMAIL' },
                        { title: 'Contact Name', data: 'CONTACT_NAME' },
                    ],
                    // Pagination settings
                    "paging": true,
                    "pageLength": 10, // Display 10 records per page
                    "lengthChange": false, // Hide page length menu
                    // Optional: Customize DataTables appearance
                    "searching": true,
                    "ordering": true,
                    "info": true
                });

                // Add click event listener to DataTable rows
                $('#clientListTable tbody').on('click', 'tr', function() {
                    // Get data of the clicked row
                    var rowData = dataTable.row(this).data();
                    // Populate form fields with client information
                    $('#clientName').val(rowData.FULL_NAME);
                    $('#clientCode').val(rowData.CLT_CODE);
                    $('#clientAddress').val(rowData.MAIL_ADDRESS);

                    // Set the selected option in clientType select box based on the client type code
                    var clientTypeCode = rowData.CLT_TYPE; // Adjust property name as per your data
                    $('#clientType').val(clientTypeCode);

                    // Set the selected option in category select box based on the category code
                    var categoryCode = rowData.CATEGORY; // Adjust property name as per your data
                    $('#category').val(categoryCode);

                    //Contact phone number
                    var phoneNumber = rowData.PHONE_NO;
                    $('#contactPhoneNo').val(phoneNumber);

                    //Contact fax number
                    var faxNumber = rowData.FAX_NO;
                    $('#contactFaxNo').val(faxNumber);

                    //Contact Email
                    var email = rowData.EMAIL;
                    $('#contactEmail').val(email);

                     //Contact Name
                     var contactName = rowData.CONTACT_NAME;
                    $('#contactName').val(contactName);

                    // Close the lightbox
                    closeLightbox();
                });
            } else {
                // If DataTable is already initialized, update the table data
                var dataTable = $('#clientListTable').DataTable();
                dataTable.clear().rows.add(data).draw();
            }
        });
    }

    // Function to close the lightbox
    function closeLightbox() {
        var lightbox = document.getElementById('clientListLightbox');
        lightbox.style.display = 'none';
    }


    // Fade in function
    function fadeIn(element) {
        element.style.opacity = 0;
        element.style.display = 'flex';

        (function fade() {
            var val = parseFloat(element.style.opacity);
            if (!((val += 0.1) > 1)) {
                element.style.opacity = val;
                requestAnimationFrame(fade);
            }
        })();
    }

    // Fade out function
    function fadeOut(element) {
        element.style.opacity = 1;

        (function fade() {
            if ((element.style.opacity -= 0.1) < 0) {
                element.style.display = "none";
            } else {
                requestAnimationFrame(fade);
            }
        })();
    }
});
</script>

<style>
/* Adjustments for two-column layout on desktop */
@media only screen and (min-width: 992px) {
    #troForm .card {
        width: 48%; /* Adjusted width for two columns */
        margin-right: 2%; /* Spacing between columns */
    }

    #troForm .card:nth-child(2n) {
        margin-right: 0; /* Remove margin from every second card to prevent extra spacing */
    }
}

/* Lightbox CSS */
.lightbox {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
    z-index: 9999;
    transition: opacity 0.5s ease; /* Smooth fading transition */
    display: flex;
    justify-content: center;
    align-items: center;
}

.tableList {
    width: 80%;
    max-width: 800px;
    height: 100%;
    max-height: 900px;
    background-color: #fff;
    border-radius: 5px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(87, 77, 77, 0.1);
    display: flex;
    justify-content: center;
    align-items: center;
}

.tableList .table-responsive {
    overflow-y: auto;
    max-height: calc(100% - 40px);
}

.tableList tbody tr:hover {
    background-color: #0000B5;
    color: #fff;
    cursor: pointer;
}

.tableList tr th, tr td {
    font-size: .8em;
    white-space: nowrap;
}
</style>

@endsection

