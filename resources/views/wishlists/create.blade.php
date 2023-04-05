@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h2 class="text-center"> {{ __('Create List') }}</h2></div>
                    <div class="card-body">
                        <div>
                            <form method="POST" action="{{ route('/wishlists/store') }}" class="form-control">
                                @csrf
                                <div class="mb-6">
                                    <label class="block">
                                        <span>Name</span>
                                        <input type="text" name="name" class="form-control" placeholder="enter name"/>
                                    </label>
                                    @error('name')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label class="block">
                                        <span>Description</span>
                                        <textarea class="form-control" name="description" placeholder="enter description"></textarea>
                                    </label>
                                    @error('description')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-6">
                                    <label class="block">
                                        <span>Library</span>
                                        <select name="library_id" class="form-select">
                                            @foreach($libraries as $library)
                                                <option value="{{ $library->id }}">{{ $library->name }}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    @error('library_id')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Create WishList</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

