<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
/**
 *
 * Blog Post Widget .
 *
 */
class Konsal_Blog_Post extends Widget_Base {

	public function get_name() {
		return 'konsalblogpost';
	}

	public function get_title() {
		return __( 'Konsal Blog Post', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'blog_post_section',
			[
				'label' => __( 'Blog Post', 'konsal' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Brand Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'layout_one',
				'options' 		=> [
					'layout_one'  	=> __( 'Style One', 'konsal' ),
					'layout_two'  	=> __( 'Style Two', 'konsal' ),
					'layout_three'  => __( 'Style Three', 'konsal' ),
					'layout_four'  	=> __( 'Style Four', 'konsal' ),
					'layout_five'  	=> __( 'Style Five', 'konsal' ),
					'layout_six'  	=> __( 'Style Six', 'konsal' ),
					'layout_seven'  => __( 'Style Seven', 'konsal' ),
				],

			]
		);

		$this->add_control(
			'image',
			[
				'label' 		=> __( 'Choose Image', 'konsal' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'condition'	=> ['layout_style' => ['layout_two', 'layout_three']]
			]
		);
        $this->add_control(
			'section_subtitle',
			[
				'label' 	=> __( 'Section Subtitle', 'konsal' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Section Subtitle', 'konsal' ), 
				'rows' 		=> 2,
				'condition'	=> ['layout_style' => ['layout_two', 'layout_three']]
			]
        );
		$this->add_control(
			'section_title',
			[
				'label' 	=> __( 'Section Title', 'konsal' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Section Title', 'konsal' ),
				'rows' 		=> 2,
				'condition'	=> ['layout_style' => ['layout_two', 'layout_three']]
			]
        );
		$this->add_control(
			'button_text',
			[
				'label' 	=> __( 'Button Text', 'konsal' ),
                'type' 		=> Controls_Manager::TEXTAREA,
				'rows' => 2,
                'default'  	=> __( 'Button Text', 'konsal' ),
				'condition'	=> ['layout_style' => ['layout_three']]
			]
        );
        $this->add_control(
			'button_link',
			[
				'label' 		=> __( 'Link', 'konsal' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'konsal' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
				'condition'	=> ['layout_style' => ['layout_three']]
			]
		);
		$this->add_control(
			'shape',
			[
				'label' 		=> __( 'Choose Shape', 'konsal' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'condition'	=> [ 'layout_style' => ['layout_three' ]] 
			]
		);

        $this->add_control(
			'blog_post_count',
			[
				'label' 	=> __( 'No of Post to show', 'konsal' ),
                'type' 		=> Controls_Manager::NUMBER,
                'min'       => 1,
                'max'       => count( get_posts( array('post_type' => 'post', 'post_status' => 'publish', 'fields' => 'ids', 'posts_per_page' => '-1') ) ),
                'default'  	=> __( '4', 'konsal' )
			]
        );

		$this->add_control(
			'title_count',
			[
				'label' 	=> __( 'Title Length', 'konsal' ),
				'type' 		=> Controls_Manager::TEXT,
				'default'  	=> __( '5', 'konsal' ),
			]
		);
		$this->add_control(
			'con_count',
			[
				'label' 	=> __( 'Excerpt Length', 'konsal' ),
				'type' 		=> Controls_Manager::TEXT,
				'default'  	=> __( '16', 'konsal' ),
			]
		);

        $this->add_control(
			'blog_post_order',
			[
				'label' 	=> __( 'Order', 'konsal' ),
                'type' 		=> Controls_Manager::SELECT,
                'options'   => [
                    'ASC'   	=> __('ASC','konsal'),
                    'DESC'   	=> __('DESC','konsal'),
                ],
                'default'  	=> 'DESC'
			]
        );

        $this->add_control(
			'blog_post_order_by',
			[
				'label' 	=> __( 'Order By', 'konsal' ),
                'type' 		=> Controls_Manager::SELECT,
                'options'   => [
                    'ID'    	=> __( 'ID', 'konsal' ),
                    'author'    => __( 'Author', 'konsal' ),
                    'title'    	=> __( 'Title', 'konsal' ),
                    'date'    	=> __( 'Date', 'konsal' ),
                    'rand'    	=> __( 'Random', 'konsal' ),
                ],
                'default'  	=> 'ID'
			]
        );

        $this->add_control(
			'exclude_cats',
			[
				'label' 		=> __( 'Exclude Categories', 'konsal' ),
                'type' 			=> Controls_Manager::SELECT2,
                'multiple' 		=> true,
				'options' 		=> $this->konsal_get_categories(),
			]
        );

        $this->add_control(
			'exclude_tags',
			[
				'label' 		=> __( 'Exclude Tags', 'konsal' ),
                'type' 			=> Controls_Manager::SELECT2,
                'multiple' 		=> true,
				'options' 		=> $this->konsal_get_tags(),
			]
        );

        $this->add_control(
			'exclude_post_id',
			[
				'label'         => __( 'Exclude Post', 'konsal' ),
                'type'          => Controls_Manager::SELECT2,
                'multiple'      => true,
				'options'       => $this->konsal_post_id(),
			]
        );
        $this->add_control(
			'read_more',
			[
				'label' 	=> __( 'Read More Text', 'konsal' ),
                'type' 		=> Controls_Manager::TEXT,
                'default'  	=> __( 'Read More', 'konsal' ),
			]
        );
        $this->end_controls_section();


         $this->start_controls_section(
			'section_title_style_section',
			[
				'label' => __( 'Style', 'konsal' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

        konsal_all_elementor_style($this, 'Title', '{{WRAPPER}} .title-selector',[ 'layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five', 'layout_six', 'layout_seven' ], '--title-color' );
		konsal_all_elementor_style($this, 'Content', '{{WRAPPER}} .desc-selector',[ 'layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five', 'layout_six', 'layout_seven' ], '--body-color' );

		$this->end_controls_section();


		
    }

    public function konsal_get_categories() {
        $cats = get_terms(array(
            'taxonomy' => 'category',
            'hide_empty' => true,
        ));

        $catarr = [];

        foreach( $cats as $singlecat ) {
            $catarr[$singlecat->term_id] = __($singlecat->name,'konsal');
        }

        return $catarr;
    }

    public function konsal_get_tags() {
        $cats = get_terms(array(
            'taxonomy' => 'post_tag',
            'hide_empty' => true,
        ));

        $catarr = [];

        foreach( $cats as $singlecat ) {
            $catarr[$singlecat->term_id] = __($singlecat->name,'konsal');
        }

        return $catarr;
    }

    // Get Specific Post
    public function konsal_post_id(){
        $args = array(
            'post_type'         => 'post',
            'posts_per_page'    => -1,
        );

        $konsal_post = new WP_Query( $args );

        $postarray = [];

        while( $konsal_post->have_posts() ){
            $konsal_post->the_post();
            $postarray[get_the_Id()] = get_the_title();
        }
        wp_reset_postdata();
        return $postarray;
    }

	protected function render() {

        $settings = $this->get_settings_for_display();
        $exclude_post = $settings['exclude_post_id'];

        if( !empty( $settings['exclude_cats'] ) && empty( $settings['exclude_tags'] ) && empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'category__not_in'      => $settings['exclude_cats']
            );
        } elseif( !empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'category__not_in'      => $settings['exclude_cats'],
                'tag__not_in'           => $settings['exclude_tags']
            );
        }elseif( !empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'category__not_in'      => $settings['exclude_cats'],
                'tag__not_in'           => $settings['exclude_tags'],
                'post__not_in'          => $exclude_post
            );
        } elseif( !empty( $settings['exclude_cats'] ) && empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'category__not_in'      => $settings['exclude_cats'],
                'post__not_in'          => $exclude_post
            );
        } elseif( empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'tag__not_in'           => $settings['exclude_tags'],
                'post__not_in'          => $exclude_post
            );
        } elseif( empty( $settings['exclude_cats'] ) && !empty( $settings['exclude_tags'] ) && empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'tag__not_in'           => $settings['exclude_tags'],
            );
        } elseif( empty( $settings['exclude_cats'] ) && empty( $settings['exclude_tags'] ) && !empty( $settings['exclude_post_id'] ) ) {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true,
                'post__not_in'          => $exclude_post
            );
        } else {
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => esc_attr( $settings['blog_post_count'] ),
                'order'                 => esc_attr( $settings['blog_post_order'] ),
                'orderby'               => esc_attr( $settings['blog_post_order_by'] ),
                'ignore_sticky_posts'   => true
            );
        }


        $blogpost = new WP_Query( $args );

        if( $settings['layout_style'] == 'layout_one' ){ ?>
        	<div class="swiper th-slider has-shadow" id="blogSlider1" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}'><?php
        		if( $blogpost->have_posts() ) { 
					echo '<div class="swiper-wrapper">';
	           		while( $blogpost->have_posts() ) { $blogpost->the_post();
	           			$categories = get_the_category();
			                echo '<div class="swiper-slide">';
			                	echo '<div class="blog-card">';
	                                echo '<div class="blog-img">';
	                                    echo '<a href="'.esc_url( get_permalink() ).'">';
	                                        the_post_thumbnail( 'konsal_415X305' );
	                                        echo '<div class="icon-btn">';
	                                            echo '<i class="far fa-plus"></i>';
	                                        echo '</div>';
	                                    echo '</a>';
	                                echo '</div>';
	                                echo '<div class="blog-content">';
	                                    echo '<div class="blog-meta">';
	                                        echo '<div class="blog-date">'.esc_html( get_the_date( 'd M' ) ).'<span class="blog-year">'.esc_html( get_the_date( ' Y' ) ).'</span></div>';

	                                        if( get_comments_number() > 1 ){
					                            $comment_text = __( 'Comments ', 'konsal' );
					                        }else{
					                            $comment_text = __( 'Comment ', 'konsal' );
					                        }
	                                        echo '<a href="'.esc_url( get_permalink() ).'"><i class="far fa-comments"></i>'.esc_html( get_comments_number() ).' '.$comment_text.'</a>';
	                                    echo '</div>';
	                                    echo '<h3 class="box-title title-selector"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h3>';
	                                    echo '<p class="blog-text desc-selector">'.esc_html( wp_trim_words( get_the_content( ), $settings['con_count'], '' ) ).'</p>';
	                                    if(!empty($settings['read_more'])){
				                            echo '<a href="'.esc_url( get_permalink() ).'" class="link-btn style2"><i class="fas fa-plus-circle me-1"></i>'.esc_html($settings['read_more']).'<i class="fas fa-arrow-right ms-2"></i></a>';
				                        }
	                                echo '</div>';
	                            echo '</div>';
	                        echo '</div>';
						}
                    echo '</div>';
	            	wp_reset_postdata();
		        }
	            
            echo '</div>';

        }elseif( $settings['layout_style'] == 'layout_two' ){
			echo '<div class="row justify-content-md-between align-items-end">';
				echo '<div class="col-md-auto">';
					echo '<div class="title-area">';
						if( !empty( $settings['section_subtitle'] ) ) {
							echo '<span class="sub-title">';
								if( !empty( $settings['image']['url'] ) ) {
									echo konsal_img_tag( array(
										'url'   => esc_url( $settings['image']['url'] ),
										'class' => 'me-2',
									) );
								}
								echo wp_kses_post( $settings['section_subtitle'] );
							echo '</span>';
						}
						if( ! empty( $settings['section_title'] ) ) {
							echo '<h2 class="sec-title">'.wp_kses_post( $settings['section_title'] ).'</h2>';
						}
					echo '</div>';
				echo '</div>';
				echo '<div class="col-md-auto">';
					echo '<div class="sec-btn text-start">';
						echo '<div class="icon-box">';
							echo '<button data-slider-prev="#blogSlider3" class="slider-arrow default"><i class="far fa-arrow-left"></i></button>';
							echo '<button data-slider-next="#blogSlider3" class="slider-arrow default"><i class="far fa-arrow-right"></i></button>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			echo '<div class="slider-area">'; ?>
				<div class="swiper th-slider has-shadow" id="blogSlider3" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}'>
					<?php
					echo '<div class="swiper-wrapper">';

						if( $blogpost->have_posts() ) { 
							while( $blogpost->have_posts() ) { $blogpost->the_post(); 
								$categories = get_the_category(); 
								echo '<div class="swiper-slide">';
									echo '<div class="blog-card style3">';
										echo '<div class="blog-img">';
											echo '<a href="'.esc_url( get_permalink() ).'">';
												the_post_thumbnail( 'konsal_355X295' );
											echo '</a>';
										echo '</div>';
										echo '<div class="blog-content">';
											echo '<div class="blog-meta">';
												echo '<a href="'.esc_url( konsal_blog_date_permalink() ).'"><i class="fa-light fa-calendar-days"></i>'.esc_html( get_the_date( 'd,m,Y' ) ).'</a>';

												if( get_comments_number() > 1 ){
													$comment_text = __( 'Comments ', 'konsal' );
												}else{
													$comment_text = __( 'Comment ', 'konsal' );
												}
												echo '<a href="'.esc_url( get_permalink() ).'"><i class="far fa-comments"></i>'.esc_html( get_comments_number() ).' '.$comment_text.'</a>';
											echo '</div>';

											echo '<h3 class="box-title title-selector"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h3>';
											echo '<p class="blog-text desc-selector">'.esc_html( wp_trim_words( get_the_content( ), $settings['con_count'], '' ) ).'</p>';
											if(!empty($settings['read_more'])){
												echo '<a href="'.esc_url( get_permalink() ).'" class="link-btn style2"><i class="fas fa-plus-circle me-1"></i>'.esc_html($settings['read_more']).'</a>';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}wp_reset_postdata();
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

        }elseif( $settings['layout_style'] == 'layout_three' ){
			echo '<div class="row justify-content-lg-between justify-content-center align-items-end">';
				echo '<div class="col-lg">';
					echo '<div class="title-area">';
						if( !empty( $settings['section_subtitle'] ) ) {
							echo '<span class="sub-title">';
								if( !empty( $settings['image']['url'] ) ) {
									echo konsal_img_tag( array(
										'url'   => esc_url( $settings['image']['url'] ),
										'class' => 'me-2',
									) );
								}
								echo wp_kses_post( $settings['section_subtitle'] );
							echo '</span>';
						}
						if( ! empty( $settings['section_title'] ) ) {
							echo '<h2 class="sec-title">'.wp_kses_post( $settings['section_title'] ).'</h2>';
						}
					echo '</div>';
				echo '</div>';
				if(!empty($settings['button_text'])){
					echo '<div class="col-lg-auto">';
						echo '<div class="sec-btn text-start">';
							echo '<a href="'.esc_url( $settings['button_link']['url'] ).'" class="link-btn text-theme">'.wp_kses_post( $settings['button_text'] ).'</a>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

			echo '<div class="slider-area">';
				echo '<div class="swiper th-slider has-shadow" id="blogSlider3" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}\'>';
					echo '<div class="swiper-wrapper">';
						if( $blogpost->have_posts() ) { 
							while( $blogpost->have_posts() ) { $blogpost->the_post();
								$categories = get_the_category(); 
								echo '<div class="swiper-slide">';
									echo '<div class="blog-card style4">';
										echo '<div class="blog-img">';
											echo '<a href="'.esc_url( get_permalink() ).'">';
												the_post_thumbnail( 'konsal_354X294' );
											echo '</a>';
										echo '</div>';
										echo '<div class="blog-date">';
											echo '<i class="far fa-calendar-days"></i> ';
											echo esc_html( get_the_date( 'd M' ) ) . ' <span class="blog-year">'.esc_html( get_the_date( 'Y' ) ).'</span>';
										echo '</div>';
										echo '<div class="blog-content" data-bg-src="'.esc_url( $settings['shape']['url'] ).'">';
											echo '<div class="blog-meta">';
												echo '<a href="'.esc_url( get_author_posts_url( get_the_author_meta('ID') ) ).'" class="author">';
													echo get_avatar( get_the_author_meta( 'ID' ));
													echo esc_html__('Post ', 'konsal');
													echo esc_html( ucwords( get_the_author() ) );
												echo '</a>';
												if( get_comments_number() > 1 ){
													$comment_text = __( 'Comments ', 'konsal' );
												}else{
													$comment_text = __( 'Comment ', 'konsal' );
												}
												echo '<a href="'.esc_url( get_permalink() ).'"><i class="far fa-comments"></i>'.esc_html( get_comments_number() ).' '.$comment_text.'</a>';
											echo '</div>';
											echo '<h3 class="box-title title-selector"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h3>';
											echo '<p class="blog-text desc-selector">'.esc_html( wp_trim_words( get_the_content( ), $settings['con_count'], '' ) ).'</p>';
											if(!empty($settings['read_more'])){
												echo '<a href="'.esc_url( get_permalink() ).'" class="link-btn style2"><i class="fas fa-plus-circle me-1"></i>'.esc_html($settings['read_more']).'</a>';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}wp_reset_postdata();
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_four' ){
			echo '<div class="slider-area">';
				echo '<div class="swiper th-slider has-shadow" id="blogSlider5" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}\'>';
					echo '<div class="swiper-wrapper">';
						if( $blogpost->have_posts() ) { 
							while( $blogpost->have_posts() ) { $blogpost->the_post();
							echo '<div class="swiper-slide">';
								echo '<div class="blog-card style5">';
									echo '<div class="blog-img">';
										echo '<a href="'.esc_url( get_permalink() ).'">';
											the_post_thumbnail( 'konsal_415X305' );
										echo '</a>';
									echo '</div>';
									echo '<div class="blog-content">';
										echo '<div class="blog-meta">';
											echo '<a href="blog.html"><i class="fa-light fa-calendar-days"></i>'.esc_html( get_the_date( 'd M Y' ) ).'</a>';
											if( get_comments_number() > 1 ){
												$comment_text = __( 'Comments ', 'konsal' );
											}else{
												$comment_text = __( 'Comment ', 'konsal' );
											}
											echo '<a href="'.esc_url( get_permalink() ).'"><i class="far fa-comments"></i>'.esc_html( get_comments_number() ).' '.$comment_text.'</a>';
										echo '</div>';
										echo '<h3 class="box-title title-selector"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h3>';
										echo '<p class="blog-text desc-selector">'.esc_html( wp_trim_words( get_the_content( ), $settings['con_count'], '' ) ).'</p>';
										if(!empty($settings['read_more'])){
											echo '<a href="'.esc_url( get_permalink() ).'" class="link-btn style2"><i class="fas fa-plus-circle me-1"></i>'.esc_html($settings['read_more']).'<i class="fas fa-arrow-right ms-2"></i></a>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
							}wp_reset_postdata();
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_five' ){
			echo '<div class="slider-area">';
				echo '<div class="swiper th-slider has-shadow" id="blogSlider6" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}\'>';
					echo '<div class="swiper-wrapper">';
						if( $blogpost->have_posts() ) { 
							while( $blogpost->have_posts() ) { $blogpost->the_post();
							echo '<div class="swiper-slide">';
								echo '<div class="blog-card style6">';
									echo '<div class="blog-img">';
										echo '<a href="'.esc_url( get_permalink() ).'">';
											the_post_thumbnail( 'konsal_415X305' );
										echo '</a>';
										echo '<div class="blog-meta">';
											echo '<a href="blog.html"><i class="fa-light fa-calendar-days"></i>'.esc_html( get_the_date( 'd M Y' ) ).'</a>';
											if( get_comments_number() > 1 ){
												$comment_text = __( 'Comments ', 'konsal' );
											}else{
												$comment_text = __( 'Comment ', 'konsal' );
											}
											echo '<a href="'.esc_url( get_permalink() ).'"><i class="far fa-comments"></i>'.esc_html( get_comments_number() ).' '.$comment_text.'</a>';
										echo '</div>';
									echo '</div>';
									echo '<div class="blog-content">';
										echo '<h3 class="box-title title-selector"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h3>';
										echo '<p class="blog-text desc-selector">'.esc_html( wp_trim_words( get_the_content( ), $settings['con_count'], '' ) ).'</p>';
										if(!empty($settings['read_more'])){
											echo '<a href="'.esc_url( get_permalink() ).'" class="link-btn style2"><i class="fas fa-plus-circle me-1"></i>'.esc_html($settings['read_more']).'<i class="fas fa-arrow-right ms-2"></i></a>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
							}wp_reset_postdata();
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_six' ){
			echo '<div class="slider-area">';
				echo '<div class="swiper th-slider has-shadow" id="blogSlider7" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}\'>';
					echo '<div class="swiper-wrapper">';
					if( $blogpost->have_posts() ) { 
						while( $blogpost->have_posts() ) { $blogpost->the_post();
							echo '<div class="swiper-slide">';
								echo '<div class="blog-card style7">';
									echo '<div class="blog-img">';
										echo '<a href="'.esc_url( get_permalink() ).'">';
											the_post_thumbnail( 'konsal_415X305' );
										echo '</a>';
										echo '<div class="blog-meta">';
											echo '<a href="blog.html"><i class="fa-light fa-calendar-days"></i>'.esc_html( get_the_date( 'd M Y' ) ).'</a>';
											if( get_comments_number() > 1 ){
												$comment_text = __( 'Comments ', 'konsal' );
											}else{
												$comment_text = __( 'Comment ', 'konsal' );
											}
											echo '<a href="'.esc_url( get_permalink() ).'"><i class="far fa-comments"></i>'.esc_html( get_comments_number() ).' '.$comment_text.'</a>';
										echo '</div>';
									echo '</div>';
									echo '<div class="blog-content">';
										echo '<h3 class="box-title title-selector"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h3>';
										echo '<p class="blog-text desc-selector">'.esc_html( wp_trim_words( get_the_content( ), $settings['con_count'], '' ) ).'</p>';
										if(!empty($settings['read_more'])){
											echo '<a href="'.esc_url( get_permalink() ).'" class="link-btn style2"><i class="fas fa-plus-circle me-1"></i>'.esc_html($settings['read_more']).'</a>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}wp_reset_postdata();
					}
					echo '</div>';
				echo '</div>';
				echo '<button data-slider-prev="#blogSlider7" class="slider-arrow slider-prev"><i class="far fa-arrow-left"></i></button>';
				echo '<button data-slider-next="#blogSlider7" class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>';
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_seven' ){
		echo '<div class="slider-area">';
			echo '<div class="swiper th-slider has-shadow" id="blogSlider8" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}\'>';
				echo '<div class="swiper-wrapper">';
				if( $blogpost->have_posts() ) { 
					while( $blogpost->have_posts() ) { $blogpost->the_post();
					echo '<div class="swiper-slide">';
						echo '<div class="blog-card style8">';
							echo '<div class="blog-img">';
								echo '<a href="'.esc_url( get_permalink() ).'">';
									the_post_thumbnail( 'konsal_415X305' );
								echo '</a>';
								echo '<div class="blog-date">';
									echo ''.esc_html(get_the_date( 'd' )).' <br> '.esc_html(get_the_date( 'M' )).' <span class="blog-year">'.esc_html(get_the_date( 'Y' )).'</span>';
								echo '</div>';
							echo '</div>';
							echo '<div class="blog-content">';
								echo '<h3 class="box-title title-selector"><a href="'.esc_url( get_permalink() ).'">'.esc_html( wp_trim_words( get_the_title( ), $settings['title_count'], '' ) ).'</a></h3>';
								echo '<p class="blog-text desc-selector">'.esc_html( wp_trim_words( get_the_content( ), $settings['con_count'], '' ) ).'</p>';
								if(!empty($settings['read_more'])){
									echo '<a href="'.esc_url( get_permalink() ).'" class="link-btn style2"><i class="fas fa-plus-circle me-1"></i>'.esc_html($settings['read_more']).'</a>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
					}wp_reset_postdata();
				}
				echo '</div>';
			echo '</div>';
			echo '<button data-slider-prev="#blogSlider8" class="slider-arrow slider-prev"><i class="far fa-arrow-left"></i></button>';
			echo '<button data-slider-next="#blogSlider8" class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>';
		echo '</div>';

		}


	}
}