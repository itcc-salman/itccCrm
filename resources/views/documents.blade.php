@extends('layouts.app')
@section('title', $doc_type_name)
@section('styles')
<style type="text/css">
    .pdfobject-container { height: 30rem; border: 1rem solid rgba(0,0,0,.1); }
</style>
@endsection
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="header-icon">
        <i class="fa fa-file-pdf-o"></i>
    </div>
    <div class="header-title">
        <h1>{{ $doc_type_name }}</h1>
        <small></small>
    </div>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card" id="pdf_view">
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
@section('scripts')
<script src="{{ asset('js/pdfobject.min.js') }}" ></script>
<script type="text/javascript">
    PDFObject.embed("{{ $file_path }}", "#pdf_view");
</script>
@endsection
