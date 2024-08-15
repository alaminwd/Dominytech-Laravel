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
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-header">
                    <h4 class="d-inline">Project Information </h4>
                    <button data-toggle="modal" data-target="#AddprojectModal" class="btn btn-primary float-right" style="height: 30px; width:150px">Add Project</button>
                
                </div>
                <div class="card-body">
                    <div class="table-responsive pt-3">
                        <table class="table table-hover category_table">
                            <thead>
                                <tr class="text-center">
                                    <th>#</th>
                                    <th>Single Project</th>
                                    <th>Category Name</th>
                                    <th>Title</th>
                                    <th>slug</th>
                                    <th>Client Name</th>
                                    <th>Location</th>
                                    <th>Project Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($projects as $sl=> $project)
                                <tr class="text-center">
                                    <td>{{$sl+1}}</td>
                                    <td>{{$project->class}}</td>
                                    <td>{{$project->rel_to_category->category_name}}</td>
                                    <td>{{$project->title}}</td>
                                    <td>{{$project->slug}}</td>
                                    <td>{{$project->client}}</td>
                                    <td>{{$project->location}}</td>
                                    <td>
                                        <img src="{{asset('upload/project')}}/{{$project->image}}" alt="">
                                    </td>
                                    <td>
                                        <button data-id="{{$project->id}}" class="btn btn-danger delete_project"><svg xmlns="" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button>
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
</div>
@endsection 

@extends('back-end.project.add_project');


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
    (function($){
        // "use strict";
        $(document).ready(function(){
            // Transliterate Cyrillic and Arabic characters to Latin
            function transliterateCyrillic(text) {
                const cyrillicToLatinMap = {
                    'А': 'A', 'а': 'a', 'Б': 'B', 'б': 'b', 'В': 'V', 'в': 'v',
                    'Г': 'G', 'г': 'g', 'Д': 'D', 'д': 'd', 'Е': 'E', 'е': 'e',
                    'Ё': 'Yo', 'ё': 'yo', 'Ж': 'Zh', 'ж': 'zh', 'З': 'Z', 'з': 'z',
                    'И': 'I', 'и': 'i', 'Й': 'Y', 'й': 'y', 'К': 'K', 'к': 'k',
                    'Л': 'L', 'л': 'l', 'М': 'M', 'м': 'm', 'Н': 'N', 'н': 'n',
                    'О': 'O', 'о': 'o', 'П': 'P', 'п': 'p', 'Р': 'R', 'р': 'r',
                    'С': 'S', 'с': 's', 'Т': 'T', 'т': 't', 'У': 'U', 'у': 'u',
                    'Ф': 'F', 'ф': 'f', 'Х': 'Kh', 'х': 'kh', 'Ц': 'Ts', 'ц': 'ts',
                    'Ч': 'Ch', 'ч': 'ch', 'Ш': 'Sh', 'ш': 'sh', 'Щ': 'Shch', 'щ': 'shch',
                    'Ъ': '', 'ъ': '', 'Ы': 'Y', 'ы': 'y', 'Ь': '', 'ь': '',
                    'Э': 'E', 'э': 'e', 'Ю': 'Yu', 'ю': 'yu', 'Я': 'Ya', 'я': 'ya',
                    // Additional characters for other Cyrillic-based languages
                    'Ә': 'Ae', 'ә': 'ae', 'Ғ': 'Gh', 'ғ': 'gh', 'Қ': 'Q', 'қ': 'q',
                    'Ң': 'Ng', 'ң': 'ng', 'Ө': 'Oe', 'ө': 'oe', 'Ұ': 'U', 'ұ': 'u',
                    'Ү': 'Ue', 'ү': 'ue', 'Һ': 'H', 'һ': 'h', 'І': 'I', 'і': 'i',
                    // Ukrainian specific
                    'Є': 'Ye', 'є': 'ye', 'І': 'I', 'і': 'i', 'Ї': 'Yi', 'ї': 'yi',
                    'Ґ': 'G', 'ґ': 'g',
                    // Belarusian specific
                    'Ў': 'U', 'ў': 'u',
                    // Serbian specific
                    'Ђ': 'Dj', 'ђ': 'dj', 'Ј': 'J', 'ј': 'j', 'Љ': 'Lj', 'љ': 'lj',
                    'Њ': 'Nj', 'њ': 'nj', 'Ћ': 'C', 'ћ': 'c', 'Џ': 'Dz', 'џ': 'dz',
                    // Macedonian specific
                    'Ѓ': 'Gj', 'ѓ': 'gj', 'Ѕ': 'Dz', 'ѕ': 'dz', 'Ќ': 'Kj', 'ќ': 'kj',
                    'Љ': 'Lj', 'љ': 'lj', 'Њ': 'Nj', 'њ': 'nj', 'Џ': 'Dz', 'џ': 'dz'
                };

                const arabicToLatinMap = {
                    'ا': 'a', 'أ': 'a', 'إ': 'i', 'آ': 'aa', 'ب': 'b', 'ت': 't', 'ث': 'th',
                    'ج': 'j', 'ح': 'h', 'خ': 'kh', 'د': 'd', 'ذ': 'dh', 'ر': 'r', 'ز': 'z',
                    'س': 's', 'ش': 'sh', 'ص': 's', 'ض': 'd', 'ط': 't', 'ظ': 'dh', 'ع': 'a',
                    'غ': 'gh', 'ف': 'f', 'ق': 'q', 'ك': 'k', 'ل': 'l', 'م': 'm', 'ن': 'n',
                    'ه': 'h', 'و': 'w', 'ي': 'y', 'ى': 'a', 'ة': 'h', 'ئ': 'e', 'ء': 'a',
                    'ؤ': 'o', 'لا': 'la'
                };

                const langToLatinMap = currentLang() === 'ar' ? arabicToLatinMap : cyrillicToLatinMap;

                return text.split('').map(char => langToLatinMap[char] || char).join('');
            }

            function convertToSlug(text) {
                const transliteratedText = transliterateCyrillic(text);

                return transliteratedText
                    .toLowerCase()
                    .trim()
                    .replace(/\s+/g, '-');           // Replace spaces with -
            }

            function currentLang() {
                return document.documentElement.lang === 'ar' ? 'ar' : 'cy';
            }

            $(document).on('keyup', '#title', function (e) {
                let slug = convertToSlug($(this).val());
                $('#slug').val(slug);

                let url = `https://dominyteach.com/` + slug;
                $('.full-slug-show').text(url);
            });
            
        });
    })(jQuery);
