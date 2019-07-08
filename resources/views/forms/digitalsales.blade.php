@extends('layouts.app')
@section('title','Digital Sales Form')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-wpforms"></i>
   </div>
   <div class="header-title">
      <h1>Digital Sales Form</h1>
      <small></small>
   </div>
</section>
<!-- Main content -->
<section class="content">
   <div class="row">
        <div class="col-lg-12 pinpin">
            <div class="card" id="lobicard-custom-control" data-sortable="true">
                <div class="card-header">
                    <div class="card-title custom_title">
                        <h4>SERVICE AGREEMENT</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('digitalsalesform') }}" method="POST" id="form_add">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="header_business_name">Business Name</label>
                                    <input type="text" id="header_business_name" name="header_business_name" class="form-control" placeholder="Business Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="header_state">State</label>
                                    <input type="text" id="header_state" name="header_state" class="form-control" placeholder="State">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="header_ref_no">Ref No</label>
                                    <input type="text" id="header_ref_no" name="header_ref_no" class="form-control" placeholder="Ref No">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="header_staff_ref">Staff Ref</label>
                                    <input type="text" id="header_staff_ref" name="header_staff_ref" class="form-control" placeholder="Staff Ref">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="header_customer_req">Request For</label>
                                    <select name="header_customer_req" id="header_customer_req" class="form-control">
                                        <option value="">Select Request Type</option>
                                        @foreach( get_direct_debit_form_customer_type() as $k => $v )
                                            <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h5 class="bd-t p-t-4 bd-b p-b-4">Customer Details</h5>

                        <div class="row p-t-4">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="main_company_name">Company Name</label>
                                    <input type="text" id="main_company_name" name="main_company_name" class="form-control" placeholder="Company Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="main_customer_name">Customer Name <small>(Given Name/s)</small></label>
                                    <input type="text" id="main_customer_name" name="main_customer_name" class="form-control" placeholder="Customer Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="main_customer_surname">Customer Surname</label>
                                    <input type="text" id="main_customer_surname" name="main_customer_surname" class="form-control" placeholder="Customer Surname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="main_customer_address_line_1">Address <small>(Street Name and Number)</small></label>
                                    <input type="text" id="main_customer_address_line_1" name="main_customer_address_line_1" class="form-control" placeholder="Street Name and Number">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="main_customer_suburb">Suburb </label>
                                    <input type="text" id="main_customer_suburb" name="main_customer_suburb" class="form-control" placeholder="Suburb">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="main_customer_state">State</label>
                                    <select name="main_customer_state" id="main_customer_state" class="form-control">
                                        <option value="">Select State</option>
                                        @foreach( get_states() as $k => $v )
                                        <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="main_customer_postcode">Postcode</label>
                                    <input type="text" id="main_customer_postcode" name="main_customer_postcode" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Postcode">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="main_customer_contact_home">Telephone (H)</label>
                                    <input type="text" id="main_customer_contact_home" name="main_customer_contact_home" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Telephone (H)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="main_customer_contact_work">Telephone (W)</label>
                                    <input type="text" id="main_customer_contact_work" name="main_customer_contact_work" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Telephone (W)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="main_customer_contact_mobile">Telephone (M)</label>
                                    <input type="text" id="main_customer_contact_mobile" name="main_customer_contact_mobile" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Telephone (M)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="main_customer_email">Email Address</label>
                                    <input type="email" id="main_customer_email" name="main_customer_email" class="form-control" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="main_customer_driver_licence_no">Driver's Licence No</label>
                                    <input type="text" id="main_customer_driver_licence_no" name="main_customer_driver_licence_no" class="form-control" placeholder="Driver's Licence No">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="main_customer_dob">DOB</label>
                                    <input type="text" id="main_customer_dob" name="main_customer_dob" class="form-control" placeholder="YYYY/MM/DD">
                                </div>
                            </div>
                        </div>

                        <h5 class="bd-t p-t-4 bd-b p-b-4">Payment Details</h5>

                        <div class="row p-t-4">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="payment_details_regular_debit_amt">Regular Debit <small>Amount</small></label>
                                    <input type="text" id="payment_details_regular_debit_amt" name="payment_details_regular_debit_amt" onkeypress="return isNumberOrSpaceKey(event)" class="form-control" placeholder="$">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="payment_details_commencing_on">Commencing on</label>
                                    <input type="text" id="payment_details_commencing_on" name="payment_details_commencing_on" class="form-control" placeholder="YYYY/MM/DD">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h6><strong>NOTE:</strong> A SET UP FEE of <strong>$11.00</strong> will be added to the first payment only.</h6>
                                <div class="form-group">
                                    <label for="payment_details_special_condition">Special Conditions</label>
                                    <input type="text" id="payment_details_special_condition" name="payment_details_special_condition" class="form-control" placeholder="Special Conditions">
                                </div>
                            </div>
                        </div>

                        <h5 class="bd-t p-t-4 bd-b p-b-4">Direct Debit From Bank Account</h5>
                        <div class="row p-t-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="direct_debit_bank_bank_name">Bank Name</label>
                                    <input type="text" id="direct_debit_bank_bank_name" name="direct_debit_bank_bank_name" class="form-control" placeholder="Bank Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="direct_debit_bank_branch_account">Branch Account Opened</label>
                                    <input type="text" id="direct_debit_bank_branch_account" name="direct_debit_bank_branch_account" class="form-control" placeholder="Branch Account Opened">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="direct_debit_bank_bsb_number">BSB Number</label>
                                    <input type="email" id="direct_debit_bank_bsb_number" name="direct_debit_bank_bsb_number" class="form-control" placeholder="BSB Number">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="direct_debit_bank_account_number">Account Number</label>
                                    <input type="text" id="direct_debit_bank_account_number" name="direct_debit_bank_account_number" class="form-control" placeholder="Account Number">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="main_customer_dob">(Not transaction card #)</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="direct_debit_bank_account_holder_name">Account Holder Name <small>(as it appears on bank statement)</small></label>
                                    <input type="text" id="direct_debit_bank_account_holder_name" name="direct_debit_bank_account_holder_name" class="form-control" placeholder="Account Holder Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="direct_debit_bank_account_holder_surname">Account Holder Surname</label>
                                    <input type="text" id="direct_debit_bank_account_holder_surname" name="direct_debit_bank_account_holder_surname" class="form-control" placeholder="Account Holder Surname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>I/We authorize FFA PaySmart Pty Ltd User ID 073053 to debit my/our account at the Bank identified above through the Bulk Electronic Clearing System (BECS) in accordance to the Payment Details above and as per the Service Agreement provided</label>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="direct_debit_bank_verified_by">Verified By</label>
                                    <input type="text" id="direct_debit_bank_verified_by" name="direct_debit_bank_verified_by" class="form-control" placeholder="Verified By">
                                </div>
                            </div>
                        </div>
                        <h5 class="bd-t p-t-4 bd-b p-b-4">Debit From Credit Card</h5>

                        <div class="row p-t-4">
                            <div class="col-md-12" id="card_type_data">
                                <span>Please charge payments as detailed above to my: (checked one)
                                    &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="debit_credit_card_card_type" value="1" id="card_visa">
                                    <label for="card_visa">{{ get_credit_card_type(1) }}</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="debit_credit_card_card_type" value="2" id="card_mastercard">
                                    <label for="card_mastercard">{{ get_credit_card_type(2) }}</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="debit_credit_card_card_type" value="3" id="card_amex">
                                    <label for="card_amex">{{ get_credit_card_type(3) }}</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <input type="radio" name="debit_credit_card_card_type" value="4" id="card_diners">
                                    <label for="card_diners">{{ get_credit_card_type(4) }}</label>
                                </span>
                            </div>
                        </div>
                        <div class="row p-t-4">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="debit_credit_card_name">Name on Card <small>(Given Name/s)</small></label>
                                    <input type="text" id="debit_credit_card_name" name="debit_credit_card_name" class="form-control" placeholder="Name on Card">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="debit_credit_card_surname">Surname</label>
                                    <input type="text" id="debit_credit_card_surname" name="debit_credit_card_surname" class="form-control" placeholder="Surname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <label>Note: FFA PaySmart will appear on your credit card statement</label>
                            </div>
                            <div class="col-md-4">
                                <label>(Not transaction card #)</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="debit_credit_card_number">Credit Card Number</label>
                                    <input type="text" id="debit_credit_card_number" name="debit_credit_card_number" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Credit Card Number">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="debit_credit_card_expiry_date">Expiry Date</label>
                                    <input type="text" id="debit_credit_card_expiry_date" name="debit_credit_card_expiry_date" class="form-control" placeholder="YYYY/MM">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label>By signing below, I understand that a surcharge of 1.6% for Visa and Mastercard and 3.5% for Amex and Diners will be added to each payment (Delete if not applicable)</label>
                            </div>
                            <div class="col-md-12">
                                <label class="bd-t p-t-4 p-b-4">DISTRIBUTION: *BLUE COPY send to FFA PaySmart (please retain if scanned and emailed) *YELLOW: Business Copy * PINK: Customer Copy</label>
                            </div>
                        </div>
                        <h5 class="bd-t p-t-4 bd-b p-b-4">Authorisation</h5>
                        <div class="row p-t-4">
                            <div class="col-md-12">
                                <label>This Authorisation is to remain in force in accordance with the Terms and Conditions on this page, the provided Service Agreement, and I/We have read and understand the same</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div id="signature-pad1">
                                    <div class="signature-pad--body">
                                        <canvas></canvas>
                                    </div>
                                    <div class="signature-pad--footer">
                                        <div class="description">Signature/s of Nominated Account Holder/s</div>
                                        <div class="signature-pad--actions">
                                            <div>
                                                <button type="button" class="button clear" data-action="clear">Clear</button>
                                                <button type="button" class="button" data-action="undo">Undo</button>
                                                <button type="button" class="button save" data-action="save-png">Save as PNG</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div id="signature-pad2">
                                    <div class="signature-pad--body">
                                        <canvas></canvas>
                                    </div>
                                    <div class="signature-pad--footer">
                                        <div class="description">Sign above</div>
                                        <div class="signature-pad--actions">
                                            <div>
                                                <button type="button" class="button clear" data-action="clear">Clear</button>
                                                <button type="button" class="button" data-action="undo">Undo</button>
                                                <button type="button" class="button save" data-action="save-png">Save as PNG</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
   </div>
</section>
<!-- /.content -->
@endsection
@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        // submit form start
        $(document).on('submit', '#form_add', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{!! route('digitalsalesform') !!}',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.status == false) {
                        notify(response.msg,0);
                    } else {
                        notify(response.msg,1);
                    }
                },
                error: function() {
                    console.log('Some error occurred in digitalsalesform !!!');
                }
            }); // end ajax here
        });
        // submit form end

    });
</script>
@endsection
