<?php if ( !is_user_logged_in() ) { header("location:". site_url() ."/wp-login");}?>
<?php 

	global $current_user;

      get_currentuserinfo();


     // make my list of users videos
     $mylist_videos = [];
      global $wpdb;
      $table = 'videomylist_users';
      // var_dump($_POST['mylist_video']);
     if (isset($_POST['mylist_video'])) {
            // echo "debug ok!! level 1";
            $data = array(
                'post_id' => $_POST['mylist_video'],
                'user_id'    => $current_user->ID
            );
            $format = array(
                '%s',
                '%s'
            );
            $success=$wpdb->insert( $table, $data, $format );
            if($success){
                // echo "debug ok!!";die();
            }
        } 

     if (isset($_POST['unlist_video'])) {
            // echo "debug ok!! level 1";
            // 
            $success = $wpdb->get_results( "DELETE FROM videomylist_users where user_id=" . $current_user->ID ." AND post_id=" . $_POST['unlist_video']);
        		 header('Location:'. $_POST['redirect_to']);

        } 
     
      // this will get the data from your table
      $retrieve_data = $wpdb->get_results( "SELECT * FROM videomylist_users where user_id=" . $current_user->ID);
      // echo "<pre>" . var_dump($retrieve_data) . "</pre>";

      if (count($retrieve_data)) {
        foreach ($retrieve_data as $key => $data) {
          $mylist_videos[] = $data->post_id;
        }
      }

      if (isset($_GET['ajax_mylist_video'])) {

          $args = array(
            'post_type'      => 'videos',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
            'orderby'=> 'title',
            'order' => 'ASC'
          );
          $video_the_query = new WP_Query( $args );
          $v_list_num = 0;
          if($video_the_query->have_posts())
          {
              $html = '<div class="container-fluid"><div class="row">';
              while ( $video_the_query->have_posts() ) :
                  $video_the_query->the_post();
                  $video_post_id = get_the_ID(); 

                  if(in_array($video_post_id, $mylist_videos)){ 
                    
                    $v_list_num++;
          
                    $html .= '<div class="col-md-12" id="video-main">
                                  <a href="'. get_the_permalink() .'">
                                      <div class="col-md-4 video-list-inner">
                                          <div class="video-thum-img">
                                            <img src="'. get_the_post_thumbnail_url() .'" alt="sponsored-img" class="video-img">
                                          </div>
                                                                  
                                          <div class="play-btn">
                                            <span></span>
                                          </div>
                                       </div>
                                       <div class="col-md-8 video-list-desc">
                                          <div class="video-name">'. get_the_title() .'</div>
                                          <div class="video-desc"> '. mb_strimwidth(get_the_content(), 0, 100,'...') .'</div>
                                          <div class="video-duration">'. get_field( "videoduration" ) .'</div>
                                      </div>
                                  
                                  </a>
                              </div>';
                  }
              endwhile;
              $html .= "</div></div>";
              wp_reset_query();
              wp_reset_postdata();
                                    
          echo $html;
          die();
        }
      }

      if (isset($_GET['ajax_mylist_qa'])) {
        
        $args = array(
          'post_type'      => 'qacategorys',
          'posts_per_page' => -1,
          'post_status'    => 'publish',
          'orderby'=> 'title',
          'order' => 'ASC'
        );
       $Increment =1;
       $qa_list_num = 0;
        $video_the_query = new WP_Query( $args );
        if($video_the_query->have_posts())
        {
            $html = '<div class="container-fluid"><div class="row">';
            while ( $video_the_query->have_posts() ) :
                $video_the_query->the_post();
                $video_post_id = get_the_ID();
                if(in_array($video_post_id, $mylist_videos)){ 
                  $qa_list_num++;
        
                $html .= '<div class="col-md-12" id="video-main-q-a">';
                
                if($Increment % 2 == 0){ 
                  
                  $html .='<div id="accordion">
                            <div class="card">
                            <div class="card-header bg-color2" id="headingOne">
                              <h5 class="mb-0">
                              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne'. $Increment .'" aria-expanded="true" aria-controls="collapseOne">
                               <span class="q-a-block-no"> 0'. $Increment .'</span>
                                <h6 class="q-a-block-title">'. get_the_title() .'</h6>
                              </button>
                              </h5>
                            </div>

                            <div id="collapseOne'. $Increment .'" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                              <div class="card-body">
                               <div class="video-list-desc">
                                <div class="video-desc"><a href="'.get_the_permalink(). '">'. get_the_content(). '</a></div>
                              </div>
                              </div>
                            </div>
                            </div>
                          </div>';
                  
                } 
                else
                {

                  $html .='<div id="accordion">
                            <div class="card">
                            <div class="card-header bg-color1" id="headingOne">
                              <h5 class="mb-0">
                              <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne'. $Increment .'" aria-expanded="true" aria-controls="collapseOne">
                               <span class="q-a-block-no"> 0'. $Increment .'</span>
                                <h6 class="q-a-block-title">'. get_the_title() .'</h6>
                              </button>
                              </h5>
                            </div>

                            <div id="collapseOne'. $Increment .'" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                              <div class="card-body">
                               <div class="video-list-desc">
                                <div class="video-desc"><a href="'.get_the_permalink(). '">'. get_the_content(). '</a></div>
                              </div>
                              </div>
                            </div>
                            </div>

                          </div>';

                }
                
                $html .='</div>';

                $Increment++;
               }
           endwhile;
           $html .= "</div></div>";
            wp_reset_query();
            wp_reset_postdata();

          echo $html;
          die();
        }
      }
  
