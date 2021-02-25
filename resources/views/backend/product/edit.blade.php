@extends('backend.templates.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="/products" class="btn btn-primary btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="/products/{{ $product->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input id="name" class="form-control" type="text" name="name" placeholder="Category Name" value="{{ $product->name }}">
                            </div>

                            <div class="form-group">
                                <label for="price">price</label>
                                <input id="price" class="form-control" type="text" name="price" placeholder="Product Price" value="{{ $product->price }}">
                            </div>

                             <div class="form-group">
                                 <label for="discount">Is Discount Available</label>
                                 <select id="discount" class="form-control" name="discount">
                                     <option value="0">false</option>
                                     <option value="1">discount</option>
                                 </select>
                             </div>

                             <div class="form-group">
                                <label for="sp">Selling Price</label>
                                <input id="sp" class="form-control" type="text" name="sp" placeholder="Product Price" value="{{ $product->sp }}">
                            </div>

                            <div class="form-group">
                                <label for="category_id">Select Product Category</label>
                                <select id="category_id" class="form-control" name="category_id">
                                   @foreach ($categories as $category)
                                       <option value="{{ $category->id }}">{{ $category->name }}</option>
                                   @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control" name="description" rows="3">{{ $product->description }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="images">Text</label>
                                <input id="images" class="form-control-file" type="file" name="images[]" multiple>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm float-right">Update</button>

                            @foreach ($product->images as $image)
                                
                                <img src="{{ asset($image->name) }}" alt="" width="120">
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection