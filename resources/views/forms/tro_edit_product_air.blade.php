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

            <a href="{{ route('forms.tro.sf', ['troNumber' => $troNumber]) }}" class="btn marsman-btn-primary txt-1 mb-2">Back to Travel Request Order</a>

            <div class="card">
                <div class="card-header marsman-bg-color-secondary p-0">
                    <p class="h6 my-2 mx-2">{{ __('Product Details - '.$sfGroup->product->PROD_DESCR) }}</p>
                </div>
                <div class="card-body bg-white">

                    <div class="col-md-12 justify-content-end d-flex px-4 txt-1">
                        <button id="updateProduct" type="submit" class="btn btn-primary mt-2 txt-1">Update Product</button>
                    </div>

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

                        <!-- TRO Number and DOC ID of this product -->
                        @if(isset($troNumber))
                            <input type="hidden" name="troNumber" id="troNumber" value="{{ $troNumber }}">
                        @endif

                        @if(isset($docId))
                            <input type="hidden" name="docId" id="docId" value="{{ $docId  }}">
                        @endif
                        <!-- important hidden data -->

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
                                                    @if (isset($sfGroup->COST_CURR_CODE))
                                                        <input type="text" class="form-control txt-1" id="costCurrencyCode" name="costCurrencyCode" value="{{ $sfGroup->COST_CURR_CODE }}">
                                                    @else
                                                        <input type="text" class="form-control txt-1" id="costCurrencyCode" name="costCurrencyCode" value="PHP">
                                                    @endif

                                                </div>
                                                <div class="form-group col-md-8 mx-2">
                                                    <label for="costCurrencyAmount" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">*Amount</label>
                                                    @if (isset($sfGroup->COST_CURR_RATE))
                                                        <input type="text" class="form-control txt-1" id="costCurrencyAmount" name="costCurrencyAmount" value="{{ $sfGroup->COST_CURR_RATE }}">
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
                                                        @if (isset($sfGroup->PUBLISH_AMT))
                                                            <input type="text" class="form-control txt-1" id="costUnitAmount" name="costUnitAmount" value="{{ number_format($sfGroup->PUBLISH_AMT, 2, '.', ',') }}">
                                                        @else
                                                            <input type="text" class="form-control txt-1" id="costUnitAmount" name="costUnitAmount" value="0">
                                                        @endif
                                                    </div>
                                                    <div class="form-group col-md-4 mx-2">
                                                        <label for="costCurrencyQuantity" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Quantity</label>
                                                        @if (isset($sfAirPax))
                                                            <input type="text" class="form-control txt-1" id="costCurrencyQuantity" name="costCurrencyQuantity" value="{{ $sfAirPax->count() }}">
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
                                                    @if (isset($sfGroup->COST_INS_AMT))
                                                        <input type="text" class="form-control txt-1" id="costInsurance" name="costInsurance" value="{{ number_format($sfGroup->COST_INS_AMT, 2, '.', ',') }}" readonly>
                                                    @else
                                                        <input type="text" class="form-control txt-1" id="costInsurance" name="costInsurance" value="0">
                                                    @endif
                                                </div>
                                                <div class="col-md-2 mb-2 p-1">
                                                    <label for="costTax" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Taxes</label>
                                                    @if (isset($sfGroup->COST_TTAX_AMT))
                                                        <input type="text" class="form-control txt-1" id="costTax" name="costTax" value="{{ number_format($sfGroup->COST_TTAX_AMT, 2, '.', ',') }}" readonly>
                                                    @else
                                                        <input type="text" class="form-control txt-1" id="costTax" name="costTax" value="">
                                                    @endif
                                                </div>
                                                <div class="col-md-2 mb-2 p-1">
                                                    <label for="costTotalUnitCost" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Total Unit Cost</label>
                                                    @if (isset($sfGroup->PUBLISH_AMT))
                                                        <input type="text" class="form-control txt-1" id="costTotalUnitCost" name="costTotalUnitCost" value="{{ number_format($sfGroup->PUBLISH_AMT, 2, '.', ',') }}" readonly>
                                                    @else
                                                        <input type="text" class="form-control txt-1" id="costTotalUnitCost" name="costTotalUnitCost" value="0">
                                                    @endif
                                                </div>
                                                <div class="col-md-2 mb-2 p-1">
                                                    <label for="costUnitQuantity" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Quantity</label>
                                                    @if (isset($sfAirPax))
                                                        <input type="text" class="form-control txt-1" id="costUnitQuantity" name="costUnitQuantity" value="{{ $sfAirPax->count() }}" readonly>
                                                    @else
                                                        <input type="number" class="form-control txt-1" id="costUnitQuantity" name="costUnitQuantity" value="0" readonly>
                                                    @endif
                                                </div>
                                                <div class="col-md-2 mb-2 p-1">
                                                    <label for="costGrandTotal" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Grand Total</label>
                                                    @if (isset($ticketInventory->PUBLISH_AMT) && isset($paxCount))
                                                        <input type="text" class="form-control txt-1" id="costGrandTotal" name="costGrandTotal" value="{{ number_format(($ticketInventory->PUBLISH_AMT + $ticketInventory->COST_TAX_AMT + $ticketInventory->COST_INS_AMT) * $paxCount, 2, '.', ',') }}" readonly>
                                                    @else
                                                        <input type="text" class="form-control txt-1" id="costGrandTotal" name="costGrandTotal" value="0" readonly>
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
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($sfAir))
                                            @foreach ($sfAir as $air)
                                            <form action="{{ route('sales-folder-air.update', [
                                                'sfNo' => $troNumber,
                                                'docId' => $docId,
                                                'itemNo' => $air->ITEM_NO,
                                            ]) }}" method="POST" class="update-form" id="updateAirItinerary">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="sfNo" id="sfNo" value="{{ $air->SF_NO }}">
                                                <input type="hidden" name="docId" id="docId" value="{{ $air->DOC_ID }}">
                                                <input type="hidden" name="itemNumber" id="itemNumber" value="{{ $air->ITEM_NO }}">
                                                <tr>
                                                    <td>
                                                        <input list="dataAirlines" id="airline" name="airline" value="{{ $air->AL_CODE }}" class="form-control txt-1">
                                                        <datalist id="dataAirlines">
                                                            @if (isset($airlines))
                                                                @foreach ($airlines as $airline)
                                                                    <option value="{{ $airline->AL_CODE }}">{{ $airline->AL_DESCR }}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="flightNumber" name="flightNumber" value="{{ $air->FLIGHT_NUM }}" class="form-control txt-1">
                                                    </td>
                                                    <td>
                                                        <input list="dataService" id="serviceClass" name="serviceClass" value="{{ $air->SERVICE_CLASS }}" class="form-control txt-1">
                                                        <datalist id="dataService">
                                                            @if (isset($serviceClasses))
                                                                @foreach ($serviceClasses as $service)
                                                                    <option value="{{ $service->SRVC_CLASS }}">{{ $service->SRVC_DESCR }}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                    </td>
                                                    <td>
                                                        <input list="dataCities" id="departureCity" name="departureCity" value="{{ $air->DEPT_CITY }}" class="form-control txt-1">
                                                        <datalist id="dataCities">
                                                            @if (isset($cities))
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->CITY_CODE }}">{{ $city->CITY_DESCR }}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                    </td>
                                                    <td>
                                                        <input type="date" id="departureDate" name="departureDate" class="form-control txt-1" value="{{ \Illuminate\Support\Carbon::parse($air->DEPT_DATE)->format('Y-m-d') }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="departureTime" name="departureTime" class="form-control txt-1" value="{{ $air->DEPT_TIME }}">
                                                    </td>
                                                    <td>
                                                        <input list="dataCities" id="arrivalCity" name="arrivalCity" class="form-control txt-1" value="{{ $air->ARVL_CITY }}">
                                                    </td>
                                                    <td>
                                                        <input type="date" id="arrivalDate" name="arrivalDate" class="form-control txt-1" value="{{ \Illuminate\Support\Carbon::parse($air->ARVL_DATE)->format('Y-m-d') }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="arrivalTime" name="arrivalTime" class="form-control txt-1" value="{{ $air->ARVL_TIME }}">
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-primary txt-1">Update</button>
                                                    </td>
                                                </tr>
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
                                            <th colspan="2"></th>
                                            <th colspan="3" class="text-center">Cost</th>
                                            <th colspan="5" class="text-center">Sales</th>

                                        </tr>
                                        <tr>
                                            <th><input type="checkbox" id="selectAll"></th>
                                            <th>Code</th>
                                            <th>Currency</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th>Currency</th>
                                            <th>Rate</th>
                                            <th>Amount</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($sfTax))
                                            @foreach ($sfTax as $tax)
                                            <form action="{{ route('sales-folder-air.update', [
                                                'sfNo' => $troNumber,
                                                'docId' => $docId,
                                                'itemNo' => $tax->ITEM_NO,
                                            ]) }}" method="POST">
                                                @csrf
                                                @method("PUT")
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" class="taxCheckbox" value="{{ $tax->ITEM_NO }}">
                                                    </td>
                                                    <td>
                                                        <input list="dataTaxCode" id="taxCode" name="taxCode" value="{{ $tax->TAX_CODE }}" class="form-control txt-1">
                                                        <datalist id="dataTaxCode">
                                                            @if (isset($taxCodes))
                                                                @foreach ($taxCodes as $taxcode)
                                                                    <option value="{{ $taxcode->TAX_CODE }}">{{ $taxcode->TAX_DESCR }}</option>
                                                                @endforeach
                                                            @endif
                                                        </datalist>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="taxCostCurrCode" name="taxCostCurrCode" value="{{ $tax->COST_CURR_CODE }}" class="form-control txt-1">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="taxCostCurrRate" name="taxCostCurrRate" value="{{ $tax->COST_CURR_RATE }}" class="form-control txt-1">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="taxCostCurrAmount" name="taxCostCurrAmount" value="{{ $tax->COST_AMOUNT }}" class="form-control txt-1">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="taxSaleCurrCode" name="taxSaleCurrCode" value="{{ $tax->SELL_CURR_CODE }}" class="form-control txt-1">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="taxSaleCurrRate" name="taxSaleCurrRate" value="{{ $tax->SELL_CURR_RATE }}" class="form-control txt-1">
                                                    </td>
                                                    <td>
                                                        <input type="text" id="taxSaleCurrAmount" name="taxSaleCurrAmount" value="{{ $tax->SELL_AMOUNT }}" class="form-control txt-1">
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-primary txt-1" id="updateTax">Update</button>
                                                    </td>
                                                </tr>
                                                <input type="hidden" name="sfNo" id="sfNo" value="{{ $tax->SF_NO }}">
                                                <input type="hidden" name="docId" id="docId" value="{{ $tax->DOC_ID }}">
                                                <input type="hidden" name="itemNumber" id="itemNumber" value="{{ $tax->ITEM_NO }}">
                                            </form>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-12 justify-content-start d-flex mt-3">
                                <button class="btn btn-danger txt-1" id="deleteSelectedTaxData">Delete Selected</button>
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
                                                    <textarea id="generalRemarks" name="generalRemarks" class="form-control txt-1" rows="5">@if(isset($sfGroup->REMARKS)){{ trim($sfGroup->REMARKS) }}@endif</textarea>
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
                                                    <textarea id="longItineraryDesc" name="longItineraryDesc" class="form-control txt-1" rows="5">@if(isset($sfGroup->LONG_DESCR)){{ trim($sfGroup->LONG_DESCR) }}@endif</textarea>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="airlineReference" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top mt-2">Airline Reference</label>
                                                    <textarea id="airlineReference" name="airlineReference" class="form-control txt-1" rows="5">@if(isset($sfGroup->AIRLINE_REMARKS)){{ trim($sfGroup->AIRLINE_REMARKS) }}@endif</textarea>
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
                                                        <input type="text" name="passengerName" id="passengerName" class="form-control txt-1" value="{{ $pax->PAX_NAME }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="passengerName" id="passengerName" class="form-control txt-1" value="{{ $pax->TICKET_NO }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="passengerName" id="passengerName" class="form-control txt-1" value="{{ $pax->PNR }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
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
        if (window.jQuery) {
            console.log("jQuery is loaded.");
        } else {
            console.log("jQuery is not loaded.");
        }

        const productNameSelect = document.getElementById('productType');
        const categorySelect = document.getElementById('showCategory');
        const routeSelect = document.getElementById('route');
        const itineraryTabs = document.querySelectorAll('.nav-link.itinerary');
        const salesTab = document.getElementById('sales-tab');
        const airTab = document.getElementById('itineraryAir-tab');
        const miscTab = document.getElementById('itineraryMisc-tab');

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
            const unitAmount = parseFloat(unitAmountInput.value.replace(/,/g, '')) || 0;
            const tax = parseFloat(taxInput.value.replace(/,/g, '')) || 0;
            const insurance = parseFloat(costInsuranceInput.value.replace(/,/g, '')) || 0;
            const totalUnitCost = unitAmount + tax + insurance;
            totalUnitCostInput.value = formatNumber(totalUnitCost);
            calculateCostGrandTotal();
        }

        function updateCurrencyQuantity() {
            unitQuantityInput.value = currencyQuantityInput.value;
            calculateCostGrandTotal();
        }

        unitAmountInput.addEventListener('input', updateTotalUnitCost);
        taxInput.addEventListener('input', updateTotalUnitCost);
        costInsuranceInput.addEventListener('input', updateTotalUnitCost);
        currencyQuantityInput.addEventListener('input', updateCurrencyQuantity);

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

        function formatNumber(num) {
            return num.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }

        // Bind the change event to the relevant input fields
        $('#costInsurance, #costTax, #costTotalUnitCost').on('input', function() {
            calculateCostGrandTotal();
        });

        //Initial load cost grand total
        updateTotalUnitCost();
        updateCurrencyQuantity();
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
                            //$('#successMessage').show();
                            //$('#errorMessage').hide();
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
                        //$('#errorMessage').show();
                        //$('#successMessage').hide();
                    }
                });
            } else {
                alert('No passengers selected.');
            }
        });

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
                        url: '{{ route('sales-folder-tax.delete') }}',
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                            sfNo: @json($troNumber),
                            docId: @json($docId),
                            taxIds: selectedIds
                        },
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
                                            '<td><input type="checkbox" class="taxCheckbox" value="' + tax.id + '"></td>' +
                                            '<td>' + tax.TAX_CODE + '</td>' +
                                            '<td>' + tax.COST_CURR_CODE + '</td>' +
                                            '<td>' + tax.COST_CURR_RATE + '</td>' +
                                            '<td>' + tax.COST_AMOUNT + '</td>' +
                                            '<td>' + tax.SELL_CURR_CODE + '</td>' +
                                            '<td>' + tax.SELL_CURR_RATE + '</td>' +
                                            '<td>' + tax.SELL_AMOUNT + '</td>' +
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

        //Update air itinerary
        $('#updateAirItinerary').on('submit', function(event) {
            event.preventDefault();

            var form = $(this);
            var url = form.attr('action');
            var method = form.attr('method');
            var formData = form.serialize();

            $.ajax({
                url: url,
                method: method,
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // Handle success response
                    alert(response.success); // Show success message
                    // You can perform further actions here after successful update
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    var errorMessage = xhr.responseJSON.error || 'Error updating record.';
                    alert(errorMessage); // Show error message
                }
            });
        });

        $('#updateProduct').click(function(e) {
            e.preventDefault();

            // Collect specific field values
            var troNumber = $('#troNumber').val();
            var docId = $('#docId').val();
            var airline = $('#airline').val(); // Assuming this field is present only for 'Air' product type
            var route = $('#route').val();
            var costUnitQuantity = $('#costUnitQuantity').val();
            var costTax = $('#costTax').val();
            var salesCurrencyCode = $('#salesCurrencyCode').val();
            var salesCurrencyAmount = $('#salesCurrencyAmount').val();
            var salesUnitAmount = $('#salesUnitAmount').val();
            var salesDiscountAmount = $('#salesDiscountAmount').val();
            var salesDiscountRate = $('#salesDiscountRate').val();
            var salesCommissionAmount = $('#salesCommissionAmount').val();
            var salesCommissionRate = $('#salesCommissionRate').val();
            var salesSurcharge = $('#salesSurcharge').val();
            var salesTotalUnitAmount = $('#salesTotalUnitAmount').val();
            var salesGrandTotal = $('#salesGrandTotal').val();
            var costUnitAmount = $('#costUnitAmount').val();
            var nonAirNetRate = $('#nonAirNetRate').val();
            var costCommissionAmount = $('#costCommissionAmount').val();
            var costCommissionRate = $('#costCommissionRate').val();
            var costDiscountAmount = $('#costDiscountAmount').val();
            var costDiscountRate = $('#costDiscountRate').val();
            var costInsurance = $('#costInsurance').val();
            var costCurrencyCode = $('#costCurrencyCode').val();
            var costCurrencyAmount = $('#costCurrencyAmount').val();
            var costTotalUnitCost = $('#costTotalUnitCost').val();
            var costGrandTotal = $('#costGrandTotal').val();
            var longItineraryDesc = $('#longItineraryDesc').val();
            var generalRemarks = $('#generalRemarks').val();
            var airlineReference = $('#airlineReference').val();
            var sfGroupSupressPrint = $('#sfGroupSupressPrint').val();
            var sfGroupFlag = $('#sfGroupFlag').val();
            var sfGroupProduct = $('#sfGroupProduct').val();
            var sfGroupId = $('#sfGroupId').val();

            // AJAX request
            $.ajax({
                url: '{{ route('sales-folder-group.update') }}',
                type: 'POST',
                dataType: 'json',
                data: {
                    _token: '{{ csrf_token() }}',
                    _method: 'PUT',
                    troNumber: troNumber,
                    docId: docId,
                    airline: airline,
                    route: route,
                    costUnitQuantity: costUnitQuantity,
                    costTax: costTax,
                    salesCurrencyCode: salesCurrencyCode,
                    salesCurrencyAmount: salesCurrencyAmount,
                    salesUnitAmount: salesUnitAmount,
                    salesDiscountAmount: salesDiscountAmount,
                    salesDiscountRate: salesDiscountRate,
                    salesCommissionAmount: salesCommissionAmount,
                    salesCommissionRate: salesCommissionRate,
                    salesSurcharge: salesSurcharge,
                    salesTotalUnitAmount: salesTotalUnitAmount,
                    salesGrandTotal: salesGrandTotal,
                    costUnitAmount: costUnitAmount,
                    nonAirNetRate: nonAirNetRate,
                    costCommissionAmount: costCommissionAmount,
                    costCommissionRate: costCommissionRate,
                    costDiscountAmount: costDiscountAmount,
                    costDiscountRate: costDiscountRate,
                    costInsurance: costInsurance,
                    costCurrencyCode: costCurrencyCode,
                    costCurrencyAmount: costCurrencyAmount,
                    costTotalUnitCost: costTotalUnitCost,
                    costGrandTotal: costGrandTotal,
                    longItineraryDesc: longItineraryDesc,
                    generalRemarks: generalRemarks,
                    airlineReference: airlineReference,
                    sfGroupSupressPrint: sfGroupSupressPrint,
                    sfGroupFlag: sfGroupFlag,
                    sfGroupProduct: sfGroupProduct,
                    sfGroupId: sfGroupId,
                },
                success: function(response) {
                    console.log('Update successful:', response);
                    alert('Update successful');
                    // Optionally handle success actions here
                },
                error: function(xhr, status, error) {
                    console.error('Update error:', error);
                    console.error('Update error');
                    // Optionally handle error actions here
                }
            });
        });

    });

</script>

@endsection

