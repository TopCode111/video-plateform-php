<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package myprofile
 */

?>
<header class="main-header header-section">
        <!-- Main Box -->
    	<div class="main-box">
        	<div class="container">
            	<div class="outer-container clearfix">
                    <!--Logo Box-->
                    <div class="logo-box">
                        <div class="logo">
						
						 <?php
                    $myprofile_custom_logo_id = get_theme_mod('custom_logo');
                    if (!empty($myprofile_custom_logo_id)) : the_custom_logo();
                    else :
                        ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <?php echo bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
						
						</div>
                    </div>
                    <!--Nav Outer-->
                    <div class="nav-outer clearfix">
                        <!-- Main Menu -->
                        <nav class="main-menu ">
                            <div class="navbar-header">
                                <!-- Toggle Button -->    	
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>                            
                            <div class="navbar-collapse collapse clearfix">
                                <ul class="primary-menu navigation clearfix ">
								<?php  wp_nav_menu( array( 'theme_location' => 'main_menu', 'container_id' => 'navbar-collapse-1',
									'container_class'=>'navbar-collapse collapse navbar-right',
									'menu_class'=>'nav navbar-nav',
									'fallback_cb'=>false, 
									'items_wrap' => '%3$s', 
									'container'=>false,
									'walker'=> new Bunch_Bootstrap_walker()  
								) ); ?>	
                                 </ul>
                            </div>
                        </nav>
                        <!-- Main Menu End-->
                    </div>
                    <!--Nav Outer End-->
            	</div>    
            </div>
        </div>
    </header>
    <!--End Main Header -->
<div class="clearfix"></div>