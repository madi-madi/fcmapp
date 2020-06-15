@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <span>Dashboard | Posts | Add Post</span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('posts.store')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                          <label for="title">Title</label>
                                          <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Title">
                                          @error('title')
                                          <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
                                        </div>


                                        <div class="form-group">
                                          <label for="body">Content</label>
                                          <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" rows="3"></textarea>
                                          @error('body')
                                          <div class="alert alert-danger">{{ $message }}</div>
                                      @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary mb-2">Add</button>

                                      </form>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
