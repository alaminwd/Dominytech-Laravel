@extends('front-end.master')


@section('content_master')
    
<!-- ============================== 
        Contact part start
==================================== -->
<section id="contact-section">
    <div class="container">
        <h4 class="breadcrumb p_color " style="font-size: 14px;"><a href="{{route('index')}}" class="p_color p_hover">Home</a><i class="fa-solid fa-angle-right" style="margin:0px 5px; font-size: 12px;"></i><a href="{{route('contact.page')}}" class="p_color p_hover">Contact</a></h4>
        <div class="row">
            <div class="col-lg-6 col-md-7 m-auto">
                <div class="contact-content">
                    <div class="contact-title">
                        <span>{{$contact_info->sub_title}}</span>
                        <h2>{{$contact_info->title}}</h2>
                    </div>
                    <p>{{$contact_info->desp}}</p>
                </div>
            </div>
            <div class="col-lg-6 col-md-5 col-12">
                <form action="{{route('send.message')}}" method="POST" id="contactform">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <input type="text" class="form-control" placeholder="Name*" id="name" name="name">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <input type="Email" class="form-control" placeholder="Email*" id="email" name="email">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <input type="number" class="form-control" placeholder="Phone*" id="phone" name="phone">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mt-3">
                                <input type="text" class="form-control" placeholder="Subject*" id="subject" name="subject">
                                
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mt-3">
                                <textarea name="desp" id="desp" class="form-control" style="resize: none; height: 100px;"
                                    placeholder="Content*" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mt-4">
                                <button type="submit" id="sendMessage" class="btn w-100">Send Message</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



<!-- ==============================
    Google Maps 
=================================-->

<section id="google-map">
    <div class="container-fluid">
        <div class="row">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14608.039158733363!2d90.36554080278788!3d23.747030307337045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b33cffc3fb%3A0x4a826f475fd312af!2sDhanmondi%2C%20Dhaka%201205!5e0!3m2!1sen!2sbd!4v1701326155158!5m2!1sen!2sbd"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>



@endsection

@section('footer_master')
{!! Toastr::message() !!}

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    $(document).on('click', '#sendMessage', function(e) {
    e.preventDefault();

    let name = $('#name').val();
    let email = $('#email').val();
    let phone = $('#phone').val();
    let subject = $('#subject').val();
    let desp = $('#desp').val();
    let _token = $('input[name="_token"]').val();

    if (!name || !email || !phone || !desp) {
        toastr.warning("Please fill all fields!", "Warning!", {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-left",
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

    let formData = new FormData();
    formData.append('name', name);
    formData.append('email', email);
    formData.append('phone', phone);
    formData.append('subject', subject);
    formData.append('desp', desp);
    formData.append('_token', _token);

    $.ajax({
        url: "{{ route('send.message') }}",
        method: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(res) {
            if (res.status === 'success') {
                $('#contactform')[0].reset();
                toastr.success("Message sent successfully!", "Success!", {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-left",
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
                toastr.error(res.message, "Error!", {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-left",
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
        error: function(xhr, status, error) {
            toastr.error("An error occurred. Please try again.", "Error!", {
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
    });
});

</script>

@endsection