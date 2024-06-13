<?php



class lbslider_widget extends \Elementor\Widget_Base {

    public function get_name() {
		return 'Grid Slider';
	}

    public function get_title() {
		return esc_html__( 'Grid Slider', 'lbslider-widget' );
	}



    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'lbslider-widget' ),
                'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'main_image',
			[
				'label' => esc_html__( 'Choose Main Image', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
        $this->add_control(
			'lb_gallery',
			[
				'label' => esc_html__( 'Add Images', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

      

        $this->end_controls_section();
    }

    public function render() {
        $settings = $this->get_settings_for_display(); ?>
        <style>
        .photos-grid-container {
		  max-height: 400px;
		  display: grid;
		  grid-template-columns: 1fr 1fr;
		  grid-template-rows: 1fr;
		  grid-gap: 0;
		  align-items: start;

  @media (max-width: 580px) {
    grid-template-columns: 1fr;
  }

  .img-box {
    border: 1px solid #ffffff;
    position: relative;
		max-height:200px;
  }
	.sub .img-box img {
		max-height:200px;
		width:100%;
		object-fit:cover;
	}
  .img-box:hover .transparent-box {
    background-color: rgba(0, 0, 0, 0.6);
  }

  .img-box:hover .caption {
    transform: translateY(-5px);
  }

  img {
    max-width: 100%;
    display: block;
    height: auto;
  }

  .caption {
    color: white;
    transition: transform 0.3s ease, opacity 0.3s ease;
    font-size: 1.5rem;
  }

  .transparent-box {
    height: 100%;
    width: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    position: absolute;
    top: 0;
    left: 0;
    transition: background-color 0.3s ease;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .main-photo {
    grid-row: 1;
    grid-column: 1;
  }
  
  .swiper-count {
	    background: #08080870;
		padding: 10px;
		position: absolute;
		z-index: 999999;
		bottom: 10px;
		right: 10px;
		color: #fff;
  }

  .sub {
    display: grid;
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr 1fr;
    grid-gap: 0em;

    &:nth-child(0) {
      grid-column: 1;
      grid-row: 1;
    }

    &:nth-child(1) {
      grid-column: 2;
      grid-row: 1;
    }

    &:nth-child(2) {
      grid-column: 1;
      grid-row: 2;
    }

    &:nth-child(3) {
      grid-column: 2;
      grid-row: 2;
    }
  }
}


.hide-element {
  border: 0;
  clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
  clip: rect(1px, 1px, 1px, 1px);
  height: 1px;
  margin: -1px;
  overflow: hidden;
  padding: 0;
  position: absolute;
  width: 1px;
}
.swiper-initialized {
    height: 300px;
   
   
}

.swiper-initialized img {
    height: 300px;
     width:100%;
     object-fit:cover;
}
.swiper {
     display: none;
 }
@media screen and (min-width: 1280px) {
  
  .container {
    margin: 0 auto;
    width: 1250px;
  }
}

@media screen and (max-width: 678px) {
  
 #gallery {
     display: none;
 }
 .swiper {
     display: block;
 }
}


* {box-sizing:border-box}

/* Slideshow container */
.slideshow-container {
  max-width: 1000px;
  position: relative;
  margin: auto;
}

/* Hide the images by default */
.mySlides {
  display: none;
}



/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.5s;
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}
        </style>
        <div id="gallery" class="photos-grid-container gallery">
        <div class="main-photo img-box">
        <a href="<?php echo esc_html($settings['main_image']['url']); ?>" class="glightbox" data-glightbox="type: image"><img src="<?php echo esc_html($settings['main_image']['url']); ?>" alt="image" /></a>
      </div>
        
<?php
        
        //echo "<pre>";
        //print_r($settings['lb_gallery']);
        //echo "</pre>";
        
         if(count($settings['lb_gallery']) > 0 ){
            echo '<div><div class="sub">';
            $max=0;
            $ext=0;
            foreach($settings['lb_gallery'] as $key => $value) :?>
            
                <?php  if($max < 4 ){ ?>
                
                <div <?php if($max == 3 ) { echo 'id="multi-link"'; }?> class="img-box"><a href="<?php echo esc_html($value["url"]); ?>" class="glightbox" data-glightbox="type: image"><img src="<?php echo esc_html($value["url"]); ?>" alt="image" />
                <?php if($max == 3 ) { ?>
                    <div class="transparent-box">
                      <div class="caption">
                        + <?php echo (count($settings['lb_gallery'])-4); ?>
                      </div>
                    </div>

                 <?php }?>
                 </a> </div>

                
                <?php 
                $max++;    
                } else {
                    if($ext == 0) {
                        echo ' <div id="more-img" class="extra-images-container hide-element">';
                      } 
                      ?>
                    <a href="<?php echo esc_html($value["url"]); ?>" class="glightbox" data-glightbox="type: image"><img src="<?php echo esc_html($value["url"]); ?>" alt="image" /></a>
                                <?php   
                       
                    if(count($settings['lb_gallery']) -1 == $max){
                        echo "</div>";
                    }

                    $ext++;
                    $max++;
                    } 
                        
            endforeach;
                
                echo  '</div></div>';
           
            

        }

        
       echo   '</div>'; ?>
      
    <div class="swiper pswp-gallery" id="slide">
         <div class="swiper-wrapper">
            <?php

if(count($settings['lb_gallery']) > 0 ){
    
    foreach($settings['lb_gallery'] as $key => $value) :?>
    
        
        
    <div class="swiper-slide"><img src="<?php echo esc_html($value["url"]); ?>" alt=""></div>


        
        <?php 
        endforeach;
        
		}


?>
 </div>
	 <div class="swiper-pagination"></div>
    <!-- Add Navigation -->
	<div class="swiper-count"></div>
	<div class="swiper-button-prev"></div>
	<div class="swiper-button-next"></div>
    
    </div> 
	
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/> 


    <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script> 
	<!--<script src="https://unpkg.com/photoswipe/dist/photoswipe-lightbox.esm.js" type="module"></script>
    <script src="https://unpkg.com/photoswipe/dist/photoswipe.esm.js" type="module"></script> -->
	
    <script>
		  document.addEventListener('DOMContentLoaded', () => {
		  const swiper = new Swiper('.swiper', {
			loop: true,
			pagination: {
			  el: '.swiper-pagination'
			},
			navigation: {
			  nextEl: '.swiper-button-next',
			  prevEl: '.swiper-button-prev'
			},
			scrollbar: {
			  el: '.swiper-scrollbar'
			}
		  });
		  
		  
		  
		  // Function to handle class change on slide change
			swiper.on('slideChange', () => {
				// Remove the 'active-slide' class from all slides
				document.querySelectorAll('.swiper-slide').forEach(slide => {
					slide.classList.remove('active-slide');
				});

				// Add the 'active-slide' class to the current active slide
				const activeSlide = swiper.slides[swiper.activeIndex];
				activeSlide.classList.add('active-slide');
				document.querySelector('.swiper-count').innerHTML=activeSlide.getAttribute('aria-label');
			});

			// Trigger the slideChange event once on load to set initial state
			swiper.emit('slideChange');
		  
		  });
</script>

<?php
    
}
}