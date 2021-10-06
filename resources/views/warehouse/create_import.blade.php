@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Dashboard')

@section('content_header')
<h1>Thông tin tài khoản</h1>
@stop

@section('content')
<section class="content">
    <div class="container">
        <import></import>
    </div>
</section>
@stop

@section('css')

@stop

@section('js')
<script src="{{ asset('js/app.js') }}"></script>
@stop
