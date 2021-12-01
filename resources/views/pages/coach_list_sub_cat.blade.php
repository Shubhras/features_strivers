<?php foreach ($user as $coach_list) {
     ?>
          <div class="col-sm-4" >
               <img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid" style="height: 200px;" alt="{{ $coach_list->name }}">
               <br>
               <h3><b>{{ $coach_list->name }}</b></h3>
          </div>

     <?php 
} 
?>
               






