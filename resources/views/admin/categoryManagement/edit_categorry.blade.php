@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Sửa danh mục</h1>
@stop

@section('content')
<div class="tm-edit-product-row" >
    <div class="col-xl-6 col-lg-6 col-md-12" style="margin: 0 auto">
        <form action="{{ route('admin.updatecategory',$category->id) }}" method="post">
            @csrf
            <div class="form-group">
            <label for="nameCategorry">Tên danh mục</label>
            <input type="text" class="form-control" id="nameCategorry"  name="name" value="{{ $category->name }}">     @error('name') {{ $message }}@enderror  
            </div>
            <div class="form-group">
            <label for="descriptionCategory">Mô tả danh mục</label>
            <input type="text" class="form-control" id="descriptionCategory"  name="description" value="{{ Str::limit($category->description, 50)}}">  @error('description') {{ $message }}@enderror
            </div>
            <div class="form-group">
            
                      <label for="loaimon">Loại danh mục sách</label>
                      <select class="form-control" id="for_books"  name="for_books">
                        <option value="1">Danh mục sách</option>
                        <option value="0">Danh mục bài viết</option>
                        
                      </select>
                  
                  </div>
            
            <div class="form-group" style="text-align: center">
                <input type="submit" class="btn btn-outline-primary" value="Sửa thông tin">
            </div>
        </form>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
