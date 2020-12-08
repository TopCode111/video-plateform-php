<?php if ( !is_user_logged_in() ) { header("location:". site_url() ."/wp-login");
   } 
?>
<?php get_header();?> 
<?php
  global $current_user;
  global $wp;

  get_currentuserinfo();

?>
     
	<div class="singlq-a-block">
		<div class="container">
			<div class="q-a-block-inner">
				<div class="col-md-12" style="">
				<div class="single-name">Q : <?= get_the_title()?></div>
					
          <div class="single-desc"> <?php the_content(); ?></div>
  				<?php 

            $retrieve_data = $wpdb->get_results( "SELECT * FROM videomylist_users where user_id=" . $current_user->ID . " AND  post_id =". get_the_ID());
        if (!count($retrieve_data)) { ?>

            <form action="<?= site_url()?>/my-page" method="post">
                <input type="hidden" name="mylist_video" value="<?= get_the_ID() ?>">
                <button class="title-hedar">今すぐ登録</button>
            </form>

              <?php 

            } else { ?>
            
          <form action="<?= site_url()?>/my-page" method="post">
          <input type="hidden" name="unlist_video" value="<?= get_the_ID() ?>">
          <input type="hidden" name="redirect_to" value="<?= home_url( add_query_arg( array(), $wp->request ) ) ?>">
                <button class="title-hedar">マイリスト登録済み</button>
          </form>
            
      <?php }
            ?>
		    </div>
			</div>
		</div>		
</div>      
		<div class="contact-page">
        <div class="container">
            <div class="main-page">
               <div class="sp_category" id="sp_category">カテゴリー</div>
                <div class="main-page-right block-with">
                    <div class="video-block-mian">
                        <div class="new-video-block">                            
                            <div class="video-inner-block">
                                <div class="container-fluid">
                                    <div class="row">
                									  <div class="col-md-12" id="video-main">
                											<div class="video-list-desc">
                                          <div class="video-name"><span>
                													A:回答
                													</span></div>
                                          <div class="video-desc"> <?php the_content(); ?></div>
                                      </div>
                                    </div>
                									 <div class="col-md-12" id="video-main">
                											<div class="video-list-desc">
                                          <div class="video-name test2"><span>
                													
                													見たtユーザーの学習
                                          </span></div>
                                        <div class="video-desc"> 
      													<div class="user-block">
      														<ul>
      															<li>
      																<div class="user-img">
      																	<img src="http://swamivivekanandeduweltrust.com/programmer/masao/wp-content/uploads/2020/10/women-3.png" class="img-user">
      																</div>
      																<div class="user-name">
      																	<p>
      																		カミロヘナオ
      																	</p>
      																	<span>
      																		それは素晴らしいチュートリアルでした。 より多くのリソース、演習、短いビデオが欲しかった

      																	</span>
      																</div>
      															</li>
      															<li>
      																<div class="user-img">
      																	<img src="http://swamivivekanandeduweltrust.com/programmer/masao/wp-content/uploads/2020/10/women-3.png" class="img-user">
      																</div>
      																<div class="user-name">
      																	<p>
      																		カミロヘナオ
      																	</p>
      																	<span>
      																		それは素晴らしいチュートリアルでした。 より多くのリソース、演習、短いビデオが欲しかった

      																	</span>
      																</div>
      															</li>
      															<li>
      																<div class="user-img">
      																	<img src="http://swamivivekanandeduweltrust.com/programmer/masao/wp-content/uploads/2020/10/women-3.png" class="img-user">
      																</div>
      																<div class="user-name">
      																	<p>
      																		カミロヘナオ
      																	</p>
      																	<span>
      																		それは素晴らしいチュートリアルでした。 より多くのリソース、演習、短いビデオが欲しかった

      																	</span>
      																</div>
      															</li>
      														</ul>
      														<a class ="arrow-img" href=""><img src="http://swamivivekanandeduweltrust.com/programmer/masao/wp-content/uploads/2020/10/arrow.png" > </a>
      														<a class="more-view-btn" href=""> <span>もっと見る</span></a>
      													</div>
      												</div>
                            </div>
                          </div>                    
                                  
                        </div>
                    </div>  
                </div>
            </div>
            
        </div>
				</div>
            </div>
		</div>
      </div>
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
                                <h2 class="title-category"></h2>
                            </div>
                            <div class="video-inner-block">
                                <div class="container-fluid">
                                    <div class="row">                                    
                                <?php
                                  $args = array(
                                      'post_type'      => 'qacategorys',
                                      'posts_per_page' => -1,
                                      'post_status'    => 'publish',
                                      'posts_per_page' => 9,
                                      'orderby'=> 'title',
                                      'order' => 'ASC'
                                    );
									                   $Increment =1;
                                    $video_the_query = new WP_Query( $args );
                                    if($video_the_query->have_posts())
                                    {
                                        while ( $video_the_query->have_posts() ) :
                                            $video_the_query->the_post();
                                            $video_post_id = get_the_ID();
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
                													<div class="video-desc"><a href="<?php echo get_the_permalink(); ?>">  <?php the_content(); ?></a></div>
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
                													<div class="video-desc"><a href="<?php echo get_the_permalink(); ?>">  <?php the_content(); ?></a></div>
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

var acc = document.getElementsByClassName("accordion-qa");
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
.video-list-desc {
    padding: 20px 30px;
}
.video-name{
  border-bottom: 2px solid #24387c;
}
@media screen and (max-width:768px){
  .video-list-desc {
    padding: 10px;
}
}
</style>    
        
<?php get_footer(); ?>