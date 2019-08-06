<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Meeting;
use App\User;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_user_role_id = User::find(\Auth::id())->roles->first()->id;
        if( $current_user_role_id == 1) :
            $webSales = DB::select(
                        DB::raw( "SELECT COUNT(webSales.id) as total, webSales.sales_person_id,u.name,
                                MONTH(webSales.created_at) as month
                                FROM users as u
                                JOIN model_has_roles as r ON r.model_id = u.id
                                JOIN web_sales_forms as webSales ON webSales.sales_person_id = u.id
                                WHERE r.role_id IN (3) AND YEAR(webSales.created_at) = YEAR(CURDATE())
                                GROUP BY webSales.sales_person_id, MONTH(webSales.created_at) DESC" )
                    );
            $digitalSales = DB::select(
                        DB::raw( "SELECT COUNT(digitalSales.id) as total, digitalSales.sales_person_id,u.name,
                                MONTH(digitalSales.created_at) as month
                                FROM users as u
                                JOIN model_has_roles as r ON r.model_id = u.id
                                JOIN digital_sales_forms as digitalSales ON digitalSales.sales_person_id = u.id
                                WHERE r.role_id IN (3) AND YEAR(digitalSales.created_at) = YEAR(CURDATE())
                                GROUP BY digitalSales.sales_person_id, MONTH(digitalSales.created_at) DESC" )
                    );
            // dd($webSales);
            // $d = [];
            $sales_agents = DB::select( DB::raw("SELECT u.id,u.name FROM users as u
                            JOIN model_has_roles as r ON r.model_id = u.id
                            WHERE r.role_id IN (3)") );
            $d = $digital = [];
            foreach ($sales_agents as $s => $sa) {
                $d[$sa->id] = [ 'label' => $sa->name ];
                $digital[$sa->id] = [ 'label' => $sa->name ];
                foreach ($webSales as $w => $ws) {
                    if( $ws->sales_person_id == $sa->id ) {
                        $d[$sa->id][$ws->month] = $ws;
                    }
                }
                // Digital Sales
                foreach ($digitalSales as $di => $ds) {
                    if( $ds->sales_person_id == $sa->id ) {
                        $digital[$sa->id][$ds->month] = $ds;
                    }
                }
            }

            // now create graph data
            // dd($d);
            $web_sales = $digital_sales = [];
            $_i = $_j = 0;
            foreach ($d as $keyd => $val) {
                $web_sales[$keyd]['label'] = $val['label'];
                $tmp = "";
                for ($i=1; $i <= 12; $i++) {
                    if( isset($val[$i]) ) {
                        $tmp .= $val[$i]->total.", ";
                    } else {
                        $tmp .= "0, ";
                    }
                }
                $web_sales[$keyd]['data'] = rtrim($tmp, ", ");
                $web_sales[$keyd]['borderColor'] = get_chart_colors($_i);
                $web_sales[$keyd]['backgroundColor'] = get_chart_colors($_i);
                $_i++;
            }
            // digital sales
            foreach ($digital as $keyd => $val) {
                $digital_sales[$keyd]['label'] = $val['label'];
                $tmp = "";
                for ($i=1; $i <= 12; $i++) {
                    if( isset($val[$i]) ) {
                        $tmp .= $val[$i]->total.", ";
                    } else {
                        $tmp .= "0, ";
                    }
                }
                $digital_sales[$keyd]['data'] = rtrim($tmp, ", ");
                $digital_sales[$keyd]['borderColor'] = get_chart_colors($_j);
                $digital_sales[$keyd]['backgroundColor'] = get_chart_colors($_j);
                $_j++;
            }
            // dd($web_sales);

            /*
            $web_sales = DB::table('users')
                        ->select(DB::raw('COUNT(web_sales_forms.id) as total, web_sales_forms.sales_person_id, users.name'))
                        ->join("web_sales_forms", function($join) {
                            $join->on("users.id", "=", "web_sales_forms.sales_person_id");
                        })->groupBy(DB::raw('web_sales_forms.sales_person_id, MONTH(web_sales_forms.created_at) DESC'))
                        ->get();
            dd($web_sales);
            */

           // tabs query

           // New Customers for current Month
           $_newcustomer = DB::select( DB::raw( "SELECT COUNT(id) as newcustomers
           FROM customers
           WHERE MONTH(created_at) = MONTH(CURDATE())
           GROUP BY MONTH(created_at)" ) );

           $tabs['newcustomers'] = isset($_newcustomer[0]->newcustomers) ? $_newcustomer[0]->newcustomers : 0;

           $_active_customer = DB::select( DB::raw( "SELECT COUNT(id) as totalcustomers FROM customers" ) );
           $tabs['totalcustomers'] = isset($_active_customer[0]->totalcustomers) ? $_active_customer[0]->totalcustomers : 0;

           // Web Monthly Sales Total
           $_web_monthly_sales = DB::select( DB::raw( "SELECT SUM(webSales.sub_total) as websales_total
           FROM web_sales_forms as webSales
           WHERE MONTH(webSales.created_at) = MONTH(CURDATE())
           GROUP BY MONTH(webSales.created_at)" ) );
           // Digital Monthly Sales Total
           $_digital_monthly_sales = DB::select( DB::raw( "SELECT SUM(digitalSales.sub_total) as digitalsales_total
           FROM digital_sales_forms as digitalSales
           WHERE MONTH(digitalSales.created_at) = MONTH(CURDATE())
           GROUP BY MONTH(digitalSales.created_at)" ) );

           $month_webSales = isset( $_web_monthly_sales[0]->websales_total ) ? $_web_monthly_sales[0]->websales_total : 0;
           $month_digitalSales = isset( $_digital_monthly_sales[0]->digitalsales_total ) ? $_digital_monthly_sales[0]->digitalsales_total : 0;

           $tabs['monthly_sales_total'] = $month_webSales + $month_digitalSales;

           // Web Yearly Sales Total
           $_ytd_web_sales = DB::select( DB::raw( "SELECT SUM(webSales.sub_total) as websales_total
           FROM web_sales_forms as webSales
           WHERE YEAR(webSales.created_at) = YEAR(CURDATE())
           GROUP BY YEAR(webSales.created_at)" ) );
           // Digital Yearly Sales Total
           $_ytd_digital_sales = DB::select( DB::raw( "SELECT SUM(digitalSales.sub_total) as digitalsales_total
           FROM digital_sales_forms as digitalSales
           WHERE YEAR(digitalSales.created_at) = YEAR(CURDATE())
           GROUP BY YEAR(digitalSales.created_at)" ) );

           $ytd_webSales = isset( $_ytd_web_sales[0]->websales_total ) ? $_ytd_web_sales[0]->websales_total : 0;
           $ytd_digitalSales = isset( $_ytd_digital_sales[0]->digitalsales_total ) ? $_ytd_digital_sales[0]->digitalsales_total : 0;

           $tabs['year_sales_total'] = $ytd_webSales + $ytd_digitalSales;

           // Meeting List
           $meetings_list = Meeting::where('is_deleted', 0)->where('meeting_status', 0 )
                        ->orderBy('meeting_at','DESC')->with(['lead','salesPerson'])->get();


        elseif( $current_user_role_id == 3 ):

            $user_id = \Auth::id();
            $user_data = User::find(\Auth::id());
            $webSales = DB::select(
                        DB::raw( "SELECT COUNT(webSales.id) as total, webSales.sales_person_id,u.name,
                                MONTH(webSales.created_at) as month
                                FROM users as u
                                JOIN web_sales_forms as webSales ON webSales.sales_person_id = u.id
                                WHERE webSales.sales_person_id = $user_id AND YEAR(webSales.created_at) = YEAR(CURDATE())
                                GROUP BY webSales.sales_person_id, MONTH(webSales.created_at) DESC" )
                    );
            $digitalSales = DB::select(
                        DB::raw( "SELECT COUNT(digitalSales.id) as total, digitalSales.sales_person_id,u.name,
                                MONTH(digitalSales.created_at) as month
                                FROM users as u
                                JOIN digital_sales_forms as digitalSales ON digitalSales.sales_person_id = u.id
                                WHERE digitalSales.sales_person_id = $user_id AND YEAR(digitalSales.created_at) = YEAR(CURDATE())
                                GROUP BY digitalSales.sales_person_id, MONTH(digitalSales.created_at) DESC" )
                    );
            // dd($webSales);
            // $d = [];
            $d = $digital = [];

            $d[$user_id] = [ 'label' => $user_data->name ];
            $digital[$user_id] = [ 'label' => $user_data->name ];
            foreach ($webSales as $w => $ws) {
                $d[$user_id][$ws->month] = $ws;
            }
            // Digital Sales
            foreach ($digitalSales as $di => $ds) {
                $digital[$sa->id][$ds->month] = $ds;
            }


            // now create graph data
            // dd($d);
            $web_sales = $digital_sales = [];
            $_i = $_j = 0;
            foreach ($d as $keyd => $val) {
                $web_sales[$keyd]['label'] = $val['label'];
                $tmp = "";
                for ($i=1; $i <= 12; $i++) {
                    if( isset($val[$i]) ) {
                        $tmp .= $val[$i]->total.", ";
                    } else {
                        $tmp .= "0, ";
                    }
                }
                $web_sales[$keyd]['data'] = rtrim($tmp, ", ");
                $web_sales[$keyd]['borderColor'] = get_chart_colors($_i);
                $web_sales[$keyd]['backgroundColor'] = get_chart_colors($_i);
                $_i++;
            }
            // digital sales
            foreach ($digital as $keyd => $val) {
                $digital_sales[$keyd]['label'] = $val['label'];
                $tmp = "";
                for ($i=1; $i <= 12; $i++) {
                    if( isset($val[$i]) ) {
                        $tmp .= $val[$i]->total.", ";
                    } else {
                        $tmp .= "0, ";
                    }
                }
                $digital_sales[$keyd]['data'] = rtrim($tmp, ", ");
                $digital_sales[$keyd]['borderColor'] = get_chart_colors($_j);
                $digital_sales[$keyd]['backgroundColor'] = get_chart_colors($_j);
                $_j++;
            }

            // tabs query

           // New Customers for current Month
           $_newcustomer = DB::select( DB::raw( "SELECT COUNT(id) as newcustomers
           FROM customers
           WHERE MONTH(created_at) = MONTH(CURDATE()) AND created_by = $user_id
           GROUP BY MONTH(created_at)" ) );

           $tabs['newcustomers'] = isset($_newcustomer[0]->newcustomers) ? $_newcustomer[0]->newcustomers : 0;

           $_active_customer = DB::select( DB::raw( "SELECT COUNT(id) as totalcustomers FROM customers WHERE created_by = $user_id" ) );
           $tabs['totalcustomers'] = isset($_active_customer[0]->totalcustomers) ? $_active_customer[0]->totalcustomers : 0;

           // Web Monthly Sales Total
           $_web_monthly_sales = DB::select( DB::raw( "SELECT SUM(webSales.sub_total) as websales_total
           FROM web_sales_forms as webSales
           WHERE MONTH(webSales.created_at) = MONTH(CURDATE()) AND webSales.sales_person_id = $user_id
           GROUP BY MONTH(webSales.created_at)" ) );
           // Digital Monthly Sales Total
           $_digital_monthly_sales = DB::select( DB::raw( "SELECT SUM(digitalSales.sub_total) as digitalsales_total
           FROM digital_sales_forms as digitalSales
           WHERE MONTH(digitalSales.created_at) = MONTH(CURDATE()) AND digitalSales.sales_person_id = $user_id
           GROUP BY MONTH(digitalSales.created_at)" ) );

           $month_webSales = isset( $_web_monthly_sales[0]->websales_total ) ? $_web_monthly_sales[0]->websales_total : 0;
           $month_digitalSales = isset( $_digital_monthly_sales[0]->digitalsales_total ) ? $_digital_monthly_sales[0]->digitalsales_total : 0;

           $tabs['monthly_sales_total'] = $month_webSales + $month_digitalSales;

           // Web Yearly Sales Total
           $_ytd_web_sales = DB::select( DB::raw( "SELECT SUM(webSales.sub_total) as websales_total
           FROM web_sales_forms as webSales
           WHERE YEAR(webSales.created_at) = YEAR(CURDATE()) AND webSales.sales_person_id = $user_id
           GROUP BY YEAR(webSales.created_at)" ) );
           // Digital Yearly Sales Total
           $_ytd_digital_sales = DB::select( DB::raw( "SELECT SUM(digitalSales.sub_total) as digitalsales_total
           FROM digital_sales_forms as digitalSales
           WHERE YEAR(digitalSales.created_at) = YEAR(CURDATE()) AND digitalSales.sales_person_id = $user_id
           GROUP BY YEAR(digitalSales.created_at)" ) );

           $ytd_webSales = isset( $_ytd_web_sales[0]->websales_total ) ? $_ytd_web_sales[0]->websales_total : 0;
           $ytd_digitalSales = isset( $_ytd_digital_sales[0]->digitalsales_total ) ? $_ytd_digital_sales[0]->digitalsales_total : 0;

           $tabs['year_sales_total'] = $ytd_webSales + $ytd_digitalSales;

           // Meeting List
           $meetings_list = Meeting::where('is_deleted', 0)->where('sales_person_id', $user_id )
                        ->where('meeting_status', 0 )->orderBy('meeting_at','DESC')->with('lead')->get();

        else:
            $web_sales = $digital_sales = $tabs = $meetings_list = [];
        endif;
            return view('home', compact('web_sales','digital_sales', 'tabs', 'meetings_list', 'current_user_role_id'));
    }
}
