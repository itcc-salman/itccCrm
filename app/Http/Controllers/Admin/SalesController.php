<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\MyModels\WebSalesForm;
use App\MyModels\WebSalesItems;
use App\MyModels\DigitalSalesForm;
use App\MyModels\DigitalSalesItems;
use App\MyModels\DirectDebitForm;
use App\User;
use PDF;

class SalesController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('permission:user-list');
        $this->middleware('permission:sales-direct-debit', ['only' => ['directDebit', 'directDebitPdfView']]);
        $this->middleware('permission:sales-web', ['only' => ['webSales', 'webSalesPdfView']]);
        $this->middleware('permission:sales-digital', ['only' => ['digitalSales', 'digitalSalesPdfView']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function webSales(Request $request)
    {
        if ($request->ajax()) {
            $response = array();
            $response['code'] = 200;

            $current_user_role_id = User::find(\Auth::id())->roles->first()->id;
            if( $current_user_role_id == 3 || $current_user_role_id == 4 ) {
                $data = WebSalesForm::where('is_deleted', 0)->where('sales_person_id', \Auth::id())->orderBy('id','DESC')->paginate(5);
            } else {
                $data = WebSalesForm::where('is_deleted', 0)->orderBy('id','DESC')->paginate(5);
            }
            $response['html'] =  view('sales._web_partial_list',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5)->render();
            return response()->json($response);
        }
        return view('sales.websales');
    }

    public function webSalesPdfView(Request $request,$id)
    {
        // dd(public_path('css/pdfstyle.css'));
        $websales = WebSalesForm::with('salesPerson','webSalesItems')->find($id);
        // view()->share('websales',$websales);
        // $pdf = PDF::loadView('sales.websalespdfview', compact('websales'));
        // return $pdf->download('websalespdfview.pdf');
        // return $pdf->stream();

        $pdf = \App::make('dompdf.wrapper');
        $html =  view('sales.websalespdfview', compact('websales'))->render();
        // return $html;
        $pdf->loadHTML($html);
        return $pdf->stream();
        // if($request->has('download')){

        //     return $pdf->download('pdfview.pdf');
        // }

        return view('sales.websalespdfview');
    }

    public function directDebit(Request $request)
    {
        if ($request->ajax()) {
            $response = array();
            $response['code'] = 200;

            $current_user_role_id = User::find(\Auth::id())->roles->first()->id;
            if( $current_user_role_id == 3 || $current_user_role_id == 4 ) {
                $data = DirectDebitForm::where('is_deleted', 0)->where('created_by', \Auth::id())->orderBy('id','DESC')->paginate(5);
            } else {
                $data = DirectDebitForm::where('is_deleted', 0)->orderBy('id','DESC')->paginate(5);
            }
            $response['html'] =  view('sales._direct_debit_partial_list',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5)->render();
            return response()->json($response);
        }
        return view('sales.directdebit');
    }

    public function directDebitPdfView(Request $request,$id)
    {
        // dd(public_path('css/pdfstyle.css'));
        $websales = DirectDebitForm::find($id);
        // view()->share('websales',$websales);
        // $pdf = PDF::loadView('sales.websalespdfview', compact('websales'));
        // return $pdf->download('websalespdfview.pdf');
        // return $pdf->stream();

        $pdf = \App::make('dompdf.wrapper');
        $html =  view('sales.websalespdfview', compact('websales'))->render();
        // return $html;
        $pdf->loadHTML($html);
        return $pdf->stream();
        // if($request->has('download')){

        //     return $pdf->download('pdfview.pdf');
        // }

        return view('sales.websalespdfview');
    }

    public function digitalSales(Request $request)
    {
        if ($request->ajax()) {
            $response = array();
            $response['code'] = 200;

            $current_user_role_id = User::find(\Auth::id())->roles->first()->id;
            if( $current_user_role_id == 3 || $current_user_role_id == 4 ) {
                $data = DigitalSalesForm::where('is_deleted', 0)->where('sales_person_id', \Auth::id())->orderBy('id','DESC')->paginate(5);
            } else {
                $data = DigitalSalesForm::where('is_deleted', 0)->orderBy('id','DESC')->paginate(5);
            }
            $response['html'] =  view('sales._digital_partial_list',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5)->render();
            return response()->json($response);
        }
        return view('sales.digitalsales');
    }

    public function digitalSalesPdfView(Request $request,$id)
    {
        // dd(public_path('css/pdfstyle.css'));
        $digitalsales = DigitalSalesForm::with('salesPerson','digitalSalesItems')->find($id);
        // view()->share('digitalsales',$digitalsales);
        // $pdf = PDF::loadView('sales.digitalsalespdfview', compact('digitalsales'));
        // return $pdf->download('digitalsalespdfview.pdf');
        // return $pdf->stream();

        $pdf = \App::make('dompdf.wrapper');
        $html =  view('sales.digitalsalespdfview', compact('digitalsales'))->render();
        // return $html;
        $pdf->loadHTML($html);
        return $pdf->stream();
        // if($request->has('download')){

        //     return $pdf->download('pdfview.pdf');
        // }

        return view('sales.digitalsalespdfview');
    }

}
