@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Dashboard')

@section('content_header')
<h1>Sửa thông tin nhà vận chuyển</h1>
@stop

@section('content')
<div class="tm-edit-product-row" >
    <div class="col-xl-6 col-lg-6 col-md-12" style="margin: 0 auto">
        <form action="{{ route('admin.updateTransporter',$transporter->id) }}" method="POST">
            @csrf
            <div class="form-group">
            <label for="nameSupplier">Tên nhà vận chuyển</label>
            <input type="text" class="form-control" id="nameSupplier" placeholder="Tên nhà vận chuyển" name="name" value="{{ $transporter->name }}">     @error('name') {{ $message }}@enderror  
            </div>
            <div class="form-group">
                <label for="emailSupplier">Email</label>
                <input type="email" class="form-control" id="emailSupplier" placeholder="example@gmail.com" name="email" value="{{ $transporter->email }}"> @error('email') {{ $message }}@enderror
            </div>
            <div class="form-group">
                <label for="emailSupplier">Mô tả</label>
                <input type="text" class="form-control" id="emailSupplier" placeholder="mô tả" name="description" value="{{ $transporter->description }}"> @error('description') {{ $message }}@enderror
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="phoneSupplier">Số điện thoại</label>
                        <input type="text" class="form-control" id="phoneSupplier" placeholder="Số điện thoại" name="phone" value="{{ $transporter->phone }}">  @error('phone') {{ $message }}@enderror
                    </div>
                    <div class="col">
                        <label for="faxSupplier">postage</label>
                        <input type="number" class="form-control" id="faxSupplier" placeholder="postage" name="postage" value="{{ $transporter->postage }}">  @error('postage') {{ $message }}@enderror
                    </div>
                </div>
            </div>
  
            <div class="form-group" style="text-align: right">
                <input type="submit" class="btn btn-outline-primary" value="Sửa đổi">
            </div>
        </form> 
    </div>
</div>

@stop

@section('css')

@stop

@section('js')

@stop
