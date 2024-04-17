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

            <div class="d-flex">

                <div class="card modules mx-2">
                    <div class="card-header marsman-bg-color-secondary">
                        <h6 class="my-1 fw-bold">{{ __('Travel Request Order') }}</h6>
                    </div>
                    <div class="card-body marsman-bg-color-lightgray" style="display: flex;">
                        <div class="p-2" style="flex: 0 0 auto; display: flex; align-items: center;">
                            <img src="{{ asset('images/folder.png') }}" width="70px" alt="Folder Icon">
                        </div>
                        <div class="p-2" style="flex: 1;">
                            <a href="{{ route('forms.tro') }}">
                            <p>
                                Automate your booking card by using this
                                tool to consolidate your sales whether air
                                tickets, non-air products, or documentation
                                prior to billing your client.
                            </p>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card modules mx-2">
                    <div class="card-header marsman-bg-color-secondary">
                        <h6 class="my-1 fw-bold">{{ __('Invoice') }}</h6>
                    </div>
                    <div class="card-body marsman-bg-color-lightgray" style="display: flex;">
                        <div class="p-2" style="flex: 0 0 auto; display: flex; align-items: center;">
                            <img src="{{ asset('images/invoice.png') }}" width="70px" alt="Folder Icon">
                        </div>
                        <div class="p-2" style="flex: 1;">
                            <p>
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

                <div class="card modules mx-2">
                    <div class="card-header marsman-bg-color-secondary">
                        <h6 class="my-1 fw-bold">{{ __('Exchange Order') }}</h6>
                    </div>
                    <div class="card-body marsman-bg-color-lightgray" style="display: flex;">
                        <div class="p-2" style="flex: 0 0 auto; display: flex; align-items: center;">
                            <img src="{{ asset('images/exchange-order.png') }}" width="70px" alt="Folder Icon">
                        </div>
                        <div class="p-2" style="flex: 1;">
                            <p>
                                If vou need to purchase or
                                exchange products from your
                                supplier, this module allows you
                                to quickly create an Exchange
                                Order.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card modules mx-2">
                    <div class="card-header marsman-bg-color-secondary">
                        <h6 class="my-1 fw-bold">{{ __('Receipt') }}</h6>
                    </div>
                    <div class="card-body marsman-bg-color-lightgray" style="display: flex;">
                        <div class="p-2" style="flex: 0 0 auto; display: flex; align-items: center;">
                            <img src="{{ asset('images/receipt.png') }}" width="70px" alt="Folder Icon">
                        </div>
                        <div class="p-2" style="flex: 1;">
                            <p>
                                Whether your client is paving
                                their outstanding balance or
                                accepting pavment refund from
                                your supplier, you can issue
                                appropriate receipt in no time!
                            </p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="d-flex mt-5">

                <div class="card modules mx-2">
                    <div class="card-header marsman-bg-color-secondary">
                        <h6 class="my-1 fw-bold">{{ __('Inventory') }}</h6>
                    </div>
                    <div class="card-body marsman-bg-color-lightgray" style="display: flex;">
                        <div class="p-2" style="flex: 0 0 auto; display: flex; align-items: center;">
                            <img src="{{ asset('images/inventory.png') }}" width="70px" alt="Folder Icon">
                        </div>
                        <div class="p-2" style="flex: 1;">
                            <p>
                                Manage your ticket and
                                voucher stocks more efficiently.
                                Whether manual or automated
                                this module gives you instant
                                access to your tickets and
                                vouchers. With seamless
                                interface with AMADEUS CRS
                                all tickets issued are
                                automatically log in this module!
                            </p>
                        </div>
                    </div>
                </div>

                <div class="card modules mx-2">
                    <div class="card-header marsman-bg-color-secondary">
                        <h6 class="my-1 fw-bold">{{ __('Cash Advance Voucher') }}</h6>
                    </div>
                    <div class="card-body marsman-bg-color-lightgray" style="display: flex;">
                        <div class="p-2" style="flex: 0 0 auto; display: flex; align-items: center;">
                            <img src="{{ asset('images/voucher.png') }}" width="70px" alt="Folder Icon">
                        </div>
                        <div class="p-2" style="flex: 1;">
                            <p>
                                Need a help to automate the
                                preparation of cash advances
                                due to documentatin request
                                from the client? This tool helps
                                you do that by allowing vou to
                                create a Cash Advance
                                Voucher based on an existing
                                request
                            </p>
                        </div>
                    </div>
                </div>

            </div>

        </main>

    </div>
</div>
<style>
    .modules {
        width: 25em;
    }

    .modules p {
        display: flex;
    }

    .modules .card-header {
        color: #8b0000;
    }
</style>

@endsection
