<?php
namespace Mos_Elementor_Addons\Widgets;
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Mos_Elementor_Addons\Classes\Helper as ControlsHelper;
//use Essential_Addons_Elementor\Traits\Helper;
class Post_Grid extends Widget_Base {

	public function get_name() {
		return 'mos_post_grid';
	}

	public function get_title() {
		return esc_html__( 'Mos Post Grid', 'elementor-addon' );
	}

	public function get_icon() {
		return 'eaicon-post-grid';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
        return [
            'post',
            'posts',
            'grid',
            'mos post grid',
            'mos posts grid',
            'blog post',
            'article',
            'custom posts',
            'masonry',
            'content views',
            'blog view',
            'content marketing',
            'blogger',
            'mos',
            'mos addons',
        ];
	}

	protected function register_controls() {
		// $post_types = get_post_types(['public' => true, 'show_in_nav_menus' => true], 'objects');
		// $post_types = wp_list_pluck($post_types, 'label', 'name');

		$post_types = ControlsHelper::get_post_types();
        $post_types['by_id'] = __('Manual Selection', 'essential-addons-for-elementor-lite');
		// Content Tab Start

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Query', 'elementor-addon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'post_type',
            [
                'label' => __('Source', 'essential-addons-for-elementor-lite'),
                'type' => Controls_Manager::SELECT,
                // 'options' => [
				// 	'post' => 'Post',
				// 	'page' => 'Page',
				// 	'e-landing-page' => 'Landing Pages',
				// 	'product' => 'Product'
				// ],
                // 'default' => 'post',
				'options' => $post_types,
                'default' => key($post_types),
            ]
		);

		$this->add_control(
            'authors', 
			[
                'label' => __('Author', 'essential-addons-for-elementor-lite'),
                'label_block' => true,
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => [],
                'options' => ControlsHelper::get_authors_list(),
                'condition' => [
                    'post_type!' => ['by_id', 'source_dynamic'],
                ],
            ]
		);

		$this->add_control(
		    'post__not_in',
		    [
			    'label'       => __( 'Exclude', 'essential-addons-for-elementor-lite' ),
			    'type'        => 'eael-select2',
			    'label_block' => true,
			    'multiple'    => true,
			    'source_name' => 'post_type',
			    'source_type' => 'any',
			    'condition'   => [
				    'post_type!' => [ 'by_id', 'source_dynamic' ],
			    ],
		    ]
	    );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts Per Page', 'essential-addons-for-elementor-lite'),
                'type' => Controls_Manager::NUMBER,
                'default' => '4',
                'min' => '1',
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => __('Offset', 'essential-addons-for-elementor-lite'),
                'type' => Controls_Manager::NUMBER,
                'default' => '0',
	            'condition' => [
	            	'orderby!' => 'rand'
	            ]
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => __('Order By', 'essential-addons-for-elementor-lite'),
                'type' => Controls_Manager::SELECT,
                'options' => ControlsHelper::get_post_orderby_options(),
                'default' => 'date',

            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __('Order', 'essential-addons-for-elementor-lite'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'asc' => 'Ascending',
                    'desc' => 'Descending',
                ],
                'default' => 'desc',

            ]
        );

		$this->end_controls_section();

		// Content Tab End


		// Style Tab Start

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__( 'Title', 'elementor-addon' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Text Color', 'elementor-addon' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hello-world' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Style Tab End

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<p class="hello-world">
			<?php //echo $settings['title']; ?>
		</p>

		<?php
	}
}