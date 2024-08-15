@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <h4>Support -01</h4>
                        </div>
                        <table class="table table-hover">
                            <tr class="text-center">
                                <th>#sl</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($supports as $sl=>$support )
                                <tr class="text-center">
                                    <td>{{$sl+1}}</td>
                                    <td>{{$support->title}}</td>
                                    <td>{{Str::limit($support->desp, 50)}}..</td>
                                    <td>
                                        <a href="{{route('support.edit', $support->id)}}" class="btn btn-info edit_category">Edit
                                            <!-- Edit Icon SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer_script')
    
@endsection