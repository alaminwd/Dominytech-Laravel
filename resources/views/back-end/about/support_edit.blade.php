@extends('layouts.dashboard')
<style>
    .toastr.success{
        background: #14A44D !important;
        color: #fff;
    }
</style>

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Update Form</h6>
                        <form class="forms-sample" action="{{route('support.update')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Title</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" name="title" value="{{$info->title}}">
                                <input type="hidden" name="id" value="{{$info->id}}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="desp" rows="5">{{$info->desp}}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2 w-50 text-center">Submit</button>
                        </form>
                    </div>
                  </div>
            </div>
        </div>
    </div>
@endsection


@section('footer_script')
<script>
    @if(session('cart-update'))
        toastr.success("{{ session('cart-update') }}");
    @endif



    @if(session('cart-error'))
        toastr.error("{{ session('cart-error') }}");
    @endif
</script>

@endsection