</script>

<script>
    $(document).on('click', '.add_project', function(e){
        e.preventDefault();
        let classValue = $('#class').val();
        let category_id = $('#category_id').val();
        let title = $('#title').val();
        let slug = $('#slug').val();
        let client = $('#client').val();
        let location = $('#location').val();
        let short_description = $('#short_description').val();
        let image = $('#image')[0].files[0];
        let _token = $('meta[name="csrf-token"]').attr('content');

        if (!title || !slug || !image || !category_id) {
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

        let formData = new FormData();
        formData.append('class', classValue);
        formData.append('category_id', category_id);
        formData.append('title', title);
        formData.append('slug', slug);
        formData.append('client', client);
        formData.append('location', location);
        formData.append('short_description', short_description);
        formData.append('image', image);
        formData.append('_token', _token);

        $.ajax({
            url: "{{ route('add.project') }}",
            method: 'post',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': _token
            },
            success: function(res) {
                if (res.status === 'success') {
                    $('#blog_Form')[0].reset();
                    toastr.success("Blog added successfully!", "Success!", {
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
            error: function(xhr, status, error) {
                console.log('Server response:', xhr.responseText);
                let errorMessage = xhr.status + ': ' + xhr.statusText;
                toastr.error("Error - " + errorMessage, "Error!", {
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


<script>
    $(document).on('click', '.delete_project', function(e){
        e.preventDefault();
        let project_id = $(this).data('id');
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
                    url: "{{ route('delete.project') }}", // Make sure this route expects a POST/DELETE request
                    method: 'POST', // Use POST or DELETE
                    data: {
                        _token: "{{ csrf_token() }}", // Include CSRF token
                        project_id: project_id,
                    },
                    success: function(res) {
                        if (res.status === 'success') {
                            $('.category_table').load(location.href + ' .category_table', function() {
                                Swal.fire(
                                    'Deleted!',
                                    'The user has been deleted.',
                                    'success'
                                );
                            });
                        }
                    },
                    error: function() {
                        Swal.fire(
                            'Error!',
                            'There was a problem deleting the user.',
                            'error'
                        );
                    }
                });
            }
        });
    });
</script>
@endsection