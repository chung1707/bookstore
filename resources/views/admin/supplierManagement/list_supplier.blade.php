@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Dashboard')

@section('content_header')
<h1>Danh sách nhà cung cấp</h1>
@stop

@section('content')
<div>
      <form action="{{ route('admin.listSupplier') }}" method="get">
            @csrf
            <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4">
              <div class="input-group">
                <input type="search" name="searchName" placeholder="Nhập từ bạn cần tìm?" aria-describedby="button-addon1" class="form-control border-0 bg-light" value="@if (isset($oldsearch)){{ $oldsearch }} @endif">
                <div class="input-group-append">
                  <button id="button-addon1" type="submit" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div>
      </form>
      @if(!isset($suppliers[0]))
      <h5>Không tìm thấy kết quả!</h5>
      @endif
      @if(isset($suppliers[0]))
      <table class="table" style="width: 1410px;">
            <thead class="thead-dark">
              <tr>
                <th scope="col" style="width:3%">ID</th>
                <th scope="col" style="width:15%">Tên NCC</th>
                <th scope="col" style="width:20%">Địa chỉ</th>
                <th scope="col" style="width:10%">Số điện thoại</th>
                <th scope="col" style="width:15%">Email</th>
                <th scope="col" style="width:10%">Fax</th>
                <th scope="col" style="width:17%">Logo</th>
                <th scope="col" style="width:10%" colspan="2">chức năng</th>
              </tr>
            </thead>
            <tbody>
                  @foreach ($suppliers as $supplier)
                        <tr>
                              <th scope="row">{{$supplier->id}}</th>
                              <td>{{$supplier->name}}</td>
                              <td>{{$supplier->address}}</td>
                              <td>{{$supplier->phone}}</td>
                              <td>{{$supplier->email}}</td>
                              <td>{{$supplier->supplier_fax}}</td>
                              <td><img style="width:100%" src="{{ asset('storage/thumbnails/'.$supplier->logo) }}" alt=""></td>
                              <td style="text-align:justify;">
                                    <a href="{{ route('admin.editSupplier',['supplier' =>$supplier]) }}" class="btn btn-primary" style="margin-right: 10px">sửa</a></a>
                              </td>
                              <td style="text-align:justify;">
                                    <form action="{{ route('admin.destroySupplier',['supplier' =>$supplier]) }}" method="post">
                                          @method('DELETE')
                                          @csrf
                                          <button class="btn btn-danger" type='submit' onclick="return confirm('Are you sure you want to delete this item?');">Xóa</button>
                                    </form>
                              </td>
                        </tr>
                  @endforeach
            </tbody>
      </table>
      @if (!isset($oldsearch))
            {{ $suppliers->links() }}        
      @endif

      @endif
</div>
@stop

@section('css')

@stop

@section('js')

@stop
