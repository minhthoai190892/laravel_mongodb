@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    {{-- title --}}
                    <div class="card-header">{{ __('Posts') }}</div>

                    <div class="card-body">
                        <table id="postsID" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Added On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    
                               
                                <tr>
                                    <td>{{ $post['title'] }}</td>
                                    <td>{{ $post['description'] }}</td>
                                    <td>{{ date("d-m-Y",strtotime($post['created_at'] ))}}</td>
                                    <td><a href="{{ url('posts'.$post['_id'].'/edit') }}">Update</a></td>
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
