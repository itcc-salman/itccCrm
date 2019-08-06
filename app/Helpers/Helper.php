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

if( !function_exists('set_date_server') ) {
    function set_date_server($v) {
        if( !empty($v) ) {
            $_td = explode('/', $v);
            $val = $_td[2]."-".$_td[1]."-".$_td[0];
            return date('Y-m-d', strtotime($val));
        }
        return NULL;
    }
}

if( !function_exists('get_date_server') ) {
    function get_date_server($v) {
        if( !empty($v) ) {
            return date('d/m/Y', strtotime($v));
        }
        return NULL;
    }
}

if( !function_exists('get_date_server_full') ) {
    function get_date_server_full($v) {
        if( !empty($v) ) {
            return date('d/m/Y h:i A', strtotime($v));
        }
        return NULL;
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
        if( $ret_type === NULL ) {
            return $return;
        } else {
            return $return[$ret_type];
        }
    }
}

if( !function_exists('get_admin_fee') ) {
    function get_admin_fee($ret_type = NULL) {
        $return = [
            '1' => 'Weekly (Admin Fee $1.30)',
            '2' => 'Fortnightly (Admin Fee $1.95)',
            '3' => 'Monthly (Admin Fee $2.95)',
            '4' => 'Quarterly (Admin Fee $3.95)'
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

if( !function_exists('get_digital_sales_services') ) {
    function get_digital_sales_services($ret_type = NULL) {
        $return = [
            '1'   => 'SEO',
            '2'   => 'Google AdWords',
            '3'   => 'Re-Marketing',
            '4'   => 'Social Media',
        ];
        if( $ret_type == NULL ) {
            return $return;
        } else {
            return $return[$ret_type];
        }
    }
}

if( !function_exists('get_minimum_aggrement_terms') ) {
    function get_minimum_aggrement_terms($ret_type = NULL) {
        $return = [
            '1'   => '6 Months',
            '2'   => '12 Months',
            '3'   => 'NA'
        ];
        if( $ret_type == NULL ) {
            return $return;
        } else {
            return $return[$ret_type];
        }
    }
}

if( !function_exists('get_lead_status') ) {
    function get_lead_status($ret_type = NULL) {
        $return = [
            '1' => 'Open',
            '2' => 'Cancelled',
            '3' => 'Follow Up',
            '4' => 'Closed',
            '5' => 'Appointment Confirmed',
            '6' => 'Not Interested',
            '7' => 'Sold'
        ];
        if( $ret_type == NULL ) {
            return $return;
        } else {
            return $return[$ret_type];
        }
    }
}

if( !function_exists('get_meeting_status') ) {
    function get_meeting_status($ret_type = NULL) {
        $return = [
            '0' => 'Pending',
            '1' => 'Done',
            '2' => 'Cancelled'
        ];
        if( $ret_type === NULL ) {
            return $return;
        } else {
            return $return[$ret_type];
        }
    }
}

if( !function_exists('get_chart_colors') ) {
    function get_chart_colors($ret_type = NULL) {
        $return = [
            '0' => 'rgba(0, 150, 136, 0.8)',
            '1' => 'rgba(51, 51, 51, 0.55)',
            '2' => 'rgba(247, 159, 129, 0.55)',
            '3' => 'rgba(129, 159, 247, 0.55)',
            '4' => 'rgba(245, 169, 208, 0.60)',
            '5' => 'rgba(169, 226, 243, 0.92)',
            '6' => 'rgba(208, 245, 169, 0.99)',
            '7' => 'rgba(224, 86, 253, 0.45)',
            '8' => 'rgba(255, 121, 121, 0.78)',
            '9' => 'rgba(186, 220, 88, 0.81)',
        ];
        if( $ret_type === NULL ) {
            return $return;
        } else {
            return $return[$ret_type];
        }
    }
}
