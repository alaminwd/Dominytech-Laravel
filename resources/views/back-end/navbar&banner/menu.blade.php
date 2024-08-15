@extends('layouts.dashboard')
<style>
    /* Custom toastr styles */
    .toast-warning {
        background-color: #f0ad4e !important;  /* Customize background color */
        color: #fff !important;  /* Customize text color */
    }
    .toast-success {
        background-color: #28a745 !important;  /* Customize background color */
        color: #fff !important;  /* Customize text color */
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Menu list</h4>
                        <p class="card-description">
                            Add class <code>.table-dark</code>
                        </p>
                        <div class="table-responsive pt-3">
                            <table class="table table-hover menu_table">
                                <thead>
                                    <tr class="text-center">
                                        <th>#</th>
                                        <th>Menu Name</th>
                                        <th>Menu Link</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menus as $sl=>$menu )
                                    <tr class="text-center">
                                        <td>{{$sl+1}}</td>
                                        <td>{{$menu->menu_name}}</td>
                                        <td>{{$menu->menu_link}}</td>
                                        <td>
                                            <button data-id="{{$menu->id}}" data-name="{{$menu->menu_name}}" data-link="{{$menu->menu_link}}" class="btn btn-info update_menu" data-toggle="modal" data-target="#updateMenu">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                            </button>

                                            <button data-id="{{$menu->id }}" class="btn btn-danger delete_menu"><svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 grid-margin">
                <div class="card" style="height: auto !important">
                    <div class="card-header">
                        <h6 class="card-title">Add Menu</h6>
                    </div>
                    <div class="card-body">
                        <div class="error-message"></div>
                        {{-- <div class="img_success mb-3"></div> --}}
                        <form class="forms-sample" id="menu_from" action="{{route('add.menu')}}" method="post" enctype="multipart/form-data">
                            @csrf
                                <div class="mb-3">
                                    <label>Menu Name</label>
                                    <input type="text" class="form-control" id="menu_name" name="menu_name" placeholder="menu name">
                                </div>
                                <div class="mb-3">
                                    <label>Menu Link</label>
                                    <input type="text" class="form-control" id="menu_link" name="menu_link" placeholder="menu link">
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary add_menu" type="submit">Add Menu</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('back-end.navbar&banner.edit_menu');


@section('footer_script')
{!! Toastr::message() !!}
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script> 
        $(document).on('click', '.add_menu', function(e){
            e.preventDefault();
            let menu_name = $('#menu_name').val();
            let menu_link = $('#menu_link').val();

            if (!menu_name || !menu_link) {
            toastr.warning("Please fill all fields!", "Warning!", {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            });
            return false;
        }
        
            $.ajax({
                url:"{{route('add.menu')}}",
                method:'post',
                data:{menu_name:menu_name, menu_link:menu_link},
                success:function(res){
                        if(res.status == 'success'){
                            $('.menu_table').load(location.href + ' .menu_table'),
                            $('#menu_from')[0].reset();
                            toastr.success("Category added successfully!", "Success!", {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": true,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "5000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        });
                    }else {
                    toastr.error(res.message, "Error!", {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": true,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    });
                }
                },
                
            });
          
        });
    </script>

    <script>
          $(document).on('click', '.update_menu', function() {
                let id = $(this).data('id');
                let menu_name = $(this).data('name'); // Corrected to 'name' to match data-name attribute
                let menu_link = $(this).data('link');
        
               
                $('#menu_id').val(id);
                $('#menu_name').val(menu_name);
                $('#menu_link').val(menu_link);
            });
            $(document).on('click', '.up_menu', function(e){
            e.preventDefault();
            let menu_id = $('#menu_id').val();
            let menu_name = $('#menu_name').val();
            let menu_link = $('#menu_link').val();
        
            $.ajax({
                url:"{{route('update.menu')}}",
                method:'post',
                data:{menu_id:menu_id, menu_name:menu_name, menu_link:menu_link},
                success:function(res){
                    if(res.status == 'success'){
                        // $('#updateMenu').modal('hide');
                        $('#update_menu_form')[0].reset();
                        $('.menu_table').load(location.href + ' .menu_table');
                       
                    }
                },
                error:function(err){
                    $('.error-message').html('');
                    let error = err.responseJSON;
                
                    $.each(error.errors, function(index, value){
                        $('.error-message').append(' <span class="text-danger">'+value+'</span> ');
                    })
                }
            });
          
        });
    </script>

    <script>
        $(document).on('click', '.delete_menu', function (event) {
            event.preventDefault();
            let menu_id = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ route('delete.menu') }}", // Make sure this route expects a POST/DELETE request
                        method: 'POST', // Use POST or DELETE
                        data: {
                            _token: "{{ csrf_token() }}", // Include CSRF token
                            menu_id: menu_id
                        },
                        success: function(res) {
                            if (res.status === 'success') {
                                $('.menu_table').load(location.href + ' .menu_table', function() {
                                    Swal.fire(
                                        'Deleted!',
                                        'The Menu Item has been deleted.',
                                        'success'
                                    );
                                });
                            } 
                        },
                    });
                }
            });
        });
    </script>


@endsection