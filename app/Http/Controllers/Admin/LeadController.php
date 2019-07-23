<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Customer;
use App\MyModels\Lead;
use App\MyModels\Meeting;
use App\User;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class LeadController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('permission:customer-list');
        // $this->middleware('permission:customer-create', ['only' => ['customerCreate','customerCreateStore']]);
        // $this->middleware('permission:customer-edit', ['only' => ['customerEdit','customerEditStore']]);
        // $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $response = array();
            $response['code'] = 200;

            $data = Lead::where('is_deleted', 0)->with('customer')->orderBy('id','DESC')->paginate(5);
            $response['html'] =  view('leads._partial_leadlist',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5)->render();
            return response()->json($response);
        }
        return view('leads.index');
    }

    public function leadCreate()
    {
        $customers = Customer::where('is_deleted', 0)->orderBy('first_name')->get();
        return view('leads.create', compact('customers'));
    }

    public function leadCreateStore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'customer_select' => 'required',
            'lead_status' => 'required',
        ],[
            'customer_select.required' => 'Customer is required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        $lead = new Lead;
        $lead->customer_id          = $request->customer_select;
        $lead->lead_status          = $request->lead_status;
        $lead->created_by           = \Auth::user()->id;
        $lead->modified_by          = \Auth::user()->id;
        $lead->save();

        setflashmsg('Lead created successfully',1);
        return response()->json(['status' => true, 'msg' => 'Lead created successfully']);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $data = Lead::with('customer')->find($request->id);
        $meetings = Meeting::where('is_deleted', 0)->where('id', $request->id )
                        ->orderBy('id','DESC')->with('salesPerson')->get();
        $meetings_html =  view('leads._partial_meetings',['data' => $meetings,'hide' => true])->render();
        $response = array();
        $response['code'] = 200;
        $response['status'] = true;
        $response['html'] =  view('leads._partial_leadview',compact('data','meetings_html'))->render();
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function leadEdit(Request $request,$id)
    {
        $data = Lead::where('id',$id)->first();
        $customers = Customer::where('is_deleted', 0)->orderBy('first_name')->get();
        $user_role_id = User::find(\Auth::id())->roles->first()->id;
        $users = User::where('is_deleted', 0)->get();
        return view('leads.edit', compact('data','customers','user_role_id','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function leadEditStore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'customer_select' => 'required',
            'lead_status' => 'required',
        ],[
            'customer_select.required' => 'Customer is required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        $lead = Lead::find($request->id);
        $lead->customer_id          = $request->customer_select;
        $lead->lead_status          = $request->lead_status;
        $lead->modified_by          = \Auth::user()->id;
        $lead->save();
        setflashmsg('Lead updated successfully',1);

        return response()->json(['status' => true, 'msg' => 'Lead updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $lead = Lead::find($request->id);
        $lead->is_deleted = 1;
        $lead->save();
        return response()->json(['status' => true, 'msg' => 'Lead deleted successfully']);
    }

    public function meetings(Request $request)
    {
        if ($request->ajax()) {
            $response = array();
            $response['code'] = 200;

            $data = Meeting::where('is_deleted', 0)->where('id', $request->id )
                        ->orderBy('id','DESC')->with('salesPerson')->get();
            $hide = false;
            $response['html'] =  view('leads._partial_meetings',compact('data','hide'))->render();
            return response()->json($response);
        }

    }

    public function meetingStore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'sales_person' => 'required',
            'subject'   => 'required',
            'meeting_at'   => 'required',
            'meeting_time'   => 'required',
            'meeting_status' => 'required',
        ],[
            'sales_person.required' => 'Sales Person is required',
            'subject.required' => 'Subject is required',
            'meeting_at.required' => 'Meeting Date is required',
            'meeting_time.required' => 'Meeting Time is required',
            'meeting_status.required' => 'Meeting Status is required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        $meeting = new Meeting;
        $meeting->lead_id           = $request->leadid;
        $meeting->sales_person_id   = $request->sales_person;
        $meeting->subject           = $request->subject;
        $meeting->body              = $request->body;
        $meeting->meeting_at        = set_date_server($request->meeting_at);
        $meeting->meeting_time      = $request->meeting_time;
        $meeting->meeting_status    = $request->meeting_status;
        $meeting->meeting_summary   = $request->meeting_summary;
        $meeting->created_by        = \Auth::user()->id;
        $meeting->modified_by       = \Auth::user()->id;
        $meeting->save();

        setflashmsg('Meeting created successfully',1);
        return response()->json(['status' => true, 'msg' => 'Meeting created successfully']);
    }

    public function meetingEdit(Request $request)
    {
        $data = Meeting::find($request->id);
        $user_role_id = User::find(\Auth::id())->roles->first()->id;
        $users = User::where('is_deleted', 0)->get();

        $response = array();
        $response['code'] = 200;
        $response['status'] = true;

        $response['html'] =  view('leads._partial_meetingedit',compact('data','user_role_id','users'))->render();
        return response()->json($response);
    }

    public function meetingEditStore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'sales_person' => 'required',
            'subject'   => 'required',
            'meeting_at'   => 'required',
            'meeting_time'   => 'required',
            'meeting_status' => 'required',
        ],[
            'sales_person.required' => 'Sales Person is required',
            'subject.required' => 'Subject is required',
            'meeting_at.required' => 'Meeting Date is required',
            'meeting_time.required' => 'Meeting Time is required',
            'meeting_status.required' => 'Meeting Status is required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        $meeting = Meeting::find($request->id);
        $meeting->sales_person_id   = $request->sales_person;
        $meeting->subject           = $request->subject;
        $meeting->body              = $request->body;
        $meeting->meeting_at        = set_date_server($request->meeting_at);
        $meeting->meeting_time      = $request->meeting_time;
        $meeting->meeting_status    = $request->meeting_status;
        $meeting->meeting_summary   = $request->meeting_summary;
        $meeting->modified_by       = \Auth::user()->id;
        $meeting->save();

        setflashmsg('Meeting updated successfully',1);
        return response()->json(['status' => true, 'msg' => 'Meeting updated successfully']);
    }

}
