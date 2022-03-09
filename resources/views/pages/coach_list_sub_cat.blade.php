<?php foreach ($user as $coach_list) {
     ?>
          <div class="col-sm-4"  data-toggle="modal" data-target="#myModal_{{$coach_list->id }}">
               <img src="{{ url('storage/'.$coach_list->photo) }}" class="lazyload img-fluid" style="height: 200px;" alt="{{ $coach_list->name }}">
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
          <div class="modal" id="myModal_{{$coach_list->id }}">
                            <div class="modal-dialog">
                            <div class="modal-content" style="margin-top: 172px;">
                            
                                <!-- Modal Header -->
                                <div class="modal-header" id="{{$coach_list->id }}" >
                                </div>
                                
                                <!-- Modal body -->
                                <div class="modal-body">
                                <img src="{{ url('storage/'.$coach_list->photo) }}" class="lazyload img-fluid" style="height: 100px;padding-left: 237px;">
                                
                                    <h4><b><center>{{ $coach_list->name }}</center></b></h4>
                                    <p><b><center>{{ $ss['en'] }}</center></b></p>
                                    <?php if($coach_list->year_of_experience!=''){?> 
                                        <p><b><center>{{ $coach_list->year_of_experience }} years Experience</center></b></p>
                                        <?php 
                                    }
                                    else{?>
                                        <p><b><center>No Experience</center></b></p>  
                                    <?php }?>
                                
                                
                                </div>
                                
                                <!-- Modal footer -->
                                <div class="modal-footer" style="justify-content:center;!important">
                                <a href="{{url('/coachall_detail/'.$coach_list->id) }}">
                                
                                <button type="button" class="btn btn-default btn-lg" >Know More</button></a>
                                
                                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal">Get Started</button>
                                </div>
                                
                            </div>
                            </div>
                             </div>

     <?php 
} 
?>
               






