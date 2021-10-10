@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Dashboard')

@section('content_header')
<h1>Sửa thông tin nhà cung cấp</h1>
@stop

@section('content')
<div class="tm-edit-product-row" >
    <div class="col-xl-6 col-lg-6 col-md-12" style="margin: 0 auto">
        <form action="{{ route('admin.updateSupplier',$supplier->id) }}" method="POST">
            @csrf
            <div class="form-group">
            <label for="nameSupplier">Tên nhà cung cấp</label>
            <input type="text" class="form-control" id="nameSupplier" placeholder="Tên nhà vận chuyển" name="name" value="{{ $supplier->name }}">     @error('name') {{ $message }}@enderror  
            </div>
            <div class="form-group">
            <label for="addressSupplier">Địa chỉ</label>
            <input type="text" class="form-control" id="addressSupplier" placeholder="Địa chỉ" name="address" value="{{ $supplier->address }}">  @error('address') {{ $message }}@enderror
            </div>
            <div class="form-group">
                <label for="emailSupplier">Email</label>
                <input type="email" class="form-control" id="emailSupplier" placeholder="example@gmail.com" name="email" value="{{ $supplier->email }}"> @error('email') {{ $message }}@enderror
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label for="phoneSupplier">Số điện thoại</label>
                        <input type="text" class="form-control" id="phoneSupplier" placeholder="Số điện thoại" name="phone" value="{{ $supplier->phone }}">  @error('phone') {{ $message }}@enderror
                    </div>
                    <div class="col">
                        <label for="faxSupplier">Số Fax</label>
                        <input type="text" class="form-control" id="faxSupplier" placeholder="Fax" name="supplier_fax" value="{{ $supplier->supplier_fax }}">  @error('supplier_fax') {{ $message }}@enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <h4>Logo cũ</h4>
                <td><img style="width: 240px;" src="{{ asset('storage/thumbnails/'.$supplier->logo) }}" alt=""></td>
            </div>
            <div class="form-group">
                <dropzone-uploader></dropzone-uploader>
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
