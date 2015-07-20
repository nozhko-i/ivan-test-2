<?php
/**
* @Packege Wordpress
* @Subpackege Nozhka
* @Since 1.0.0
*/

if ( class_exists( 'My_Custom_Post_Type' ) ) {

	class My_Custom_Post_Type_Child extends My_Custom_Post_Type
	{
		/**
		 * @param array $args
		 * @param array $labels
		 */
		public function __construct()
		{
			parent::__construct();

			$this->set_post_type_name( 'Book' );
		}

		public function add_args()
		{
			parent::add_args();

			$this->set_post_types_args(
				array(
					'label'                 => $this->get_post_type_name(),
					'labels'                => $this->get_post_types_labels(),
					'public'                => true,
					'show_ui'               => true,
					'supports'              => array( 'title', 'editor', 'thumbnail' ),
					'show_in_nav_menus'     => true,
					'_builtin'              => false,
				)
			);
		}

	}

}


// Run child class
$my_cpt = new My_Custom_Post_Type_Child();