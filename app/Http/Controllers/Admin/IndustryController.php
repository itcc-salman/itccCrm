<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Industry;

class IndustryController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:master-industry-list');
        $this->middleware('permission:master-industry-create', ['only' => ['industryCreate']]);
        $this->middleware('permission:master-industry-edit', ['only' => ['industryget', 'industryEdit']]);
        $this->middleware('permission:master-industry-delete', ['only' => ['industryDestroy']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function industry(Request $request)
    {
        if ($request->ajax()) {
            $response = array();
            $response['code'] = 200;

            $data = Industry::where('is_deleted', 0)->orderBy('id','DESC')->paginate(5);
            $response['html'] =  view('master.industry._partial_list',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5)->render();
            return response()->json($response);
        }
        return view('master.industry.index');
    }

    public function industryCreate(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        $input['name']          = $request->name;
        $input['status']        = $request->status;
        $input['created_by']    = \Auth::user()->id;
        $input['modified_by']   = \Auth::user()->id;

        $industry = Industry::create($input);
        return response()->json(['status' => true, 'msg' => 'Industry added successfully']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function industryget(Request $request)
    {
        $data = Industry::find($request->id);

        $response = array();
        $response['code'] = 200;
        $response['status'] = true;

        $response['html'] =  view('master.industry._partial_edit',compact('data'))->render();
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function industryEdit(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        $d = Industry::find($request->id);
        $d->name          = $request->name;
        $d->status        = $request->status;
        $d->modified_by   = \Auth::user()->id;
        $d->save();

        return response()->json(['status' => true, 'msg' => 'Industry updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function industryDestroy($id)
    {
        $d = Industry::find($id);
        $d->is_deleted = 1;
        $d->save();
        return response()->json(['status' => true, 'msg' => 'Industry deleted successfully']);
    }
}
