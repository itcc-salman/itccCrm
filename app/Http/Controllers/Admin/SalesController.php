<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\MyModels\WebSalesForm;
use App\MyModels\WebSalesItems;
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
        // $this->middleware('permission:role-create', ['only' => ['roleCreate']]);
        // $this->middleware('permission:role-edit', ['only' => ['edit','roleEdit']]);
        // $this->middleware('permission:role-delete', ['only' => ['destroy']]);
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

            $data = WebSalesForm::where('is_deleted', 0)->orderBy('id','DESC')->paginate(5);
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

}
