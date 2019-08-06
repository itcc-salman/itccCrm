<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MyModels\Industry;
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
        $this->middleware('permission:lead-list');
        $this->middleware('permission:lead-create', ['only' => ['leadCreate','leadCreateStore']]);
        $this->middleware('permission:lead-edit', ['only' => ['leadEdit','leadEditStore']]);
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

            $current_user_role_id = User::find(\Auth::id())->roles->first()->id;
            if( $current_user_role_id == 3 || $current_user_role_id == 4 ) {
                $data = Lead::where('is_deleted', 0)->where('sales_person_id', \Auth::id())->with('salesPerson')->orderBy('id','DESC')->paginate(5);
            } else {
                $data = Lead::where('is_deleted', 0)->with('salesPerson')->orderBy('id','DESC')->paginate(5);
            }
            $response['html'] =  view('leads._partial_leadlist',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5)->render();
            return response()->json($response);
        }
        return view('leads.index');
    }

    public function leadCreate()
    {
        $industry = Industry::where('is_deleted', 0)->orderBy('name')->get();
        $user_role_id = User::find(\Auth::id())->roles->first()->id;
        $users = User::getSalesAgents();
        return view('leads.create', compact('industry', 'user_role_id', 'users'));
    }

    public function leadCreateStore(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:leads,email',
            'contact_work' => 'required',
            'lead_status' => 'required',
            'customer_select' => 'required',
        ],[
            'first_name.required' => 'First Name is required',
            'last_name.required' => 'Last Name is required',
            'contact_work.required' => 'Contact Work is required',
            'customer_select.required' => 'Sales Person is required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        }

        $lead = new Lead;
        $lead->first_name           = $request->first_name;
        $lead->last_name            = $request->last_name;
        $lead->email                = $request->email;
        $lead->company_name         = $request->company_name;
        $lead->abn                  = $request->abn;
        $lead->address_line1        = $request->address_line1;
        $lead->suburb               = $request->suburb;
        $lead->state                = $request->state;
        $lead->post_code            = $request->post_code;
        $lead->contact_work         = $request->contact_work;
        $lead->contact_mobile       = $request->contact_mobile;
        $lead->website_url          = $request->website_url;
        $lead->no_of_employees      = $request->no_of_employees;
        $lead->industry             = $request->industry;
        $lead->sales_person_id      = $request->customer_select;
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
        $data = Lead::with('salesPerson')->find($request->id);
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

        $industry = Industry::where('is_deleted', 0)->orderBy('name')->get();
        $user_role_id = User::find(\Auth::id())->roles->first()->id;
        $users = User::getSalesAgents();
        return view('leads.edit', compact('data','industry','user_role_id','users'));
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
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_work' => 'required',
            'lead_status' => 'required',
            'customer_select' => 'required',
        ],[
            'first_name.required' => 'First Name is required',
            'last_name.required' => 'Last Name is required',
            'contact_work.required' => 'Contact Work is required',
            'customer_select.required' => 'Sales Person is required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => false, 'errors' => $validator->getMessageBag()->toArray()]);
        }

        $lead = Lead::find($request->id);
        $lead->first_name           = $request->first_name;
        $lead->last_name            = $request->last_name;
        $lead->email                = $request->email;
        $lead->company_name         = $request->company_name;
        $lead->abn                  = $request->abn;
        $lead->address_line1        = $request->address_line1;
        $lead->suburb               = $request->suburb;
        $lead->state                = $request->state;
        $lead->post_code            = $request->post_code;
        $lead->contact_work         = $request->contact_work;
        $lead->contact_mobile       = $request->contact_mobile;
        $lead->website_url          = $request->website_url;
        $lead->no_of_employees      = $request->no_of_employees;
        $lead->industry             = $request->industry;
        $lead->sales_person_id      = $request->customer_select;
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

            $data = Meeting::where('is_deleted', 0)->where('lead_id', $request->id )
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
        $users = User::getSalesAgents();

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
