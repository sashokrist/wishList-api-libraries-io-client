@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h2 class="text-center"> {{ __('Create Library') }}</h2></div>
                    <div class="card-body">
                        <div>
                            <form method="POST" action="{{ route('/libraries/store') }}" class="form-control">
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
                                        <span>URL</span>
                                        <input type="text" class="form-control" name="url" placeholder="enter url"></input>
                                    </label>
                                    @error('url')
                                    <div>{{ $message }}</div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Create Library</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

