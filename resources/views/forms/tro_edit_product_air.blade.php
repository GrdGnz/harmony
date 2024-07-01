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
                                <table id="airItineraryTable" class="table table-bordered">
                                    <thead class="marsman-bg-color-darkgray text-white">
                                        <tr>
                                            <th></th>
                                            <th colspan="2"></th>
                                            <th colspan="3" class="text-center">Departure</th>
                                            <th colspan="3" class="text-center">Arrival</th>
                                            <th colspan="2"></th>
                                        </tr>
                                        <tr>
                                            <th><input type="checkbox" id="selectAllAirItinerary"></th>
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
                                            ]) }}" method="POST" class="update-air-form" id="updateAirItinerary">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="sfNo" id="sfNoAirItinerary" value="{{ $air->SF_NO }}">
                                                <input type="hidden" name="docId" id="docIdAirItinerary" value="{{ $air->DOC_ID }}">
                                                <input type="hidden" name="itemNumber" id="itemNumberAirItinerary" value="{{ $air->ITEM_NO }}">
                                                <tr data-sf-no="{{ $air->SF_NO }}" data-doc-id="{{ $air->DOC_ID }}" data-item-no="{{ $air->ITEM_NO }}">
                                                    <td>
                                                        <input type="checkbox" name="selectedAirItinerary[]" value="{{ $air->ITEM_NO }}" class="select-item-air-itinerary">
                                                    </td>
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

                            <button id="deleteAirItinerary" class="btn btn-danger txt-1">Delete Selection</button>

                            <hr class="w-100">

                            <form action="{{ route('sales-folder-air.store') }}" method="POST" id="addAirItineraryForm">
                                @csrf
                                <input type="hidden" id="sfNo" name="sfNo" value="{{ $troNumber }}">
                                <input type="hidden" id="docId" name="docId" value="{{ $docId }}">
                                <div class="col-md-12 d-flex">
                                    <!-- Column 1 -->
                                    <div class="col-md-6 p-1">
                                        <div class="card mt-2">
                                            <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                                <p class="mx-2 my-2">{{ __('FLIGHT DETAILS') }}</p>
                                            </div>
                                            <div class="card-body marsman-bg-color-gray1">
                                                <div class="form-group mb-2">
                                                    <label for="airlineNew" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Airline</label>
                                                    <select id="airlineNew" name="airlineNew" class="form-control form-select txt-1">
                                                        @if (isset($airlines))
                                                            @foreach ($airlines as $airline)
                                                                <option value="{{ $airline->AL_CODE }}">{{ $airline->AL_DESCR }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="flightNumberNew" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Flight Number</label>
                                                    <input type="text" class="form-control txt-1" id="flightNumberNew" name="flightNumberNew">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="serviceClassNew" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Service Class</label>
                                                    <select id="serviceClassNew" name="serviceClassNew" class="form-control form-select txt-1">
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
                                                    <label for="departureCityNew" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">City</label>
                                                    <select id="departureCityNew" name="departureCityNew" class="form-control form-select txt-1">
                                                        @if (isset($cities))
                                                            @foreach ($cities as $city)
                                                                <option value="{{ $city->CITY_CODE }}">{{ $city->CITY_DESCR }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="departureDateNew" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Date</label>
                                                    <input type="date" class="form-control txt-1" id="departureDateNew" name="departureDateNew" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="departureTimeNew" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Time</label>
                                                    <input type="text" class="form-control txt-1" id="departureTimeNew" name="departureTimeNew" value="1200">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mt-2 col-md-6 m-1">
                                            <div class="card-header m-0 p-0 marsman-bg-color-darkgray text-white">
                                                <p class="mx-2 my-2">{{ __('ARRIVAL') }}</p>
                                            </div>
                                            <div class="card-body marsman-bg-color-gray1">
                                                <div class="form-group mb-2">
                                                    <label for="arrivalCityNew" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">City</label>
                                                    <select id="arrivalCityNew" name="arrivalCityNew" class="form-control form-select txt-1">
                                                        @if (isset($cities))
                                                            @foreach ($cities as $city)
                                                                <option value="{{ $city->CITY_CODE }}">{{ $city->CITY_DESCR }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="arrivalDateNew" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Date</label>
                                                    <input type="date" class="form-control txt-1" id="arrivalDateNew" name="arrivalDateNew" min="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}" value="{{ \Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">
                                                </div>
                                                <div class="form-group mb-2">
                                                    <label for="arrivalTimeNew" class="form-label marsman-bg-color-label text-white txt-1 p-2 m-0 rounded-top">Time</label>
                                                    <input type="text" class="form-control txt-1" id="arrivalTimeNew" name="arrivalTimeNew" value="1200">
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
                                    <button type="submit" class="btn btn-primary txt-1">Add</button>
                                </div>
                            </form>

                        </div>

                        <!-- Tab 4 :: Taxes -->
                        <div class="tab-pane fade show" id="addtaxes" role="tabpanel" aria-labelledby="addtaxes-tab">
                            <h4>Taxes</h4>

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

                            <hr class="w-100">

                            <!-- Add new tax data -->
                            <form id="taxAddForm" action="{{ route('sales-folder-tax.store') }}" method="post">
                                @csrf
                                <input type="hidden" id="sfNo" name="sfNo" value="{{ $troNumber }}">
                                <input type="hidden" id="docId" name="docId" value="{{ $docId }}">

                            <div class="col-md-12 d-flex">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header m-0 p-0"></div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="form-group">
                                                <label for="taxCodeNew" class="form-label marsman-bg-color-label text-white m-0 p-2 rounded-top">Tax Code</label>
                                                <select id="taxCode" name="taxCodeNew" class="form-control form-select txt-1">
                                                    @if(isset($taxCodes))
                                                        @foreach ($taxCodes as $tax)
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
                                                <label for="taxCostCurrCodeNew" class="form-label marsman-bg-color-label text-white m-0 p-2 rounded-top">Cost Currency Code</label>
                                                <select id="taxCostCurrCodeNew" name="taxCostCurrCodeNew" class="form-control form-select txt-1">
                                                    <option value="PHP">PHP</option>
                                                    <option value="USD">USD</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="taxCostCurrRateNew" class="form-label marsman-bg-color-label text-white m-0 p-2 rounded-top">Cost Currency Rate</label>
                                                <input type="number" id="taxCostCurrRateNew" name="taxCostCurrRateNew" class="form-control txt-1" value="0">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="taxCostCurrAmountNew" class="form-label marsman-bg-color-label text-white m-0 p-2 rounded-top">Cost Currency Amount</label>
                                                <input type="number" id="taxCostCurrAmountNew" name="taxCostCurrAmountNew" class="form-control txt-1" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header m-0 p-0"></div>
                                        <div class="card-body marsman-bg-color-gray1">
                                            <div class="form-group mb-2">
                                                <label for="taxSaleCurrCodeNew" class="form-label marsman-bg-color-label text-white m-0 p-2 rounded-top">Sale Currency Code</label>
                                                <select id="taxSaleCurrCodeNew" name="taxSaleCurrCodeNew" class="form-control form-select txt-1">
                                                    <option value="PHP">PHP</option>
                                                    <option value="USD">USD</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="taxSaleCurrRateNew" class="form-label marsman-bg-color-label text-white m-0 p-2 rounded-top">Sale Currency Rate</label>
                                                <input type="number" id="taxSaleCurrRateNew" name="taxSaleCurrRateNew" class="form-control txt-1" value="0">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label for="taxSaleCurrAmountNew" class="form-label marsman-bg-color-label text-white m-0 p-2 rounded-top">Sale Currency Amount</label>
                                                <input type="number" id="taxSaleCurrAmountNew" name="taxSaleCurrAmountNew" class="form-control txt-1" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 justify-content-end d-flex mt-3">
                                <button type="submit" class="btn btn-primary txt-1" id="addTaxData">Add Tax</button>
                            </div>

                            </form>
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

                        <!-- Tab 7 :: Passenger -->
                        <div class="tab-pane fade show" id="passenger" role="tabpanel" aria-labelledby="passenger-tab">
                            <p class="h3">Passenger</p>

                            <div class="table-responsive">
                                <table id="passengerList" class="table table-bordered">
                                    <thead class="marsman-bg-color-darkgray text-white">
                                        <tr>
                                            <th><input type="checkbox" id="selectAllPax"></th>
                                            <th>Passenger Name</th>
                                            <th>Ticket Number</th>
                                            <th>PNR</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($infoPax))
                                            @foreach ($infoPax as $pax)
                                                <tr data-sf-no="{{ $pax->SF_NO }}" data-doc-id="{{ $pax->DOC_ID }}" data-item-no="{{ $pax->ITEM_NO }}">
                                                    <td><input type="checkbox" class="rowCheckbox"></td>
                                                    <td>
                                                        <input type="text" name="passengerName" class="form-control txt-1 passenger-name" value="{{ $pax->PAX_NAME }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="ticketNumber" class="form-control txt-1 ticket-number number-only" value="{{ $pax->TICKET_NO }}">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="pnr" class="form-control txt-1 pnr" value="{{ $pax->PNR }}">
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary txt-1 form-control updatePax">Update</button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <button id="deletePaxSelection" class="btn btn-danger txt-1">Delete Selection</button>
                            <hr class="w-100">

                            <div class="col-md-12 d-flex mt-2">
                                <div class="col-md-6">
                                    <div class="card-body marsman-bg-color-gray1">
                                        <div class="form-group">
                                            <label for="passengerNameNew" class="form-label txt-1 marsman-bg-color-label text-white rounded-top p-2 m-0">Passenger Name</label>
                                            <input type="text" class="form-control txt-1" id="passengerNameNew" name="passengerNameNew">
                                        </div>
                                        <div class="form-group mt-2">
                                            <label for="passengerPNRNew" class="form-label txt-1 marsman-bg-color-label text-white rounded-top p-2 m-0">PNR</label>
                                            <input type="text" class="form-control txt-1" id="passengerPNRNew" name="passengerPNRNew" maxlength="6">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body marsman-bg-color-gray1">
                                        <div class="form-group">
                                            <label for="passengerTicketNumberNew" class="form-label txt-1 marsman-bg-color-label text-white rounded-top p-2 m-0">Ticket Number</label>
                                            <input type="text" class="form-control txt-1 number-only" id="passengerTicketNumberNew" name="passengerTicketNumberNew" maxlength="10">
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
        const taxTab = document.getElementById('addtaxes-tab');

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

        // Select all elements with the class 'number-only'
        const numberInputs = document.querySelectorAll('.number-only');

        // Default tabs depending on scenarios
        @if (session('newRecord'))
                new bootstrap.Tab(airTab).show();
                airTab.style.display = 'block';
        @endif
        @if (session('newTaxRecord') || session('deletedTaxRecords'))
                new bootstrap.Tab(taxTab).show();
                taxTab.style.display = 'block';
        @endif

        // Add an event listener to each element and not allow letters
        numberInputs.forEach(function(input) {
            input.addEventListener('keydown', function(event) {
                // Allow control keys like backspace, tab, enter, etc.
                const allowedKeys = [
                    'Backspace', 'ArrowLeft', 'ArrowRight', 'ArrowUp', 'ArrowDown',
                    'Tab', 'Enter', 'Delete'
                ];

                // Allow numeric keys, numpad keys, and allowed control keys
                if (
                    (event.key >= '0' && event.key <= '9') ||
                    (event.key >= 'Numpad0' && event.key <= 'Numpad9') ||
                    allowedKeys.includes(event.key)
                ) {
                    return; // Allow the keypress
                } else {
                    event.preventDefault(); // Prevent the keypress
                    alert('Letters are not allowed. Please enter numbers only.');
                }
            });
        });

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

        // Handle select all checkbox
        $('#selectAll').on('change', function() {
            $('.taxCheckbox').prop('checked', $(this).prop('checked'));
        });

        // Handle delete selected tax data
        $('#deleteSelectedTaxData').click(function() {
            var selectedIds = $('.taxCheckbox:checked').map(function() {
                return $(this).val();
            }).get();

            if (selectedIds.length > 0) {
                if (confirm('Are you sure you want to delete the selected tax data?')) {
                    var records = selectedIds.map(function(itemId) {
                        var row = $('#taxList').find('input[value="' + itemId + '"]').closest('tr');
                        return {
                            sfNo: @json($troNumber),
                            docId: @json($docId),
                            itemNo: itemId // ITEM_NO from checkbox value
                        };
                    });

                    console.log('Selected Records:', records); // Debugging line

                    $.ajax({
                        url: '{{ route("sales-folder-tax.deleteMultiple") }}',
                        type: 'DELETE',
                        data: {
                            records: records,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            // Redirect back to the previous page
                            window.location.href = '{{ route("sales-folder-tax.successDelete") }}';
                        },
                        error: function(xhr) {
                            console.error('Error:', xhr.responseText); // Improved error logging
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

        // Update air itinerary
        $(document).on('submit', '.update-air-form', function(event) {
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
            var fareCalculation = $('#fareCalculation').val();
            var paxDescription = $('#paxDescription').val();

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
                    fareCalculation: fareCalculation,
                    paxDescription: paxDescription
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).on('click', '.updatePax', function() {
            var row = $(this).closest('tr');
            var sfNo = row.data('sf-no');
            var docId = row.data('doc-id');
            var itemNo = row.data('item-no');
            var paxName = row.find('.passenger-name').val();
            var ticketNo = row.find('.ticket-number').val();
            var pnr = row.find('.pnr').val();

            $.ajax({
                url: '{{ url('/sales-folder-pax/update') }}/' + sfNo + '/' + docId + '/' + itemNo,
                type: 'POST', // Use POST method for AJAX
                data: {
                    paxName: paxName,
                    ticketNo: ticketNo,
                    pnr: pnr,
                    _token: '{{ csrf_token() }}',
                    _method: 'PUT' // Spoof PUT method
                },
                success: function(response) {
                    if (response.success) {
                        alert('Record updated successfully.');
                    } else {
                        alert('Error: ' + response.error);
                    }
                },
                error: function(xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });

        //Select all passengers
        $('#selectAllPax').change(function() {
            $('.rowCheckbox').prop('checked', this.checked);
        });


        //Delete selected passengers
        $('#deletePaxSelection').click(function() {
            let idsToDelete = [];
            $('.rowCheckbox:checked').each(function() {
                let tr = $(this).closest('tr');
                idsToDelete.push({
                    sf_no: tr.data('sf-no'),
                    doc_id: tr.data('doc-id'),
                    item_no: tr.data('item-no')
                });
            });

            if (idsToDelete.length > 0) {
                let confirmed = confirm('Are you sure you want to delete the selected records?');
                if (confirmed) {
                    $.ajax({
                        url: '{{ route("sales-folder-pax.deleteMultiple") }}',
                        type: 'DELETE',
                        data: {
                            ids: idsToDelete,
                            sfNo: @json($troNumber),
                            docId: @json($docId),
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log(response.success);

                            //Update quantity values in product
                            $('#costCurrencyQuantity').val(response.totalCount);
                            $('#costUnitQuantity').val(response.totalCount);
                            calculateCostGrandTotal();

                            $('.rowCheckbox:checked').closest('tr').remove();
                        },
                        error: function(response) {
                            console.log(response.error);
                        }
                    });
                }
            } else {
                alert('No records selected');
            }
        });

        //Add passenger data
        $('#addPax').click(function(e) {
            e.preventDefault();

            let passengerName = $('#passengerNameNew').val();
            let passengerPNR = $('#passengerPNRNew').val();
            let passengerTicketNumber = $('#passengerTicketNumberNew').val();
            let sf_no = @json($sfGroup->SF_NO);
            let doc_id = @json($sfGroup->DOC_ID);
            let productCategory = @json($sfGroup->PROD_CAT);

            $.ajax({
                url: '{{ route("sales-folder-pax.store") }}',
                type: 'POST',
                data: {
                    passengerName: passengerName,
                    passengerPNR: passengerPNR,
                    passengerTicketNumber: passengerTicketNumber,
                    sf_no: sf_no,
                    doc_id: doc_id,
                    productCategory: productCategory,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    alert(response.message);

                    $('#costCurrencyQuantity').val(response.totalCount);
                    $('#costUnitQuantity').val(response.totalCount);
                    calculateCostGrandTotal();

                    if (response.data) {
                        const tableBody = $('#passengerList tbody');
                        tableBody.empty();
                        response.data.forEach(function(row) {
                            console.log("Appending row:", row);
                            tableBody.append(`
                                <tr data-sf-no="${row.SF_NO}" data-doc-id="${row.DOC_ID}" data-item-no="${row.ITEM_NO}">
                                    <td><input type="checkbox" class="rowCheckbox"></td>
                                    <td>
                                        <input type="text" name="passengerName" class="form-control txt-1 passenger-name" value="${row.PAX_NAME}">
                                    </td>
                                    <td>
                                        <input type="text" name="ticketNumber" class="form-control txt-1 ticket-number" value="${row.TICKET_NO}">
                                    </td>
                                    <td>
                                        <input type="text" name="pnr" class="form-control txt-1 pnr" value="${row.PNR}">
                                    </td>
                                    <td><button class="btn btn-primary txt-1 form-control updatePax">Update</button></td>
                                </tr>
                            `);
                        });
                    }

                    // Clear the form fields
                    $('#passengerNameNew').val('');
                    $('#passengerTicketNumberNew').val('');
                    $('#passengerPNRNew').val('');
                },
                error: function(response) {
                    console.log(response);
                    alert('Error adding passenger. Please check data provided.');
                }
            });
        });

        //Select all air itinerary
        document.getElementById('selectAllAirItinerary').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.select-item-air-itinerary');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

         //Delete air itinerary
         $('#deleteAirItinerary').click(function() {
            var selected = $('.select-item-air-itinerary:checked');
            var records = selected.map(function() {
                var tr = $(this).closest('tr');
                return {
                    sfNo: tr.data('sf-no'),
                    docId: tr.data('doc-id'),
                    itemNo: tr.data('item-no')
                };
            }).get();

            if (records.length > 0) {
                console.log('Selected Records:', records); // Debugging line

                $.ajax({
                    url: '{{ route("sales-folder-air.deleteMultiple") }}',
                    type: 'DELETE',
                    data: {
                        records: records,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            // Remove deleted rows from the table
                            selected.closest('tr').remove();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText); // Improved error logging
                    }
                });
            } else {
                alert('No items selected.');
            }
        });

    });

</script>

@endsection

