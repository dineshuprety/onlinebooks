
      <?php
      

      if($post_count > $post_per_page){ ?>

              <ul class="pagination px-5">
              <?php
                if(isset($_GET['page'])){
                  $prev=$_GET['page']-1;
                }else{
                  $prev=0;
                }
                if($prev+1<=1){
                  echo '
                      <li class="page-item disabled">
                      <a class="page-link" href="index.php?page='.$page_id.'" tabindex="-1">Previous</a>
                    </li>
                  ';
                }else{
                  echo '
                      <li class="page-item">
                      <a class="page-link" href="index.php?page='.$prev.'" tabindex="-1">Previous</a>
                    </li>
                  ';
                }
              ?> 
             
             <?php
                    if(isset($_GET['page'])){
                      $active=$_GET['page'];
                    }else{
                      $active=1;
                    }

                  for($i=1; $i<=$total_pager; $i++){
                    if($i==$active){
                      echo ' <li class="page-item active"><a class="page-link " href="index.php?page='.$i.'">'.$i.'</a></li>';
                    }else{
                      echo ' <li class="page-item"><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
                    }
                    
                  }
             
               ?>
               <?php
               if(isset($_GET['page'])){
                 $next=$_GET['page']+1;
               }else{
                 $next=2;
               }
               if($next-1 >= $total_pager){

                  echo ' <li class="page-item disabled">
                  <a class="page-link" href="#">Next</a>
                </li>';

               }else{
                 echo ' <li class="page-item">
                 <a class="page-link" href="index.php?page='.$next.'">Next</a>
               </li>';
               }
                
               ?>
            </ul>

      <?php }
        // pagenation ends
    ?>
