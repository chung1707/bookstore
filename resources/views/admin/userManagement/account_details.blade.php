@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Dashboard')

@section('content_header')
<h1>Thông tin tài khoản</h1>
@stop

@section('content')
<section class="content">
    <div class="container">
        <account-infos :user="{{ json_encode($user) }}"></account-infos>
    </div>
</section>
@stop

@section('css')

@stop

@section('js')

@stop
