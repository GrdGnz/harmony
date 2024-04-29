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

            <div class="d-flex flex-column"> <!-- Change this to flex-column for mobile view -->

                <div class="row"> <!-- Wrap each card in a row -->
                    <div class="col modules">
                        <div class="card mx-2">
                            <div class="card-header marsman-bg-color-secondary">
                                <h6 class="my-1 fw-bold">{{ __('Travel Request Order') }}</h6>
                            </div>
                            <div class="card-body marsman-bg-color-lightgray" style="display: flex;">
                                <div class="p-2" style="flex: 0 0 auto; display: flex; align-items: center;">
                                    <img src="{{ asset('images/folder.png') }}" width="70px" alt="Folder Icon">
                                </div>
                                <div class="p-2" style="flex: 1;">
                                    <a href="{{ route('searchForm.tro') }}">
                                        <p class="txt-2">
                                            Automate your booking card by using this
                                            tool to consolidate your sales whether air
                                            tickets, non-air products, or documentation
                                            prior to billing your client.
                                        </p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row"> <!-- Repeat this structure for each card -->
                    <div class="col modules">
                        <div class="card mx-2">
                            <div class="card-header marsman-bg-color-secondary">
                                <h6 class="my-1 fw-bold">{{ __('Invoice') }}</h6>
                            </div>
                            <div class="card-body marsman-bg-color-lightgray" style="display: flex;">
                                <div class="p-2" style="flex: 0 0 auto; display: flex; align-items: center;">
                                    <img src="{{ asset('images/invoice.png') }}" width="70px" alt="Folder Icon">
                                </div>
                                <div class="p-2" style="flex: 1;">
                                    <p class="txt-2">
                                        For up-to-date receivables from
                                        your client, quickly bill your
                                        client on purchase products
                                        whether cash, on-account.
                                        credit card or UAPT payment
                                        with this easy-to-use tool
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row"> <!-- Add more rows for additional cards -->
                    <div class="col modules">
                        <div class="card mx-2">
                            <div class="card-header marsman-bg-color-secondary">
                                <h6 class="my-1 fw-bold">{{ __('Exchange Order') }}</h6>
                            </div>
                            <div class="card-body marsman-bg-color-lightgray" style="display: flex;">
                                <div class="p-2" style="flex: 0 0 auto; display: flex; align-items: center;">
                                    <img src="{{ asset('images/exchange-order.png') }}" width="70px" alt="Folder Icon">
                                </div>
                                <div class="p-2" style="flex: 1;">
                                    <p class="txt-2">
                                        If you need to purchase or
                                        exchange products from your
                                        supplier, this module allows you
                                        to quickly create an Exchange
                                        Order.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row"> <!-- Add more rows for additional cards -->
                    <div class="col modules">
                        <div class="card mx-2">
                            <div class="card-header marsman-bg-color-secondary">
                                <h6 class="my-1 fw-bold">{{ __('Receipt') }}</h6>
                            </div>
                            <div class="card-body marsman-bg-color-lightgray" style="display: flex;">
                                <div class="p-2" style="flex: 0 0 auto; display: flex; align-items: center;">
                                    <img src="{{ asset('images/receipt.png') }}" width="70px" alt="Folder Icon">
                                </div>
                                <div class="p-2" style="flex: 1;">
                                    <p class="txt-2">
                                        Whether your client is paying
                                        their outstanding balance or
                                        accepting payment refunds from
                                        your supplier, you can issue
                                        appropriate receipts in no time!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row"> <!-- Add more rows for additional cards -->
                    <div class="col modules">
                        <div class="card mx-2">
                            <div class="card-header marsman-bg-color-secondary">
                                <h6 class="my-1 fw-bold">{{ __('Inventory') }}</h6>
                            </div>
                            <div class="card-body marsman-bg-color-lightgray" style="display: flex;">
                                <div class="p-2" style="flex: 0 0 auto; display: flex; align-items: center;">
                                    <img src="{{ asset('images/inventory.png') }}" width="70px" alt="Folder Icon">
                                </div>
                                <div class="p-2" style="flex: 1;">
                                    <p class="txt-2">
                                        Manage your ticket and
                                        voucher stocks more efficiently.
                                        Whether manual or automated,
                                        this module gives you instant
                                        access to your tickets and
                                        vouchers. With seamless
                                        integration with AMADEUS CRS,
                                        all tickets issued are
                                        automatically logged in this module!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row"> <!-- Add more rows for additional cards -->
                    <div class="col modules">
                        <div class="card mx-2">
                            <div class="card-header marsman-bg-color-secondary">
                                <h6 class="my-1 fw-bold">{{ __('Cash Advance Voucher') }}</h6>
                            </div>
                            <div class="card-body marsman-bg-color-lightgray" style="display: flex;">
                                <div class="p-2" style="flex: 0 0 auto; display: flex; align-items: center;">
                                    <img src="{{ asset('images/voucher.png') }}" width="70px" alt="Folder Icon">
                                </div>
                                <div class="p-2" style="flex: 1;">
                                    <p class="txt-2">
                                        Need help automating the
                                        preparation of cash advances
                                        due to documentation requests
                                        from the client? This tool helps
                                        you do that by allowing you to
                                        create a Cash Advance
                                        Voucher based on an existing
                                        request.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </main>

    </div>
</div>

<style>
    .modules {
        width: 100%; /* Set width to full for mobile view */
        margin-bottom: 1em; /* Add some spacing between cards */
    }

    .modules .card {
        width: 100%; /* Set card width to full */
    }

    .modules .card-header {
        color: #8b0000;
    }
</style>

@endsection
