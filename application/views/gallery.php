 <!-- ========== Breadcrumb Section Start ========== -->
 <div class="py-12">
     <div class="container">
         <div class="breadcrumb">
             <ul>
                 <li>
                     <a href='<?= base_url('/') ?>'>
                         <span>
                             <i class="hgi hgi-stroke hgi-home-01 text-[20px]"></i>
                         </span>
                         Home
                     </a>
                 </li>
                 <li class="text-light-disabled-text">&#8226;</li>
                 <li><span>Gallery</span></li>
             </ul>
         </div>
     </div>
 </div>
 <!-- ========== Breadcrumb Section End ========== -->

 <div class="pb-12">
     <div class="container">
         <div class="grid grid-cols-12 gap-6">
             <div class="xl:col-span-12 col-span-12">

                 <div id="gallery" class="grid 2xl:grid-cols-3 xl:grid-cols-2 grid-cols-12 gap-6 pb-12">

                     <?php
                    for($i=1; $i<47; $i++){
                    ?>

                     <div class="gallery-item 2xl:col-span-1 xl:col-span-1 md:col-span-6 col-span-12">
                         <div class="mb-6">
                             <img src="assets/images/gallery/<?= $i ?>.jpeg" class="rounded-xl gallery-img"
                                 style="height:500px;width:100%;cursor:pointer;" onclick="openPopup(this.src)">
                         </div>
                     </div>

                     <?php } ?>

                 </div>

                 <div class="text-center">
                     <div id="loadMore" class="btn btn-large btn-primary rounded-[100px] px-[35px] py-[11px]">
                         <a href="#">Load More</a>
                     </div>
                 </div>

             </div>
         </div>
     </div>
 </div>

 <div id="imagePopup" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
     background:rgba(0,0,0,0.8); justify-content:center; align-items:center; z-index:9999;">

     <span onclick="closePopup()"
         style="position:absolute; top:20px; right:40px; color:white; font-size:40px; cursor:pointer;">
         &times;
     </span>

     <img id="popupImg" style="max-width:90%; max-height:90%; border-radius:10px;">
 </div>

 <script>
document.addEventListener("DOMContentLoaded", function() {

    let items = document.querySelectorAll(".gallery-item");
    let loadMore = document.getElementById("loadMore");

    let visible = 12;

    items.forEach((item, index) => {
        if (index >= visible) {
            item.style.display = "none";
        }
    });

    loadMore.addEventListener("click", function() {

        visible += 12;

        items.forEach((item, index) => {
            if (index < visible) {
                item.style.display = "block";
            }
        });

        if (visible >= items.length) {
            loadMore.style.display = "none";
        }

    });

});


function openPopup(src) {
    document.getElementById("popupImg").src = src;
    document.getElementById("imagePopup").style.display = "flex";
}

function closePopup() {
    document.getElementById("imagePopup").style.display = "none";
}
 </script>