?>
<?php /* Template Name: Mypage Template */ ?>
<?php get_header(); ?>
<div class="my-page-block">
		<div class="my-page-inner">	
			<div class="bottom-left">名前 ： <?php echo $current_user->user_login;?><br/>
			
      メール : <?php echo $current_user->user_email;?><br/>
			ID : <?php echo $current_user->ID;?></div>
		</div>
	
</div>
 <div class="contact-page">
        <div class="container">
            <div class="main-page">
              <div class="sp_category" id="sp_category">カテゴリー</div>
                <div class="main-page-left">
                    <div class="side-ber-mian-video">
                        <div class="side-ber-title">
                            <h2 class="title-category">動画カテゴリー</h2>
                        </div>
                             <?php 
                         
                                $args = array(
                                           'taxonomy' => 'video_categories',
                                           'post_type' => 'videos',
                                           'orderby' => 'name',
                                           'order'   => 'ASC',
                                            'parent' => 0,
                                           'hide_empty'  => 0
                                       );

                                $categories = get_categories($args);
         
                                foreach ($categories as $cat) {
                                    ?>
                                      
                                     <button class="accordion"><img src="http://videolist.uh-oh.jp/wp-content/uploads/2020/10/network_wire.png"><a href="<?php echo get_term_link($cat);?>"><?=$cat->name?></a></button>
                                        
                                     
                                     <?php
                                      $args = array(
                                        'post_type' => 'videos',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'video_categories',
                                                'field' => 'term_id',
                                                'terms' => $cat->term_id,
                                            )
                                        )
                                        );
                                        ?>
                                        <div class="panel">
                                        <?php
                                        $the_query = new WP_Query( $args );
                                        if($the_query->have_posts())
                                        {
                                            while ( $the_query->have_posts() ) :
                                                $the_query->the_post();
                                                $post_id = get_the_ID();
                                        echo '<ul class="subcategory" style="list-style-type: none;">';
                                          
                                              ?>
                                            <li>
                                                <input type="radio" value="<?=$post_id?>" class="video-radio"   name="alg_Type" onclick="location.href='<?php echo get_the_permalink(); ?>'"/> 
                                                <label for="<?=$post_id?>"><?= get_the_title()?></label>
                                            </li>
                                             
                                          <?php
                                            endwhile;
                                            wp_reset_query();
                                            wp_reset_postdata();
                                            }
                                            else
                                            {
                                                echo "<h4>現在ありません</h4>";
                                            }
                                        echo '</ul>';
                                        ?>
                                        </div>
                                        <?php
                                     ?>
                                <?php } ?>
                    </div>
					
					         <div class="side-ber-q-a">
                        <div>
                            <h2 class="title-category">Q＆Aカテゴリー</h2>
                            </div>
                             <?php  
                         
                                $args = array(
                                           'taxonomy' => 'qa_categories',
                                           'post_type' => 'qacategorys',
                                           'orderby' => 'name',
                                           'order'   => 'ASC',
                                           'parent' => 0,
                                           'hide_empty'  => 0
                                       );

                                $QAcategories = get_categories($args);
         
                                foreach ($QAcategories as $QAcat) {
                                    ?>
                                      
                                     <button class="accordion"><img src="http://videolist.uh-oh.jp/wp-content/uploads/2020/10/network_wire.png"><a href="<?php echo get_term_link($QAcat);?>"><?=$QAcat->name?></a></button>
                                        
                                     
                                     <?php
                                      $args = array(
                                        'post_type' => 'qacategorys',
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => 'qa_categories',
                                                'field' => 'term_id',
                                                'terms' => $QAcat->term_id,
                                            )
                                        )
                                        );
                                        ?>
                                        <div class="panel">
                                        <?php
                                        $the_query = new WP_Query( $args );
                                        if($the_query->have_posts())
                                        {
                                            while ( $the_query->have_posts() ) :
                                                $the_query->the_post();
                                                $post_id = get_the_ID();
                                        echo '<ul class="subcategory" style="list-style-type: none;">';
                                          
                                              ?>
                                            <li>
                                                <input type="radio" value="<?=$post_id?>" class="video-radio"   name="alg_Type" onclick="location.href='<?php echo get_the_permalink(); ?>'"/> 
                                                <label for="<?=$post_id?>"><?= get_the_title()?></label>
                                            </li>
                                             
                                          <?php
                                            endwhile;
                                            wp_reset_query();
                                            wp_reset_postdata();
                                            }
                                            else
                                            {
                                                echo "<h4>現在ありません</h4>";
                                            }
                                        echo '</ul>';
                                        ?>
                                        </div>
                                        <?php
                                     ?>
                                <?php } ?>
                    </div>     
                </div>
                <div class="main-page-right">
                    <div class="video-block-mian">
                        <div class="new-video-block">
                            <div class="title-video-block">
                                <h2 class="title-category">マイリスト (動画) </h2>
                            </div>
                            <div id="mypage-video-inner-block" class="video-inner-block">
                                <div class="container-fluid">
                                    <div class="row">
                                    
                                <?php
                                  $args = array(
                                      'post_type'      => 'videos',
                                      // 'posts_per_page' => -1,
                                      'post_status'    => 'publish',
                                      'posts_per_page' => 3,
                                      'orderby'=> 'title',
                                      'order' => 'ASC'
                                    );
                                    $video_the_query = new WP_Query( $args );
                                    $v_list_num = 0;
                                    if($video_the_query->have_posts())
                                    {
                                        while ( $video_the_query->have_posts() ) :
                                            $video_the_query->the_post();
                                            $video_post_id = get_the_ID(); 

                                            if(in_array($video_post_id, $mylist_videos)){ 
                                              $v_list_num++;
                                    ?>
                                    <div class="col-md-12" id="video-main">
                                        <a href="<?php echo get_the_permalink(); ?>">
                                            <div class="col-md-4 video-list-inner">
                                                <div class="video-thum-img">
                        													<img src="<?php echo the_post_thumbnail_url();?>" alt="sponsored-img" class="video-img">
                        												</div>
                                                                        
                        												<div class="play-btn">
                        													<span></span>
                        												</div>
                                             </div>
                                             <div class="col-md-8 video-list-desc">
                                                <div class="video-name"><?= get_the_title()?></div>
                                                <div class="video-desc"> <?php echo mb_strimwidth(get_the_content(), 0, 100,'...') ; ?></div>
                                                <div class="video-duration"> <?php echo get_field( "videoduration" ); ?></div>
                                            </div>
                                        
                                        </a>
                                    </div>
                                    
                                    
                                         
                                  <?php
                                    }
                                    endwhile;
                                    wp_reset_query();
                                    wp_reset_postdata();
                                    ?>
                                    </div>
    									             
                                </div>  
                                <?php if($v_list_num > 0) {?>
                                <a class ="arrow-img ajax_mylist_video_call" href="javascript:return"><img src="http://swamivivekanandeduweltrust.com/programmer/masao/wp-content/uploads/2020/10/arrow.png" > </a>
                                <br>
                                <a class="more-view-btn ajax_mylist_video_call" href="javascript:return"> <span>もっと見る</span></a>
                                
                                <?php 
                                  }else{
                                    echo "<h4>現在ありません</h4>";
                                  }
                                }
                                else
                                {
                                    echo "<h4>現在ありません</h4>";
                                }
                                ?>
                            </div>
                        </div>
						    <div class="video-block-mian">
                        <div class="new-video-block">
                            <div class="title-video-block">
                                <h2 class="title-category">マイリスト (Q&A)</h2>
                            </div>
                            <div id="mypage-qa-inner-block"  class="video-inner-block">
                                <div class="container-fluid">
                                    <div class="row">
                                    
                                <?php
                                  $args = array(
                                      'post_type'      => 'qacategorys',
                                      'posts_per_page' => -1,
                                      'post_status'    => 'publish',
                                      'posts_per_page' => 3,
                                      'orderby'=> 'title',
                                      'order' => 'ASC'
                                    );
									                 $Increment =1;
                                   $qa_list_num = 0;
                                    $video_the_query = new WP_Query( $args );
                                    if($video_the_query->have_posts())
                                    {
                                        while ( $video_the_query->have_posts() ) :
                                            $video_the_query->the_post();
                                            $video_post_id = get_the_ID();
                                            if(in_array($video_post_id, $mylist_videos)){ 
                                              $qa_list_num++;
                                    ?>
                                    <div class="col-md-12" id="video-main-q-a">
                  									<?php
                  									
                  									if($Increment % 2 == 0){ 
                  									?>
                  										
                  										<div id="accordion">
                  										  <div class="card">
                  											<div class="card-header bg-color2" id="headingOne">
                  											  <h5 class="mb-0">
                  												<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne<?php echo $Increment;?>" aria-expanded="true" aria-controls="collapseOne">
                  												 <span class="q-a-block-no"> 0<?php echo $Increment;?></span>
                  													<h6 class="q-a-block-title">
                  														<?= get_the_title()?>
                  													</h6>
                  												</button>
                  											  </h5>
                  											</div>

                  											<div id="collapseOne<?php echo $Increment;?>" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                  											  <div class="card-body">
                  												 <div class="video-list-desc">
                  													<div class="video-desc"><a href="<?php echo get_the_permalink(); ?>"> <?php the_content(); ?></a></div>
                  												</div>
                  											  </div>
                  											</div>
                  										  </div>
                  										</div>
                  										
                  									<?php 
                  									} 
                  									else
                  									{
                  									?>			
                  										<div id="accordion">
                  										  <div class="card">
                  											<div class="card-header bg-color1" id="headingOne">
                  											  <h5 class="mb-0">
                  												<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne<?php echo $Increment;?>" aria-expanded="true" aria-controls="collapseOne">
                  												 <span class="q-a-block-no"> 0<?php echo $Increment;?></span>
                  													<h6 class="q-a-block-title">
                  														<?= get_the_title()?>
                  													</h6>
                  												</button>
                  											  </h5>
                  											</div>

                  											<div id="collapseOne<?php echo $Increment;?>" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                  											  <div class="card-body">
                  												 <div class="video-list-desc">
                  													<div class="video-desc"><a href="<?php echo get_the_permalink(); ?>"> <?php the_content(); ?></a></div>
                  												</div>
                  											  </div>
                  											</div>
                  										  </div>

                  										</div>
                  									<?php
                  									}
                                    
                  									?>				
                                    </div>   
                                  <?php
									                 $Increment++;
                                   }
                                   endwhile;
                                    wp_reset_query();
                                    wp_reset_postdata();
                                    ?>
                                    </div>
                                </div> 
                                <?php if($qa_list_num > 0){ ?> 
                                <a class ="arrow-img ajax_mylist_qa_call" href="javascript:return"><img src="http://swamivivekanandeduweltrust.com/programmer/masao/wp-content/uploads/2020/10/arrow.png" > </a>
                                    <br>
                                    <a class="more-view-btn ajax_mylist_qa_call" href="javascript:return"> <span>もっと見る</span></a>
                                    <?php
                                      }else{
                                        echo "<h4>現在ありません</h4>";
                                      }
                                    }
                                    else
                                    {
                                        echo "<h4>現在ありません</h4>";
                                    }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	 </div>
      	   
       <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
      <!-- End Contact Page -->
       
 <script>
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
var category_tap = true;
    $("#sp_category").click(function(e){
      if(category_tap == true){
          $(".main-page-left").css('display','block');
          category_tap = false;
      }else{
        category_tap = true;
        $(".main-page-left").css('display','none');
      }

    })

    $(function() {
      
        $(".ajax_mylist_video_call").on("click", function(){
            $.ajax({
                async: true,
                type: 'GET',
                url: '<?= site_url()?>/my-page',
                data: {
                  ajax_mylist_video : 'yes'
                },
                success: function (response) {
                  // Reload the page.
                  // console.log(response);
                  $("#mypage-video-inner-block").html(response);
                },
                error: function ( jqXHR, exception ) {
                  console.log( msg );
                },
              });
        });

        $(".ajax_mylist_qa_call").on("click", function(){
            $.ajax({
                async: true,
                type: 'GET',
                url: '<?= site_url()?>/my-page',
                data: {
                  ajax_mylist_qa : 'yes'
                },
                success: function (response) {
                  // Reload the page.
                  // console.log(response);
                  $("#mypage-qa-inner-block").html(response);
                },
                error: function ( jqXHR, exception ) {
                  console.log( msg );
                },
              });
        });
    });

</script>
 <style>
  .banner-icon.d-inline-block{
    display: none;
  }
@media screen and (max-width:768px){
  .video-block-mian{
    margin-top:30px;
  }
}
</style>  
        
<?php get_footer(); ?>