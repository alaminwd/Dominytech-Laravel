
  
<!DOCTYPE html>
<!--
Template Name: NobleUI - Admin & Dashboard Template
Author: NobleUI
Website: https://www.nobleui.com
Contact: nobleui123@gmail.com
Purchase: https://1.envato.market/nobleui_admin
License: You must have a valid license purchased only from above link or https://themeforest.net/user/nobleui/portfolio/ in order to legally use the theme for your project.
-->
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gymove - Fitness Bootstrap Admin Dashboard</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
	<link rel="stylesheet" href="{{asset('back-end/vendor/chartist/css/chartist.min.css ')}}">
    <link href="{{asset('back-end/vendor/bootstrap-select/dist/css/bootstrap-select.min.css ')}}" rel="stylesheet">
	<link href="{{asset('back-end/vendor/owl-carousel/owl.carousel.css ')}}" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	
    <link href="{{asset('back-end/css/style.css ')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>

	    

<!-- Button trigger modal -->
{{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button> --}}
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <form action="{{route('add.category')}}" method="POST" id="category_Form" enctype="multipart/form-data">
        @csrf 
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="mb-3">
                      <label class="form-label">Category Name</label>
                      <input type="text" class="form-control" name="category" id="category">
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Slug</label>
                      <input type="text" class="form-control" name="slug" id="slug">
                      <span class="full-slug-show">https://dominyteach.com/</span>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Short Description</label>
                      <textarea class="form-control" name="short_description" id="short_description" rows="5" placeholder="Max 100 character"></textarea>
                  </div>
                  <div class="mb-3">
                      <label class="form-label">Long Description</label>
                      <textarea class="form-control" name="long_description" id="long_description" rows="5" placeholder="Max 250 character"></textarea>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Upload Image</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary add_category">Save changes</button>
                </div>
              </div>
            </div>
      </form>
  </div>




<!-- Button trigger modal -->
      <!-- Modal -->
   
 <!-- Required vendors -->
 <script src="{{asset('back-end/vendor/global/global.min.js ')}}"></script>
 <script src="{{asset('back-end/vendor/bootstrap-select/dist/js/bootstrap-select.min.js ')}}"></script>
 <script src="{{asset('back-end/vendor/chart.js/Chart.bundle.min.js ')}}"></script>
   <script src="{{asset('back-end/js/custom.min.js ')}}"></script>
 <script src="{{asset('back-end/js/deznav-init.js ')}}"></script>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
 <script src="{{asset('back-end/js/deznav-init.js ')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
 {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

 <script src="{{asset('back-end/vendor/owl-carousel/owl.carousel.js ')}}"></script>
 
 <!-- Chart piety plugin files -->
   <script src="{{asset('back-end/vendor/peity/jquery.peity.min.js ')}}"></script>
 
 <!-- Apex Chart -->
 <script src="{{asset('back-end/vendor/apexchart/apexchart.js ')}}"></script>
 
 <!-- Dashboard 1 -->
 <script src="{{asset('back-end/js/dashboard/dashboard-1.js ')}}"></script>
 <script>
   function carouselReview(){
     /*  testimonial one function by = owl.carousel.js */
     jQuery('.testimonial-one').owlCarousel({
       loop:true,
       autoplay:true,
       margin:30,
       nav:false,
       dots: false,
       left:true,
       navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
       responsive:{
         0:{
           items:1
         },
         484:{
           items:2
         },
         882:{
           items:3
         },	
         1200:{
           items:2
         },			
         
         1540:{
           items:3
         },
         1740:{
           items:4
         }
       }
     })			
   }
   jQuery(window).on('load',function(){
     setTimeout(function(){
       carouselReview();
     }, 1000); 
   });
 </script>
  
	@yield('footer_script')
	

	<!-- end custom js for this page -->
</body>
</html>    
  

     

