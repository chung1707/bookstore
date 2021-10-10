@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Thêm mới danh mục</h1>
@stop

@section('content')
<div class="tm-edit-product-row" >
    <div class="col-xl-6 col-lg-6 col-md-12" style="margin: 0 auto">
        <form action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="form-group">
            <label for="nameCategorry">Tên danh mục</label>
            <input type="text" class="form-control" id="nameCategorry" placeholder="Tên danh mục" name="name" value="{{ old('name') }}">     @error('name') {{ $message }}@enderror  
            </div>
            <div class="form-group">
            <label for="descriptionCategory">Mô tả danh mục</label>
            <input type="text" class="form-control" id="descriptionCategory" placeholder="Mổ tả danh mục" name="description" value="{{ old('description') }}">  @error('description') {{ $message }}@enderror
            </div>
            <!-- <div class="form-group">
                <label for="emailSupplier">For_book</label>
                <input type="int" class="form-control" id="for_books" placeholder="For_books" name="for_books" value="{{ old('for_books') }}"> @error('for_books') {{ $message }}@enderror
            </div> -->
            <div class="form-group">
            
                      <label for="loaimon">Loại danh mục sách</label>
                      <select class="form-control" id="for_books"  name="for_books">
                        <option value="1">Danh mục sách</option>
                        <option value="0">Danh mục bài viết</option>
                        
                      </select>
                  
                  </div>
            
            <div class="form-group" style="text-align: center">
                <input type="submit" class="btn btn-outline-primary" value="Thêm mới">
            </div>
        </form>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
