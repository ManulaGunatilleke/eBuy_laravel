@extends('layouts.admin')

@section('content')

        <div class="row">

            <div class="col-md-12">

                <div class = "card">

                    <div class="card-header">

                        <h4>Edit Category
                            <a href="{{ url('admin/category') }}" class="btn btn-primary btn-sm text-white float-end">Back</a>
                        </h4>

                    </div>

                    <div class="card-body">

                        <form action="{{ url('admin/category/'.$category->id) }}" method = "POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label>Name</label>
                                    <input type="text" name = "name" value = "{{ $category->name }}" class = "form-control" />
                                    @error('name') <small class = "text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Slug</label>
                                    <input type="text" name = "slug" value = "{{ $category->slug }}" class = "form-control" />
                                    @error('slug') <small class = "text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                <label>Description</label>
                                    <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Image</label>
                                    <input type="file" name = "image" class = "form-control" />
                                    <!-- @error('image') <small class = "text-danger">{{$message}}</small> @enderror -->
                                    <img src="{{ asset('/uploads/category/'.$category->image) }}" width = "60px" hight = "60px" />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Status</label>
                                    <input type="checkbox" name = "status" {{ $category->status == 1 ? 'checked':'' }} />
                                </div>

                                <div class="col-md-12 mb-3">
                                    <h4>SEO Tags</h4>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Meta_Title</label>
                                    <input type="text" name = "meta_title" value = "{{ $category->meta_title }}" class = "form-control" />
                                    @error('meta_title') <small class = "text-danger">{{$message}}</small> @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Meta_Keyword</label>
                                    <textarea name="meta_keyword" class = "form-control" rows = "3">{{ $category->meta_keyword }}</textarea>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label>Meta_Description</label>
                                    <textarea name="meta_description" class = "form-control" rows = "3">{{ $category->meta_description }}</textarea>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <button type = "submit" class = "btn btn-primary float-end">Update</button>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

@endsection