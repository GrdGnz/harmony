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
                    <p class="h6 my-1">{{ __('Find Ticket') }}</p>
                </div>
                <div class="card-body">

                    <!-- Search Form -->
                    <form id="searchForm">
                        @csrf
                        <input type="hidden" id="troNumber" name="troNumber" value="{{ $troNumber }}">
                        <input type="hidden" id="docId" name="docId" value="{{ $docId }}">
                        <div class="form-group">
                            <label for="paxName">Passenger Name</label>
                            <input type="text" class="form-control txt-1" id="paxName" name="paxName" placeholder="Enter Passenger Name">
                        </div>
                        <div class="form-group mb-2">
                            <label for="ticketNumber">Ticket Number</label>
                            <input type="text" class="form-control txt-1" id="ticketNumber" name="ticketNumber" placeholder="Enter Ticket Number">
                        </div>
                        <div class="form-group mb-2">
                            <label for="pnr">PNR</label>
                            <input type="text" class="form-control txt-1" id="pnr" name="pnr" placeholder="Enter PNR">
                        </div>

                        <button type="submit" class="btn btn-primary txt-1 mb-2">Search</button>
                        <button type="button" class="btn btn-secondary txt-1 mb-2" id="clearSearch">Clear</button>

                    </form>

                    <!-- DataTables Markup -->
                    <div class="table-responsive">
                        <table id="inventoryTable" class="table table-striped table-bordered" style="width:100%">
                            <thead class="marsman-bg-color-dark text-white">
                                <tr>
                                    <th></th>
                                    <th>Ticket Number</th>
                                    <th>PNR</th>
                                    <th>Pax Name</th>
                                </tr>
                            </thead>
                            <tbody class="hover-color">

                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12 justify-content-start d-flex">
                        <button type="button" class="btn btn-primary my-3 txt-1" id="getTickets">Get Tickets</button>
                    </div>
                </div>
            </div>

        </main>
    </div>
</div>

<script>
$(document).ready(function() {
    var selectedTickets = [];

    var table = $('#inventoryTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('inventory.data') }}",
            "data": function(d) {
                d.paxName = $('#paxName').val();
                d.ticketNumber = $('#ticketNumber').val();
                d.pnr = $('#pnr').val();
            }
        },
        "pageLength": 30,
        "lengthChange": false,
        "columns": [
            {
                "data": null,
                "orderable": false,
                "render": function(data, type, row, meta) {
                    return '<input type="checkbox" class="ticket-checkbox" value="' + row.TICKET_NO + '" data-pnr="' + row.PNR + '" data-paxname="' + row.FIRST_PAX_NAME + '">';
                }
            },
            {
                "data": "TICKET_NO",
                "render": function(data, type, row, meta) {
                    var sfno = '{{ $troNumber }}';
                    var tktno = row.TICKET_NO;
                    var url = "{{ route('forms.tro.add_product', [':troNumber', ':ticketNumber']) }}"
                        .replace(':troNumber', sfno)
                        .replace(':ticketNumber', tktno);
                    return '<a href="' + url + '">' + data + '</a>';
                }
            },
            { "data": "PNR" },
            { "data": "FIRST_PAX_NAME" },
        ]
    });

    $('#inventoryTable tbody').on('change', '.ticket-checkbox', function() {
        var ticketNo = $(this).val();
        var pnr = $(this).data('pnr');
        var paxName = $(this).data('paxname');
        if (this.checked) {
            if (selectedTickets.length > 0 && selectedTickets[0].pnr !== pnr) {
                alert('You can only select tickets with the same PNR.');
                $(this).prop('checked', false);
                return;
            }
            selectedTickets.push({ ticketNo: ticketNo, pnr: pnr, paxName: paxName });
        } else {
            selectedTickets = selectedTickets.filter(function(ticket) {
                return ticket.ticketNo !== ticketNo;
            });
        }
        console.log("Selected Tickets: ", selectedTickets); // Add logging here
    });

    $('#getTickets').click(function() {
        if (selectedTickets.length === 0) {
            alert('Please select at least one ticket.');
            return;
        }

        var troNumber = $('#troNumber').val();
        var docId = $('#docId').val();


        console.log("Sending data: ", {
            _token: '{{ csrf_token() }}',
            troNumber: troNumber,
            docId: docId,
            tickets: selectedTickets
        }); // Add logging here

        $.ajax({
            url: '{{ route("sales-folder-pax.tempdata.store") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                troNumber: troNumber,
                docId: docId,
                tickets: selectedTickets
            },
            success: function(response) {
                window.location.href = response.redirect_url;
            },
            error: function(xhr) {
                const errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred';
                alert(errorMessage);
            }
        });
    });

    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        table.ajax.reload();
    });

    $('#clearSearch').click(function() {
        $('#searchForm').find('input[type=text], input[type=date], select').val('');
        table.ajax.reload();
    });

    $('#inventoryTable tbody').css('cursor', 'pointer');
});

</script>

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

@endsection


