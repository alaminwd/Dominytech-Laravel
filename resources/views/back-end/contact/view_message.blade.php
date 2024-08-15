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
                    <h6 class="card-title">Contact Message</h6>
                    <form class="forms-sample" id="mail_Form" action="{{ route('reply.message') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Name*</label>
                            <input type="hidden" name="id" value="{{ $contact_message->id }}">
                            <input type="text" class="form-control" readonly name="name" autocomplete="off" value="{{ $contact_message->name }}">
                        </div>
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" class="form-control" readonly name="email" value="{{ $contact_message->email }}">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input type="number" class="form-control" readonly name="phone" value="{{ $contact_message->phone }}">
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" class="form-control" readonly name="subject" value="{{ $contact_message->subject }}">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" readonly name="message" rows="5">{{ $contact_message->desp }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Message Reply</label>
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
            url: "{{ route('reply.message') }}",
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