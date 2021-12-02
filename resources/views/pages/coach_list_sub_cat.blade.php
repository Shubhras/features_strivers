<?php foreach ($user as $coach_list) {
     ?>
          <div class="col-sm-4" >
               <img src="{{ imgUrl($coach_list->photo, '') }}" class="lazyload img-fluid" style="height: 200px;" alt="{{ $coach_list->name }}">
               <br>
               <?php
                    $name = json_decode($coach_list->sub_cat);
                    $ss = array();
                    foreach ($name as $key => $sub) {
                    $ss[$key] = $sub;
                    }
               ?>
               <h4><b>{{ $coach_list->name }}</b></h4>
               <p><b>{{ $ss['en'] }}</b></p>
               <?php if($coach_list->year_of_experience!=''){?> 
                    <p><b>{{ $coach_list->year_of_experience }} years Experience</b></p>
                    <?php 
               }
               else{?>
                    <p><b>No Experience</b></p>  
               <?php }?>
          </div>

     <?php 
} 
?>
               






