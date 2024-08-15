@extends('layouts.dashboard')
<style>
    /* Custom toastr styles */
    .toast-warning {
        background-color: #f0ad4e !important;  /* Customize background color */
        color: #fff !important;  /* Customize text color */
    }
    .toast-error {
        background-color: #28a745 !important; 
        color: #fff !important; 
    }
    .toast-success {
        background-color: #28a745 !important;  
        color: #fff !important; 
    }
</style>

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card m-auto">
                <div class="card">
                  <div class="card-body">
                        <h6 class="card-title">Notification Message</h6>
                        <form class="forms-sample" id="mail_Form" action="{{ route('send.mail') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputUsername1">Name*</label>
                                <input type="hidden" name="id" value="{{ $message->id }}">
                                <input type="text" class="form-control" id="exampleInputUsername1" name="name" autocomplete="off" value="{{ $message->name }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="{{ $message->email }}">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMessage">Message</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="5">{{ $message->desp }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputMessageReplay">Message Reply</label>
                                <textarea class="form-control" id="reply" name="reply" rows="5"></textarea>
                            </div>
                            <button type="button" id="sending_mail" class="btn btn-primary mr-2">Submit</button>
                        </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection


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
    $(document).on('click', '#sending_mail', function(e){
        e.preventDefault();

        let form = $('#mail_Form')[0];
        let formData = new FormData(form);
        let reply = $('#reply').val();

        if (!reply) {
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
            url: "{{ route('send.mail') }}",
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            success: function(res) {
                if (res.status === 'success') {
                    $('#mail_Form')[0].reset();
                    toastr.success("Email sent successfully!", "Success!", {
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
                } else {
                    toastr.success(res.message, "Error!", {
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
@endsection