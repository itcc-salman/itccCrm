<!DOCTYPE html>
<html lang="en-IN">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>ITCC - CRM</title>
    <base href="{{ url('/') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/pdfstyle.css') }}" />
    {{-- <link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700&display=swap" rel="stylesheet"> --}}
</head>

<body>

<div class="web_size">

    <div class="container">

        <div class="crm_header">
            <div class="crm_logo">
                <img src="{{ asset('images/itcc_logo.png') }}" alt=""/>
                <p>Service Agreement</p>
            </div>
            <div class="crm_info">
                <h2>IT Consulting Company</h2>
                <p>ABN : 93 162 094 500</p>
                <ul>
                    <li>P : 1300 770 119</li>
                    <li>E : support@itconsultingscompany.com.au</li>
                    <li>W : itconsultingscompany.com.au</li>
                </ul>
            </div>
        </div>

        <div class="crm_title">
            <h2>Client Details</h2>
        </div>

        <div class="crm_client_form">
            <div class="ccf_left">
                <div class="ccf_tab">
                    <div class="ccf_tab_label">Full Name</div>
                    @php
                    $fullname = str_split( strtoupper($websales->client_name) );
                    $surname = str_split( strtoupper($websales->client_surname) );
                    $licounttotal1 = 24;
                    // $licountfullname = 11;
                    // $licountsurname = 10;
                    $tmpcount = 1;
                    @endphp
                    <div class="ccf_tab_input">
                        <ul>
                            @foreach( $fullname as $n )
                            @php $tmpcount++; @endphp
                            <li>{{ $n }}</li>
                            @endforeach
                            <li></li>
                            @foreach( $surname as $n )
                            @php $tmpcount++; @endphp
                            <li>{{ $n }}</li>
                            @endforeach
                            @for( $i = $tmpcount; $i < $licounttotal1; $i++ )
                            <li></li>
                            @endfor
                        </ul>
                        <div class="ccf_tab_span">
                            <span>Given Name/s</span>
                            <span>Surname</span>
                        </div>
                    </div>
                </div>
                <div class="ccf_tab">
                    <div class="ccf_tab_label">Company Name</div>
                    @php
                    $compname = str_split( strtoupper($websales->client_company_name) );
                    $licounttotal2 = 25;
                    $tmpcount = 1;
                    @endphp
                    <div class="ccf_tab_input">
                        <ul>
                            @foreach( $compname as $n )
                            @php $tmpcount++; @endphp
                            <li>{{ $n }}</li>
                            @endforeach
                            @for( $i = $tmpcount; $i < $licounttotal2; $i++ )
                            <li></li>
                            @endfor
                        </ul>
                    </div>
                </div>
                <div class="ccf_tab">
                    <div class="ccf_tab_label">Address</div>
                    @php
                    $addr = str_split( strtoupper($websales->client_address_line_1) );
                    $suburb = str_split( strtoupper($websales->client_suburb) );
                    $licounttotal3 = 24;
                    $tmpcount = 1;
                    @endphp
                    <div class="ccf_tab_input">
                        <ul>
                            @foreach( $addr as $n )
                            @php $tmpcount++; @endphp
                            <li>{{ $n }}</li>
                            @endforeach
                            <li></li>
                            @foreach( $suburb as $n )
                            @php $tmpcount++; @endphp
                            <li>{{ $n }}</li>
                            @endforeach
                            @for( $i = $tmpcount; $i < $licounttotal3; $i++ )
                            <li></li>
                            @endfor
                        </ul>
                        <div class="ccf_tab_span">
                            <span>Street Name and Number</span>
                            <span>Suburb</span>
                        </div>
                    </div>
                </div>
                <div class="ccf_tab">
                    <div class="ccf_tab_label"></div>
                    @php
                    $state = str_split( strtoupper($websales->client_state) );
                    $postcode = str_split( strtoupper($websales->client_postcode) );
                    $licounttotal4 = 3;
                    $licounttotal5 = 4;
                    $tmpcount = 1;
                    @endphp
                    <div class="ccf_tab_input">
                        <div class="ccf_tab_part">
                            <ul>
                                @foreach( $state as $n )
                                @php $tmpcount++; @endphp
                                <li>{{ $n }}</li>
                                @endforeach
                                @for( $i = $tmpcount; $i < $licounttotal4; $i++ )
                                <li></li>
                                @endfor
                            </ul>
                            <span>State</span>
                        </div>
                        <div class="ccf_tab_part_space"></div>
                        <div class="ccf_tab_part">
                            <ul>
                                @php $tmpcount = 1; @endphp
                                @foreach( $postcode as $n )
                                @php $tmpcount++; @endphp
                                <li>{{ $n }}</li>
                                @endforeach
                                @for( $i = $tmpcount; $i < $licounttotal5; $i++ )
                                <li></li>
                                @endfor
                            </ul>
                            <span>Postcode</span>
                        </div>
                        <div class="ccf_tab_part_space"></div>
                        @php
                        $abn = str_split( strtoupper($websales->client_abn) );
                        $licounttotal6 = 11;
                        $tmpcount = 1;
                        @endphp
                        <div class="ccf_tab_part_label">
                            <label>ABN</label>
                        </div>
                        <div class="ccf_tab_part">
                            <ul>
                                @foreach( $abn as $n )
                                @php $tmpcount++; @endphp
                                <li>{{ $n }}</li>
                                @endforeach
                                @for( $i = $tmpcount; $i < $licounttotal6; $i++ )
                                <li></li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="ccf_tab">
                    <div class="ccf_tab_label">Contact (W)</div>
                    @php
                    $c_work = str_split( strtoupper($websales->client_contact_work) );
                    $c_mobile = str_split( strtoupper($websales->client_contact_mobile) );
                    $licounttotal7 = 10;
                    $licounttotal8 = 10;
                    $tmpcount = 1;
                    @endphp
                    <div class="ccf_tab_input">
                        <div class="ccf_tab_part">
                            <ul>
                                @foreach( $c_work as $n )
                                @php $tmpcount++; @endphp
                                <li>{{ $n }}</li>
                                @endforeach
                                @for( $i = $tmpcount; $i < $licounttotal7; $i++ )
                                <li></li>
                                @endfor
                            </ul>
                        </div>
                        <div class="ccf_tab_part_space"></div>
                        <div class="ccf_tab_part_label">
                            <label>(M)</label>
                        </div>
                        <div class="ccf_tab_part">
                            <ul>
                                @php $tmpcount = 1; @endphp
                                @foreach( $c_mobile as $n )
                                @php $tmpcount++; @endphp
                                <li>{{ $n }}</li>
                                @endforeach
                                @for( $i = $tmpcount; $i < $licounttotal8; $i++ )
                                <li></li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="ccf_tab">
                    <div class="ccf_tab_label">Email</div>
                    @php
                    $_email = str_split( strtoupper($websales->client_email) );
                    $licounttotal9 = 25;
                    $tmpcount = 1;
                    @endphp
                    <div class="ccf_tab_input">
                        <ul>
                            @foreach( $_email as $n )
                            @php $tmpcount++; @endphp
                            <li>{{ $n }}</li>
                            @endforeach
                            @for( $i = $tmpcount; $i < $licounttotal9; $i++ )
                            <li></li>
                            @endfor
                        </ul>
                    </div>
                </div>
                <div class="ccf_tab">
                    <div class="ccf_tab_label">Website</div>
                    @php
                    $_website = str_split( strtoupper($websales->client_website) );
                    $licounttotal10 = 25;
                    $tmpcount = 1;
                    @endphp
                    <div class="ccf_tab_input">
                        <ul>
                            @foreach( $_website as $n )
                            @php $tmpcount++; @endphp
                            <li>{{ $n }}</li>
                            @endforeach
                            @for( $i = $tmpcount; $i < $licounttotal10; $i++ )
                            <li></li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
            <div class="ccf_right">
                <div class="ccf_project_start">
                    <label>Project Start Date</label>
                    <span> {{ $websales->project_start_date }} </span>
                </div>
                <div class="ccf_total">
                    <label><span>Total Amount</span></label>
                    <span class="dolar">{{ $websales->project_amount }}</span>
                </div>
            </div>
        </div>

        <div class="crm_title">
            <h2>Services / Products</h2>
        </div>

        <div class="crm_client_form">
            <div class="ccf_full">
                <div class="ccf_check">
                    @if( in_array(1, $websales->project_services) )
                    <img src="{{ asset('images/check_box_check.png') }}" alt=""/>
                    @else
                    <img src="{{ asset('images/check_box.png') }}" alt=""/>
                    @endif
                    <label for="graphic_design">Graphic Design</label>
                </div>
                <div class="ccf_check">
                    @if( in_array(2, $websales->project_services) )
                    <img src="{{ asset('images/check_box_check.png') }}" alt=""/>
                    @else
                    <img src="{{ asset('images/check_box.png') }}" alt=""/>
                    @endif
                    <label for="web_design">Web Design</label>
                </div>
                <div class="ccf_check">
                    @if( in_array(3, $websales->project_services) )
                    <img src="{{ asset('images/check_box_check.png') }}" alt=""/>
                    @else
                    <img src="{{ asset('images/check_box.png') }}" alt=""/>
                    @endif
                    <label for="responsive">Responsive</label>
                </div>
                <div class="ccf_check">
                    @if( in_array(4, $websales->project_services) )
                    <img src="{{ asset('images/check_box_check.png') }}" alt=""/>
                    @else
                    <img src="{{ asset('images/check_box.png') }}" alt=""/>
                    @endif
                    <label for="web_development">Web Development</label>
                </div>
                <div class="ccf_check">
                    @if( in_array(5, $websales->project_services) )
                    <img src="{{ asset('images/check_box_check.png') }}" alt=""/>
                    @else
                    <img src="{{ asset('images/check_box.png') }}" alt=""/>
                    @endif
                    <label for="domain">Domain</label>
                </div>
                <div class="ccf_check">
                    @if( in_array(6, $websales->project_services) )
                    <img src="{{ asset('images/check_box_check.png') }}" alt=""/>
                    @else
                    <img src="{{ asset('images/check_box.png') }}" alt=""/>
                    @endif
                    <label for="hosting">Hosting</label>
                </div>
                <div class="ccf_check">
                    @if( in_array(7, $websales->project_services) )
                    <img src="{{ asset('images/check_box_check.png') }}" alt=""/>
                    @else
                    <img src="{{ asset('images/check_box.png') }}" alt=""/>
                    @endif
                    <label for="custom_web_app">Custom Web App</label>
                </div>
                <div class="ccf_check">
                    @if( in_array(8, $websales->project_services) )
                    <img src="{{ asset('images/check_box_check.png') }}" alt=""/>
                    @else
                    <img src="{{ asset('images/check_box.png') }}" alt=""/>
                    @endif
                    <label for="other">Other</label>
                </div>
            </div>
        </div>

        <div class="crm_item_table">
            <table>
                <thead>
                    <tr>
                        <th>Item Description</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $websales->webSalesItems as $k => $item )
                    <tr class="{{ ($k % 2 ? 'sec' : '') }}">
                        <td>{{ $item->item_descriptions }}</td>
                        <td>{{ $item->unit_price }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->total }}</td>
                    </tr>
                    @endforeach
                    <tr class="sec">
                        <td></td>
                        <td></td>
                        <td>
                            <div class="crm_total">
                                <label>Sub Total</label>
                            </div>
                            <div class="crm_total">
                                <label>GST</label>
                            </div>
                            <div class="crm_total">
                                <label><span>Total</span></label>
                            </div>
                        </td>
                        <td>
                            <div class="crm_total">
                                <label>{{ $websales->sub_total }}</label>
                            </div>
                            <div class="crm_total">
                                <label>{{ $websales->gst_total }}</label>
                            </div>
                            <div class="crm_total">
                                <label><span>{{ $websales->total_amt }}</span></label>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="crm_client_form">
            <div class="ccf_half">
                <div class="ccf_payment pay_one">
                    <h3>Payment Type</h3>
                    <div class="ccf_check_full">
                        @if( $websales->payment_method == 1 )
                        <img src="{{ asset('images/check_box_check.png') }}" alt=""/>
                        @else
                        <img src="{{ asset('images/check_box.png') }}" alt=""/>
                        @endif
                        <label for="upfront">Upfront</label>
                    </div>
                    <div class="ccf_check_full">
                        @if( $websales->payment_method == 2 )
                        <img src="{{ asset('images/check_box_check.png') }}" alt=""/>
                        @else
                        <img src="{{ asset('images/check_box.png') }}" alt=""/>
                        @endif
                        <label for="304030">30/40/30</label>
                    </div>
                </div>
                <div class="ccf_payment pay_two">
                    <h3>Payment Method</h3>
                    <div class="ccf_half">
                        <div class="ccf_check_full">
                            @if( $websales->payment_type == 3 )
                            <img src="{{ asset('images/check_box_check.png') }}" alt=""/>
                            @else
                            <img src="{{ asset('images/check_box.png') }}" alt=""/>
                            @endif
                            <label for="invoice">Invoice</label>
                        </div>
                        <div class="ccf_check_full">
                            @if( $websales->payment_type == 1 )
                            <img src="{{ asset('images/check_box_check.png') }}" alt=""/>
                            @else
                            <img src="{{ asset('images/check_box.png') }}" alt=""/>
                            @endif
                            <label for="bank_cheque">Bank Cheque</label>
                        </div>
                    </div>
                    <div class="ccf_half">
                        <div class="ccf_check_full">
                            @if( $websales->payment_method == 3 )
                            <img src="{{ asset('images/check_box_check.png') }}" alt=""/>
                            @else
                            <img src="{{ asset('images/check_box.png') }}" alt=""/>
                            @endif
                            <label for="5050">50/50</label>
                        </div>
                        <div class="ccf_check_full">
                            @if( $websales->payment_type == 2 )
                            <img src="{{ asset('images/check_box_check.png') }}" alt=""/>
                            @else
                            <img src="{{ asset('images/check_box.png') }}" alt=""/>
                            @endif
                            <label for="direct_debit">Direct Debit</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ccf_half">
                <div class="ccf_payment pay_three">
                    <h3>Authorisation</h3>
                    <div class="ccf_tab_client">
                        <div class="ccf_tab_client_label">Client Name</div>
                        @php
                        $tmpcount = 1;
                        $licounttotal11 = 14;
                        @endphp
                        <div class="ccf_tab_client_input">
                            <ul>
                                @foreach( $fullname as $n )
                                @php $tmpcount++; @endphp
                                <li>{{ $n }}</li>
                                @endforeach
                                <li></li>
                                @foreach( $surname as $n )
                                @php $tmpcount++; @endphp
                                <li>{{ $n }}</li>
                                @endforeach
                                @for( $i = $tmpcount; $i < $licounttotal11; $i++ )
                                <li></li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                    <div class="ccf_tab_client">
                        <div class="ccf_tab_client_label">Sales Person</div>
                        @php
                        $sales_personName = str_split( strtoupper($websales->salesPerson->name) );
                        $tmpcount = 1;
                        @endphp
                        <div class="ccf_tab_client_input">
                            <ul>
                                @foreach( $sales_personName as $n )
                                @php $tmpcount++; @endphp
                                <li>{{ $n }}</li>
                                @endforeach
                                @for( $i = $tmpcount; $i < $licounttotal11; $i++ )
                                <li></li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                    <div class="ccf_tab_date">
                        <label>Date</label>
                        <label>{{ get_date_server($websales->authorisation_date) }}</label>
                    </div>
                    <div class="ccf_tab_signature">
                        <label>Signature</label>
                        <img src="{{ $websales->authorisation_signature }}">
                    </div>
                </div>
            </div>
        </div>

        <div class="office_use_only">
            <div class="ouo_title">
                <h3>Office Use Only</h3>
            </div>
            <div class="ouo_tabs">
                <div class="ouo_tab">
                    <label>Accepted By</label>
                    <input type="text" name="" value="" id="">
                </div>
                <div class="ouo_tab">
                    <label>Project Manager</label>
                    <input type="text" name="" value="" id="">
                </div>
            </div>
            <div class="ouo_thanks">
                <h3>Thank you for your business</h3>
                <p>Copyright 2015-16 IT C Co Pty Ltd</p>
            </div>
        </div>

    </div>
</div>
</body>
</html>
