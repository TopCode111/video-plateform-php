<?php if ( !is_user_logged_in() ) { header("location:". site_url() ."/wp-login");
   } 
?>
<?php /* Template Name: Top Template */ ?>
<?php get_header();?>
    <div class="slideshow-container">

    <div class="">
      
      <img src="<?php echo site_url(); ?>/wp-content/uploads/2020/10/Top-2.png" style="width:100%">
       
    </div>  
    </div>         
          
    <br>
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
                                      
                                      <button class="accordion"> <img src="http://videolist.uh-oh.jp/wp-content/uploads/2020/10/network_wire.png"><a href="<?php echo get_term_link($cat);?>"><?=$cat->name?></a></button> 
                                     
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
											                   echo '<ul class="subcategory" style="list-style-type: none;">';
                                            while ( $the_query->have_posts() ) :
                                                $the_query->the_post();
                                                $post_id = get_the_ID(); 
                                              ?>
                                            <li>												
                                                <input type="radio" value="<?=$post_id?>" class="video-radio" id="alg_Type_<?=$post_id?>"   name="alg_Type_<?=$post_id?>" onclick="location.href='<?php echo get_the_permalink(); ?>'"/> 
                                                <label for="alg_Type_<?=$post_id?>"><?= get_the_title()?></label>
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
                                <h2 class="title-category">新しいおすすめの動画</h2>
                            </div>
                            <div class="video-inner-block">
                                <div class="container-fluid">
                                    <div class="row">                                    
                                  <?php
                                  $args = array(
                                      'post_type'      => 'videos',                                      
                                      'post_status'    => 'publish',
                                      'posts_per_page' => 3,                                      
                                      'order' => 'DESC'
                                    );
                                    $video_the_query = new WP_Query( $args );
                                    if($video_the_query->have_posts())
                                    {
                                        while ( $video_the_query->have_posts() ) :
                                            $video_the_query->the_post();
                                            $video_post_id = get_the_ID();
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
                                    endwhile;
                                    wp_reset_query();
                                    wp_reset_postdata();
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
                        <div class="populer-video-block">
                            <div class="title-video-block">
                                 <h2 class="title-category">人気の動画</h2>
                            </div>
                            <div class="video-inner-block">
                                <div class="container-fluid">
                                <div class="row">                                
                            <?php							
                              $args = array(
                                  'post_type'      => 'videos',
                                  'post_status'    => 'publish',
                                  'posts_per_page' => 3,
                                  'meta_key' => 'post_views_count',
                                  'orderby' => 'meta_value_num',
								                  'order' => 'DESC'
                                );
                                $video_the_query = new WP_Query( $args );
                                if($video_the_query->have_posts())
                                {
                                    while ( $video_the_query->have_posts() ) :
                                        $video_the_query->the_post();
                                        $video_post_id = get_the_ID();										
										                    $populr_video = get_field('populer_video');											
                                ?>
              									<?php //if ( $populr_video): ?>
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
              									<?php //endif; ?>                                     
                              <?php
                                endwhile;
                                wp_reset_query();
                                wp_reset_postdata();
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
                        <div class="browser-video-block">
                            <div class="title-video-block">
                                 <h2 class="title-category">閲覧履歴</h2>
                            </div>
                            <div class="video-inner-block">
                                <div class="container-fluid">
                                <div class="row">
                                
                            <?php
                            $postdate = readpost();
                            $numlist = 0;
                            if (!empty($postdate)) {
                              $args = array(                                  
                                  'post_type'      => 'videos',                                  
                                  'post_status'    => 'publish',                           
                                  
                                  'orderby' => 'post__in',
                                  'post__in' => $postdate,
                                  'order' => ''                             
                                );
                                $video_history = new WP_Query( $args );
                                if($video_history->have_posts())
                                {
                                    while ( $video_history->have_posts() ) :
                                      if ($numlist === 3) break;
                                        $video_history->the_post();
                                        $video_post_id = get_the_ID();
                                        $numlist++;
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
                                endwhile;
                                wp_reset_query();
                                wp_reset_postdata();
                                }
                                else
                                {
                                    echo "<h4>現在ありません</h4>";
                                }
                              }else{
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
  $(document).ready(function(){

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
  })
</script>
<style>

</style>    
        
<?php get_footer(); ?>