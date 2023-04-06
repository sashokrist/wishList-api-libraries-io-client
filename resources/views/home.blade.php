@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h3 class="text-center">
                            {{ __('Profile - ') }} {{ auth()->user()->name }}
                        </h3></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                            <form action="{{ route('deactivate') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger">Deactivate</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
