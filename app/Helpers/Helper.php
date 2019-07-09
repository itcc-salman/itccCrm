<?php

if( !function_exists('setflashmsg') ) {
    function setflashmsg($msg,$type = '1') {
        if($type == '1') {
            request()->session()->flash('notify-success', $msg);
        } else {
            request()->session()->flash('notify-error', $msg);
        }
    }
}

if( !function_exists('get_status_label') ) {
    function get_status_label($s) {
        return ($s == 0 ? 'Active' : 'InActive');
    }
}

if( !function_exists('get_gst_percentage') ) {
    function get_gst_percentage() {
        return 10;
    }
}

if( !function_exists('get_status_fields') ) {
    function get_status_fields() {
        return [
            '0' => 'Active',
            '1' => 'InActive'
        ];
    }
}

if( !function_exists('get_direct_debit_form_customer_type') ) {
    function get_direct_debit_form_customer_type($ret_type = NULL) {
        $return = [
            '0' => 'New Customer',
            '1' => 'Renewal of Existing Customer',
            '2' => 'Change of Details'
        ];
        if( $ret_type == NULL ) {
            return $return;
        } else {
            return $return[$ret_type];
        }
    }
}

if( !function_exists('get_credit_card_type') ) {
    function get_credit_card_type($ret_type = NULL) {
        $return = [
            '1' => 'Visa',
            '2' => 'Mastercard',
            '3' => 'Amex',
            '4' => 'Diners'
        ];
        if( $ret_type == NULL ) {
            return $return;
        } else {
            return $return[$ret_type];
        }
    }
}

if( !function_exists('get_document_types') ) {
    function get_document_types($ret_type = NULL) {
        $return = [
            '1' => 'SEO Packages',
            '2' => 'Web Packages',
            '3' => 'Domain and Hosting Packages',
            '4' => 'Social Media Packages',
            '5' => 'Case Studies'
        ];
        if( $ret_type == NULL ) {
            return $return;
        } else {
            return $return[$ret_type];
        }
    }
}

if( !function_exists('get_states') ) {
    function get_states($ret_type = NULL) {
        $return = [
            'ACT'   => 'Australian Capital Territory',
            'NSW'   => 'New South Wales',
            'NT'    => 'Northern Territory',
            'QLD'   => 'Queensland',
            'SA'    => 'South Australia',
            'TAS'   => 'Tasmania',
            'VIC'   => 'Victoria',
            'WA'    => 'Western Australia'
        ];
        if( $ret_type == NULL ) {
            return $return;
        } else {
            return $return[$ret_type];
        }
    }
}

if( !function_exists('get_web_sales_services') ) {
    function get_web_sales_services($ret_type = NULL) {
        $return = [
            '1'   => 'Graphic Design',
            '2'   => 'Web Design',
            '3'   => 'Responsive',
            '4'   => 'Web Development',
            '5'   => 'Domain',
            '6'   => 'Hosting',
            '7'   => 'Custom Web App',
            '8'   => 'Other'
        ];
        if( $ret_type == NULL ) {
            return $return;
        } else {
            return $return[$ret_type];
        }
    }
}

if( !function_exists('get_payment_type') ) {
    function get_payment_type($ret_type = NULL) {
        $return = [
            '1'   => 'Bank Cheque',
            '2'   => 'Direct Debit',
            '3'   => 'Invoice'
        ];
        if( $ret_type == NULL ) {
            return $return;
        } else {
            return $return[$ret_type];
        }
    }
}

if( !function_exists('get_payment_method') ) {
    function get_payment_method($ret_type = NULL) {
        $return = [
            '1'   => 'Upfront',
            '2'   => '30/40/30',
            '3'   => '50/50'
        ];
        if( $ret_type == NULL ) {
            return $return;
        } else {
            return $return[$ret_type];
        }
    }
}
