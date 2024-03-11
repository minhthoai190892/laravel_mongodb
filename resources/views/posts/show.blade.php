@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    {{-- title --}}
                    <div class="card-header">{{ __('Posts') }}</div>

                    <div class="card-body">
                        {{-- Show message --}}
                        @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Succsess!</strong>{!! session('success_message') !!}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                        @endif
                        {{-- Show message --}}
                        <a href="{{ url('/posts'.'/create') }}">Create New Post</a>
                        <table id="postsID" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 20%">Title</th>
                                    <th>Description</th>
                                    <th style="width: 10%">Added On</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td>{{ $post['title'] }}</td>
                                        <td>{{ $post['description'] }}</td>
                                        <td>{{ date('d-m-Y', strtotime($post['created_at'])) }}</td>
                                        <td>
                                            <form action="{{ route('posts.destroy', ['post' => $post['_id']]) }}"
                                                method="POST" style="float: right;margin-left: 10px">
                                                @csrf @method('delete')
                                                <button type="submit" class="btn btn-primary btn-block">Delete</button>
                                            </form>
                                            <a href="{{ url('posts/' . $post['_id'] . '/edit') }} "style="float: right"><button
                                                    type="submit" class="btn btn-primary btn-block">Update</button>
                                            </a>&nbsp;
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
