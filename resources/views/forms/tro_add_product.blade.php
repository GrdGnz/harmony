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

                    <div class="form-group col-md-12 mx-1 my-1 d-flex justify-content-end">
                        <button type="button" id="createProduct" class="btn btn-primary txt-1">Save</button>
                        <a href="{{ route('searchTicket.tro', ['troNumber' => $troNumber, 'docId' => $docId]) }}" id="findTicket" class="btn btn-success txt-1 mx-1">Find Ticket</a>
                    </div>

                    <hr class="w-100">

                    <div class="row col-md-12 d-flex">

                        <div class="form-group col-md-6 mb-2">
                            <label for="productType" class="form-label txt-1 marsman-bg-color-label text-white p-2 m-0 rounded-top">Product Name</label>
                            @if (isset($ticketInventory->type->PROD_DESCR))
                                <input type="text" id="showProduct" name="showProduct" class="form-control form-select txt-1" value="{{ $ticketInventory->type->PROD_DESCR }}" readonly>
                                <input type="hidden" id="productType" name="productType" value="{{ $ticketInventory->PROD_TYPE }}">
                            @else
                                <select id="productType" name="productType" class="form-control form-select txt-1" readonly>
                                    <option value="">-- Choose Product --</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->PROD_TYPE }}" data-category="{{ $product->PROD_CAT }}" data-route="{{ $product->ROUTE }}">{{ $product->PROD_DESCR }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                        <div class="form-group col-md-3 mb-2">
                            <label for="productCategory" class="form-label txt-1 marsman-bg-color-label text-white p-2 m-0 rounded-top">Product Category</label>

                            @if (isset($ticketInventory->category->PROD_CAT_DESCR))
                                <input type="text" id="showCategory" name="showCategory" class="form-control form-select txt-1" value="{{ $ticketInventory->category->PROD_CAT_DESCR }}" readonly>
                                <input type="hidden" id="productCategory" name="productCategory" value="{{ $ticketInventory->PROD_CAT }}">

                            @else

                                <input type="text" class="form-control txt-1" id="showCategory" value="" readonly>
                                <input type="hidden" id="productCategory" name="productCategory" value="">

                            @endif
                        </div>
                        <div class="form-group col-md-3 mb-2">
                            <label for="route" class="form-label txt-1 marsman-bg-color-label text-white p-2 m-0 rounded-top">Route</label>
                            @if (isset($ticketInventory->route->ROUTE_DESCR))
                                <input type="text" id="showRoute" name="showRoute" class="form-control form-select txt-1" value="{{ $ticketInventory->route->ROUTE_DESCR }}" readonly>
                                <input type="hidden" id="route" name="route" value="{{ $ticketInventory->ROUTE_TYPE }}">

                            @else

                                <input type="text" class="form-control txt-1" id="showRoute" value="" readonly>
                                <input type="hidden" id="route" name="route" value="">

                            @endif

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
                                    <div class="d-flex">
                                        <div class="card mt-2 col-md-6">
                                            <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                                <p class="mx-2 my-2">{{ __('DISCOUNT') }}</p>
                                            </div>
                                            <div class="card-body marsman-bg-color-gray1">
                                                <div class="col-md-12 d-flex">
                                                    <div class="form-group col-md-6 mx-2">
                                                        <label for="salesDiscountRate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Rate</label>
                                                        <input type="text" class="form-control txt-1" id="salesDiscountRate" name="salesDiscountRate" value="0">
                                                    </div>
                                                    <div class="form-group col-md-4 mx-2">
                                                        <label for="salesDiscountAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Amount</label>
                                                        <input type="text" class="form-control txt-1" id="salesDiscountAmount" name="salesDiscountAmount" value="0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Commission -->
                                        <div class="card mt-2 col-md-6">
                                            <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                                <p class="mx-2 my-2">{{ __('COMMISSION') }}</p>
                                            </div>
                                            <div class="card-body marsman-bg-color-gray1">
                                                <div class="col-md-12 d-flex">
                                                    <div class="form-group col-md-6 mx-2">
                                                        <label for="salesCommissionRate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Rate</label>
                                                        <input type="text" class="form-control txt-1" id="salesCommissionRate" name="salesCommissionRate" value="0">
                                                    </div>
                                                    <div class="form-group col-md-4 mx-2">
                                                        <label for="salesCommissionAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Amount</label>
                                                        <input type="text" class="form-control txt-1" id="salesCommissionAmount" name="salesCommissionAmount" value="0">
                                                    </div>
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
                                            </div>
                                            <div class="col-md-12 d-flex">
                                                <div class="form-group col-md-6 p-1">
                                                    <label for="salesTax" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Taxes</label>
                                                    <input type="number" class="form-control txt-1 p-2" id="salesTax" name="salesTax" value="0">
                                                </div>
                                                <div class="form-group col-md-6 p-1">
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
                                                    @if (isset($ticketInventory->COST_CURR_CODE))
                                                        <input type="text" class="form-control txt-1" id="costCurrencyCode" name="costCurrencyCode" value="{{ $ticketInventory->COST_CURR_CODE }}">
                                                    @else
                                                        <input type="text" class="form-control txt-1" id="costCurrencyCode" name="costCurrencyCode" value="PHP">
                                                    @endif

                                                </div>
                                                <div class="form-group col-md-8 mx-2">
                                                    <label for="costCurrencyAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Amount</label>
                                                    @if (isset($ticketInventory->COST_CURR_RATE))
                                                        <input type="text" class="form-control txt-1" id="costCurrencyAmount" name="costCurrencyAmount" value="{{ $ticketInventory->COST_CURR_RATE }}">
                                                    @else
                                                        <input type="text" class="form-control txt-1" id="costCurrencyAmount" name="costCurrencyAmount" value="0">
                                                    @endif
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
                                                        <label for="costUnitAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Unit Amount</label>
                                                        @if (isset($ticketInventory->PUBLISH_AMOUNT))
                                                            <input type="text" class="form-control txt-1" id="costUnitAmount" name="costUnitAmount" value="{{ number_format($ticketInventory->PUBLISH_AMOUNT, 2, '.', ',') }}">
                                                        @else
                                                            <input type="text" class="form-control txt-1" id="costUnitAmount" name="costUnitAmount" value="0">
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-4 mx-2">
                                                        <label for="costUnitQuantity" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Quantity</label>
                                                        @if (isset($paxCount))
                                                            <input type="text" class="form-control txt-1" id="costUnitQuantity" name="costUnitQuantity" value="{{ $paxCount }}">
                                                        @else
                                                            <input type="number" class="form-control txt-1" id="costUnitQuantity" name="costUnitQuantity" value="0">
                                                        @endif
                                                    </div>
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
                                            <div class="col-md-12 d-flex">
                                                <div class="col-md-4 p-1">
                                                    <label for="splFareCode" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Special Fare Code</label>
                                                    <input type="text" class="form-control txt-1" id="splFareCode" name="splFareCode">
                                                </div>
                                                <div class="col-md-4 p-1">
                                                    <label for="costPublishedRate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Published Rate</label>
                                                    @if (isset($ticketInventory->ANET_AMOUNT))
                                                        <input type="text" class="form-control txt-1" id="costPublishedRate" name="costPublishedRate" value="{{ number_format($ticketInventory->ANET_AMOUNT, 2, '.', ',') }}">
                                                    @else
                                                        <input type="text" class="form-control txt-1" id="costPublishedRate" name="costPublishedRate">
                                                    @endif

                                                </div>
                                                <div class="col-md-4 p-1">
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
                                            <div class="col-md-12 d-flex">
                                                <div class="form-group col-md-6 p-1">
                                                    <label for="nonAirPublishedRate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Published Rate</label>
                                                    @if (isset($ticketInventory->ONET_AMOUNT))
                                                        <input type="text" class="form-control txt-1" id="nonAirPublishedRate" name="nonAirPublishedRate" value="{{ number_format($ticketInventory->ONET_AMOUNT, 2, '.', ',') }}">
                                                    @else
                                                        <input type="text" class="form-control txt-1" id="nonAirPublishedRate" name="nonAirPublishedRate">
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-6 p-1">
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

                                    <div class="d-flex">
                                        <div class="card mt-2 col-md-6">
                                            <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                                <p class="mx-2 my-2">{{ __('DISCOUNT') }}</p>
                                            </div>
                                            <!-- Discount -->
                                            <div class="card-body marsman-bg-color-gray1">
                                                <div class="col-md-12 d-flex">
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="costDiscountRate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Rate</label>
                                                        @if (isset($ticketInventory->COST_DISC_PERC))
                                                            <input type="text" class="form-control txt-1" id="costDiscountRate" name="costDiscountRate" value="{{ $ticketInventory->COST_DISC_PERC }}">
                                                        @else
                                                            <input type="text" class="form-control txt-1" id="costDiscountRate" name="costDiscountRate" value="0">
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2 mx-2">
                                                        <label for="costDiscountAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Amount</label>
                                                        @if (isset($ticketInventory->COST_DISC_AMOUNT))
                                                            <input type="text" class="form-control txt-1" id="costDiscountAmount" name="costDiscountAmount" value="{{ number_format($ticketInventory->COST_DISC_AMOUNT, 2, '.', ',') }}">
                                                        @else
                                                            <input type="text" class="form-control txt-1" id="costDiscountAmount" name="costDiscountAmount" value="0">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mt-2 col-md-6">
                                            <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                                <p class="mx-2 my-2">{{ __('COMMISSION') }}</p>
                                            </div>
                                            <!-- Commission -->
                                            <div class="card-body marsman-bg-color-gray1">
                                                <div class="col-md-12 d-flex">
                                                    <div class="form-group col-md-6 mb-2">
                                                        <label for="costCommissionRate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Rate</label>
                                                        @if (isset($ticketInventory->COST_COMM_PERC))
                                                            <input type="text" class="form-control txt-1" id="costCommissionRate" name="costCommissionRate" value="{{ $ticketInventory->COST_COMM_PERC }}">
                                                        @else
                                                            <input type="text" class="form-control txt-1" id="costCommissionRate" name="costCommissionRate" value="0">
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-6 mb-2 mx-2">
                                                        <label for="costCommissionAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Amount</label>
                                                        @if (isset($ticketInventory->COST_COMM_AMOUNT))
                                                            <input type="text" class="form-control txt-1" id="costCommissionAmount" name="costCommissionAmount" value="{{ number_format($ticketInventory->COST_COMM_AMOUNT, 2, '.', ',') }}">
                                                        @else
                                                            <input type="text" class="form-control txt-1" id="costCommissionAmount" name="costCommissionAmount" value="0">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <!-- Insurance -->
                                    <div class="card mt-2">
                                        <div class="card-header m-0 p-0">
                                        </div>
                                        <!-- Insurance -->
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="row col-md-12 d-flex">
                                                <div class="col-md-4 mb-2 p-1">
                                                    <label for="costInsurance" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Insurance</label>
                                                    @if (isset($ticketInventory->COST_INS_AMOUNT))
                                                        <input type="text" class="form-control txt-1" id="costInsurance" name="costInsurance" value="{{ number_format($ticketInventory->COST_INS_AMOUNT, 2, '.', ',') }}">
                                                    @else
                                                        <input type="text" class="form-control txt-1" id="costInsurance" name="costInsurance" value="0">
                                                    @endif
                                                </div>
                                                <div class="col-md-2 mb-2 p-1">
                                                    <label for="costTax" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Taxes</label>
                                                    @if (isset($ticketInventory->COST_TAX_AMOUNT))
                                                        <input type="text" class="form-control txt-1" id="costTax" name="costTax" value="{{ number_format($ticketInventory->COST_TAX_AMOUNT, 2, '.', ',') }}">
                                                    @else
                                                        <input type="text" class="form-control txt-1" id="costTax" name="costTax" value="0">
                                                    @endif
                                                </div>
                                                <div class="col-md-2 mb-2 p-1">
                                                    <label for="costTotalUnitCost" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Total Unit Cost</label>
                                                    @if (isset($ticketInventory->PUBLISH_AMOUNT))
                                                        <input type="text" class="form-control txt-1" id="costTotalUnitCost" name="costTotalUnitCost" value="{{ number_format($ticketInventory->PUBLISH_AMOUNT, 2, '.', ',') }}">
                                                    @else
                                                        <input type="text" class="form-control txt-1" id="costTotalUnitCost" name="costTotalUnitCost" value="0">
                                                    @endif
                                                </div>
                                                <div class="col-md-2 mb-2 p-1">
                                                    <label for="costUnitQuantity" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Quantity</label>
                                                    @if (isset($paxCount))
                                                        <input type="text" class="form-control txt-1" id="costUnitQuantity" name="costUnitQuantity" value="{{ $paxCount }}">
                                                    @else
                                                        <input type="number" class="form-control txt-1" id="costUnitQuantity" name="costUnitQuantity" value="0">
                                                    @endif
                                                </div>
                                                <div class="col-md-2 mb-2 p-1">
                                                    <label for="costGrandTotal" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Grand Total</label>
                                                    @if (isset($ticketInventory->PUBLISH_AMOUNT) && isset($paxCount))
                                                        <input type="text" class="form-control txt-1" id="costGrandTotal" name="costGrandTotal" value="{{ number_format(($ticketInventory->PUBLISH_AMOUNT + $ticketInventory->COST_TAX_AMOUNT + $ticketInventory->COST_INS_AMOUNT) * $paxCount, 2, '.', ',') }}">
                                                    @else
                                                        <input type="text" class="form-control txt-1" id="costGrandTotal" name="costGrandTotal" value="0">
                                                    @endif
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
                                            <div class="col-md-12 d-flex">
                                                <div class="col-md-4 mb-2 p-1">
                                                    <label for="tourCode" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Tour Code</label>
                                                    <input type="text" class="form-control txt-1" id="tourCode" name="tourCode">
                                                </div>
                                                <div class="col-md-4 mb-2 p-1">
                                                    <label for="mpdMco" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">MPD / MCO</label>
                                                    <input type="text" class="form-control txt-1" id="mpdMco" name="mpdMco">
                                                </div>
                                                <div class="col-md-4 mb-2 p-1">
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
                                                    <input type="text" list="listHotels" id="hotelCode" name="hotelCode" class="form-control txt-1">
                                                    <datalist id="listHotels">
                                                        @foreach ($hotels as $hotel)
                                                            <option value="{{ $hotel->HOTEL_CODE }}">{{ $hotel->HOTEL_DESCR }}</option>
                                                        @endforeach
                                                    </datalist>
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
                                                        <input type="text" list="listRoomTypes" id="roomType" name="roomType" class="form-control txt-1">
                                                        <datalist id="listRoomTypes">
                                                            @foreach ($roomTypes as $roomType)
                                                                <option value="{{ $roomType->ROOM_CODE }}">{{ $roomType->ROOM_DESCR }}</option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <div class="form-group col-md-8 mx-1 my-1">
                                                        <label for="roomCategory" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Room Category</label>
                                                        <input type="text" list="listRoomCategories" id="roomCategory" name="roomCategory" class="form-control txt-1">
                                                        <datalist id="listRoomCategories">
                                                            @foreach ($roomCategories as $roomCategory)
                                                                <option value="{{ $roomCategory->ROOM_CAT }}">{{ $roomCategory->ROOM_DESCR }}</option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <div class="form-group col-md-8 mx-1 my-1">
                                                        <label for="hotelBookingStatus" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Status</label>
                                                        <input type="text" list="listBookingStatus" id="hotelBookingStatus" name="hotelBookingStatus" class="form-control txt-1">
                                                        <datalist id="listBookingStatus">
                                                            @foreach ($bookStatus as $status)
                                                                <option value="{{ $status->BK_CODE }}">{{  $status->BK_DESCR }}</option>
                                                            @endforeach
                                                        </datalist>
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
                                                <input type="text" list="listMeals" id="hotelBreakfast" name="hotelBreakfast" class="form-control txt-1">
                                                <datalist id="listMeals">
                                                    @foreach ($meals as $meal)
                                                        <option value="{{ $meal->MEAL_CODE }}">{{ $meal->MEAL_DESCR }}</option>
                                                    @endforeach
                                                </datalist>
                                            </div>
                                            <div class="form-group col-md-12 mx-1 my-1">
                                                <label for="hotelLunch" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Lunch</label>
                                                <input type="text" list="listMeals" id="hotelLunch" name="hotelLunch" class="form-control txt-1">
                                            </div>
                                            <div class="form-group col-md-12 mx-1 my-1">
                                                <label for="hotelDinner" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Dinner</label>
                                                <input type="text" list="listMeals" id="hotelDinner" name="hotelDinner" class="form-control txt-1">
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
                                                    <label for="hotelConfNo" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Confirmation Number</label>
                                                    <input type="text" class="form-control txt-1" id="hotelConfNo" name="hotelConfNo">
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="hotelPaxRefNo" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Passenger Reference Number</label>
                                                    <input type="text" class="form-control txt-1" id="hotelPaxRefNo" name="hotelPaxRefNo">
                                                </div>
                                                <div class="form-group col-md-2 mt-2">
                                                    <label for="hotelGuests" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Number of Guest</label>
                                                    <input type="number" class="form-control txt-1" id="hotelGuests" name="hotelGuests" value="0">
                                                </div>
                                            </div>
                                            <div class="col-md-6 mx-2">
                                                <div class="form-group">
                                                    <label for="hotelOtherServices" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Other Services</label>
                                                    <input type="text" class="form-control txt-1" id="hotelOtherServices" name="hotelOtherServices">
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
                                                    <option value="" selected>-- Select Type --</option>
                                                    @if(isset($miscRates))
                                                        @foreach ($miscRates as $type)
                                                            <option value="{{ $type->MISC_CODE }}">{{ $type->MISC_DESCR }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="additionalDescription" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Additional Description</label>
                                                <input type="text" id="additionalDescription" name="additionalDescription" class="form-control txt-1">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscServiceClass" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Service Class</label>
                                                <select class="form-control form-select txt-1" id="miscServiceClass" name="miscServiceClass">
                                                    <option value="" selected>-- Select Service Class --</option>
                                                    @if(isset($serviceClasses))
                                                        @foreach ($serviceClasses as $service)
                                                            <option value="{{ $service->SRVC_CLASS }}">{{ $service->SRVC_DESCR }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscStatus" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Status</label>
                                                <select class="form-control form-select txt-1" id="miscStatus" name="miscStatus">
                                                    <option value="" selected>-- Select Status --</option>
                                                    @if(isset($bookStatus))
                                                        @foreach ($bookStatus as $status)
                                                            <option value="{{ $status->BK_CODE }}">{{ $status->BK_DESCR }}</option>
                                                        @endforeach
                                                    @endif
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
                                                    <option value="" selected>-- Select Processing Center --</option>
                                                    @if(isset($processingCenters))
                                                        @foreach ($processingCenters as $proc)
                                                            <option value="{{ $proc->PROC_CODE }}">{{ $proc->PROC_DESCR }}</option>
                                                        @endforeach
                                                    @endif
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
                                                <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                                    <p class="mx-2 my-2">{{ __('CAR DETAILS') }}</p>
                                                </div>
                                                <div class="card-body marsman-bg-color-gray1">
                                                    <div class="form-group">
                                                        <label for="carProvider" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Provider</label>
                                                        <input type="text" list="listProviders" id="carProvider" name="carProvider" class="form-control txt-1">
                                                        <datalist id="listProviders">
                                                            @if (isset($carSupplier))
                                                                @foreach ($carSupplier as $supplier)
                                                                    <option value="{{ $supplier->SUPP_ID }}">{{ $supplier->SUPP_NAME }}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="carType" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Type</label>
                                                        <input type="text" list="listCarTypes" id="carType" name="carType" class="form-control txt-1">
                                                        <datalist id="listCarTypes">
                                                            <option value="" selected>-- Select Type --</option>
                                                            @if(isset($carTypes))
                                                                @foreach ($carTypes as $type)
                                                                    <option value="{{ $type->CAR_CODE }}">{{ $type->CAR_DESCR }}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="carCategory" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Category</label>
                                                        <input type="text" list="listCarCategories" id="carCategory" name="carCategory" class="form-control txt-1">
                                                        <datalist id="listCarCategories">
                                                            @if(isset($carCategories))
                                                                @foreach ($carCategories as $category)
                                                                    <option value="{{ $category->CAR_CAT }}">{{ $category->CAR_DESCR }}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="carStatus" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Status</label>
                                                        <input type="text" list="bookingStatus" id="carStatus" name="carStatus" class="form-control txt-1">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card mt-2">
                                                <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                                    <p class="mx-2 my-2">{{ __('*PICK-UP') }}</p>
                                                </div>
                                                <div class="card-body marsman-bg-color-gray1">
                                                    <div class="col-md-12 d-flex">
                                                        <div class="form-group col-md-6 p-1">
                                                            <label for="pickUpDate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Date</label>
                                                            <input type="date" class="form-control txt-1" id="pickUpDate" name="pickUpDate">
                                                        </div>
                                                        <div class="form-group col-md-6 p-1">
                                                            <label for="pickUpTime" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Time</label>
                                                            <input type="text" class="form-control txt-1" id="pickUpTime" name="pickUpTime" placeholder="1200">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group mt-2 p-2">
                                                            <label for="pickUpLocation" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Location</label>
                                                            <input type="text" class="form-control txt-1" id="pickUpLocation" name="pickUpLocation">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card mt-2">
                                                <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                                    <p class="mx-2 my-2">{{ __('*DROP-OFF') }}</p>
                                                </div>
                                                <div class="card-body marsman-bg-color-gray1">
                                                    <div class="col-md-12 d-flex">
                                                        <div class="form-group col-md-6 p-1">
                                                            <label for="dropoffDate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Date</label>
                                                            <input type="date" class="form-control txt-1" id="dropoffDate" name="dropoffDate">
                                                        </div>
                                                        <div class="form-group col-md-6 p-1">
                                                            <label for="dropoffTime" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Time</label>
                                                            <input type="text" class="form-control txt-1" id="dropoffTime" name="dropoffTime" placeholder="1200">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group mt-2 p-2">
                                                            <label for="dropoffLocation" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Location</label>
                                                            <input type="text" class="form-control txt-1" id="dropoffLocation" name="dropoffLocation">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- Column 2 -->
                                        <div class="col-md-6 p-1">

                                            <div class="card">
                                                <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                                    <p class="mx-2 my-2">{{ __('PICK-UP REFERENCE') }}</p>
                                                </div>
                                                <div class="card-body marsman-bg-color-gray1">
                                                    <div class="row col-md-12">
                                                        <div class="form-group col-md-6">
                                                            <label for="carCity" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Location</label>
                                                            <input type="text" class="form-control txt-1" id="carCity" name="carCity">
                                                        </div>
                                                        <div class="form-group col-md-4">
                                                            <label for="carArrival" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Arrival</label>
                                                            <input type="text" class="form-control txt-1" id="carArrival" name="carArrival">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="carFlightNumber" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Flight Number</label>
                                                            <input type="text" class="form-control txt-1" id="carFlightNumber" name="carFlightNumber">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="carSpecialRequest" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Special Request</label>
                                                            <input type="text" class="form-control txt-1" id="carSpecialRequest" name="carSpecialRequest">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="pickupPhoneNumber" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Phone Number</label>
                                                            <input type="text" class="form-control txt-1" id="pickupPhoneNumber" name="pickupPhoneNumber">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="pickupPaxRefNumber" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Passenger Reference Number</label>
                                                            <input type="text" class="form-control txt-1" id="pickupPaxRefNumber" name="pickupPaxRefNumber">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="pickupConfirmationNumber" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Confirmation Number</label>
                                                            <input type="text" class="form-control txt-1" id="pickupConfirmationNumber" name="pickupConfirmationNumber">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card mt-2">
                                                <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                                    <p class="mx-2 my-2">{{ __('STOP OVER') }}</p>
                                                </div>
                                                <div class="card-body marsman-bg-color-gray1">
                                                    <div class="form-group">
                                                        <label for="stopoverFirst" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">First</label>
                                                        <input type="text" class="form-control txt-1" id="stopoverFirst" name="stopoverFirst">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="stopoverSecond" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Second</label>
                                                        <input type="text" class="form-control txt-1" id="stopoverSecond" name="stopoverSecond">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="stopoverThird" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Third</label>
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

                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

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
                                        @if (isset($airTempData))
                                            @foreach ($airTempData as $temp)
                                                <tr>
                                                    <td>{{ $temp->AL_CODE }}</td>
                                                    <td>{{ $temp->FLIGHT_NUM }}</td>
                                                    <td>{{ $temp->SERVICE_CLASS }}</td>
                                                    <td>{{ $temp->DEPT_CITY }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($temp->DEPT_DATE)->format('Y-m-d') }}</td>
                                                    <td>{{ $temp->DEPT_TIME }}</td>
                                                    <td>{{ $temp->ARVL_CITY }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($temp->ARVL_DATE)->format('Y-m-d') }}</td>
                                                    <td>{{ $temp->ARVL_TIME }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <hr class="w-100">

                            <div class="col-md-12 d-flex">
                                <!-- Column 1 -->
                                <div class="col-md-6 p-1">
                                    <div class="card mt-2">
                                        <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('FLIGHT DETAILS') }}</p>
                                        </div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="form-group mb-2">
                                                <label for="airline" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Airline</label>
                                                <input type="text" list="listAirlines" id="airline" name="airline" class="form-control txt-1">
                                                <datalist id="listAirlines">
                                                    @if (isset($airlines))
                                                        @foreach ($airlines as $airline)
                                                            <option value="{{ $airline->AL_CODE }}">{{ $airline->AL_DESCR }}</option>
                                                        @endforeach
                                                    @endif
                                                </datalist>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="flightNumber" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Flight Number</label>
                                                <input type="text" class="form-control txt-1" id="flightNumber" name="flightNumber">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="serviceClass" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Service Class</label>
                                                <input type="text" list="listServiceClass" id="serviceClass" name="serviceClass" class="form-control txt-1">
                                                <datalist id="listServiceClass">
                                                    @if (isset($serviceClasses))
                                                        @foreach ($serviceClasses as $serviceClass)
                                                            <option value="{{ $serviceClass->SRVC_CLASS }}">{{ $serviceClass->SRVC_DESCR }}</option>
                                                        @endforeach
                                                    @endif
                                                </datalist>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column 2 -->
                                <div class="col-md-6 p-1 d-flex">

                                    <div class="card mt-2 col-md-6 m-1">
                                        <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('DEPARTURE') }}</p>
                                        </div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="form-group mb-2">
                                                <label for="departureCity" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">City</label>
                                                <input type="text" list="listCities" id="departureCity" name="departureCity" class="form-control txt-1">
                                                <datalist id="listCities">
                                                    @if (isset($cities))
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->CITY_CODE }}">{{ $city->CITY_DESCR }}</option>
                                                        @endforeach
                                                    @endif
                                                </datalist>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="departureDate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Date</label>
                                                <input type="date" class="form-control txt-1" id="departureDate" name="departureDate">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="departureTime" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Time</label>
                                                <input type="text" class="form-control txt-1" id="departureTime" name="departureTime" value="1200">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card mt-2 col-md-6 m-1">
                                        <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                            <p class="mx-2 my-2">{{ __('ARRIVAL') }}</p>
                                        </div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="form-group mb-2">
                                                <label for="arrivalCity" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">City</label>
                                                <input type="text" list="listCities" id="arrivalCity" name="arrivalCity" class="form-control txt-1">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="arrivalDate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Date</label>
                                                <input type="date" class="form-control txt-1" id="arrivalDate" name="arrivalDate">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="arrivalTime" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Time</label>
                                                <input type="text" class="form-control txt-1" id="arrivalTime" name="arrivalTime" value="1200">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-2">
                                <button class="btn btn-primary txt-1" id="addAirItinerary">Add</button>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($taxTempData))
                                            @foreach ($taxTempData as $tax)
                                                <tr>
                                                    <td>{{ $tax->TAX_CODE }}</td>
                                                    <td>{{ $tax->COST_CURR_CODE }}</td>
                                                    <td>{{ $tax->COST_CURR_RATE }}</td>
                                                    <td>{{ $tax->COST_AMOUNT }}</td>
                                                    <td>{{ $tax->BILL_FLAG }}</td>
                                                    <td>{{ $tax->INCL_FLAG }}</td>
                                                    <td>{{ $tax->SELL_CURR_CODE }}</td>
                                                    <td>{{ $tax->SELL_CURR_RATE }}</td>
                                                    <td>{{ $tax->SELL_AMOUNT }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
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
                                <table id="passengerList" class="table table-bordered table-striped">
                                    <thead class="marsman-bg-color-darkgray text-white">
                                        <tr>
                                            <th>Passenger Name</th>
                                            <th>Ticket Number</th>
                                            <th>PNR</th>
                                        </tr>
                                    </thead>
                                    <tbody class="marsman-bg-color-gray2">
                                        @if (isset($tempPaxData))
                                            @foreach ($tempPaxData as $data)
                                                <tr>
                                                    <td>{{ $data->PAX_NAME }}</td>
                                                    <td>{{ $data->TICKET_NO }}</td>
                                                    <td>{{ $data->PNR }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
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
        const categorySelect = document.getElementById('showCategory');
        const routeSelect = document.getElementById('route');
        const itineraryTabs = document.querySelectorAll('.nav-link.itinerary');
        const salesTab = document.getElementById('sales-tab');
        const airTab = document.getElementById('itineraryAir-tab');
        const miscTab = document.getElementById('itineraryMisc-tab');
        var products = @json($products);
        var categories = @json($productCategories);
        var routes = @json($routes);

        document.getElementById('productType').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];

            // Get category and route information from the selected option
            var categoryCode = selectedOption.getAttribute('data-category');
            var routeCode = selectedOption.getAttribute('data-route');

            // Find descriptions for the selected category and route
            var categoryDescription = categories.find(c => c.PROD_CAT === categoryCode)?.PROD_CAT_DESCR || '';
            var routeDescription = routes.find(r => r.ROUTE_CODE === routeCode)?.ROUTE_DESCR || '';

            // Update the hidden input fields
            document.getElementById('productCategory').value = categoryCode;
            document.getElementById('route').value = routeCode;

            // Update the display fields
            document.getElementById('showCategory').value = categoryDescription;
            document.getElementById('showRoute').value = routeDescription;
        });

         // Hide all itinerary tabs initially
        itineraryTabs.forEach(tab => tab.style.display = 'none');

        // Make #itineraryAir-tab the active when ticket with AIR product is present
        @if (isset($paxTicketNumber))
            if (categorySelect.value === 'AIR') {
                new bootstrap.Tab(airTab).show();
                airTab.style.display = 'block';
            } else if(categorySelect.value === 'MISCELLANEOUS') {
                new bootstrap.Tab(miscTab).show();
                miscTab.style.display = 'block';
            }
        @endif

        productNameSelect.addEventListener('change', function() {
            const selectedCategory = this.value;

            // Show/hide the appropriate itinerary tab
            showItineraryTab();

            // Make #sales-tab the active tab
            if (selectedCategory) {
                new bootstrap.Tab(salesTab).show();
            }
        });

        function showItineraryTab() {
            const selectedCategoryName = categorySelect.value;
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
            var productCategory = $('#productCategory').val();

            $.ajax({
                url: '{{ route('sales-folder-pax.tempdata.transfer') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    productCategory: productCategory
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

