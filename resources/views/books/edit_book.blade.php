@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Sửa thông tin sản phẩm')

@section('content_header')
<h1>Sửa thông tin sản phẩm</h1>
@stop

@section('content')
<div class="container-fluid">
<edit-book :book="{{ json_encode($book) }}"></edit-book>
<div class="form-group col-sm-2">
    <a style="    margin-left: 310px;"
        class="btn btn-block btn-danger"
        href="{{ redirect()->back()->getTargetUrl() }}"
    >
        Quay lại
    </a>
</div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
