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
                    <p class="h6 my-2 mx-2">{{ __('Travel Request Order Product Group - New') }} - Doc ID: {{ $docId }}</p>
                </div>
                <div class="card-body bg-white">


                    <!-- Tabs -->
                    <ul class="nav nav-tabs mb-3 bg-white" id="myTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales" role="tab" aria-controls="sales" aria-selected="true">Sales / Cost</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link itinerary" id="itineraryMisc-tab" data-bs-toggle="tab" data-bs-target="#itineraryMisc" role="tab" aria-controls="itineraryMisc" aria-selected="false">Itinerary</a>
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

                        <!-- Tab 3 :: Itinerary MISC -->
                        <div class="tab-pane fade show" id="itineraryMisc" role="tabpanel" aria-labelledby="itineraryMisc-tab">
                            <p class="h3">MISC</p>
                            <div class="card">
                                <div class="card-header m-0 p-0">
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12 d-flex">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="miscType" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">*Type</label>
                                                <input type="text" list="listTypes" id="miscType" name="miscType" class="form-control txt-1" value="@if (isset($infoMisc)){{ trim($infoMisc->MISC_CODE) }}@endif">
                                                <datalist id="listTypes">
                                                    @if(isset($miscRates))
                                                        @foreach ($miscRates as $type)
                                                            <option value="{{ $type->MISC_CODE }}">{{ $type->MISC_DESCR }}</option>
                                                        @endforeach
                                                    @endif
                                                </datalist>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="additionalDescription" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Additional Description</label>
                                                <input type="text" id="additionalDescription" name="additionalDescription" class="form-control txt-1">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscServiceClass" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Service Class</label>
                                                <input type="text" list="listServiceClass" id="miscServiceClass" name="miscServiceClass" class="form-control txt-1" value="@if (isset($infoMisc)){{ trim($infoMisc->SERVICE_CLASS) }}@endif">
                                                <datalist id="listServiceClass">
                                                    @if(isset($serviceClasses))
                                                        @foreach ($serviceClasses as $service)
                                                            <option value="{{ $service->SRVC_CLASS }}">{{ $service->SRVC_DESCR }}</option>
                                                        @endforeach
                                                    @endif
                                                </datalist>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscStatus" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Status</label>
                                                <input type="text" list="listStatus" id="miscStatus" name="miscStatus" class="form-control txt-1" value="@if (isset($infoMisc)){{ trim($infoMisc->STATUS) }}@endif">
                                                <datalist id="listStatus">
                                                    @if(isset($bookStatus))
                                                        @foreach ($bookStatus as $status)
                                                            <option value="{{ $status->BK_CODE }}">{{ $status->BK_DESCR }}</option>
                                                        @endforeach
                                                    @endif
                                                </datalist>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscStartDate" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">*Start Date</label>
                                                <input type="date" id="miscStartDate" name="miscStartDate" class="form-control txt-1" value="@if (isset($infoMisc)){{ trim(\Carbon\Carbon::parse($infoMisc->START_DATE)->format('Y-m-d')) }}@endif">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscStartLoc" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Start Location</label>
                                                <input type="text" id="miscStartLoc" name="miscStartLoc" class="form-control txt-1">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscEndDate" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">*End Date</label>
                                                <input type="date" id="miscEndDate" name="miscEndDate" class="form-control txt-1"  value="@if (isset($infoMisc)){{ trim(\Carbon\Carbon::parse($infoMisc->END_DATE)->format('Y-m-d')) }}@endif">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscEndLoc" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">End Location</label>
                                                <input type="text" id="miscEndLoc" name="miscEndLoc" class="form-control txt-1">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscRemarks" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Remarks</label>
                                                <textarea id="miscRemarks" name="miscRemarks" rows="4" class="form-control txt-1">@if (isset($infoMisc)){{ trim($infoMisc->REMARKS) }}@endif</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mx-2">
                                                <label for="procCenter" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Proc. Center</label>
                                                <input type="text" list="listProcCenter" id="procCenter" name="procCenter" class="form-control txt-1" value="@if (isset($infoMisc)){{ trim($infoMisc->PROC_CENTER) }}@endif">
                                                <datalist id="listProcCenter">
                                                    @if(isset($processingCenters))
                                                        @foreach ($processingCenters as $proc)
                                                            <option value="{{ $proc->PROC_CODE }}">{{ $proc->PROC_DESCR }}</option>
                                                        @endforeach
                                                    @endif
                                                </datalist>
                                            </div>
                                            <div class="form-group mx-2 mt-2">
                                                <label for="docOfficer" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Doc Officer</label>
                                                <select class="form-control form-select txt-1" id="docOfficer" name="docOfficer">
                                                    <option></option>
                                                </select>
                                            </div>
                                            <div class="form-group mx-2 mt-2">
                                                <label for="miscCategory" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Category</label>
                                                <select class="form-control form-select txt-1" id="miscCategory" name="miscCategory">
                                                    <option></option>
                                                </select>
                                            </div>
                                            <div class="form-group mx-2 mt-2">
                                                <label for="miscConfNo" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Confirmation Number</label>
                                                <input type="text" class="form-control txt-1" id="miscConfNo" name="miscConfNo">
                                            </div>
                                            <div class="form-group mx-2 mt-2">
                                                <label for="miscPaxRefNo" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Passenger Reference Number</label>
                                                <input type="text" class="form-control txt-1" id="miscPaxRefNo" name="miscPaxRefNo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
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

                        <!-- Tab 6 :: Remarks -->
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

                                    </tbody>
                                </table>
                            </div>

                            <hr class="w-100">

                            <div class="col-md-12 d-flex">
                                <div class="col-md-6">
                                    <div class="card-body marsman-bg-color-gray1">
                                        <div class="form-group">
                                            <label for="passengerName" class="form-label txt-1 marsman-bg-color-label text-white rounded-top p-2 m-0">Passenger Name</label>
                                            <input type="text" class="form-control txt-1" id="passengerName" name="passengerName">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="passengerPNR" class="form-label txt-1 marsman-bg-color-label text-white rounded-top p-2 m-0">PNR</label>
                                            <input type="text" class="form-control txt-1" id="passengerPNR" name="passengerPNR">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body marsman-bg-color-gray1">
                                        <div class="form-group">
                                            <label for="passengerTicketNumber" class="form-label txt-1 marsman-bg-color-label text-white rounded-top p-2 m-0">Ticket Number</label>
                                            <input type="text" class="form-control txt-1" id="passengerTicketNumber" name="passengerTicketNumber">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12 mx-1 my-1 d-flex justify-content-end">
                                        <button class="btn btn-success txt-1 mt-3" id="addPax">Add</button>
                                    </div>
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
        const checkInDate = document.getElementById('checkInDate');
        const checkOutDate = document.getElementById('checkOutDate');
        const hotelNights = document.getElementById('hotelNights');
        const productNameSelect = document.getElementById('productType');
        const categorySelect = document.getElementById('productCategory');
        const routeSelect = document.getElementById('route');
        const itineraryTabs = document.querySelectorAll('.nav-link.itinerary');
        const salesTab = document.getElementById('sales-tab');  // Make sure this ID matches your HTML

        // Initially make the product and route select boxes disabled
        productNameSelect.disabled = true;
        routeSelect.disabled = true;

        // Hide all itinerary tabs initially
        itineraryTabs.forEach(tab => tab.style.display = 'none');

        categorySelect.addEventListener('change', function() {
            const selectedCategory = this.value;

            // Enable the product and route select boxes if a category is selected
            productNameSelect.disabled = !selectedCategory;
            routeSelect.disabled = !selectedCategory;

            // Filter products based on the selected category
            filterProducts();

            // Reset the product select box to its default option
            productNameSelect.value = '';
            routeSelect.value = '';

            // Show/hide the appropriate itinerary tab
            showItineraryTab();

            // Make #sales-tab the active tab
            if (selectedCategory) {
                new bootstrap.Tab(salesTab).show();
            }
        });

        routeSelect.addEventListener('change', function() {
            // Filter products based on the selected category and route
            filterProducts();
        });

        function filterProducts() {
            const selectedCategoryName = categorySelect.options[categorySelect.selectedIndex].text.trim();
            const selectedRoute = routeSelect.options[routeSelect.selectedIndex].text.trim();
            const routeFilter = selectedRoute === 'Domestic' ? 'DOM' : selectedRoute === 'International' ? 'INTL' : '';

            const options = productNameSelect.querySelectorAll('option');
            options.forEach(option => {
                const productDescription = option.text.trim();
                let showOption = false;

                if (selectedCategoryName === 'HOTEL') {
                    showOption = productDescription.startsWith('HOTEL');
                    if (routeFilter) {
                        showOption = showOption && productDescription.includes(routeFilter);
                    }
                } else if (selectedCategoryName === 'AIR') {
                    showOption = productDescription.startsWith('AIR ');
                    if (routeFilter) {
                        showOption = showOption && productDescription.includes(routeFilter);
                    }
                } else if (selectedCategoryName === 'CAR / TRANSFER') {
                    showOption = productDescription.startsWith('CARS') || productDescription.startsWith('TRANSFERS');
                    if (routeFilter) {
                        showOption = showOption && productDescription.includes(routeFilter);
                    }
                } else if (selectedCategoryName === 'MISCELLANEOUS') {
                    showOption = productDescription.startsWith('MISCELLANEOUS');
                } else {
                    showOption = option.dataset.category === selectedCategoryName;
                }

                option.style.display = showOption ? '' : 'none';
            });
        }

        function showItineraryTab() {
            const selectedCategoryName = categorySelect.options[categorySelect.selectedIndex].text.trim();
            const hotelTab = document.getElementById('itineraryHotel-tab');
            const miscTab = document.getElementById('itineraryMisc-tab');
            const airTab = document.getElementById('itineraryAir-tab');
            const carTab = document.getElementById('itineraryCar-tab');
            const hotelContent = document.getElementById('itineraryHotel');
            const miscContent = document.getElementById('itineraryMisc');

            // Hide all itinerary tabs
            itineraryTabs.forEach(tab => tab.style.display = 'none');

            // Show the appropriate itinerary tab based on the selected category
            if (selectedCategoryName === 'HOTEL') {
                hotelTab.style.display = 'block';
                miscTab.style.display = 'none';
                carTab.style.display = 'none';
                airTab.style.display = 'none';
            } else if (selectedCategoryName === 'MISCELLANEOUS') {
                miscTab.style.display = 'block';
                hotelTab.style.display = 'none';
                carTab.style.display = 'none';
                airTab.style.display = 'none';
            } else if (selectedCategoryName === 'AIR') {
                airTab.style.display = 'block';
                miscTab.style.display = 'none';
                hotelTab.style.display = 'none';
                carTab.style.display = 'none';
            } else if (selectedCategoryName === 'CAR / TRANSFER') {
                carTab.style.display = 'block';
                airTab.style.display = 'none';
                miscTab.style.display = 'none';
                hotelTab.style.display = 'none';
            }
        }

        function calculateNights() {
            const checkIn = new Date(checkInDate.value);
            const checkOut = new Date(checkOutDate.value);

            if (!isNaN(checkIn.getTime()) && !isNaN(checkOut.getTime()) && checkOut > checkIn) {
                const timeDifference = checkOut.getTime() - checkIn.getTime();
                const daysDifference = timeDifference / (1000 * 3600 * 24);
                hotelNights.value = daysDifference;
            } else {
                hotelNights.value = 0;
            }
        }

        checkInDate.addEventListener('change', () => {
            if (checkOutDate.value) {
                const checkIn = new Date(checkInDate.value);
                const checkOut = new Date(checkOutDate.value);
                if (checkOut <= checkIn) {
                    checkOutDate.value = '';
                    hotelNights.value = 0;
                }
            }
            calculateNights();
        });

        checkOutDate.addEventListener('change', () => {
            const checkIn = new Date(checkInDate.value);
            const checkOut = new Date(checkOutDate.value);
            if (checkInDate.value && checkOut <= checkIn) {
                checkOutDate.value = '';
                hotelNights.value = 0;
                alert('Check-out date must be after the check-in date.');
            }
            calculateNights();
        });

        document.getElementById('productType').addEventListener('change', function() {
            var selectedProduct = this.options[this.selectedIndex].text;
            var hotelTab = document.getElementById('itineraryHotel-tab');
            var miscTab = document.getElementById('itineraryMisc-tab');
            var carTab = document.getElementById('itineraryCar-tab');
            var airTab = document.getElementById('itineraryAir-tab');

            if (selectedProduct.includes('HOTEL')) {
                new bootstrap.Tab(hotelTab).show();
            } else if (selectedProduct.includes('MISCELLANEOUS')) {
                new bootstrap.Tab(miscTab).show();
            } else if (selectedProduct.includes('AIR')) {
                new bootstrap.Tab(airTab).show();
            } else if (selectedProduct.includes('CAR / TRANSFER')) {
                new bootstrap.Tab(carTab).show();
            }
        });

        //Add Hotel Itinerary
        function addHotelProduct() {
            var formData = {
                troNumber: $('#troNumber').val(),
                docId: $('#docId').val(),
                hotelCode: $('#hotelCode').val(),
                checkInDate: $('#checkInDate').val(),
                checkOutDate: $('#checkOutDate').val(),
                roomType: $('#roomType').val(),
                roomCategory: $('#roomCategory').val(),
                bookStatus: $('#hotelBookingStatus').val(),
                numberOfGuest: $('#hotelGuests').val(),
                roomQuantity: $('#roomQuantity').val(),
                isVip: $('#isVip').is(':checked') ? 1 : 0,
                hotelBreakfast: $('#hotelBreakfast').val(),
                hotelLunch: $('#hotelLunch').val(),
                hotelDinner: $('#hotelDinner').val(),
                otherServices: $('#hotelOtherServices').val(),
                hotelRemarks: $('#hotelRemarks').val(),
            };

            $.ajax({
                url: '{{ route('sales-folder-hotel.store') }}',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response.data);
                    alert(response.success);

                    //Save Sales Folder Group
                    saveSalesFolderGroup();

                    // Redirect to the specified route
                    var troNumber = $('#troNumber').val();
                    var redirectUrl = '{{ route("forms.tro.sf", ":troNumber") }}';
                    redirectUrl = redirectUrl.replace(':troNumber', troNumber);
                    window.location.href = redirectUrl;
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        console.log(response.data);
                        alert(value);
                    });
                }
            });
        }

        //Add Car/Transfer Itinerary
        function addCarTransferProduct() {
            var formData = {
                troNumber: $('#troNumber').val(),
                docId: $('#docId').val(),
                carProvider: $('#carProvider').val(),
                carType: $('#carType').val(),
                carCategory: $('#carCategory').val(),
                carFlightNumber: $('#carFlightNumber').val(),
                pickUpDate: $('#pickUpDate').val(),
                pickUpTime: $('#pickUpTime').val(),
                pickUpLocation: $('#pickUpLocation').val(),
                dropoffDate: $('#dropoffDate').val(),
                dropoffTime: $('#dropoffTime').val(),
                dropoffLocation: $('#dropoffLocation').val(),
                stopoverFirst: $('#stopoverFirst').val(),
                stopoverSecond: $('#stopoverSecond').val(),
                stopoverThird: $('#stopoverThird').val(),
                pickupPhoneNumber: $('#pickupPhoneNumber').val(),
                carSpecialRequest: $('#carSpecialRequest').val(),
                carStatus: $('#carStatus').val(),
            };

            $.ajax({
                url: '{{ route('sales-folder-transfer.store') }}',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response.data);
                    alert(response.success);

                    //Save Sales Folder Group
                    saveSalesFolderGroup();

                    // Redirect to the specified route
                    var troNumber = $('#troNumber').val();
                    var redirectUrl = '{{ route("forms.tro.sf", ":troNumber") }}';
                    redirectUrl = redirectUrl.replace(':troNumber', troNumber);
                    window.location.href = redirectUrl;
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        console.log(response.data);
                        alert(value);
                    });
                }
            });
        }

        //Add Miscellaneous Itinerary
        function addMiscProduct() {
            var formData = {
                troNumber: $('#troNumber').val(),
                docId: $('#docId').val(),
                miscType: $('#miscType').val(),
                procCenter: $('#procCenter').val(),
                miscStartDate: $('#miscStartDate').val(),
                miscStartLoc: $('#miscStartLoc').val(),
                miscEndDate: $('#miscEndDate').val(),
                miscEndLoc: $('#miscEndLoc').val(),
                miscServiceClass: $('#miscServiceClass').val(),
                miscStatus: $('#miscStatus').val(),
                miscRemarks: $('#miscRemarks').val(),
            };

            $.ajax({
                url: '{{ route('sales-folder-misc.store') }}',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response.data);
                    alert(response.success);

                    //Save Sales Folder Group
                    saveSalesFolderGroup();

                    // Redirect to the specified route
                    var troNumber = $('#troNumber').val();
                    var redirectUrl = '{{ route("forms.tro.sf", ":troNumber") }}';
                    redirectUrl = redirectUrl.replace(':troNumber', troNumber);
                    window.location.href = redirectUrl;
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        console.log(response.data);
                        alert(value);
                    });
                }
            });
        }

        // Add Air Itinerary segment
        $('#addAirItinerary').click(function() {
            const data = {
                troNumber: $('#troNumber').val(),
                docId: $('#docId').val(),
                airline: $('#airline').val(),
                flightNumber: $('#flightNumber').val(),
                serviceClass: $('#serviceClass').val(),
                departureCity: $('#departureCity').val(),
                departureDate: $('#departureDate').val(),
                departureTime: $('#departureTime').val(),
                arrivalCity: $('#arrivalCity').val(),
                arrivalDate: $('#arrivalDate').val(),
                arrivalTime: $('#arrivalTime').val(),
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: '{{ route('sales-folder-air.tempdata.store') }}',
                type: 'POST',
                data: data,
                success: function(response) {
                    $('#successText').text(response.message);
                    $('#successMessage').show();
                    $('#errorMessage').hide();

                    // Update the table with the new data
                    const tableBody = $('#itineraryAir tbody');
                    tableBody.empty();
                    response.data.forEach(function(row) {
                        tableBody.append(`
                            <tr>
                                <td>${row.AL_CODE}</td>
                                <td>${row.FLIGHT_NUM}</td>
                                <td>${row.SERVICE_CLASS}</td>
                                <td>${row.DEPT_CITY}</td>
                                <td>${row.DEPT_DATE}</td>
                                <td>${row.DEPT_TIME}</td>
                                <td>${row.ARVL_CITY}</td>
                                <td>${row.ARVL_DATE}</td>
                                <td>${row.ARVL_TIME}</td>
                            </tr>
                        `);
                    });
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred';
                    $('#errorText').text(errorMessage);
                    $('#errorMessage').show();
                    $('#successMessage').hide();
                }
            });
        });

        //Add Temporary Passengers
        $('#addPax').click(function() {

            const data = {
                troNumber: $('#troNumber').val(),
                docId: $('#docId').val(),
                passengerName: $('#passengerName').val(),
                productCategory: $('#productCategory').val(),
                passengerTicketNumber: $('#passengerTicketNumber').val(),
                passengerPNR: $('#passengerPNR').val(),
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: '{{ route('sales-folder-pax.tempdata.store') }}',
                type: 'POST',
                data: data,
                success: function(response) {
                    $('#successText').text(response.message);
                    $('#successMessage').show();
                    $('#errorMessage').hide();

                    // Update the table with the new data
                    const tableBody = $('#passengerList tbody');
                    tableBody.empty();
                    response.data.forEach(function(row) {
                        tableBody.append(`
                            <tr>
                                <td>${row.PAX_NAME}</td>
                                <td>${row.TICKET_NO}</td>
                                <td>${row.PNR}</td>
                            </tr>
                        `);
                    });
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred';
                    $('#errorText').text(errorMessage);
                    $('#errorMessage').show();
                    $('#successMessage').hide();
                }
            });
        });

        // Save data from temp table to permanent table
        $('#createProduct').on('click', function() {
            saveSalesFolderGroup();
        });

        function saveSalesFolderGroup() {
            var formData = {
                troNumber: $('#troNumber').val(),
                docId: $('#docId').val(),
                productType: $('#productType').val(),
                productCategory: $('#productCategory').val(),
                airline: $('#airline').val(),
                route: $('#route').val(),
                salesUnitQuantity: $('#salesUnitQuantity').val(),
                salesTax: $('#salesTax').val(),
                salesCurrencyCode: $('#salesCurrencyCode').val(),
                salesCurrencyAmount: $('#salesCurrencyAmount').val(),
                salesUnitAmount: $('#salesUnitAmount').val(),
                salesDiscountAmount: $('#salesDiscountAmount').val(),
                salesDiscountRate: $('#salesDiscountRate').val(),
                salesCommissionAmount: $('#salesCommissionAmount').val(),
                salesCommissionRate: $('#salesCommissionRate').val(),
                salesSurcharge: $('#salesSurcharge').val(),
                salesTotalUnitAmount: $('#salesTotalUnitAmount').val(),
                salesGrandTotal: $('#salesGrandTotal').val(),
                costCommissionAmount: $('#costCommissionAmount').val(),
                costCommissionRate: $('#costCommissionRate').val(),
                costDiscountAmount: $('#costDiscountAmount').val(),
                costDiscountRate: $('#costDiscountRate').val(),
                costTax: $('#costTax').val(),
                costCurrencyCode: $('#costCurrencyCode').val(),
                costCurrencyAmount: $('#costCurrencyAmount').val(),
                costTotalUnitCost: $('#costTotalUnitCost').val(),
                costGrandTotal: $('#costGrandTotal').val(),
                longItineraryDesc: $('#longItineraryDesc').val(),
                generalRemarks: $('#generalRemarks').val(),
                airlineReference: $('#airlineReference').val(),
            };

            $.ajax({
                url: '{{ route('sales-folder-group.store') }}',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    alert('Product group saved successfully');

                    // Check the selected product category and call the corresponding function
                    var productCategory = $('#productCategory').val();

                    //Save temporary added passengers to SALES_FOLDER_PAX
                    transferPaxTempData();

                    if (productCategory === 'A') {
                        var productAdded = transferAirTempData();
                    } else if (productCategory === 'H') {
                        var productAdded = addHotelProduct();
                    } else if (productCategory === 'C') {
                        var productAdded = addCarTransferProduct();
                    } else if (productCategory === 'M') {
                        var productAdded = addMiscProduct();
                    }
                },
                error: function(response) {
                    //alert('Failed to save product group');
                }
            });
        }

        function transferAirTempData() {
            $.ajax({
                url: '{{ route('sales-folder-air.tempdata.transfer') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#successText').text(response.message);
                    $('#successMessage').show();
                    $('#errorMessage').hide();

                    //Save Sales Folder Group
                    saveSalesFolderGroup();

                    // Clear the temporary table data display
                    const tableBody = $('#itineraryAir tbody');
                    tableBody.empty();

                    // Redirect to the specified route
                    var troNumber = $('#troNumber').val();
                    var redirectUrl = '{{ route("forms.tro.sf", ":troNumber") }}';
                    redirectUrl = redirectUrl.replace(':troNumber', troNumber);
                    window.location.href = redirectUrl;
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred';
                    $('#errorText').text(errorMessage);
                    $('#errorMessage').show();
                    $('#successMessage').hide();
                }
            });
        }

        function transferPaxTempData() {
            $.ajax({
                url: '{{ route('sales-folder-pax.tempdata.transfer') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#successText').text(response.message);
                    $('#successMessage').show();
                    $('#errorMessage').hide();

                    // Clear the temporary table data display
                    const tableBody = $('#passengerList tbody');
                    tableBody.empty();
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred';
                    $('#errorText').text(errorMessage);
                    $('#errorMessage').show();
                    $('#successMessage').hide();
                }
            });
        }
    });
</script>

@endsection

