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

                    <div class="col-md-12 d-flex my-2">
                        <div class="btn-group p-1 m-1" role="group" aria-label="Basic checkbox toggle button group">

                            <input type="checkbox" value="Y" class="txt-1 mx-1 px-1" id="sfGroupFlag" name="sfGroupFlag" autocomplete="off">
                            <label class="btn my-1 mx-0 px-0" for="sfGroupFlag">Group</label>

                            <span class="mx-2"></span>

                            <input type="checkbox" value="Y" class="txt-1 mx-1 px-1" id="sfGroupSupressPrint" name="sfGroupSupressPrint" autocomplete="off">
                            <label class="btn my-1 mx-0 px-0" for="sfGroupSupressPrint">Do not include this group when printed</label>

                            <span class="mx-2"></span>

                            <input type="checkbox" value="Y" class="txt-1 mx-1 px-1" id="sfGroupProduct" name="sfGroupProduct" autocomplete="off">
                            <label class="btn my-1 mx-0 px-0" for="sfGroupProduct">Part of multiple products</label>

                        </div>
                        <div class="m-2 col-md-4 d-flex">
                            <label for="sfGroupId" class="form-label txt-1 my-1 marsman-bg-color-label text-white p-2 rounded-start">Group ID</label>
                            <input type="number" class="form-control txt-2 m-0 p-2 rounded-end w-25" id="sfGroupId" name="sfGroupId">
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
                                                    <label for="salesGrandTotal" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        al</label>
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
                                                        <label for="costCurrencyQuantity" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Quantity</label>
                                                        @if (isset($paxCount))
                                                            <input type="text" class="form-control txt-1" id="costCurrencyQuantity" name="costCurrencyQuantity" value="{{ $paxCount }}">
                                                        @else
                                                            <input type="number" class="form-control txt-1" id="costCurrencyQuantity" name="costCurrencyQuantity" value="0">
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
                                                        <input type="text" class="form-control-plaintext txt-1" id="costInsurance" name="costInsurance" value="{{ number_format($ticketInventory->COST_INS_AMOUNT, 2, '.', ',') }}" readonly>
                                                    @else
                                                        <input type="text" class="form-control-plaintext txt-1" id="costInsurance" name="costInsurance" value="0">
                                                    @endif
                                                </div>
                                                <div class="col-md-2 mb-2 p-1">
                                                    <label for="costTax" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Taxes</label>
                                                    @if (isset($ticketInventory->COST_TAX_AMOUNT))
                                                        <input type="text" class="form-control-plaintext txt-1" id="costTax" name="costTax" value="{{ number_format($ticketInventory->COST_TAX_AMOUNT, 2, '.', ',') }}" readonly>
                                                    @else
                                                        <input type="text" class="form-control-plaintext txt-1" id="costTax" name="costTax" value="0" readonly>
                                                    @endif
                                                </div>
                                                <div class="col-md-2 mb-2 p-1">
                                                    <label for="costTotalUnitCost" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Total Unit Cost</label>
                                                    @if (isset($ticketInventory->PUBLISH_AMOUNT))
                                                        <input type="text" class="form-control-plaintext txt-1" id="costTotalUnitCost" name="costTotalUnitCost" value="{{ number_format($ticketInventory->PUBLISH_AMOUNT, 2, '.', ',') }}" readonly>
                                                    @else
                                                        <input type="text" class="form-control-plaintext txt-1" id="costTotalUnitCost" name="costTotalUnitCost" value="0" readonly>
                                                    @endif
                                                </div>
                                                <div class="col-md-2 mb-2 p-1">
                                                    <label for="costUnitQuantity" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Quantity</label>
                                                    @if (isset($paxCount))
                                                        <input type="text" class="form-control-plaintext txt-1" id="costUnitQuantity" name="costUnitQuantity" value="{{ $paxCount }}" readonly>
                                                    @else
                                                        <input type="number" class="form-control-plaintext txt-1" id="costUnitQuantity" name="costUnitQuantity" value="0" readonly>
                                                    @endif
                                                </div>
                                                <div class="col-md-2 mb-2 p-1">
                                                    <label for="costGrandTotal" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Grand Total</label>
                                                    @if (isset($ticketInventory->PUBLISH_AMOUNT) && isset($paxCount))
                                                        <input type="text" class="form-control-plaintext txt-1" id="costGrandTotal" name="costGrandTotal" value="{{ number_format(($ticketInventory->PUBLISH_AMOUNT + $ticketInventory->COST_TAX_AMOUNT + $ticketInventory->COST_INS_AMOUNT) * $paxCount, 2, '.', ',') }}" readonly>
                                                    @else
                                                        <input type="text" class="form-control-plaintext txt-1" id="costGrandTotal" name="costGrandTotal" value="0" readonly>
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
                                                    <select id="hotelCode" name="hotelCode" class="form-control form-select txt-1">
                                                        @foreach ($hotels as $hotel)
                                                            <option value="{{ $hotel->HOTEL_CODE }}">{{ $hotel->HOTEL_DESCR }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <div class="form-group col-md-6 mx-1 my-1">
                                                        <label for="checkInDate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Check-out Date</label>
                                                        <input type="date" class="form-control txt-1" id="checkInDate" name="checkInDate" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                                    </div>
                                                    <div class="form-group col-md-4 mx-1 my-1">
                                                        <label for="hotelNights" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Number of Nights</label>
                                                        <input type="number" class="form-control txt-1" id="hotelNights" name="hotelNights" value="1" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <div class="form-group col-md-6 mx-1 my-1">
                                                        <label for="checkOutDate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Check-in Date</label>
                                                        <input type="date" class="form-control txt-1" id="checkOutDate" name="checkOutDate" min="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}" value="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">
                                                    </div>
                                                    <div class="form-group col-md-4 mx-1 my-1">
                                                        <label for="roomQuantity" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Room Quantity</label>
                                                        <input type="number" class="form-control txt-1" id="roomQuantity" name="roomQuantity" value="1">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <div class="form-group col-md-8 mx-1 my-1">
                                                        <label for="roomType" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Room Type</label>
                                                        <input type="checkbox" class="mx-1" value="isVip"> VIP
                                                        <select id="roomType" name="roomType" class="form-control forn-select txt-1">
                                                            @foreach ($roomTypes as $roomType)
                                                                <option value="{{ $roomType->ROOM_CODE }}">{{ $roomType->ROOM_DESCR }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <div class="form-group col-md-8 mx-1 my-1">
                                                        <label for="roomCategory" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Room Category</label>
                                                        <select id="roomCategory" name="roomCategory" class="form-control form-select txt-1">
                                                            @foreach ($roomCategories as $roomCategory)
                                                                <option value="{{ $roomCategory->ROOM_CAT }}">{{ $roomCategory->ROOM_DESCR }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 d-flex">
                                                    <div class="form-group col-md-8 mx-1 my-1">
                                                        <label for="hotelBookingStatus" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Status</label>
                                                        <select id="hotelBookingStatus" name="hotelBookingStatus" class="form-control form-select txt-1">
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
                                                <select id="hotelBreakfast" name="hotelBreakfast" class="form-control form-select txt-1">
                                                    @foreach ($meals as $meal)
                                                        <option value="{{ $meal->MEAL_CODE }}">{{ $meal->MEAL_DESCR }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 mx-1 my-1">
                                                <label for="hotelLunch" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Lunch</label>
                                                <select id="hotelLunch" name="hotelLunch" class="form-control form-select txt-1">
                                                    @foreach ($meals as $meal)
                                                        <option value="{{ $meal->MEAL_CODE }}">{{ $meal->MEAL_DESCR }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-md-12 mx-1 my-1">
                                                <label for="hotelDinner" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Dinner</label>
                                                <select id="hotelDinner" name="hotelDinner" class="form-control form-select txt-1">
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
                                                <input type="date" id="miscStartDate" name="miscStartDate" class="form-control txt-1" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscStartLoc" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">Start Location</label>
                                                <input type="text" id="miscStartLoc" name="miscStartLoc" class="form-control txt-1">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="miscEndDate" class="form-label marsman-bg-color-dark text-white txt-1 p-2 m-0 rounded-top">*End Date</label>
                                                <input type="date" id="miscEndDate" name="miscEndDate" class="form-control txt-1" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
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
                                                    @if (isset($employees))
                                                        @foreach ($employees as $employee)
                                                            <option value="{{ $employee->EMP_ID }}">{{ $employee->FULL_NAME}}</option>
                                                        @endforeach
                                                    @endif
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
                                                        <select id="carProvider" name="carProvider" class="form-control form-select txt-1">
                                                            @if (isset($carSupplier))
                                                                @foreach ($carSupplier as $supplier)
                                                                    <option value="{{ $supplier->SUPP_ID }}">{{ $supplier->SUPP_NAME }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="carType" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Type</label>
                                                        <select id="carType" name="carType" class="form-control form-select txt-1">
                                                            @if(isset($carTypes))
                                                                @foreach ($carTypes as $type)
                                                                    <option value="{{ $type->CAR_CODE }}">{{ $type->CAR_DESCR }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="carCategory" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Category</label>
                                                        <select id="carCategory" name="carCategory" class="form-control form-select txt-1">
                                                            @if(isset($carCategories))
                                                                @foreach ($carCategories as $category)
                                                                    <option value="{{ $category->CAR_CAT }}">{{ $category->CAR_DESCR }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label for="carStatus" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Status</label>
                                                        <select id="carStatus" name="carStatus" class="form-control form-select txt-1">
                                                            @foreach ($bookStatus as $status)
                                                                <option value="{{ $status->BK_CODE }}">{{  $status->BK_DESCR }}</option>
                                                            @endforeach
                                                        </select>
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
                                                            <label for="transferPaxRefNo" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Passenger Reference Number</label>
                                                            <input type="text" class="form-control txt-1" id="transferPaxRefNo" name="transferPaxRefNo">
                                                        </div>
                                                        <div class="form-group mt-2">
                                                            <label for="transferConfNo" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Confirmation Number</label>
                                                            <input type="text" class="form-control txt-1" id="transferConfNo" name="transferConfNo">
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
                                                <select id="airline" name="airline" class="form-control form-select txt-1">
                                                    @if (isset($airlines))
                                                        @foreach ($airlines as $airline)
                                                            <option value="{{ $airline->AL_CODE }}">{{ $airline->AL_DESCR }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="flightNumber" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Flight Number</label>
                                                <input type="text" class="form-control txt-1" id="flightNumber" name="flightNumber">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="serviceClass" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Service Class</label>
                                                <select id="serviceClass" name="serviceClass" class="form-control form-select txt-1">
                                                    @if (isset($serviceClasses))
                                                        @foreach ($serviceClasses as $serviceClass)
                                                            <option value="{{ $serviceClass->SRVC_CLASS }}">{{ $serviceClass->SRVC_DESCR }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
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
                                                <select id="departureCity" name="departureCity" class="form-control form-select txt-1">
                                                    @if (isset($cities))
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->CITY_CODE }}">{{ $city->CITY_DESCR }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="departureDate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Date</label>
                                                <input type="date" class="form-control txt-1" id="departureDate" name="departureDate" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
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
                                                <select id="arrivalCity" name="arrivalCity" class="form-control form-select txt-1">
                                                    @if (isset($cities))
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->CITY_CODE }}">{{ $city->CITY_DESCR }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="arrivalDate" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Date</label>
                                                <input type="date" class="form-control txt-1" id="arrivalDate" name="arrivalDate" min="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}" value="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="arrivalTime" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Time</label>
                                                <input type="text" class="form-control txt-1" id="arrivalTime" name="arrivalTime" value="1200">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Confirmation number and Pax ref number -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header"></div>
                                    <div class="card-body marsman-bg-color-gray1">
                                        <div class="col-md-12 d-flex">
                                            <div class="form-group col-md-6 p-1">
                                                <label for="airConfNo" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Confirmation Number</label>
                                                <input type="text" id="airConfNo" name="airConfNo" class="form-control txt-1">
                                            </div>
                                            <div class="form-group col-md-6 p-1">
                                                <label for="airPaxRefNo" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Passenger Reference Number</label>
                                                <input type="text" id="airPaxRefNo" name="airPaxRefNo" class="form-control txt-1">
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

                            @if(session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="table-responsive">
                                <table id="taxList" class="table table-bordered table-striped">
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
                                            <th>Currency</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th><input type="checkbox" id="selectAll"></th>
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
                                                    <td>{{ $tax->SELL_CURR_CODE }}</td>
                                                    <td>{{ $tax->SELL_CURR_RATE }}</td>
                                                    <td>{{ $tax->SELL_AMOUNT }}</td>
                                                    <td><input type="checkbox" class="taxCheckbox" value="{{ $tax->id }}"></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-12 justify-content-end d-flex mt-3">
                                <button class="btn btn-danger txt-1" id="deleteSelectedTaxData">Delete Selected</button>
                            </div>

                            <hr class="w-100 mt-5">

                            <form id="taxAddForm" action="{{ route('sales-folder-tax.tempdata.store') }}" method="post">
                                @csrf
                                <input type="hidden" id="currentTab" name="currentTab" value="addtaxes">

                            <div class="col-md-12 d-flex">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header m-0 p-0"></div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="form-group">
                                                <label for="taxCode" class="form-label marsman-bg-color-label text-white m-0 p-2 rounded-top">Tax Code</label>
                                                <select id="taxCode" name="taxCode" class="form-control form-select txt-1">
                                                    @if(isset($taxes))
                                                        @foreach ($taxes as $tax)
                                                            <option value="{{ $tax->TAX_CODE }}">{{ trim($tax->TAX_DESCR) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header m-0 p-0"></div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="form-group mb-2">
                                                <label for="taxCostCurrCode" class="form-label marsman-bg-color-label text-white m-0 p-2 rounded-top">Cost Currency Code</label>
                                                <select id="taxCostCurrCode" name="taxCostCurrCode" class="form-control form-select txt-1">
                                                    <option value="PHP">PHP</option>
                                                    <option value="USD">USD</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="taxCostCurrRate" class="form-label marsman-bg-color-label text-white m-0 p-2 rounded-top">Cost Currency Rate</label>
                                                <input type="number" id="taxCostCurrRate" name="taxCostCurrRate" class="form-control txt-1" value="0">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="taxCostCurrAmount" class="form-label marsman-bg-color-label text-white m-0 p-2 rounded-top">Cost Currency Amount</label>
                                                <input type="number" id="taxCostCurrAmount" name="taxCostCurrAmount" class="form-control txt-1" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header m-0 p-0"></div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="form-group mb-2">
                                                <label for="taxSaleCurrCode" class="form-label marsman-bg-color-label text-white m-0 p-2 rounded-top">Sale Currency Code</label>
                                                <select id="taxSaleCurrCode" name="taxSaleCurrCode" class="form-control form-select txt-1">
                                                    <option value="PHP">PHP</option>
                                                    <option value="USD">USD</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="taxSaleCurrRate" class="form-label marsman-bg-color-label text-white m-0 p-2 rounded-top">Sale Currency Rate</label>
                                                <input type="number" id="taxSaleCurrRate" name="taxSaleCurrRate" class="form-control txt-1" value="0">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="taxSaleCurrAmount" class="form-label marsman-bg-color-label text-white m-0 p-2 rounded-top">Sale Currency Amount</label>
                                                <input type="number" id="taxSaleCurrAmount" name="taxSaleCurrAmount" class="form-control txt-1" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 justify-content-end d-flex mt-3">
                                <button class="btn btn-primary txt-1" id="addTaxData">Add Tax</button>
                            </div>

                            </form>

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

                        <!-- Tab 7 :: Passengers -->
                        <div class="tab-pane fade show" id="passenger" role="tabpanel" aria-labelledby="passenger-tab">
                            <p class="h3">Passenger</p>

                            <div class="table-responsive">
                                <table id="passengerList" class="table table-bordered table-striped">
                                    <thead class="marsman-bg-color-darkgray text-white">
                                        <tr>
                                            <th><input type="checkbox" id="selectAllPax"></th>
                                            <th>Passenger Name</th>
                                            <th>Ticket Number</th>
                                            <th>PNR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($tempPaxData))
                                            @foreach ($tempPaxData as $data)
                                                <tr>
                                                    <td><input type="checkbox" class="selectRow" data-ticket-number="{{ $data->TICKET_NO }}"></td>
                                                    <td>{{ $data->PAX_NAME }}</td>
                                                    <td>{{ $data->TICKET_NO }}</td>
                                                    <td>{{ $data->PNR }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <button class="btn btn-danger txt-1 mt-3" id="deleteSelected">Delete Selected</button>

                            <div class="col-md-12 d-flex">
                                <div class="col-md-6">
                                    <div class="card-body marsman-bg-color-gray1">
                                        <div class="form-group">
                                            <label for="passengerName" class="form-label txt-1 marsman-bg-color-label text-white rounded-top p-2 m-0">Passenger Name</label>
                                            <input type="text" class="form-control txt-1" id="passengerName" name="passengerName">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="passengerPNR" class="form-label txt-1 marsman-bg-color-label text-white rounded-top p-2 m-0">PNR</label>
                                            <input type="text" class="form-control txt-1" id="passengerPNR" name="passengerPNR" maxlength="6">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body marsman-bg-color-gray1">
                                        <div class="form-group">
                                            <label for="passengerTicketNumber" class="form-label txt-1 marsman-bg-color-label text-white rounded-top p-2 m-0">Ticket Number</label>
                                            <input type="text" class="form-control txt-1" id="passengerTicketNumber" name="passengerTicketNumber" maxlength="10">
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

<!-- Success Message -->
<div id="successMessage" class="lightbox-container" style="display: none;">
    <div class="lightbox-content">
        <span class="close-button">&times;</span>
        <h2>Success</h2>
        <p id="successText"></p>
    </div>
</div>

<!-- Error Message -->
<div id="errorMessage" class="lightbox-container" style="display: none;">
    <div class="lightbox-content">
        <span class="close-button">&times;</span>
        <h2>Error</h2>
        <p id="errorText"></p>
    </div>
</div>

<style>
.nav-tabs li a {
    cursor: pointer;
}

.no-wrap {
    white-space: nowrap;
}

.lightbox-container {
  display: none;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
  animation: fadeIn 0.5s;
}

.lightbox-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 30%;
  animation: fadeIn 0.5s;
}

.close-button {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close-button:hover,
.close-button:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
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

        // Add click event listeners to the close buttons and the background
        const successMessage = document.getElementById('successMessage');
        const errorMessage = document.getElementById('errorMessage');
        const closeButtons = document.querySelectorAll('.close-button');
        const lightboxContainers = document.querySelectorAll('.lightbox-container');

        //Cost amount auto update on manual input
        const costInsuranceInput = document.getElementById('costInsurance');
        const unitAmountInput = document.getElementById('costUnitAmount');
        const taxInput = document.getElementById('costTax');
        const totalUnitCostInput = document.getElementById('costTotalUnitCost');
        const unitQuantityInput = document.getElementById('costUnitQuantity');
        const currencyQuantityInput = document.getElementById('costCurrencyQuantity');

        function updateTotalUnitCost() {
            getTotalTax().then(() => {
                const unitAmount = parseFloat(unitAmountInput.value.replace(/,/g, '')) || 0;
                const tax = parseFloat(taxInput.value.replace(/,/g, '')) || 0;
                const insurance = parseFloat(costInsuranceInput.value.replace(/,/g, '')) || 0;
                const totalUnitCost = unitAmount + tax + insurance;
                totalUnitCostInput.value = formatNumber(totalUnitCost);
                calculateCostGrandTotal();
                //alert(tax);
            }).catch((error) => {
                console.error('Error fetching total tax:', error);
            });
        }


        function updateQuantity() {
            unitQuantityInput.value = currencyQuantityInput.value;
            calculateCostGrandTotal();
        }

        unitAmountInput.addEventListener('input', updateTotalUnitCost);
        taxInput.addEventListener('input', updateTotalUnitCost);
        costInsuranceInput.addEventListener('input', updateTotalUnitCost);
        currencyQuantityInput.addEventListener('input', updateQuantity);

        // Popup notification box
        closeButtons.forEach((button) => {
            button.addEventListener('click', () => {
                successMessage.style.display = 'none';
                errorMessage.style.display = 'none';
                successMessage.style.animation = 'fadeOut 0.5s';
                errorMessage.style.animation = 'fadeOut 0.5s';
            });
        });

        lightboxContainers.forEach((container) => {
            container.addEventListener('click', (event) => {
                if (event.target === container) {
                container.style.display = 'none';
                container.style.animation = 'fadeOut 0.5s';
                }
            });
        });

        //Number format any input value with numbers
        function formatNumber(value) {
            // Ensure value is converted to a number
            let num = parseFloat(value);

            // Check if num is a valid number
            if (!isNaN(num)) {
                // Format the number with commas and exactly two decimal places
                return num.toLocaleString('en-US', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            } else {
                // Handle case where value is not a valid number
                return '';
            }
        }

        //Default input with number format
        window.onload = function() {
            const taxInput = $('costTax').val();
            formatNumber(taxInput);
        };

        // Auto retrieve product category and route of selected type
        document.getElementById('productType').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];

            // Get category and route information from the selected option
            var categoryCode = selectedOption.getAttribute('data-category');

            // If selected product has 'TRANSFER', make the category as 'C'
            if(selectedOption.getAttribute('data-category') === 'X') {
                categoryCode = 'C';
            }

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
                //new bootstrap.Tab(airTab).show();
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

        // Function to update the #costUnitQuantity input
        function updatePaxCount() {
            // Fetch the current TRO number from the form (assuming it's available)
            var troNumber = $('#troNumber').val(); // Replace with your actual selector

            // Make an AJAX call to get the count of passengers for the current TRO
            $.ajax({
            url: '{{ route('sales-folder-pax.tempdata.count') }}', // Replace with your actual route
            data: { troNumber: troNumber },
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            method: 'POST',
            success: function(response) {
                // Update the #costUnitQuantity input with the count
                console.log('Total current pax count: ' + response.count);
                $('#costUnitQuantity').val(response.count);
                //calculateCostGrandTotal();
                console.log('Value of cost quantity: ' + $('#costUnitQuantity').val());
            },
            error: function(error) {
                console.error('Error fetching passenger count:', error);
            }
            });
        }
        //Initial load pax count
        updatePaxCount();

        function getTotalPax(callback) {
            // Fetch the current TRO number from the form (assuming it's available)
            var troNumber = $('#troNumber').val(); // Replace with your actual selector

            // Make an AJAX call to get the count of passengers for the current TRO
            $.ajax({
                url: '{{ route('sales-folder-pax.tempdata.count') }}', // Replace with your actual route
                data: { troNumber: troNumber },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                success: function(response) {
                    callback(response.count);
                },
                error: function(error) {
                    console.error('Error fetching passenger count:', error.message);
                    callback(null);
                }
            });
        }

        getTotalPax(function(count) {
            if (count !== null) {
                $('#costUnitQuantity').val(count);
                console.log('Total current pax count: ' + count);
                console.log('Value of cost quantity: ' + $('#costUnitQuantity').val());
                console.log('This is the callback result.');
            } else {
                $('#costUnitQuantity').val(0);
                console.log('Error fetching passenger count. Defaulting to 0');
            }
        });

        function calculateCostGrandTotal() {
            // Get the values of insurance, tax, unit cost, and quantity
            var unitQuantity = $('#costUnitQuantity').val();
            var insurance = parseFloat($('#costInsurance').val().replace(/,/g, '')) || 0;
            var tax = parseFloat($('#costTax').val().replace(/,/g, '')) || 0;
            var unitCost = parseFloat($('#costTotalUnitCost').val().replace(/,/g, '')) || 0;

            getTotalPax(function(count) {
                console.log('Get total pax count: ' + count);
                var quantity = count !== 0 ? count : unitQuantity;
                console.log('Current quantity: ' + quantity);
                console.log('Current manual quantity: ' + unitQuantity);
                $('#costUnitQuantity').val(quantity);

                // Calculate the grand total
                var grandTotal = unitCost * quantity;
                console.log('Final quantity: ' + quantity);
                if (quantity === 0) {
                    grandTotal = 0;
                }

                // Format the grand total to 2 decimal places with commas
                var formattedGrandTotal = formatNumber(grandTotal);

                // Update the input field with the formatted grand total
                console.log('Grand Total is: ' + formattedGrandTotal);
                $('#costGrandTotal').val(formattedGrandTotal);
            });
        }


        // Bind the change event to the relevant input fields
        $('#costInsurance, #costTax, #costTotalUnitCost').on('input', function() {
            calculateCostGrandTotal();
        });

        //Initial load cost grand total
        getTotalTax();
        updateTotalUnitCost();
        updateQuantity();
        calculateCostGrandTotal();

        function getGrandTotal() {
            // Get the values of insurance, tax, unit cost, and quantity
            var insurance = parseFloat($('#costInsurance').val().replace(/,/g, '')) || 0;
            var tax = parseFloat($('#costTax').val().replace(/,/g, '')) || 0;
            var unitCost = parseFloat($('#costTotalUnitCost').val().replace(/,/g, '')) || 0;

            getTotalPax(function(count) {
                if (count !== null) {
                    var quantity = count;
                    console.log('This is the callback result of getting the grand total.');
                } else {
                    var quantity = 0;
                    console.log('Error fetching passenger count. Defaulting to 0');
                }
            });

            // Calculate the grand total
            var grandTotal = (insurance + tax + unitCost) * quantity;

            // Format the grand total to 2 decimal places with commas
            var formattedGrandTotal = formatNumber(grandTotal);

            return formattedGrandTotal;
        }

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

        // Check first if there is a selected Product type
        function validateProductType() {
            if ($('#productType').val() === '') {
                alert('Please select a product type.');
                return false;
            }
            return true;
        }

        //Add Hotel Itinerary
        function addHotelProduct() {

            if (!validateProductType()) {
                return;
            }

            var formData = {
                troNumber: $('#troNumber').val(),
                docId: $('#docId').val(),
                hotelCode: $('#hotelCode').val(),
                checkInDate: $('#checkInDate').val(),
                checkOutDate: $('#checkOutDate').val(),
                checkOutDate: $('#checkOutDate').val(),
                hotelNights: $('#hotelNights').val(),
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

            if (!validateProductType()) {
                return;
            }

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

            if (!validateProductType()) {
                return;
            }

            var formData = {
                troNumber: $('#troNumber').val(),
                docId: $('#docId').val(),
                miscType: $('#miscType').val(),
                procCenter: $('#procCenter').val(),
                docOfficer: $('#docOfficer').val(),
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

            if (!validateProductType()) {
                return;
            }

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
                passengerTicketNumber: $('#passengerTicketNumber').val(),
                passengerPNR: $('#passengerPNR').val(),
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: '{{ route('sales-folder-pax.tempdata.pax.store') }}',
                type: 'POST',
                data: data,
                success: function(response) {
                    alert(response.message);

                    //Update product quantity
                    $('#costCurrencyQuantity').val(response.totalCount);
                    $('#costUnitQuantity').val(response.totalCount);
                    getTotalTax();
                    updateTotalUnitCost();
                    updateQuantity();
                    calculateCostGrandTotal();

                    if (response.data) {
                        const tableBody = $('#passengerList tbody');
                        tableBody.empty();
                        response.data.forEach(function(row) {
                            tableBody.append(`
                                <tr>
                                    <td><input type="checkbox" class="selectRow" data-ticket-number="${row.TICKET_NO}"></td>
                                    <td>${row.PAX_NAME}</td>
                                    <td>${row.TICKET_NO}</td>
                                    <td>${row.PNR}</td>
                                </tr>
                            `);
                        });
                    }

                    $('#passengerName').val('');
                    $('#passengerTicketNumber').val('');
                    $('#passengerPNR').val('');
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON ? xhr.responseJSON.error : 'An error occurred';
                    alert(errorMessage);
                }
            });
        });

        // Select All Checkbox
        $('#selectAllPax').change(function() {
            $('.selectRow').prop('checked', $(this).prop('checked'));
        });

        // Handle individual row checkbox change
        $(document).on('change', '.selectRow', function() {
            if ($('.selectRow:checked').length === $('.selectRow').length) {
                $('#selectAll').prop('checked', true);
            } else {
                $('#selectAll').prop('checked', false);
            }
        });

        // Delete Selected Passengers
        $('#deleteSelected').click(function() {
            const selectedTickets = [];
            $('.selectRow:checked').each(function() {
                selectedTickets.push($(this).data('ticket-number'));
            });

            if (selectedTickets.length > 0) {
                $.ajax({
                    url: '{{ route('sales-folder-pax.tempdata.delete') }}',
                    type: 'POST',
                    data: {
                        ticketNumbers: selectedTickets,
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        if (response.message) {
                            alert(response.message);
                            getTotalTax();
                            updateTotalUnitCost();
                            updateQuantity();
                            calculateCostGrandTotal();
                        }

                        if (response.data) {
                            const tableBody = $('#passengerList tbody');
                            tableBody.empty();
                            response.data.forEach(function(row) {
                                tableBody.append(`
                                    <tr>
                                        <td><input type="checkbox" class="selectRow" data-ticket-number="${row.TICKET_NO}"></td>
                                        <td>${row.PAX_NAME}</td>
                                        <td>${row.TICKET_NO}</td>
                                        <td>${row.PNR}</td>
                                    </tr>
                                `);
                            });
                        }
                    },
                    error: function(xhr) {
                        const errorMessage = xhr.responseJSON ? xhr.responseJSON.error : 'An error occurred';
                        alert(errorMessage);
                    }
                });
            } else {
                alert('No passengers selected.');
            }
        });


        // Save data from temp table to permanent table
        $('#createProduct').on('click', function() {

            //Check if a product type is selected
            if (!validateProductType()) {
                return;
            }

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
                costUnitAmount: $('#costUnitAmount').val(),
                costCommissionAmount: $('#costCommissionAmount').val(),
                costCommissionRate: $('#costCommissionRate').val(),
                costDiscountAmount: $('#costDiscountAmount').val(),
                costDiscountRate: $('#costDiscountRate').val(),
                costTax: $('#costTax').val(),
                costInsurace: $('#costInsurace').val(),
                costCurrencyCode: $('#costCurrencyCode').val(),
                costCurrencyAmount: $('#costCurrencyAmount').val(),
                costTotalUnitCost: $('#costTotalUnitCost').val(),
                costGrandTotal: $('#costGrandTotal').val(),
                longItineraryDesc: $('#longItineraryDesc').val(),
                generalRemarks: $('#generalRemarks').val(),
                airlineReference: $('#airlineReference').val(),
                admAlloc: $('#admAlloc').val(),
                lowestFare: $('#lowestFare').val(),
                promoAlloc: $('#promoAlloc').val(),
                iataFare: $('#iataFare').val(),
                staffDiscount: $('#staffDiscount').val(),
                fareSaving: $('#fareSaving').val(),
                pta: $('#pta').val(),
                rtt: $('#rtt').val(),
                sfGroupFlag: $('#sfGroupFlag').val(),
                sfSupressPrint: $('#sfSupressPrint').val(),
                sfGroupProduct: $('#sfGroupProduct').val(),
                sfGroupId: $('#sfGroupId').val(),
                paxDescription: $('#paxDescription').val(),
                fareCalculation: $('#fareCalculation').val(),
            };

            var productCategory = $('#productCategory').val();

            if (productCategory == 'H') {
                formData['confirmationNumber'] = $('#hotelConfNo').val();
                formData['paxReferenceNumber'] = $('#hotelPaxRefNo').val();
            } else if (productCategory == 'M') {
                formData['confirmationNumber'] = $('#miscConfNo').val();
                formData['paxReferenceNumber'] = $('#miscPaxRefNo').val();
            } else if (productCategory == 'C') {
                formData['confirmationNumber'] = $('#transferConfNo').val();
                formData['paxReferenceNumber'] = $('#transferPaxRefNo').val();
            } else if (productCategory == 'A') {
                formData['confirmationNumber'] = $('#airConfNo').val();
                formData['paxReferenceNumber'] = $('#airPaxRefNo').val();
            }

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

                    //Save temporary added taxes to SALES_FOLDER_TAX
                    transferTaxTempData();

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

                    // Clear the temporary table data display
                    const tableBody = $('#passengerList tbody');
                    tableBody.empty();
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred';
                }
            });
        }

        function transferTaxTempData() {
            var troNumber = $('#troNumber').val();
            var docId = $('#docId').val();

            $.ajax({
                url: '{{ route('sales-folder-tax.tempdata.transfer') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    troNumber: troNumber,
                    docId: docId
                },
                success: function(response) {
                    console.log(response.message);

                    // Clear the temporary table data display
                    const tableBody = $('#passengerList tbody');
                    tableBody.empty();
                },
                error: function(xhr) {
                    const errorMessage = xhr.responseJSON ? xhr.responseJSON.message : 'An error occurred';
                    console.log(errorMessage);
                }
            });
        }

        //Save tax data
        $('#taxAddForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            // Get form data
            var formData = $(this).serialize();

            // AJAX request for adding tax data
            $.ajax({
                url: '{{ route('sales-folder-tax.tempdata.store') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Handle success
                    console.log(response);
                    // Show success message
                    alert(response.success);
                    // Update the table or UI with the returned data
                    if (response.data) {
                        var tableBody = $('#taxList tbody');
                        tableBody.empty(); // Clear existing rows
                        $.each(response.data, function(index, tax) {
                            tableBody.append(
                                '<tr>' +
                                    '<td>' + tax.TAX_CODE + '</td>' +
                                    '<td>' + tax.COST_CURR_CODE + '</td>' +
                                    '<td>' + tax.COST_CURR_RATE + '</td>' +
                                    '<td>' + tax.COST_AMOUNT + '</td>' +
                                    '<td>' + tax.SELL_CURR_CODE + '</td>' +
                                    '<td>' + tax.SELL_CURR_RATE + '</td>' +
                                    '<td>' + tax.SELL_AMOUNT + '</td>' +
                                    '<td><input type="checkbox" class="taxCheckbox" value="' + tax.id + '"></td>' +
                                '</tr>'
                            );
                        });
                    }

                    // Update cost
                    getTotalTax();
                    updateTotalUnitCost();
                    updateQuantity();
                    calculateCostGrandTotal();
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                    alert('Failed to save tax data: ' + xhr.responseText);
                }
            });
        });

        // Handle select all checkbox
        $('#selectAll').on('change', function() {
            $('.taxCheckbox').prop('checked', $(this).prop('checked'));
        });

        // Handle delete selected tax data
        $('#deleteSelectedTaxData').on('click', function() {
            var selectedIds = $('.taxCheckbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedIds.length > 0) {
                if (confirm('Are you sure you want to delete the selected tax data?')) {
                    // AJAX request for deleting selected tax data
                    $.ajax({
                        url: '{{ route('sales-folder-tax.tempdata.delete') }}',
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                            taxIds: selectedIds
                        },
                        success: function(response) {
                            // Update cost
                            getTotalTax();
                            updateTotalUnitCost();
                            updateQuantity();
                            calculateCostGrandTotal();

                            // Handle success
                            console.log(response);
                            // Show success message
                            alert(response.success);
                            // Update the table or UI with the returned data
                            if (response.data) {
                                var tableBody = $('#taxList tbody');
                                tableBody.empty(); // Clear existing rows
                                $.each(response.data, function(index, tax) {
                                    tableBody.append(
                                        '<tr>' +
                                            '<td>' + tax.TAX_CODE + '</td>' +
                                            '<td>' + tax.COST_CURR_CODE + '</td>' +
                                            '<td>' + tax.COST_CURR_RATE + '</td>' +
                                            '<td>' + tax.COST_AMOUNT + '</td>' +
                                            '<td>' + tax.SELL_CURR_CODE + '</td>' +
                                            '<td>' + tax.SELL_CURR_RATE + '</td>' +
                                            '<td>' + tax.SELL_AMOUNT + '</td>' +
                                            '<td><input type="checkbox" class="taxCheckbox" value="' + tax.id + '"></td>' +
                                        '</tr>'
                                    );
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            // Handle error
                            console.error(xhr.responseText);
                            alert('Failed to delete tax data: ' + xhr.responseText);
                        }
                    });
                }
            } else {
                alert('Please select at least one tax data to delete.');
            }
        });

        // Update the hidden input field with the current tab ID whenever the user switches tabs
        $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
            $('#currentTab').val($(e.target).attr('data-bs-target').substring(1));
        });

        // Activate the tab upon redirect if needed
        const currentTab = "{{ session('currentTab') }}";
        if (currentTab) {
            const tabTrigger = document.querySelector(`#myTabs a[data-bs-target="#${currentTab}"]`);
            if (tabTrigger) {
                new bootstrap.Tab(tabTrigger).show();
            }
        }

        function getTotalTax() {
            return new Promise((resolve, reject) => {
                $.ajax({
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    url: "{{ route('sales-folder-tax.tempdata.total') }}",
                    success: function(data) {
                        var taxTotal = formatNumber(data.totalCostAmount);
                        $('#costTax').val(taxTotal);
                        resolve(); // Resolve the promise when the AJAX call is successful
                    },
                    error: function(error) {
                        reject(error); // Reject the promise if there's an error
                    }
                });
            });
        }

    });
</script>

@endsection

