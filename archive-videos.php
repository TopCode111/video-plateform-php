     <?php /* Template Name: Video Category Template */ ?>
     <?php get_header(); ?>
     <div class="slideshow-container">

    <div class="">
      
      <img src="<?php echo site_url();?>/wp-content/uploads/2020/10/you-x-ventures-Oalh2MojUuk-unsplash-scaled-e1602582503236.jpg" style="width:100%">
	  
	  <div class="text"><?php echo the_title();?></div>
	  <p class="qa-content">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet diam nonummy.</p>
       
    </div>  
    </div>    
          
    <br>
     <div class="contact-page">
        <div class="container">
            <div class="main-page">
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
                                      
                                     <button class="accordion"><img src="http://swamivivekanandeduweltrust.com/programmer/masao/wp-content/uploads/2020/10/network_wire.png"><a href="<?php echo get_term_link($cat);?>"><?=$cat->name?></a></button>                                        
                                     
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
                                                echo "<h2>No Result Found</h2>";
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
                                <h2 class="title-category"></h2>
                            </div>
                            <div class="video-inner-block">
                                <div class="container-fluid">
                                    <div class="row">
                                    
                                <?php
                                 $cat_obj = get_queried_object();                                 
                                 $cat = get_term_by('slug',$catSlug,'video_categories');                               
                                 $args = array(
                                      'post_type'      => 'videos',
                                      'tax_query' => array(
                                            array(
                                                'taxonomy' => 'video_categories',
                                                
                                                'terms' => $catID,
                                            )
                                        ),
                                      'posts_per_page' => -1,
                                      'post_status'    => 'publish',
                                      'posts_per_page' => 10,                                      
                                      'orderby' => 'title',
                                      'order' => 'ASC'
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
                                            <div class="video-list-inner">
                                                <div class="video-thum-img">
													<img src="<?php echo the_post_thumbnail_url();?>" alt="sponsored-img" class="video-img">
												</div>
                                                
												<div class="play-btn">
													<span></span>
												</div>
                                             </div>
                                             <div class="video-list-desc">
                                                <div class="video-name"><?= get_the_title()?></div>
                                                <div class="video-desc"> <?php the_content(); ?></div>
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
                                        echo "<h2>No Result Found</h2>";
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
</script>
 <style>
img.imgdata {
height: 167px;
width: 270px;
border-radius: 5%;
}
 .accordion {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.accordion:hover {
  background-color: #ccc;
}

.accordion:after {
  content: '\002B';
  color: #777;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}



 
.panel {
  padding: 0 18px;
  background-color: white;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}

.video-name {
    font-size: 22px;
    font-weight: 600;
    color: #24387c;
	border:0;
}
	.video-list-desc {
    padding-left: 22px;
    padding: 15px 10px 15px 15px;
}
.video-duration {
    background: #ACD9EE;
    width: 111px;
    border-radius: 24px;
    padding: 4px 14px;
}

#video-main{
    border: 1px solid #ccc;
    border-radius: 13px;
    margin: 8px;
    padding:0;
}
.text {
         color: white;
    font-size: 20px;
    padding: 8px 12px;
    position: absolute;
    bottom: 253px;
    width: 188px;
    text-align: center;
    background: #0C4A85;
    font-weight: bold;
    display: block;
    margin-left: 714px;
}
.slideshow-container {
  width: 100%;
  position: relative;
  margin: auto;
}


 .accordion-qa {
  background-color: #eee;
  color: #444;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
}

.accordion-qa:hover {
  background-color: #ccc;
}

.accordion-qa:after {
  content: '\002B';
  color: #777;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}
.number-qa {
        
    width: 52px;
    height: 45px;
    font-size: 25px;
    text-align: center;
    border: 5px solid white;
    border-radius: 34px;
    color: white;
    font-weight: bold;
}
p.qa-content {
    color: white;
    font-size: 20px;
    padding: 8px 12px;
    position: absolute;
    bottom: 134px;
    width: 44%;
    text-align: center;
    /* background: #0C4A85; */
    font-weight: bold;
    /* display: block; */
    margin-left: 418px;
}
video {
    height: 305px;
    margin-top: -24px;
}
</style>  
        
     <?php get_footer(); ?>