@extends('layouts.app')
@section('title','Direct Debit Form')
@section('styles')
<link href="{{ asset('assets/plugins/icheck/skins/all.css') }}" rel="stylesheet" />


<style type="text/css">
    .signature-pad--body canvas {
        border: 2px solid #eee;
    }
    /*.signature-pad--body canvas {
        border: 2px solid #eee;
        position: relative;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
    }*/
    .signature-pad--footer .description {
        font-size: 14px;
    }
</style>
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
   <div class="header-icon">
      <i class="fa fa-wpforms"></i>
   </div>
   <div class="header-title">
      <h1>Direct Debit Form</h1>
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
                        <h4>Pay Smart</h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('directdebitform') }}" method="POST" id="form_add">
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
                            <div class="col-lg-6 col-md-12 col-sm-12">
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
                            <div class="col-lg-6 col-md-12 col-sm-12">
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
<script src="{{ asset('assets/plugins/icheck/icheck.min.js') }}" ></script>
<script src="{{ asset('js/signature_pad.umd.js') }}" ></script>
<script type="text/javascript">

    $(document).ready(function() {

        $('#card_type_data input').iCheck({
            radioClass: 'iradio_minimal',
            increaseArea: '20%'
        });

        window.mobilecheck = function() {
            var check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
        };

        window.mobileAndTabletcheck = function() {
            var check = false;
            (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
            return check;
        };

        // first signatire pad
        var wrapper = document.getElementById("signature-pad1");
        var clearButton = wrapper.querySelector("[data-action=clear]");
        var undoButton = wrapper.querySelector("[data-action=undo]");
        var savePNGButton = wrapper.querySelector("[data-action=save-png]");
        var canvas = wrapper.querySelector("canvas");
        var signaturePad = new SignaturePad(canvas, {
            penColor: "rgb(0,15,85)",
            velocityFilterWeight: .7,
            minWidth: 0.5,
            maxWidth: 2.5,
            throttle: 16, // max x milli seconds on event update, OBS! this introduces lag for event update
            minPointDistance: 3,
            // It's Necessary to use an opaque color when saving image as JPEG;
            // this option can be omitted if only saving as PNG or SVG
            backgroundColor: "rgb(255, 255, 255)"
        });

        // Adjust canvas coordinate space taking into account pixel ratio,
        // to make it look crisp on mobile devices.
        // This also causes canvas to be cleared.
        function resizeCanvas() {
            // When zoomed out to less than 100%, for some very strange reason,
            // some browsers report devicePixelRatio as less than 1
            // and only part of the canvas is cleared then.
            var ratio =  Math.max(window.devicePixelRatio || 1, 1);

            // This part causes the canvas to be cleared
            if( window.mobilecheck() ) {
                canvas.width = 290;
                canvas.height = 300;
            } else if ( window.mobileAndTabletcheck() ) {
                canvas.width = 350;
                canvas.height = 300;
            } else {
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
            }
            canvas.getContext("2d").scale(ratio, ratio);

            // This library does not listen for canvas changes, so after the canvas is automatically
            // cleared by the browser, SignaturePad#isEmpty might still return false, even though the
            // canvas looks empty, because the internal data of this library wasn't cleared. To make sure
            // that the state of this library is consistent with visual state of the canvas, you
            // have to clear it manually.
            signaturePad.clear();
        }

        // On mobile devices it might make more sense to listen to orientation change,
        // rather than window resize events.
        window.onresize = resizeCanvas;
        resizeCanvas();

        function download(dataURL, filename) {
            if (navigator.userAgent.indexOf("Safari") > -1 && navigator.userAgent.indexOf("Chrome") === -1) {
                window.open(dataURL);
            } else {
                var blob = dataURLToBlob(dataURL);
                var url = window.URL.createObjectURL(blob);

                var a = document.createElement("a");
                a.style = "display: none";
                a.href = url;
                a.download = filename;

                document.body.appendChild(a);
                a.click();

                window.URL.revokeObjectURL(url);
            }
        }

        // One could simply use Canvas#toBlob method instead, but it's just to show
        // that it can be done using result of SignaturePad#toDataURL.
        function dataURLToBlob(dataURL) {
            // Code taken from https://github.com/ebidel/filer.js
            var parts = dataURL.split(';base64,');
            var contentType = parts[0].split(":")[1];
            var raw = window.atob(parts[1]);
            var rawLength = raw.length;
            var uInt8Array = new Uint8Array(rawLength);

            for (var i = 0; i < rawLength; ++i) {
                uInt8Array[i] = raw.charCodeAt(i);
            }

            return new Blob([uInt8Array], { type: contentType });
        }

        clearButton.addEventListener("click", function (event) {
            signaturePad.clear();
        });

        undoButton.addEventListener("click", function (event) {
            var data = signaturePad.toData();

            if (data) {
                data.pop(); // remove the last dot or line
                signaturePad.fromData(data);
            }
        });

        savePNGButton.addEventListener("click", function (event) {
            if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
            } else {
                var dataURL = signaturePad.toDataURL();
                download(dataURL, "signature.png");
            }
        });

        // second signature pad
        var wrapper1 = document.getElementById("signature-pad2");
        var clearButton1 = wrapper1.querySelector("[data-action=clear]");
        var undoButton1 = wrapper1.querySelector("[data-action=undo]");
        var savePNGButton1 = wrapper1.querySelector("[data-action=save-png]");
        var canvas1 = wrapper1.querySelector("canvas");
        var signaturePad1 = new SignaturePad(canvas1, {
            penColor: "rgb(0,15,85)",
            velocityFilterWeight: .7,
            minWidth: 0.5,
            maxWidth: 2.5,
            throttle: 16, // max x milli seconds on event update, OBS! this introduces lag for event update
            minPointDistance: 3,
            // It's Necessary to use an opaque color when saving image as JPEG;
            // this option can be omitted if only saving as PNG or SVG
            backgroundColor: "rgb(255, 255, 255)"
        });

        // Adjust canvas coordinate space taking into account pixel ratio,
        // to make it look crisp on mobile devices.
        // This also causes canvas to be cleared.
        function resizeCanvas1() {
            // When zoomed out to less than 100%, for some very strange reason,
            // some browsers report devicePixelRatio as less than 1
            // and only part of the canvas is cleared then.
            var ratio =  Math.max(window.devicePixelRatio || 1, 1);
            if( window.mobilecheck() ) {
                canvas1.width = 290;
                canvas1.height = 300;
            } else if ( window.mobileAndTabletcheck() ) {
                canvas1.width = 350;
                canvas1.height = 300;
            } else {
                canvas1.width = canvas1.offsetWidth * ratio;
                canvas1.height = canvas1.offsetHeight * ratio;
            }
            canvas1.getContext("2d").scale(ratio, ratio);

            // This library does not listen for canvas changes, so after the canvas is automatically
            // cleared by the browser, SignaturePad#isEmpty might still return false, even though the
            // canvas looks empty, because the internal data of this library wasn't cleared. To make sure
            // that the state of this library is consistent with visual state of the canvas, you
            // have to clear it manually.
            signaturePad1.clear();
        }

        // On mobile devices it might make more sense to listen to orientation change,
        // rather than window resize events.
        // if(window.width() > 300){
        //     window.onresize = resizeCanvas1;
        // } else {
        //     window.orientationchange = resizeCanvas1;
        // }
        window.onresize = resizeCanvas1;
        resizeCanvas1();

        function download1(dataURL, filename) {
            if (navigator.userAgent.indexOf("Safari") > -1 && navigator.userAgent.indexOf("Chrome") === -1) {
                window.open(dataURL);
            } else {
                var blob = dataURLToBlob1(dataURL);
                var url = window.URL.createObjectURL(blob);

                var a = document.createElement("a");
                a.style = "display: none";
                a.href = url;
                a.download = filename;

                document.body.appendChild(a);
                a.click();

                window.URL.revokeObjectURL(url);
            }
        }

        // One could simply use Canvas#toBlob method instead, but it's just to show
        // that it can be done using result of SignaturePad#toDataURL.
        function dataURLToBlob1(dataURL) {
            // Code taken from https://github.com/ebidel/filer.js
            var parts = dataURL.split(';base64,');
            var contentType = parts[0].split(":")[1];
            var raw = window.atob(parts[1]);
            var rawLength = raw.length;
            var uInt8Array = new Uint8Array(rawLength);

            for (var i = 0; i < rawLength; ++i) {
                uInt8Array[i] = raw.charCodeAt(i);
            }

            return new Blob([uInt8Array], { type: contentType });
        }

        clearButton1.addEventListener("click", function (event) {
            signaturePad1.clear();
        });

        undoButton1.addEventListener("click", function (event) {
            var data = signaturePad1.toData();

            if (data) {
                data.pop(); // remove the last dot or line
                signaturePad1.fromData(data);
            }
        });

        savePNGButton1.addEventListener("click", function (event) {
            if (signaturePad1.isEmpty()) {
                alert("Please provide a signature first.");
            } else {
                var dataURL = signaturePad1.toDataURL();
                download1(dataURL, "signature1.png");
            }
        });

        // submit form start
        $(document).on('submit', '#form_add', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{!! route('directdebitform') !!}',
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
                    console.log('Some error occurred in directdebitform !!!');
                }
            }); // end ajax here
        });
        // submit form end
    });
</script>
@endsection
