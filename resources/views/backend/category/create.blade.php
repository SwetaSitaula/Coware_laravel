@extends('backend.templates.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="/categories" class="btn btn-primary btn-sm">Back</a>
                    </div>
                    <div class="card-body">
                        <form action="/categories" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input id="name" class="form-control" type="text" name="name" placeholder="Category Name">
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm float-right">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection