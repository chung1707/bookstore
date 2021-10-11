@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Chi tiết danh mục</h1>
@stop

@section('content')
<div class="tm-edit-product-row" >
    <div class="col-xl-6 col-lg-6 col-md-12" style="margin: 0 auto">
        <form action="" method="">
            @csrf
            <div class="form-group">
            <label for="nameCategorry">Tên danh mục</label>
            <input type="text" class="form-control" id="nameCategorry"  name="name" value="{{ $category->name }}">    
            </div>
            <div class="form-group">
            <label for="descriptionCategory">Mô tả danh mục</label>
            <input type="text" class="form-control" id="descriptionCategory"  name="description" value="{{ Str::limit($category->description, 50)}}">  
            </div>
            <div class="form-group">
            <label for="created_atCategory">Ngày tạo</label>
            <input type="text" class="form-control" id="created_atCategory"  name="created_at" value="{{ Str::limit($category->created_at, 50)}}">  
            </div>
            <div class="form-group">
            <label for="updated_atCategory">Ngày cập nhập</label>
            <input type="text" class="form-control" id="updated_atCategory"  name="updated_at" value="{{ $category->updated_at }}"> 
            </div>
            
            
            <div class="form-group" style="text-align: center">
            <td style="text-align:justify;">
                <a href="{{ route('category.index') }}" class="btn btn-primary" style="margin-right: 10px">Quay lại</a></a>
              </td>
            </div>
           
              
        </form>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
