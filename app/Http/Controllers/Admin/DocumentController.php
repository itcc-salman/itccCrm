<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\MyModels\Document;
use Illuminate\Validation\Rule;

class DocumentController  extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:master-document-list');
        $this->middleware('permission:master-document-edit', ['only' => ['documentget', 'documentEdit']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function documents(Request $request)
    {
        if ($request->ajax()) {
            $response = array();
            $response['code'] = 200;

            $data = Document::where('is_deleted', 0)->orderBy('id','DESC')->paginate(5);
            $response['html'] =  view('master.documents._partial_list',compact('data'))->with('i', ($request->input('page', 1) - 1) * 5)->render();
            return response()->json($response);
        }
        return view('master.documents.index');
    }

    public function documentCreate(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'document' => 'required',
            'document_type' => 'required'
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        $input['document_name'] = $request->document;
        $input['document_type'] = $request->document_type;
        $input['created_by']    = \Auth::user()->id;
        $input['modified_by']   = \Auth::user()->id;

        $industry = Document::create($input);
        return response()->json(['status' => true, 'msg' => 'Document added successfully']);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function documentget(Request $request)
    {
        $data = Document::find($request->id);

        $response = array();
        $response['code'] = 200;
        $response['status'] = true;

        $response['html'] =  view('master.documents._partial_edit',compact('data'))->render();
        return response()->json($response);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function documentEdit(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'document' => 'sometimes|mimes:pdf',
            'document_type' => array( 'required', Rule::unique('documents')->ignore($request->id) ),
        ]);

        if ($validator->fails())
        {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first()]);
        }

        $d = Document::find($request->id);

        if( $request->file('document') ) {
            $uploadedFile = $request->file('document');
            $filename = time().$uploadedFile->getClientOriginalName();

            Storage::disk('public_uploads')->putFileAs(
                'documents',
                $uploadedFile,
                $filename
            );
            $d->document_name = $filename;
        }

        $d->document_type = $request->document_type;
        $d->modified_by   = \Auth::user()->id;
        $d->save();

        return response()->json(['status' => true, 'msg' => 'Document updated successfully']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function documentDestroy($id)
    {
        $d = Document::find($id);
        $d->is_deleted = 1;
        $d->save();
        return response()->json(['status' => true, 'msg' => 'Document deleted successfully']);
    }

    public function docs($doc_type)
    {
        if( $doc_type > count(get_document_types()) ) { abort(404); }
        $doc_type_name = get_document_types($doc_type);
        $doc = Document::where('document_type', $doc_type)->first();
        $file_path = Storage::disk('public_uploads')->url($doc->document_name);
        return view('documents', compact('doc_type_name','file_path'));
    }
}
