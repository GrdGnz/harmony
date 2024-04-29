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

            <!-- Form for Stored Procedure (Stock Supply) :: START -->
            <form>
                @csrf

            <a href="{{ route('searchForm.tro') }}" class="btn marsman-btn-primary txt-1 mb-2">Back to Search</a>

            <div class="card" id="troForm">

                <div class="card-header marsman-bg-color-secondary">
                    <p class="h6 my-1">{{ __('Travel Request Order') }}</p>
                </div>
                <div class="card-body">

                    @if(session('success'))
                        <div style="color: green;">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div style="color: red;">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Tabs -->
                    <ul class="nav nav-tabs mb-3" id="myTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="transaction-tab" data-bs-toggle="tab" data-bs-target="#transaction" role="tab" aria-controls="transaction" aria-selected="true">Transaction Reference</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" role="tab" aria-controls="contact" aria-selected="false">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="production-tab" data-bs-toggle="tab" data-bs-target="#production" role="tab" aria-controls="production" aria-selected="false">Production</a>
                        </li>
                        <li>
                            <a class="btn btn-success txt-1 mx-3">Save Changes</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="transaction" role="tabpanel" aria-labelledby="transaction-tab">

                            <div class="d-flex flex-wrap row">

                                <!-- TRANSACTION REFERENCE -->
                                <div class="card col-lg-6 col-md-12 mb-3">
                                    <div class="card-header marsman-bg-color-darkgray text-white">
                                        <span class="txt-1">Transaction Reference</span>
                                    </div>
                                    <div class="card-body marsman-bg-color-lightgray">
                                        <div class="form-group">
                                            <label for="travelRequestNo" class="form-label my-1 px-1">Travel Request Order No.</label>
                                            <input type="text" id="ebcNumber" name="ebcNumber" class="form-control txt-1" disabled>
                                            <div class="m-2"></div>
                                            <label for="travelRequestDate" class="form-label my-1 px-1">Date</label>
                                            <input type="date" id="ebcDate" name="ebcDate" class="form-control txt-1" disabled>
                                            <div class="m-2"></div>
                                            <label for="tripDate" class="form-label my-1 px-1">Trip Date</label>
                                            <input type="date" id="tripDate" name="tripDate" class="form-control txt-1" disabled>
                                        </div>
                                    </div>
                                </div>

                                <!-- CLIENT -->
                                <div class="card col-lg-6 col-md-12 mb-3">
                                    <div class="card-header marsman-bg-color-darkgray text-white">
                                        <span class="txt-1">Client</span>
                                    </div>
                                    <div class="card-body marsman-bg-color-lightgray">
                                        <div class="form-group">

                                            <a href="{{ route('forms.tro.clients') }}" class="btn btn-primary txt-1">Select Client</a>

                                            <div class="m-2"></div>

                                            <label for="clientType" class="form-label my-1 px-1">*Type</label>
                                            <select id="clientType" name="clientType" class="form-control txt-1">
                                                @foreach($clientTypes as $types)
                                                    <option value="{{ $types->code }}">{{ $types->name }}</option>
                                                @endforeach
                                            </select>

                                            <div class="m-2"></div>

                                            <label for="clientCode" class="form-label my-1 px-1">Code</label>
                                            <input type="text" id="clientCode" name="clientCode"
                                            @if(isset($client->CLT_CODE))
                                                value="{{ $client->CLT_CODE }}"
                                            @endif
                                            class="form-control txt-1">

                                            <div class="m-2"></div>

                                            <label for="clientName" class="form-label my-1 px-1">*Name</label>
                                            <input type="text" id="clientName" name="clientName"
                                            @if(isset($client->FULL_NAME))
                                                value="{{ $client->FULL_NAME }}"
                                            @endif
                                            class="form-control txt-1">

                                            <div class="m-2"></div>

                                            <label for="clientAddress" class="form-label my-1 px-1">Address</label>
                                            <input type="text" id="clientAddress" name="clientAddress"
                                                @if(isset($client->MAIL_ADDRESS))
                                                    value="{{ trim($client->MAIL_ADDRESS) }}"
                                                @endif
                                            class="form-control txt-1">

                                            <div class="m-2"></div>

                                            <label for="category" class="form-label my-1 px-1">*Category</label>
                                            <select name="category" id="category" class="form-control txt-1">
                                                @foreach ($clientCategories as $category)
                                                    <option value="{{ $category->code }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                            <!-- CONTACT -->
                            <div class="card mb-3">
                                <div class="card-header marsman-bg-color-darkgray text-white">
                                    <span class="txt-1">Contact</span>
                                </div>
                                <div class="card-body marsman-bg-color-lightgray">
                                    <div class="form-group">
                                        <label for="contactPhoneNo" class="form-label txt-1">Phone No.</label>
                                        <input type="text" id="contactPhoneNo" name="contactPhoneNo"
                                        @if(isset($client->contact->PHONE_NO))
                                            value="{{ $client->contact->PHONE_NO }}"
                                        @endif
                                        class="form-control txt-1">

                                        <div class="m-2"></div>

                                        <label for="contactFaxNo" class="form-label txt-1">Fax No.</label>
                                        <input type="text" id="contactFaxNo" name="contactFaxNo"
                                        @if(isset($client->contact->FAX_NO))
                                            value="{{ $client->contact->FAX_NO }}"
                                        @endif
                                        class="form-control txt-1">

                                        <div class="m-2"></div>

                                        <label for="contactEmail" class="form-label txt-1">Email</label>
                                        <input type="text" id="contactEmail" name="contactEmail"
                                        @if(isset($client->contact->EMAIL))
                                            value="{{ $client->contact->EMAIL }}"
                                        @endif
                                        class="form-control txt-1">

                                        <div class="m-2"></div>

                                        <label for="contactName" class="form-label txt-1">Name</label>
                                        <input type="text" id="contactName" name="contactName"
                                        @if(isset($client->contact->CONTACT_NAME))
                                            value="{{ $client->contact->CONTACT_NAME }}"
                                        @endif
                                        class="form-control txt-1">

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane fade" id="production" role="tabpanel" aria-labelledby="production-tab">

                            <!-- PRODUCTION -->
                            <div class="card mb-3">
                                <div class="card-header marsman-bg-color-darkgray text-white">
                                    <span class="txt-1">Production</span>
                                </div>
                                <div class="card-body marsman-bg-color-lightgray">
                                    <div class="form-group">
                                        <label for="salesAgentName" class="form-label txt-1">*Sales Agent</label>
                                        <select id="salesAgentName" name="salesAgentName" class="form-control txt-1">
                                            @foreach ($agents as $agent)
                                                <option value="{{ $agent->EMP_ID }}">{{ $agent->FULL_NAME }}</option>
                                            @endforeach
                                        </select>
                                        <div class="m-2"></div>
                                        <label for="salesType" class="form-label txt-1">Sales Type</label>
                                        <select id="salesType" name="salesType" class="form-control txt-1">
                                            @foreach ($salesTypes as $salesType)
                                                <option value="{{ $salesType->SALES_TYPE }}">{{ $salesType->SALES_DESCR }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            </form>

            <!--ADD PRODUCTS -->
            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3 marsman-bg-color-lightgray marsman-border-primary-1" id="productTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="products-tab" data-bs-toggle="tab" data-bs-target="#products" role="tab" aria-controls="products" aria-selected="true">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="reference-tab" data-bs-toggle="tab" data-bs-target="#reference" role="tab" aria-controls="reference" aria-selected="false">Client Reference</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="billing-tab" data-bs-toggle="tab" data-bs-target="#billing" role="tab" aria-controls="billing" aria-selected="false">Billing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mis-tab" data-bs-toggle="tab" data-bs-target="#mis" role="tab" aria-controls="mis" aria-selected="false">MIS</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="invoice-tab" data-bs-toggle="tab" data-bs-target="#invoice" role="tab" aria-controls="invoice" aria-selected="false">Invoice</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="exchange-tab" data-bs-toggle="tab" data-bs-target="#exchange" role="tab" aria-controls="exchange" aria-selected="false">Exchange Order</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="cashAdvance-tab" data-bs-toggle="tab" data-bs-target="#cashAdvance" role="tab" aria-controls="cashAdvance" aria-selected="false">Cash Advance Voucher</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="refund-tab" data-bs-toggle="tab" data-bs-target="#refund" role="tab" aria-controls="refund" aria-selected="false">Refund</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="docRemarks-tab" data-bs-toggle="tab" data-bs-target="#docRemarks" role="tab" aria-controls="docRemarks" aria-selected="false">Document Remarks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="altRemarks-tab" data-bs-toggle="tab" data-bs-target="#altRemarks" role="tab" aria-controls="altRemarks" aria-selected="false">Alternate Remarks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="presetRemarks-tab" data-bs-toggle="tab" data-bs-target="#presetRemarks" role="tab" aria-controls="presetRemarks" aria-selected="false">Preset Remarks</a>
                </li>
            </ul>

            <!-- TAB CONTENTS -->
            <div class="tab-content marsman-bg-color-lightgray p-3">
                <div class="tab-pane fade show active p-3" id="products" role="tabpanel" aria-labelledby="products-tab">
                    <div class="row">
                        <table class="table table-bordered table-striped">
                            <thead class="marsman-bg-color-dark text-white">
                                <tr>
                                    <th>Grp</th>
                                    <th>Prt</th>
                                    <th>Product Name</th>
                                    <th>Cat</th>
                                    <th>PNR</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row justify-content-end w-100">
                        <div class="col-sm-2">
                            <button class="btn btn-success txt-1">Add</button>
                        </div>
                    </div>
                </div>

                <!-- TAB 2 : Client Reference -->
                <div class="tab-pane fade marsman-bg-color-lightblue p-2" id="reference" role="tabpanel" aria-labelledby="reference-tab">
                    <div class="d-flex col-md-12">
                        <div class="form-group col-md-6 p-2">
                            <label for="xoNo" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">XO No.</label>
                            <input type="text" id="xoNo" name="xoNo" class="form-control txt-1 mb-3">
                            <label for="xoDate" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">XO Date</label>
                            <input type="date" id="xoDate" name="xoDate" class="form-control txt-1 mb-3">
                            <label for="traNo" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">TRA No.</label>
                            <input type="text" id="traNo" name="traNo" class="form-control txt-1 mb-3">
                            <label for="dueDate" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Due Date</label>
                            <input type="date" id="dueDate" name="dueDate" class="form-control txt-1">
                        </div>
                        <div class="form-group col-md-6 p-2">
                            <label for="costCenter" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Cost Center</label>
                            <select class="form-select txt-1 mb-3" id="costCenter" name="costCenter">
                            </select>
                            <label for="transDept" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Transmittal Department</label>
                            <select class="form-select txt-1 mb-3" id="transDept" name="transDept">
                            </select>
                            <label for="contact" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Contact</label>
                            <input type="text" id="contact" name="contact" class="form-control txt-1 mb-3">
                            <label for="phoneNo" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Phone No.</label>
                            <input type="text" id="phoneNo" name="phoneNo" class="form-control txt-1 mb-3">
                            <label for="faxNo" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Fax No.</label>
                            <input type="text" id="faxNo" name="faxNo" class="form-control txt-1 mb-3">
                            <label for="email" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Email</label>
                            <input type="text" id="email" name="email" class="form-control txt-1 mb-3">
                        </div>
                    </div>
                </div>
                <!-- TAB 3 : Billing -->
                <div class="tab-pane fade marsman-bg-color-lightblue p-2" id="billing" role="tabpanel" aria-labelledby="billing-tab">
                    <div class="d-flex col-md-12">
                        <div class="form-group col-md-6 p-2">
                            <label for="creditTerm" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Credit Term</label>
                            <select class="form-select txt-1 mb-3" id="creditTerm" name="creditTerm">
                            </select>
                            <label for="daysDue" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Days Due</label>
                            <input type="text" id="daysDue" name="daysDue" class="form-control txt-1 mb-3">
                            <div class="row col-md-12">
                                <div class="col-auto">
                                    <label for="currency" class="marsman-bg-color-dark text-white p-2 m-0 rounded-top">Currency</label>
                                    <input type="text" id="currency" name="currency" class="form-control txt-1 mb-3 col-md-2">
                                </div>
                                <div class="col">
                                    <label for="currencyAmount" class="marsman-bg-color-dark text-white p-2 m-0 rounded-top">Currency Amount</label>
                                    <input type="text" id="currencyAmount" name="currencyAmount" class="form-control txt-1 mb-3 col-md-4">
                                </div>
                            </div>
                            <label for="troAmount" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">TRO Amount</label>
                            <input type="text" id="troAmount" name="troAmount" class="form-control txt-1 mb-3">
                            <label for="invoiceoAmount" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Invoice Amount</label>
                            <input type="text" id="invoiceoAmount" name="invoiceoAmount" class="form-control txt-1 mb-3">
                            <label for="orNumber" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">OR No.</label>
                            <input type="text" id="orNumber" name="orNumber" class="form-control txt-1 mb-3">
                        </div>
                        <div class="form-group col-md-6 p-2">
                            <label for="paymentType" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Payment Type</label>
                            <select class="form-select txt-1 mb-3" id="paymentType" name="paymentType">
                            </select>
                            <label for="cardType" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Card Type</label>
                            <select class="form-select txt-1 mb-3" id="cardType" name="cardType">
                            </select>
                            <label for="cardNo" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Card No.</label>
                            <input type="text" id="cardNo" name="cardNo" class="form-control txt-1 mb-3">
                            <label for="cardHolder" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Card Holder Name</label>
                            <input type="text" id="cardHolder" name="cardHolder" class="form-control txt-1 mb-3">
                            <div class="row col-md-12">
                                <div class="col">
                                    <label for="cardIssueDate" class="marsman-bg-color-dark text-white p-2 m-0 rounded-top">Issue Date</label>
                                    <input type="date" id="cardIssueDate" name="cardIssueDate" class="form-control txt-1 mb-3 col-md-4">
                                </div>
                                <div class="col">
                                    <label for="cardExpiryDate" class="marsman-bg-color-dark text-white p-2 m-0 rounded-top">Expiry Date</label>
                                    <input type="date" id="cardExpiryDate" name="cardExpiryDate" class="form-control txt-1 mb-3 col-md-4">
                                </div>
                            </div>
                            <label for="bank" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Bank</label>
                            <input type="text" id="bank" name="bank" class="form-control txt-1 mb-3">
                            <div class="row col-md-12">
                                <div class="col-auto">
                                    <label for="surcharge" class="marsman-bg-color-dark text-white p-2 m-0 rounded-top">Surcharge</label>
                                    <input type="text" id="surcharge" name="surcharge" class="form-control txt-1 mb-3 col-md-4">
                                </div>
                                <div class="col">
                                    <label for="approvalCode" class="marsman-bg-color-dark text-white p-2 m-0 rounded-top">Approval Code</label>
                                    <input type="text" id="approvalCode" name="approvalCode" class="form-control txt-1 mb-3 col-md-4">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TAB 4 : MIS -->
                <div class="tab-pane fade marsman-bg-color-lightblue p-2" id="mis" role="tabpanel" aria-labelledby="mis-tab">
                    <div class="d-flex col-md-12">
                        <div class="form-group col-md-6 p-2">
                            <label for="prefPNR" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Pref. PNR</label>
                            <input type="text" id="prefPNR" name="prefPNR" class="form-control txt-1 mb-3">
                            <label for="prefPax" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Pref. Pax</label>
                            <input type="text" id="prefPax" name="prefPax" class="form-control txt-1 mb-3">
                            <label for="department" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Department</label>
                            <select class="form-select txt-1 mb-3" id="department" name="department">
                            </select>
                            <label for="branch" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Branch</label>
                            <select class="form-select txt-1 mb-3" id="branch" name="branch">
                            </select>
                            <label for="workgroup" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Workgroup</label>
                            <select class="form-select txt-1 mb-3" id="workgroup" name="workgroup">
                            </select>
                            <div class="row col-md-12">
                                <div class="col-auto">
                                    <label for="roeCurrency" class="marsman-bg-color-dark text-white p-2 m-0 rounded-top">ROE Currency</label>
                                    <input type="text" id="roeCurrency" name="roeCurrency" class="form-control txt-1 mb-3 col-md-2">
                                </div>
                                <div class="col">
                                    <label for="roeAmount" class="marsman-bg-color-dark text-white p-2 m-0 rounded-top">ROE Amount</label>
                                    <input type="text" id="roeAmount" name="roeAmount" class="form-control txt-1 mb-3 col-md-4">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6 p-2">
                            <label for="bookedBy" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Nooked By</label>
                            <select class="form-select txt-1 mb-3" id="bookedBy" name="bookedBy">
                            </select>
                            <label for="issuedBy" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Issued By</label>
                            <select class="form-select txt-1 mb-3" id="issuedBy" name="issuedBy">
                            </select>
                            <label for="secondaryStatus" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Secondary Status</label>
                            <select class="form-select txt-1 mb-3" id="secondaryStatus" name="secondaryStatus">
                            </select>
                        </div>
                    </div>
                </div>
                <!-- TAB 5 : Invoice -->
                <div class="tab-pane fade p-3" id="invoice" role="tabpanel" aria-labelledby="invoice-tab">

                    <div class="row table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="marsman-bg-color-dark text-white">
                                <tr class="no-wrap">
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Inv. No.</th>
                                    <th>Mnl. Inv. No.</th>
                                    <th>Date</th>
                                    <th>Posted</th>
                                    <th>Client Name</th>
                                    <th>Curr.</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="no-wrap">
                                    <td></td>
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
                    <div class="row justify-content-end w-100">
                        <div class="col-sm-2">
                            <button class="btn btn-success txt-1">New</button>
                        </div>
                    </div>

                </div>
                <!-- TAB 6 : Exchange Order -->
                <div class="tab-pane fade p-3" id="exchange" role="tabpanel" aria-labelledby="exchange-tab">

                    <div class="row table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="marsman-bg-color-dark text-white">
                                <tr class="no-wrap">
                                    <th>Status</th>
                                    <th>XO No.</th>
                                    <th>Mnl XO No.</th>
                                    <th>Date</th>
                                    <th>Supplier Name</th>
                                    <th>Posted</th>
                                    <th>Curr.</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="no-wrap">
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
                    <div class="row justify-content-end w-100">
                        <div class="col-sm-2">
                            <button class="btn btn-success txt-1">New</button>
                        </div>
                    </div>

                </div>
                <!-- TAB 7 : Cash Advance Voucher -->
                <div class="tab-pane fade p-3" id="cashAdvance" role="tabpanel" aria-labelledby="cashAdvance-tab">

                    <div class="row table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="marsman-bg-color-dark text-white">
                                <tr class="no-wrap">
                                    <th>Status</th>
                                    <th>CAV No.</th>
                                    <th>Mnl CAV No.</th>
                                    <th>Date</th>
                                    <th>Documentation Officer</th>
                                    <th>Curr.</th>
                                    <th>Rate</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="no-wrap">
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
                    <div class="row justify-content-end w-100">
                        <div class="col-sm-2">
                            <button class="btn btn-success txt-1">New</button>
                        </div>
                    </div>

                </div>
                <!-- TAB 8 : Refund -->
                <div class="tab-pane fade" id="refund" role="tabpanel" aria-labelledby="refund-tab">

                    <div class="row table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="marsman-bg-color-dark text-white">
                                <tr class="no-wrap">
                                    <th>Status</th>
                                    <th>Refund No.</th>
                                    <th>Date</th>
                                    <th>Category</th>
                                    <th>Document No.</th>
                                    <th>Passenger Name</th>
                                    <th>Supplier</th>
                                    <th>PNR</th>
                                    <th>Airline</th>
                                    <th>Original</th>
                                    <th>Refunded</th>
                                    <th>Client Name</th>
                                    <th>Reason for Refund</th>
                                    <th>Payment Type</th>
                                    <th>Office ID</th>
                                    <th>User ID</th>
                                    <th>Date</th>
                                    <th>Office ID</th>
                                    <th>User ID</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="no-wrap">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
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
                    <div class="row justify-content-end w-100">
                        <div class="col-sm-2">
                            <button class="btn btn-success txt-1">New</button>
                        </div>
                    </div>

                </div>
                <!-- TAB 9 : Document Remarks -->
                <div class="tab-pane fade" id="docRemarks" role="tabpanel" aria-labelledby="docRemarks-tab">
                    <div class="d-flex col-md-12">
                        <div class="form-group col-md-6 p-2">
                            <div class="row p-2">
                                <label for="troRemarks" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Travel Request Order</label>
                                <textarea id="troRemarks" name="troRemarks" class="form-control"></textarea>
                            </div>
                            <div class="row p-2">
                                <label for="eoRemarks" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Travel Request Order</label>
                                <textarea id="eoRemarks" name="eoRemarks" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-md-6 p-2">
                            <div class="row p-2">
                                <label for="invRemarks" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Travel Request Order</label>
                                <textarea id="invRemarks" name="invRemarks" class="form-control"></textarea>
                            </div>
                            <div class="row p-2">
                                <label for="caRemarks" class="form-label marsman-bg-color-dark text-white p-2 m-0 rounded-top">Travel Request Order</label>
                                <textarea id="caRemarks" name="caRemarks" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TAB 10 : Alternate Remarks -->
                <div class="tab-pane fade" id="altRemarks" role="tabpanel" aria-labelledby="altRemarks-tab">
                    <div class="col-md-12 p-3">
                        <textarea id="txtAltRemarks" name="txtAltRemarks" class="form-control" rows="10"></textarea>
                    </div>
                </div>
                <!-- TAB 11 : Preset Remarks -->
                <div class="tab-pane fade" id="presetRemarks" role="tabpanel" aria-labelledby="presetRemarks-tab">
                    <div class="col-md-12 p-3">
                        <textarea id="txtPresetRemarks" name="txtPresetRemarks" class="form-control" rows="10"></textarea>
                    </div>
                </div>
            </div>

        </main>

    </div>
</div>

<style>
/* Adjustments for two-column layout on desktop */
@media only screen and (min-width: 992px) {
    #troForm .card {
        width: 48%; /* Adjusted width for two columns */
        margin-right: 2%; /* Spacing between columns */
    }

    #troForm .card:nth-child(2n) {
        margin-right: 0; /* Remove margin from every second card to prevent extra spacing */
    }
}

.nav-tabs li a {
    cursor: pointer;
}

.no-wrap th, .no-wrap td {
      white-space: nowrap;
    }
</style>

@endsection

