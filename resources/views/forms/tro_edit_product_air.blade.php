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

            <!-- TRO Number and DOC ID of this product -->
            @if(isset($troNumber))
                <input type="hidden" name="troNumber" id="troNumber" value="{{ $troNumber }}">
            @endif

            @if(isset($docId))
                <input type="hidden" name="docId" id="docId" value="{{ $docId  }}">
            @endif
            <!-- important hidden data -->

            <a href="{{ route('forms.tro.sf', ['troNumber' => $troNumber]) }}" class="btn marsman-btn-primary txt-1 mb-2">Back to Travel Request Order</a>

            <div class="card">
                <div class="card-header marsman-bg-color-secondary p-0">
                    <p class="h6 my-2 mx-2">{{ __('Product Details - '.$sfGroup->product->PROD_DESCR) }}</p>
                </div>
                <div class="card-body bg-white">

                    <hr class="w-100">

                    <!-- Tabs -->
                    <ul class="nav nav-tabs mb-3 bg-white" id="myTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales" role="tab" aria-controls="sales" aria-selected="true">Sales / Cost</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link itinerary" id="itineraryAir-tab" data-bs-toggle="tab" data-bs-target="#itineraryAir" role="tab" aria-controls="itineraryAir" aria-selected="false">Itinerary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="addtaxes-tab" data-bs-toggle="tab" data-bs-target="#addtaxes" role="tab" aria-controls="addtaxes" aria-selected="false">Taxes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="mis-tab" data-bs-toggle="tab" data-bs-target="#mis" role="tab" aria-controls="mis" aria-selected="false">MIS / Other Reference</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="remarks-tab" data-bs-toggle="tab" data-bs-target="#remarks" role="tab" aria-controls="remarks" aria-selected="false">Remarks</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="passenger-tab" data-bs-toggle="tab" data-bs-target="#passenger" role="tab" aria-controls="passenger" aria-selected="false">Passenger</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <!-- Tab 1 :: Sales -->
                        <div class="tab-pane fade show active" id="sales" role="tabpanel" aria-labelledby="sales-tab">

                            <div class="row col-md-12 d-flex mt-2">

                                <div class="form-group col-md-6 mb-2">
                                    <p class="h4">SALES</p>
                                    <!-- Currency -->
                                    <div class="card">
                                        <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('CURRENCY') }}</p>
                                        </div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="col-md-12 d-flex">
                                                <div class="form-group">
                                                    <label for="salesCurrencyCode" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Code</label>
                                                    <input type="text" class="form-control txt-1" id="salesCurrencyCode" name="salesCurrencyCode" value="PHP">
                                                </div>
                                                <div class="form-group col-md-8 mx-2">
                                                    <label for="salesCurrencyAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Amount</label>
                                                    <input type="text" class="form-control txt-1" id="salesCurrencyAmount" name="salesCurrencyAmount" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--- Unit -->
                                    <div class="card mt-2">
                                        <div class="card-header m-0 p-0">

                                        </div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="col-md-12 d-flex">
                                                <div class="form-group col-md-6 mx-2">
                                                    <label for="salesUnitAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Unit Amount</label>
                                                    <input type="text" class="form-control txt-1" id="salesUnitAmount" name="salesUnitAmount" value="0">
                                                </div>
                                                <div class="form-group col-md-4 mx-2">
                                                    <label for="salesUnitQuantity" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Quantity</label>
                                                    <input type="number" class="form-control txt-1" id="salesUnitQuantity" name="salesUnitQuantity" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Discount -->
                                    <div class="card mt-2">
                                        <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('DISCOUNT') }}</p>
                                        </div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="col-md-12 d-flex">
                                                <div class="form-group col-md-6 mx-2">
                                                    <label for="salesDiscountRate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Rate</label>
                                                    <input type="number" class="form-control txt-1" id="salesDiscountRate" name="salesDiscountRate" value="0">
                                                </div>
                                                <div class="form-group col-md-4 mx-2">
                                                    <label for="salesDiscountAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Amount</label>
                                                    <input type="number" class="form-control txt-1" id="salesDiscountAmount" name="salesDiscountAmount" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Commission -->
                                    <div class="card mt-2">
                                        <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('COMMISSION') }}</p>
                                        </div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="col-md-12 d-flex">
                                                <div class="form-group col-md-6 mx-2">
                                                    <label for="salesCommissionRate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Rate</label>
                                                    <input type="number" class="form-control txt-1" id="salesCommissionRate" name="salesCommissionRate" value="0">
                                                </div>
                                                <div class="form-group col-md-4 mx-2">
                                                    <label for="salesCommissionAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Amount</label>
                                                    <input type="number" class="form-control txt-1" id="salesCommissionAmount" name="salesCommissionAmount" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mt-2">
                                        <div class="card-header m-0 p-0">

                                        </div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="col-md-12 d-flex mt-2">
                                                <div class="form-group col-md-4">
                                                    <label for="govTax" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Government Tax</label>
                                                    <select class="form-control form-select" id="govTax" name="govTax">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-8 mx-2">
                                                    <label for="govTaxAmount" class="form-label bg-none text-white txt-1 p-2 m-0 rounded-top">Amount</label>
                                                    <input type="text" class="form-control txt-1 p-2" id="govTaxAmount" name="govTaxAmount">
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <div class="form-group">
                                                    <label for="govTaxCat" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Government Tax Category</label>
                                                    <select class="form-control form-select txt-1" id="govTaxCat" name="govTaxCat">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="salesTax" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Taxes</label>
                                                    <input type="number" class="form-control txt-1 p-2" id="salesTax" name="salesTax" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <div class="form-group">
                                                    <label for="salesSurcharge" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Surcharge</label>
                                                    <input type="text" class="form-control txt-1 p-2" id="salesSurcharge" name="salesSurcharge" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-12 d-flex mt-2">
                                                <div class="form-group col-md-6">
                                                    <label for="salesTotalUnitAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Total Unit Amount</label>
                                                    <input type="text" class="form-control txt-1 p-2" id="salesTotalUnitAmount" name="salesTotalUnitAmount" value="0">
                                                </div>
                                                <div class="form-group col-md-6 mx-2">
                                                    <label for="salesTotalIncome" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Total Income</label>
                                                    <input type="text" class="form-control txt-1 p-2" id="salesTotalIncome" name="salesTotalIncome" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-12 d-flex mt-2">
                                                <div class="form-group col-md-6">
                                                    <label for="salesGrandTotal" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Grand Total</label>
                                                    <input type="text" class="form-control txt-1 p-2" id="salesGrandTotal" name="salesGrandTotal" value="0">
                                                </div>
                                                <div class="form-group col-md-6 mx-2">
                                                    <label for="unitIncome" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Unit income</label>
                                                    <input type="text" class="form-control txt-1 p-2" id="unitIncome" name="unitIncome" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- COST Column 1 -->
                                <div class="form-group col-md-6">
                                    <p class="h4">COST</p>
                                    <div class="card">
                                        <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('CURRENCY') }}</p>
                                        </div>
                                        <!-- Currency -->
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="col-md-12 d-flex">
                                                <div class="form-group">
                                                    <label for="costCurrencyCode" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Code</label>
                                                    <input type="text" class="form-control txt-1" id="costCurrencyCode" name="costCurrencyCode" value="PHP">
                                                </div>
                                                <div class="form-group col-md-8 mx-2">
                                                    <label for="costCurrencyAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Amount</label>
                                                    <input type="text" class="form-control txt-1" id="costCurrencyAmount" name="costCurrencyAmount" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Air Product -->
                                    <div class="card mt-2">
                                        <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('AIR PRODUCT') }}</p>
                                        </div>
                                        <!-- Fare Code -->
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="col-md-12">
                                                <div class="form-group mb-2">
                                                    <label for="splFareCode" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Special Fare Code</label>
                                                    <input type="text" class="form-control txt-1" id="splFareCode" name="splFareCode">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="costPublishedRate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Published Rate</label>
                                                    <input type="text" class="form-control txt-1" id="costPublishedRate" name="costPublishedRate">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="costNetRate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Net Rate</label>
                                                    <input type="text" class="form-control txt-1" id="costNetRate" name="costNetRate">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Non Air Product -->
                                    <div class="card mt-2">
                                        <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('NON-AIR PRODUCT') }}</p>
                                        </div>
                                        <!-- Net Rate -->
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="nonAirNetRate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Net Rate</label>
                                                    <input type="text" class="form-control txt-1" id="nonAirNetRate" name="nonAirNetRate">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Others -->
                                    <div class="card mt-2">
                                        <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('OTHERS') }}</p>
                                        </div>
                                        <!-- Supplier -->
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="costSupplier" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Supplier</label>
                                                    <select type="text" class="form-control form-select txt-1" id="costSupplier" name="costSupplier">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="form-group my-2">
                                                    <label for="xoNumber" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Exchange Order Number</label>
                                                    <input type="text" class="form-control txt-1" id="xoNumber" name="xoNumber">
                                                </div>
                                                <div class="form-group">
                                                    <label for="account" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Account</label>
                                                    <select type="text" class="form-control form-select txt-1" id="account" name="account">
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mt-2">
                                        <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('DISCOUNT') }}</p>
                                        </div>
                                        <!-- Discount -->
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="col-md-12 d-flex">
                                                <div class="form-group col-md-6 mb-2">
                                                    <label for="costDiscountRate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Rate</label>
                                                    <input type="text" class="form-control txt-1" id="costDiscountRate" name="costDiscountRate" value="0">
                                                </div>
                                                <div class="form-group col-md-6 mb-2 mx-2">
                                                    <label for="costDiscountAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Amount</label>
                                                    <input type="text" class="form-control txt-1" id="costDiscountAmount" name="costDiscountAmount" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-2">
                                        <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('COMMISSION') }}</p>
                                        </div>
                                        <!-- Commission -->
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="col-md-12 d-flex">
                                                <div class="form-group col-md-6 mb-2">
                                                    <label for="costCommissionRate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Rate</label>
                                                    <input type="text" class="form-control txt-1" id="costCommissionRate" name="costCommissionRate" value="0">
                                                </div>
                                                <div class="form-group col-md-6 mb-2 mx-2">
                                                    <label for="costCommissionAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Amount</label>
                                                    <input type="text" class="form-control txt-1" id="costCommissionAmount" name="costCommissionAmount" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Insurance -->
                                    <div class="card mt-2">
                                        <div class="card-header m-0 p-0">
                                        </div>
                                        <!-- Insurance -->
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="col-md-12">
                                                <div class="form-group mb-2">
                                                    <label for="costInsurance" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Insurance</label>
                                                    <input type="text" class="form-control txt-1" id="costInsurance" name="costInsurance">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="costTax" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Taxes</label>
                                                    <input type="text" class="form-control txt-1" id="costTax" name="costTax" value="0">
                                                </div>
                                            </div>
                                            <div class="form-group d-flex mb-2">
                                                <div class="form-group col-md-6 mb-2">
                                                    <label for="costTotalUnitCost" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Total Unit Cost</label>
                                                    <input type="text" class="form-control txt-1" id="costTotalUnitCost" name="costTotalUnitCost" value="0">
                                                </div>
                                                <div class="form-group col-md-4 mb-2 mx-2">
                                                    <label for="costUnitQuantity" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Quantity.</label>
                                                    <input type="number" class="form-control txt-1" id="costUnitQuantity" name="costUnitQuantity" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="costGrandTotal" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Grand Total</label>
                                                    <input type="text" class="form-control txt-1" id="costGrandTotal" name="costGrandTotal" value="0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tour Code -->
                                    <div class="card mt-2">
                                        <div class="card-header m-0 p-0">
                                        </div>
                                        <!-- Tour Code -->
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="col-md-12">
                                                <div class="form-group mb-2">
                                                    <label for="tourCode" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Tour Code</label>
                                                    <input type="text" class="form-control txt-1" id="tourCode" name="tourCode">
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group mb-2">
                                                    <label for="mpdMco" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">MPD / MCO</label>
                                                    <input type="text" class="form-control txt-1" id="mpdMco" name="mpdMco">
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <div class="form-group">
                                                    <label for="voucherNumber" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Voucher Number</label>
                                                    <input type="text" class="form-control txt-1" id="voucherNumber" name="voucherNumber">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Tab 3 :: Itinerary AIR -->
                        <div class="tab-pane fade show" id="itineraryAir" role="tabpanel" aria-labelledby="itineraryAir-tab">
                            <p class="h3">AIR</p>

                            <!-- Notification placeholders -->
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="marsman-bg-color-darkgray text-white">
                                        <tr>
                                            <th colspan="3"></th>
                                            <th colspan="3" class="text-center">Departure</th>
                                            <th colspan="3" class="text-center">Arrival</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th>Airline</th>
                                            <th>Flight No.</th>
                                            <th>Service Class</th>
                                            <th>*City</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>*City</th>
                                            <th>Date</th>
                                            <th>Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($sfAir))
                                            @foreach ($sfAir as $air)
                                            <form action="{{ route('sales-folder-air.update', [
                                                'sfNo' => $troNumber,
                                                'docId' => $docId,
                                                'itemNo' => $air->ITEM_NO,
                                            ]) }}" method="POST">
                                                @csrf
                                                @method("PUT")
                                                <tr>
                                                    <td>
                                                        <input list="dataAirlines" id="airline" name="airline" value="{{ $air->AL_CODE }}" class="form-control">
                                                        <datalist id="dataAirlines">
                                                            @if (isset($airlines))
                                                                @foreach ($airlines as $airline)
                                                                    <option value="{{ $airline->AL_CODE }}">{{ $airline->AL_DESCR }}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="flightNumber" name="flightNumber" value="{{ $air->FLIGHT_NUM }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input list="dataService" id="serviceClass" name="serviceClass" value="{{ $air->SERVICE_CLASS }}" class="form-control">
                                                        <datalist id="dataService">
                                                            @if (isset($serviceClasses))
                                                                @foreach ($serviceClasses as $service)
                                                                    <option value="{{ $service->SRVC_CLASS }}">{{ $service->SRVC_DESCR }}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                    </td>
                                                    <td>
                                                        <input list="dataCities" id="departureCity" name="departureCity" value="{{ $air->DEPT_CITY }}" class="form-control">
                                                        <datalist id="dataCities">
                                                            @if (isset($cities))
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->CITY_CODE }}">{{ $city->CITY_DESCR }}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="departureDate" name="departureDate" class="form-control" value="{{ \Illuminate\Support\Carbon::parse($air->DEPT_DATE)->format('Y-m-d') }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="departureTime" name="departureTime" class="form-control" value="{{ $air->DEPT_TIME }}">
                                                    </td>
                                                    <td>
                                                        <input list="dataCities" id="arrivalCity" name="arrivalCity" class="form-control" value="{{ $air->ARVL_CITY }}">
                                                        <datalist id="dataCities">
                                                            @if (isset($cities))
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->CITY_CODE }}">{{ $city->CITY_DESCR }}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="arrivalDate" name="arrivalDate" class="form-control" value="{{ \Illuminate\Support\Carbon::parse($air->ARVL_DATE)->format('Y-m-d') }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="arrivalTime" name="arrivalTime" class="form-control" value="{{ $air->ARVL_TIME }}">
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-primary txt-1" id="updateItineraryAir">Update</button>
                                                    </td>
                                                </tr>
                                                <input type="hidden" name="sfNo" id="sfNo" value="{{ $air->SF_NO }}">
                                                <input type="hidden" name="docId" id="docId" value="{{ $air->DOC_ID }}">
                                                <input type="hidden" name="itemNumber" id="itemNumber" value="{{ $air->ITEM_NO }}">
                                            </form>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                            </div>

                        </div>

                        <!-- Tab 4 :: Taxes -->
                        <div class="tab-pane fade show" id="addtaxes" role="tabpanel" aria-labelledby="addtaxes-tab">
                            <h4>Taxes</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="marsman-bg-color-dark text-white">
                                        <tr>
                                            <th></th>
                                            <th colspan="3" class="text-center">Cost</th>
                                            <th colspan="5" class="text-center">Sales</th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th>Code</th>
                                            <th>Currency</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th>Bill</th>
                                            <th>Incl.</th>
                                            <th>Currency</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th>Code</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Tab 5 :: MIS -->
                        <div class="tab-pane fade show" id="mis" role="tabpanel" aria-labelledby="mis-tab">
                            <p class="h3">MIS / Other Reference</p>

                            <div class="row col-md-12 d-flex mt-2">
                                <div class="form-group col-md-6">
                                    <div class="card">
                                        <div class="card-header m-0 p-0"></div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <label for="gds" class="form-label marsman-bg-color-label text-white p-2 m-0 rounded-top">GDS</label>
                                            <select id="gds" name="gds" class="form-control txt-1">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="card mt-2">
                                        <div class="card-header p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('BOOKING') }}</p>
                                        </div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <label for="bookLocation" class="form-label marsman-bg-color-label text-white p-2 m-0 rounded-top">Location</label>
                                            <input type="text" id="bookLocation" name="bookLocation" class="form-control txt-1">
                                            <label for="bookUser" class="form-label marsman-bg-color-label text-white p-2 m-0 rounded-top mt-2">User ID</label>
                                            <input type="text" id="bookUser" name="bookUser" class="form-control txt-1">
                                            <label for="bookDate" class="form-label marsman-bg-color-label text-white p-2 m-0 rounded-top mt-2">Date</label>
                                            <input type="date" id="bookDate" name="bookDate" class="form-control txt-1">
                                        </div>
                                    </div>

                                    <div class="card mt-2">
                                        <div class="card-header p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('ISSUANCE') }}</p>
                                        </div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <label for="issueLocation" class="form-label marsman-bg-color-label text-white p-2 m-0 rounded-top">Location</label>
                                            <input type="text" id="issueLocation" name="issueLocation" class="form-control txt-1">
                                            <label for="issueUser" class="form-label marsman-bg-color-label text-white p-2 m-0 rounded-top mt-2">User ID</label>
                                            <input type="text" id="issueUser" name="issueUser" class="form-control txt-1">
                                            <label for="issueDate" class="form-label marsman-bg-color-label text-white p-2 m-0 rounded-top mt-2">Date</label>
                                            <input type="date" id="issueDate" name="issueDate" class="form-control txt-1">
                                        </div>
                                    </div>

                                    <div class="card mt-2 mb-2">
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="p-2">
                                                <input type="checkbox" name="lht" value="1"> Long Haul Travel
                                                <div class="form-group mt-2">
                                                    <label for="region" class="form-label marsman-bg-color-label text-white p-2 m-0 rounded-top">Region</label>
                                                    <select id="region" name="region" class="form-control form-select txt-1">
                                                        <option></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6">

                                    <div class="card">
                                        <div class="card-header m-0 p-0"></div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="form-group mb-2">
                                                <label for="admAlloc" class="form-label marsman-bg-color-label text-white p-2 m-0 rounded-top">ADM Allocation</label>
                                                <input type="text" id="admAlloc" name="admAlloc" class="form-control txt-1">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="lowestFare" class="form-label marsman-bg-color-label text-white p-2 m-0 rounded-top">Lowest Fare</label>
                                                <input type="text" id="lowestFare" name="lowestFare" class="form-control txt-1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mt-1">
                                        <div class="card-header m-0 p-0"></div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="form-group mb-2">
                                                <label for="promoAlloc" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Promo Allocation</label>
                                                <input type="text" id="promoAlloc" name="promoAlloc" class="form-control txt-1">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="iataFare" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">IATA Fare</label>
                                                <input type="text" id="iataFare" name="iataFare" class="form-control txt-1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mt-1">
                                        <div class="card-header m-0 p-0"></div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="form-group mb-2">
                                                <label for="staffDiscount" class="form-label marsman-bg-color-label text-white p-2 m-0 rounded-top">Staff Discount</label>
                                                <input type="text" id="staffDiscount" name="staffDiscount" class="form-control txt-1">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="fareSaving" class="form-label marsman-bg-color-label text-white p-2 m-0 rounded-top">Fare Saving</label>
                                                <input type="text" id="fareSaving" name="fareSaving" class="form-control txt-1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mt-1">
                                        <div class="card-header m-0 p-0"></div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="form-group mb-2">
                                                <label for="pta" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">PTA</label>
                                                <input type="text" id="pta" name="pta" class="form-control txt-1">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="rtt" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">RTT</label>
                                                <input type="text" id="rtt" name="rtt" class="form-control txt-1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card mt-1">
                                        <div class="card-header m-0 p-0"></div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="form-group mb-2">
                                                <label for="allPNR" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">All PNR</label>
                                                <input type="text" id="allPNR" name="allPNR" class="form-control txt-1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('VESSEL RELATED INFO') }}
                                        </div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="row">
                                                <div class="form-group col-md-6 mb-2">
                                                    <label for="embarkationLoc" class="form-label marsman-bg-color-label text-white p-2 m-0 rounded-top">Embarkation Location</label>
                                                    <input type="text" id="embarkationLoc" name="embarkationLoc"s class="form-control txt-1">
                                                </div>
                                                <div class="form-group col-md-6 mb-2">
                                                    <label for="embarkationLoc" class="form-label txt-gray1 p-2 m-0 rounded-top">Embarkation Location</label>
                                                    <input type="text" id="embarkationLoc2" name="embarkationLoc2" class="form-control txt-1">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-4 mb-2">
                                                    <label for="embarkDate" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top mt-2">Date</label>
                                                    <input type="date" id="embarkDate" name="embarkDate" class="form-control txt-1">
                                                </div>
                                                <div class="form-group col-md-4 mb-2">
                                                    <input type="checkbox" name="isJoining" value="1">
                                                    <label for="joiningTotal" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top mt-2">Joining</label>
                                                    <input type="number" id="joiningTotal" name="joiningTotal" value="0" class="form-control txt-1">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-md-12 mb-2">
                                                    <label for="vesselName" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top mt-2">Vessel Name</label>
                                                    <input type="checkbox" name="toPrint" value="1" class="mr-2"> Print
                                                    <select id="vesselName" name="vesselName" class="form-control form-select txt-1">
                                                        @foreach ($vessels as $vessel)
                                                            <option value="{{ $vessel->VESSEL_CODE }}">{{ $vessel->VESSEL_NAME }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12 mb-2">
                                                    <label for="vesselPrincipal" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top mt-2">Principal</label>
                                                    <select id="vesselPrincipal" name="vesselPrincipal" class="form-control txt-1">
                                                        <option></option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-12 mb-2">
                                                    <label for="vesselRemarks" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Remarks</label>
                                                    <input type="text" id="vesselRemarks" name="vesselRemarks" class="form-control txt-1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 6 :: Remarks -->
                        <div class="tab-pane fade show" id="remarks" role="tabpanel" aria-labelledby="remarks-tab">
                            <p class="h3">Remarks</p>

                            <div class="row col-md-12 d-flex mt-2 marsman-bg-color-gray1 p-2">
                                <div class="col-md-6 mt-2">
                                    <div class="form-group">
                                        <div class="card">
                                            <div class="card-header p-0 m-0"></div>
                                            <div class="card-body">
                                                <div class="form-group mb-2">
                                                    <label for="generalRemarks" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top mt-2">General Remarks</label>
                                                    <textarea id="generalRemarks" name="generalRemarks" class="form-control txt-1" rows="5"></textarea>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="fareCalculation" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top mt-2">Fare Calculation</label>
                                                    <textarea id="fareCalculation" name="fareCalculation" class="form-control txt-1" rows="5"></textarea>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="paxDescription" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top mt-2">Pax Description</label>
                                                    <textarea id="paxDescription" name="paxDescription" class="form-control txt-1" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 mt-2">
                                    <div class="form-group">
                                        <div class="card">
                                            <div class="card-header p-0 m-0"></div>
                                            <div class="card-body">
                                                <div class="form-group mb-2">
                                                    <label for="longItineraryDesc" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top mt-2">Long Itinerary Description</label>
                                                    <textarea id="longItineraryDesc" name="longItineraryDesc" class="form-control txt-1" rows="5"></textarea>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="airlineReference" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top mt-2">Airline Reference</label>
                                                    <textarea id="airlineReference" name="airlineReference" class="form-control txt-1" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- Tab 6 :: Passenger -->
                        <div class="tab-pane fade show" id="passenger" role="tabpanel" aria-labelledby="passenger-tab">
                            <p class="h3">Passenger</p>

                            <div class="table-responsive">
                                <table id="passengerList" class="table table-bordered">
                                    <thead class="marsman-bg-color-darkgray text-white">
                                        <tr>
                                            <th>Passenger Name</th>
                                            <th>Ticket Number</th>
                                            <th>PNR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($sfAirPax))
                                            @foreach ($sfAirPax as $pax)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="passengerName" id="passengerName" class="form-control" value="{{ $pax->PAX_NAME }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="passengerName" id="passengerName" class="form-control" value="{{ $pax->TICKET_NO }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="passengerName" id="passengerName" class="form-control" value="{{ $pax->PNR }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>

                                <div class="col-md-12 d-flex justify-content-end">
                                    <button class="btn btn-primary txt-1" id="updateItineraryAir">Update</button>
                                </div>
                            </div>

                        </div>

                        <!-- End Tab Panes -->
                    </div>

                </div>
            </div>

        </main>

    </div>
</div>

<style>
.nav-tabs li a {
    cursor: pointer;
}

.no-wrap {
    white-space: nowrap;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {



    });
</script>

@endsection

