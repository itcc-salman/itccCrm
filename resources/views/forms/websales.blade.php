@extends('layouts.app')
@section('title','Web Sales Form')
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
      <h1>Web Sales Form</h1>
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
                        <h4>SERVICE AGREEMENT
                            <a class="btn btn-add pull-right" href="{{ route('websales') }}"><i class="fa fa-list"></i> Web Sales List </a>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('websalesform') }}" method="POST" id="form_add">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="lead">Select Lead</label>
                                    <select name="lead" id="lead" class="form-control sm-select">
                                        <option value="">Select Lead</option>
                                        @foreach( $leads as $v )
                                        <option value="{{ $v->id }}">{{ $v->getCustomerFullName() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sales_person">Sales Person</label>
                                    @if($user_role_id == 1)
                                    <select name="sales_person" id="sales_person" class="form-control sm-select">
                                        <option value="">Select Sales Person</option>
                                        @foreach( $users as $u )
                                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                                        @endforeach
                                    </select>
                                    @else
                                    <input type="hidden" name="sales_person" id="sales_person" value="{{ \Auth::id() }}">
                                    <input type="text" readonly value="{{ \Auth::user()->name }}" class="form-control">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <h5 class="bd-t p-t-4 bd-b p-b-4">Client Details</h5>

                        <div class="row p-t-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_name">Customer Name <small>(Given Name/s)</small></label>
                                    <input type="text" id="client_name" name="client_name" class="form-control" placeholder="Customer Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_surname">Customer Surname</label>
                                    <input type="text" id="client_surname" name="client_surname" class="form-control" placeholder="Customer Surname">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_company_name">Company Name</label>
                                    <input type="text" id="client_company_name" name="client_company_name" class="form-control" placeholder="Company Name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_address_line_1">Address <small>(Street Name and Number)</small></label>
                                    <input type="text" id="client_address_line_1" name="client_address_line_1" class="form-control" placeholder="Street Name and Number">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_suburb">Suburb </label>
                                    <input type="text" id="client_suburb" name="client_suburb" class="form-control" placeholder="Suburb">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_state">State</label>
                                    <select name="client_state" id="client_state" class="form-control sm-select">
                                        <option value="">Select State</option>
                                        @foreach( get_states() as $k => $v )
                                        <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_postcode">Postcode</label>
                                    <input type="text" id="client_postcode" name="client_postcode" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Postcode">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_contact_work">Contact (W)</label>
                                    <input type="text" id="client_contact_work" name="client_contact_work" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Contact (W)">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_contact_mobile">Contact (M)</label>
                                    <input type="text" id="client_contact_mobile" name="client_contact_mobile" onkeypress="return isNumberKey(event)" class="form-control" placeholder="Contact (M)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_abn">ABN</label>
                                    <input type="text" id="client_abn" name="client_abn" class="form-control" placeholder="ABN">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_email">Email Address</label>
                                    <input type="email" id="client_email" name="client_email" class="form-control" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="client_website">Website</label>
                                    <input type="text" id="client_website" name="client_website" class="form-control" placeholder="Website">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="project_start_date">Project Start Date</label>
                                    <input type="text" id="project_start_date" name="project_start_date" class="form-control datepicker" autocomplete="new-password" placeholder="DD/MM/YYYY">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="project_amount">Total Amount</label>
                                    <input type="text" id="project_amount" name="project_amount" class="form-control" onkeypress="return isNumberOrSpaceKey(event)" placeholder="$">
                                </div>
                            </div>
                        </div>

                        <h5 class="bd-t p-t-4 bd-b p-b-4">Service/Products</h5>

                        <div class="row p-t-4" id="project_services_data">
                            @foreach( get_web_sales_services() as $k => $v )
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="checkbox" id="project_services_{{ $k }}" name="project_services[]" value="{{ $k }}">
                                    &nbsp;&nbsp;&nbsp;<label for="project_services_{{ $k }}">{{ $v }} </label>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div id="items_row" class="p-t-4 bd-t">
                            <div class="row calc">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="item_descriptions_1">Item Description</label>
                                        <input type="text" id="item_descriptions_1" name="item_descriptions[]" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="unit_price_1">Unit Price</label>
                                        <input type="text" id="unit_price_1" name="unit_price[]" thisval="1" class="form-control unit_price" onkeypress="return isNumberKey(event)" placeholder="$">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="quantity_1">Quantity</label>
                                        <input type="text" id="quantity_1" name="quantity[]" thisval="1" class="form-control qty" onkeypress="return isNumberKey(event)" placeholder="Quantity" value="1">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="total_1">Total</label>
                                        <input type="text" id="total_1" readonly name="total[]" class="form-control total_inline" placeholder="Total">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button id="add_items" data-toggle="tooltip" title="@lang('lang.add_more')" class="btn btn-primary m-t-25"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-right">
                                <table class="table">
                                    <tr>
                                        <td align="right">Sub Total :<td>
                                        <td>$ <span id="sub_total">0</span><td>
                                    </tr>
                                    <tr>
                                        <td align="right">GST :<td>
                                        <td>$ <span id="gst_total">0</span><td>
                                    </tr>
                                    <tr>
                                        <td align="right">TOTAL :<td>
                                        <td>$ <span id="main_total">0</span><td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="payment_type">Payment Type</label>
                                    <select name="payment_type" id="payment_type" class="form-control">
                                        <option value="">Select Payment Type</option>
                                        @foreach( get_payment_type() as $k => $v )
                                        <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="payment_method">Payment Method</label>
                                    <select name="payment_method" id="payment_method" class="form-control">
                                        <option value="">Select Payment Method</option>
                                        @foreach( get_payment_method() as $k => $v )
                                        <option value="{{ $k }}">{{ $v }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="authorisation_date">Date</label>
                                    <input name="authorisation_date" id="authorisation_date" class="form-control datepicker" autocomplete="new-password" placeholder="DD/MM/YYYY">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div id="signature-pad">
                                    <div class="signature-pad--body">
                                        <canvas></canvas>
                                    </div>
                                    <div class="signature-pad--footer">
                                        <div class="description">Signature/s of Nominated Account Holder/s</div>
                                        <div class="signature-pad--actions">
                                            <div>
                                                <button type="button" class="button clear" data-action="clear">Clear</button>
                                                <button type="button" class="button" data-action="undo">Undo</button>
                                                <button type="button" class="button save" data-action="save-png">Save</button>
                                                <input type="hidden" name="signature_first" id="signature_first">
                                            </div>
                                            <img src="" id="signature_first_img">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="card-footer">
                    <div class="custom_title">
                        <div class="reset-button pull-right">
                            <button type="reset" class="btn btn-warning"> Reset</button>
                            <button type="submit" class="btn btn-success"> Save</button>
                        </div>
                    </div>
                </div>
                </form>
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
    function calculate_total() {
        var maintotal = subtotal = gsttotal = 0;
        var gst_percentage = parseFloat('{{ get_gst_percentage() }}');
        $('.calc').each(function(i,e) {
            var _unitPrice = $(e).find('.unit_price');
            var _qty = $(e).find('.qty');
            var _tot = $(e).find('.total_inline');
            var _thistotal = 0;

            if( _unitPrice.val() == '' || _unitPrice.val() == undefined || isNaN(_unitPrice.val())) {
                _unitPrice.val(0);
            }
            if( _qty.val() == '' || _qty.val() == undefined || isNaN(_qty.val()) ) {
                _qty.val(0);
            }
            _thistotal = parseFloat(_unitPrice.val()) * parseFloat(_qty.val());
            _tot.val(_thistotal);
            subtotal += parseFloat(_thistotal);
        });
        gsttotal = ( parseFloat(subtotal) * parseFloat(gst_percentage) ) / 100;
        maintotal = subtotal + gsttotal;
        $('#sub_total').text(subtotal);
        $('#gst_total').text(gsttotal);
        $('#main_total').text(maintotal);
        // debugger
    }

    $(document).ready(function() {

        $(document).on('change', '.unit_price', function(e) {
            calculate_total();
        });

        $(document).on('change', '.qty', function(e) {
            calculate_total();
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
        var wrapper = document.getElementById("signature-pad");
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
            document.getElementById('signature_first').value = '';
            document.getElementById('signature_first_img').src = '';
        });

        undoButton.addEventListener("click", function (event) {
            var data = signaturePad.toData();

            if (data) {
                data.pop(); // remove the last dot or line
                signaturePad.fromData(data);
            }
            document.getElementById('signature_first').value = '';
            document.getElementById('signature_first_img').src = '';
        });

        savePNGButton.addEventListener("click", function (event) {
            if (signaturePad.isEmpty()) {
                alert("Please provide a signature first.");
            } else {
                var dataURL = signaturePad.toDataURL();
                // download(dataURL, "signature.png");
                document.getElementById('signature_first').value = dataURL;
                document.getElementById('signature_first_img').src = dataURL;
            }
        });

        $(document).on('change', '#lead', function(e) {
            e.preventDefault();
            var _lead_id = $(this).val();
            $('#client_name').val('');
            $('#client_surname').val('');
            $('#client_company_name').val('');
            $('#client_address_line_1').val('');
            $('#client_suburb').val('');
            $('#client_state').val('').trigger('change');
            $('#client_postcode').val('');
            $('#client_contact_work').val('');
            $('#client_contact_mobile').val('');
            $('#client_abn').val('');
            $('#client_email').val('');
            $('#client_website').val('');
            $('#sales_person').val('').trigger('change');
            if( _lead_id != '') {
                // call ajax here
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '{!! route('lead_select') !!}',
                    type: 'POST',
                    data: { lead_id: _lead_id},
                    cache: false,
                    success: function (response) {
                        if(response.status == false) {
                            notify(response.msg,0);
                        } else {
                            var _cust = response.data;
                            $('#client_name').val(_cust.first_name);
                            $('#client_surname').val(_cust.last_name);
                            $('#client_company_name').val(_cust.company_name);
                            $('#client_address_line_1').val(_cust.address_line1);
                            $('#client_suburb').val(_cust.suburb);
                            $('#client_state').val(_cust.state).trigger('change');
                            $('#client_postcode').val(_cust.post_code);
                            $('#client_contact_work').val(_cust.contact_work);
                            $('#client_contact_mobile').val(_cust.contact_mobile);
                            $('#client_abn').val(_cust.abn);
                            $('#client_email').val(_cust.email);
                            $('#client_website').val(_cust.website_url);
                            $('#sales_person').val(_cust.sales_person_id).trigger('change');
                        }
                    },
                    error: function() {
                        console.log('Some error occurred in lead_select !!!');
                    }
                }); // end ajax here
            }
        });

        $('#project_services_data input').iCheck({
            checkboxClass: 'icheckbox_minimal',
            radioClass: 'iradio_minimal',
            increaseArea: '20%'
        });
        var _count = 2;
        $(document).on('click', '#add_items', function(e) {
            e.preventDefault();
            var _d = `<div class="row calc" id="items_`+_count+`">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="item_descriptions_`+_count+`">Item Description</label>
                                <input type="text" id="item_descriptions_`+_count+`" name="item_descriptions[]" class="form-control" placeholder="">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="unit_price_`+_count+`">Unit Price</label>
                                <input type="text" id="unit_price_`+_count+`" thisval="`+_count+`" name="unit_price[]" class="form-control unit_price" onkeypress="return isNumberKey(event)" placeholder="$">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="quantity_`+_count+`">Quantity</label>
                                <input type="text" id="quantity_`+_count+`" thisval="`+_count+`" name="quantity[]" class="form-control qty" onkeypress="return isNumberKey(event)" placeholder="Quantity" value="1">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="total_`+_count+`">Total</label>
                                <input type="text" id="total_`+_count+`" readonly name="total[]" class="form-control total_inline" placeholder="Total">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group">
                                <button id="remove_item" remove="`+_count+`" class="btn btn-danger m-t-25 removeme"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                    </div>`;
            $('#items_row').append(_d);
            _count++;
            $(this).blur();
        });

        $(document).on('click', '.removeme', function(e) {
            e.preventDefault();
            var _rmid = $(this).attr('remove');
            $('#items_'+_rmid).remove();
            calculate_total();
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
                url: '{!! route('websalesform') !!}',
                type: 'POST',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    if(response.status == false) {
                        notify(response.msg,0);
                    } else {
                        location.href = '{{ route('websales') }}'
                        // notify(response.msg,1);
                    }
                },
                error: function() {
                    console.log('Some error occurred in websalesform !!!');
                }
            }); // end ajax here
        });
        // submit form end

    });
</script>
@endsection
