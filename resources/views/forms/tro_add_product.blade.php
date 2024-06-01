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

            <a href="{{ route('forms.tro.sf', ['troNumber' => $troNumber]) }}" class="btn marsman-btn-primary txt-1 mb-2">Back to Travel Exchange Order</a>

            <div class="card">
                <div class="card-header marsman-bg-color-secondary p-0">
                    <p class="h6 my-2 mx-2">{{ __('Travel Request Order Product Group - New') }}</p>
                </div>
                <div class="card-body bg-white">

                    <div class="form-group col-md-12 mx-1 my-1 d-flex justify-content-end">
                        <button type="button" id="submitForm" class="btn btn-primary txt-1">Save</button>
                        <button type="button" id="findTicket" class="btn btn-success txt-1 mx-1">Find Ticket</button>
                    </div>

                    <hr class="w-100">

                    <div class="row col-md-12 d-flex">
                        <div class="form-group col-md-6 mb-2">
                            <label for="productName" class="form-label txt-1 marsman-bg-color-label text-white p-2 m-0 rounded-top">Product Name</label>
                            <select id="productName" name="productName" class="form-control form-select txt-1" readonly>
                                <option value="">-- Choose Product --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->PROD_TYPE }}" data-category="{{ $product->PROD_CAT }}">{{ $product->PROD_DESCR }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3 mb-2">
                            <label for="category" class="form-label marsman-bg-color-label text-white p-2 m-0 rounded-top">Category</label>
                            <select id="category" name="category" class="form-control form-select txt-1">
                                <option value="" selected="selected">-- Choose Category --</option>
                                @foreach ($productCategories as $category)
                                    <option value="{{ $category->PROD_CAT }}">{{ $category->PROD_CAT_DESCR }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3 mb-2">
                            <label for="route" class="form-label marsman-bg-color-label text-white p-2 m-0 rounded-top">Route</label>
                            <select id="route" name="route" class="form-control form-select txt-1">
                                <option value="">-- Choose Route --</option>
                                @foreach ($routes as $route)
                                    <option value="{{ $route->ROUTE_CODE }}">{{ $route->ROUTE_DESCR }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Tabs -->
                    <ul class="nav nav-tabs mb-3 bg-white" id="myTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="sales-tab" data-bs-toggle="tab" data-bs-target="#sales" role="tab" aria-controls="sales" aria-selected="true">Sales / Cost</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link itinerary" id="itineraryHotel-tab" data-bs-toggle="tab" data-bs-target="#itineraryHotel" role="tab" aria-controls="itineraryHotel" aria-selected="false">Itinerary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link itinerary" id="itineraryMisc-tab" data-bs-toggle="tab" data-bs-target="#itineraryMisc" role="tab" aria-controls="itineraryMisc" aria-selected="false">Itinerary</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link itinerary" id="itineraryCar-tab" data-bs-toggle="tab" data-bs-target="#itineraryCar" role="tab" aria-controls="itineraryCar" aria-selected="false">Itinerary</a>
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
                                                    <label for="currencyCode" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Code</label>
                                                    <input type="text" class="form-control txt-1" id="currencyCode" name="currencyCode">
                                                </div>
                                                <div class="form-group col-md-8 mx-2">
                                                    <label for="currencyAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Amount</label>
                                                    <input type="text" class="form-control txt-1" id="currencyAmount" name="currencyAmount">
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
                                                    <label for="unitAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Unit Amount</label>
                                                    <input type="text" class="form-control txt-1" id="unitAmount" name="unitAmount" value="0">
                                                </div>
                                                <div class="form-group col-md-4 mx-2">
                                                    <label for="unitQuantity" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Quantity</label>
                                                    <input type="number" class="form-control txt-1" id="unitQuantity" name="unitQuantity" value="0">
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
                                                    <label for="discountRate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Rate</label>
                                                    <input type="number" class="form-control txt-1" id="discountRate" name="discountRate" value="0">
                                                </div>
                                                <div class="form-group col-md-4 mx-2">
                                                    <label for="discountAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Amount</label>
                                                    <input type="number" class="form-control txt-1" id="discountAmount" name="discountAmount" value="0">
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
                                                    <label for="commissionRate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Rate</label>
                                                    <input type="number" class="form-control txt-1" id="commissionRate" name="commissionRate" value="0">
                                                </div>
                                                <div class="form-group col-md-4 mx-2">
                                                    <label for="commissionAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Amount</label>
                                                    <input type="number" class="form-control txt-1" id="commissionAmount" name="commissionAmount" value="0">
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
                                                    <label for="taxes" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Taxes</label>
                                                    <input type="number" class="form-control txt-1 p-2" id="taxes" name="taxes" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-12 mt-2">
                                                <div class="form-group">
                                                    <label for="surcharge" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Surcharge</label>
                                                    <input type="text" class="form-control txt-1 p-2" id="surcharge" name="surcharge" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-12 d-flex mt-2">
                                                <div class="form-group col-md-6">
                                                    <label for="totalUnitAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Total Unit Amount</label>
                                                    <input type="text" class="form-control txt-1 p-2" id="totalUnitAmount" name="totalUnitAmount" value="0">
                                                </div>
                                                <div class="form-group col-md-6 mx-2">
                                                    <label for="totalIncome" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Total Income</label>
                                                    <input type="text" class="form-control txt-1 p-2" id="totalIncome" name="totalIncome" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-12 d-flex mt-2">
                                                <div class="form-group col-md-6">
                                                    <label for="grandTotal" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Grand Total</label>
                                                    <input type="text" class="form-control txt-1 p-2" id="grandTotal" name="grandTotal" value="0">
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
                                                    <label for="costCurrencyCode" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Code</label>
                                                    <input type="text" class="form-control txt-1" id="costCurrencyCode" name="costCurrencyCode">
                                                </div>
                                                <div class="form-group col-md-8 mx-2">
                                                    <label for="costCurrencyAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Amount</label>
                                                    <input type="text" class="form-control txt-1" id="costCurrencyAmount" name="costCurrencyAmount">
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
                                                    <input type="text" class="form-control txt-1" id="costDiscountRate" name="costDiscountRate">
                                                </div>
                                                <div class="form-group col-md-6 mb-2 mx-2">
                                                    <label for="costDiscountAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Amount</label>
                                                    <input type="text" class="form-control txt-1" id="costDiscountAmount" name="costDiscountAmount">
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
                                                    <input type="text" class="form-control txt-1" id="costCommissionRate" name="costCommissionRate">
                                                </div>
                                                <div class="form-group col-md-6 mb-2 mx-2">
                                                    <label for="costCommissionAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Amount</label>
                                                    <input type="text" class="form-control txt-1" id="costCommissionAmount" name="costCommissionAmount">
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
                                                    <label for="costTaxes" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Taxes</label>
                                                    <input type="text" class="form-control txt-1" id="costTaxes" name="costTaxes">
                                                </div>
                                            </div>
                                            <div class="form-group d-flex mb-2">
                                                <div class="form-group col-md-6 mb-2">
                                                    <label for="costTotalUnitCost" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Total Unit Cost</label>
                                                    <input type="text" class="form-control txt-1" id="costTotalUnitCost" name="costTotalUnitCost">
                                                </div>
                                                <div class="form-group col-md-4 mb-2 mx-2">
                                                    <label for="costUnitQuantity" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Quantity.</label>
                                                    <input type="number" class="form-control txt-1" id="costUnitQuantity" name="costUnitQuantity" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="costGrandTotal" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Grand Total</label>
                                                    <input type="text" class="form-control txt-1" id="costGrandTotal" name="costGrandTotal">
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

                        <!-- Tab 3 :: Itinerary HOTEL -->
                        <div class="tab-pane fade show" id="itineraryHotel" role="tabpanel" aria-labelledby="itineraryHotel-tab">
                            <p class="h3">HOTEL</p>
                            <div class="row col-md-12 d-flex mt-2">

                                <input type="hidden" id="troNumber" name="troNumber" value="{{ $troNumber }}">

                                <!-- Column 1 -->
                                <div class="form-group col-md-6 mb-1">
                                    <div class="card">
                                        <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('ACCOMODATION') }}</p>
                                        </div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="col-md-12">
                                                <div class="form-group mb-2">
                                                    <label for="hotelCode" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Hotel</label>
                                                    <select class="form-control form-select txt-1" id="hotelCode" name="hotelCode">
                                                        <option value="" selected="selected">-- Choose Hotel --</option>
                                                        @foreach ($hotels as $hotel)
                                                            <option value="{{ $hotel->HOTEL_CODE }}">{{ $hotel->HOTEL_DESCR }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <div class="form-group col-md-6 mx-1 my-1">
                                                        <label for="checkInDate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Check-in Date</label>
                                                        <input type="date" class="form-control txt-1" id="checkInDate" name="checkInDate">
                                                    </div>
                                                    <div class="form-group col-md-4 mx-1 my-1">
                                                        <label for="hotelNights" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Number of Nights</label>
                                                        <input type="number" class="form-control txt-1" id="hotelNights" name="hotelNights" value="0" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <div class="form-group col-md-6 mx-1 my-1">
                                                        <label for="checkOutDate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Check-in Date</label>
                                                        <input type="date" class="form-control txt-1" id="checkOutDate" name="checkOutDate">
                                                    </div>
                                                    <div class="form-group col-md-4 mx-1 my-1">
                                                        <label for="roomQuantity" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Room Quantity</label>
                                                        <input type="number" class="form-control txt-1" id="roomQuantity" name="roomQuantity" value="0">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <div class="form-group col-md-8 mx-1 my-1">
                                                        <label for="roomType" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Room Type</label>
                                                        <input type="checkbox" class="mx-1" value="isVip"> VIP
                                                        <select class="form-control form-select txt-1" id="roomType" name="roomType">
                                                            @foreach ($roomTypes as $roomType)
                                                                <option value="{{ $roomType->ROOM_CODE }}">{{ $roomType->ROOM_DESCR }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <div class="form-group col-md-8 mx-1 my-1">
                                                        <label for="roomCategory" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Room Category</label>
                                                        <select class="form-control form-select txt-1" id="roomCategory" name="roomCategory">
                                                            @foreach ($roomCategories as $roomCategory)
                                                                <option value="{{ $roomCategory->ROOM_CAT }}">{{ $roomCategory->ROOM_DESCR }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <div class="form-group col-md-8 mx-1 my-1">
                                                        <label for="bookStatus" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Status</label>
                                                        <select class="form-control form-select txt-1" id="bookStatus" name="bookStatus">
                                                            @foreach ($bookStatus as $status)
                                                                <option value="{{ $status->BK_CODE }}">{{  $status->BK_DESCR }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- Column 2 -->
                                <div class="form-group col-md-6">
                                    <div class="card">
                                        <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('MEALS') }}</p>
                                        </div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="form-group col-md-12 mx-1 my-1">
                                                <label for="hotelBreakfast" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Breakfast</label>
                                                <select class="form-control form-select txt-1" id="hotelBreakfast" name="hotelBreakfast">
                                                    <option value="" selected="selected">-- Choose Breakfast--</option>
                                                    @foreach ($meals as $meal)
                                                        <option value="{{ $meal->MEAL_CODE }}">{{ $meal->MEAL_DESCR }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 mx-1 my-1">
                                                <label for="hotelLunch" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Lunch</label>
                                                <select class="form-control form-select txt-1" id="hotelLunch" name="hotelLunch">
                                                    <option value="" selected="selected">-- Choose Lunch --</option>
                                                    @foreach ($meals as $meal)
                                                        <option value="{{ $meal->MEAL_CODE }}">{{ $meal->MEAL_DESCR }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 mx-1 my-1">
                                                <label for="hotelDinner" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Dinner</label>
                                                <select class="form-control form-select txt-1" id="hotelDinner" name="hotelDinner">
                                                    <option value="" selected="selected">-- Choose Dinner --</option>
                                                    @foreach ($meals as $meal)
                                                        <option value="{{ $meal->MEAL_CODE }}">{{ $meal->MEAL_DESCR }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <div class="card">
                                    <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                        <p class="mx-2 my-2">{{ __('OTHER REFERENCE') }}</p>
                                    </div>
                                    <div class="card-body marsman-bg-color-gray1">
                                        <div class="col-md-12 d-flex">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="confNo" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Confirmation Number</label>
                                                    <input type="text" class="form-control txt-1" id="confNo" name="confNo">
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="paxRefNo" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Passenger Reference Number</label>
                                                    <input type="text" class="form-control txt-1" id="paxRefNo" name="paxRefNo">
                                                </div>
                                                <div class="form-group col-md-2 mt-2">
                                                    <label for="numberOfGuest" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Number of Guest</label>
                                                    <input type="number" class="form-control txt-1" id="numberOfGuest" name="numberOfGuest" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mx-2">
                                                <div class="form-group">
                                                    <label for="otherServices" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Other Services</label>
                                                    <input type="text" class="form-control txt-1" id="otherServices" name="otherServices">
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="hotelRemarks" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Remarks</label>
                                                    <textarea class="form-control txt-1" id="hotelRemarks" name="hotelRemarks" rows="5"></textarea>
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
                                                <select class="form-control form-select txt-1" id="miscType" name="miscType">
                                                    <option></option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="additionalDescription" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Additional Description</label>
                                                <input type="text" id="additionalDescription" name="additionalDescription" class="form-control txt-1">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="serviceClass" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Service Class</label>
                                                <select class="form-control form-select txt-1" id="serviceClass" name="serviceClass">
                                                    <option></option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscStatus" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Status</label>
                                                <select class="form-control form-select txt-1" id="miscStatus" name="miscStatus">
                                                    <option></option>
                                                </select>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscStartDate" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">*Start Date</label>
                                                <input type="date" id="miscStartDate" name="miscStartDate" class="form-control txt-1">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscStartLoc" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Start Location</label>
                                                <input type="text" id="miscStartLoc" name="miscStartLoc" class="form-control txt-1">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscEndDate" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">*End Date</label>
                                                <input type="date" id="miscEndDate" name="miscEndDate" class="form-control txt-1">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscEndLoc" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">End Location</label>
                                                <input type="text" id="miscEndLoc" name="miscEndLoc" class="form-control txt-1">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscRemarks" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Remarks</label>
                                                <textarea id="miscRemarks" name="miscRemarks" rows="4" class="form-control txt-1"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mx-2">
                                                <label for="procCenter" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Proc. Center</label>
                                                <select class="form-control form-select txt-1" id="procCenter" name="procCenter">
                                                    <option></option>
                                                </select>
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
                                                <input type="text" class="form-control form-select txt-1" id="miscConfNo" name="miscConfNo">
                                            </div>
                                            <div class="form-group mx-2 mt-2">
                                                <label for="miscPaxRefNo" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Passenger Reference Number</label>
                                                <input type="text" class="form-control form-select txt-1" id="miscPaxRefNo" name="miscPaxRefNo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tab 3 :: Itinerary CAR / TRANSFER -->
                        <div class="tab-pane fade show" id="itineraryCar" role="tabpanel" aria-labelledby="itineraryCar-tab">
                            <p class="h3">CAR / TRANSFER</p>

                            <div class="card">
                                <div class="card-header m-0 p-0">
                                </div>
                                <div class="card-body">
                                    <div class="col-md-12 d-flex">
                                        <!-- Column 1 -->
                                        <div class="col-md-6 p-1">

                                            <div class="card">
                                                <div class="card-header m-0 p-0">
                                                    <p class="mx-2 my-2">{{ __('CAR DETAILS') }}</p>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="carProvider" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Provider</label>
                                                        <select class="form-control form-select txt-1" id="carProvider" name="carProvider">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="carType" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">*Type</label>
                                                        <select class="form-control form-select txt-1" id="carType" name="carType">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="carCategory" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Category</label>
                                                        <select class="form-control form-select txt-1" id="carCategory" name="carCategory">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="carStatus" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">*Status</label>
                                                        <select class="form-control form-select txt-1" id="carStatus" name="carStatus">
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card mt-2">
                                                <div class="card-header m-0 p-0">
                                                    <p class="mx-2 my-2">{{ __('*PICK-UP') }}</p>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="pickUpDate" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Date</label>
                                                        <input type="date" class="form-control form-select txt-1" id="pickUpDate" name="pickUpDate">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="pickUpLocation" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Location</label>
                                                        <input type="text" class="form-control txt-1" id="pickUpLocation" name="pickUpLocation">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card mt-2">
                                                <div class="card-header m-0 p-0">
                                                    <p class="mx-2 my-2">{{ __('*DROP-OFF') }}</p>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="dropoffDate" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Date</label>
                                                        <input type="date" class="form-control form-select txt-1" id="dropoffDate" name="dropoffDate">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="dropoffLocation" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Location</label>
                                                        <input type="text" class="form-control txt-1" id="dropoffLocation" name="dropoffLocation">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Column 2 -->
                                        <div class="col-md-6 p-1">

                                            <div class="card">
                                                <div class="card-header m-0 p-0">
                                                    <p class="mx-2 my-2">{{ __('PICK-UP REFERENCE') }}</p>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-6">
                                                            <label for="carCity" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Location</label>
                                                            <input type="text" class="form-control txt-1" id="carCity" name="carCity">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="carArrival" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Arrival</label>
                                                            <input type="text" class="form-control txt-1" id="carArrival" name="carArrival">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="flightNumber" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Flight Number</label>
                                                            <input type="text" class="form-control txt-1" id="flightNumber" name="flightNumber">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="specialRequest" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Special Request</label>
                                                            <input type="text" class="form-control txt-1" id="specialRequest" name="specialRequest">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="pickupPhoneNumber" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Phone Number</label>
                                                            <input type="text" class="form-control txt-1" id="pickupPhoneNumber" name="pickupPhoneNumber">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="pickupPaxRefNumber" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Passenger Reference Number</label>
                                                            <input type="text" class="form-control txt-1" id="pickupPaxRefNumber" name="pickupPaxRefNumber">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="pickupConfirmationNumber" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Confirmation Number</label>
                                                            <input type="text" class="form-control txt-1" id="pickupConfirmationNumber" name="pickupConfirmationNumber">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card mt-2">
                                                <div class="card-header m-0 p-0">
                                                    <p class="mx-2 my-2">{{ __('STOP OVER') }}</p>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <label for="stopoverFirst" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">First</label>
                                                        <input type="text" class="form-control txt-1" id="pickupConfirmationNumber" name="pickupConfirmationNumber">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="stopoverSecond" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Second</label>
                                                        <input type="text" class="form-control txt-1" id="stopoverSecond" name="stopoverSecond">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="stopoverThird" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Third</label>
                                                        <input type="text" class="form-control txt-1" id="stopoverThird" name="stopoverThird">
                                                    </div>
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

                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead class="marsman-bg-color-darkgray text-white">
                                        <tr>
                                            <th colspan="3"></th>
                                            <th colspan="3" class="text-center">Departure</th>
                                            <th colspan="3" class="text-center">Arrival</th>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
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
        const productNameSelect = document.getElementById('productName');
        const categorySelect = document.getElementById('category');
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

        document.getElementById('productName').addEventListener('change', function() {
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

        //HOTEL Form1
        $('#submitForm').on('click', function() {
            var formData = {
                troNumber: $('#troNumber').val(),
                hotelCode: $('#hotelCode').val(),
                checkInDate: $('#checkInDate').val(),
                checkOutDate: $('#checkOutDate').val(),
                roomType: $('#roomType').val(),
                roomCategory: $('#roomCategory').val(),
                bookStatus: $('#bookStatus').val(),
                numberOfGuest: $('#numberOfGuest').val(),
                roomQuantity: $('#roomQuantity').val(),
                isVip: $('#isVip').is(':checked') ? 1 : 0,
                hotelBreakfast: $('#hotelBreakfast').val(),
                hotelLunch: $('#hotelLunch').val(),
                hotelDinner: $('#hotelDinner').val(),
                otherServices: $('#otherServices').val(),
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
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    $.each(errors, function(key, value) {
                        console.log(response.data);
                        alert(value);
                    });
                }
            });
        });
    });
</script>

@endsection

