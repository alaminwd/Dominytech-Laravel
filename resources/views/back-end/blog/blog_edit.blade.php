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
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Basic Form</h6>
                    <form class="forms-sample" id="blogForm" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" value="{{$blog->id}}">
                            <label for="exampleInputUsername1">Title</label>
                            <input type="text" class="form-control" name="title" id="title"  value="{{$blog->title}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slug</label>
                            <input type="text" class="form-control" name="slug" id="slug" value="{{$blog->slug}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Short Description</label>
                            <input class="form-control" name="short_desp" value="{{$blog->short_desp}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Long Description</label>
                            <textarea class="form-control summernote" name="long_desp" id="exampleFormControlTextarea1" rows="5">{{$blog->long_desp}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="form-group text-center">
                            <button type="button" id="submitBtn" class="btn btn-primary mr-2 w-50">Update Blog</button>
                        </div>
                    </form>
                    {!! Toastr::message() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
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
    document.getElementById('submitBtn').addEventListener('click', function(event) {
        event.preventDefault();
        updateBlog();
    });

    function updateBlog() {
        let formData = new FormData(document.getElementById('blogForm'));

        fetch('{{ route("update.blog")}}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(res => {
            if (res.status === 'error') {
                toastr.error(res.message.join('<br>'), "Error!", {
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
                toastr.success(res.message, "Success!", {
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
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>

    
@endsection