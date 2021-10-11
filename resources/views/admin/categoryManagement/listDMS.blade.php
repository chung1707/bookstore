@extends('adminlte::page', ['iFrameEnabled' => true])

@section('title', 'Dashboard')

@section('content_header')
<h1>Danh mục sách</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">    
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">DANH MỤC SÁCH </h3>    
            </div>
            <form action="{{ route('category.index') }}" method="get">
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
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên Danh Mục Sách</th>
                            <th>Mô tả</th>
                            <th>Xem chi tiết</th>
                            <th colspan ="2">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ Str::limit($category->description, 50) }} </td>
                            <td><a href="{{ route('category.show',['category' =>$category]) }}" class="btn btn-default btn-sm">Xem chi tiết</a></td>
                            <td><a href="{{ route('category.edit',['category' =>$category]) }}" class="btn btn-default btn-sm">Sửa</a></td>
                            <td class="table__content">
                                <form action="{{ route('category.destroy',['category' =>$category]) }} " method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-default btn-sm" type='submit'>Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
 

            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
