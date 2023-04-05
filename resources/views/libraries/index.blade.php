@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h2 class="text-center"> {{ __('Libraries') }}</h2></div>
                    <div>
                        <a href="{{ route('libraries/create') }}" class="btn btn-primary">Create library</a>
                    </div>
                    <div class="card-body">
                        <div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">URL</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($libraries as $item)
                                    <tr>
                                        <td>{{ $item->id }}
                                            <form action="{{ route('destroy', $item->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm">X</button>
                                            </form>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>{{ $item->url }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        setTimeout(function () {
            $('.alert').fadeOut('slow');
        }, 3000);
    </script>
@endsection



