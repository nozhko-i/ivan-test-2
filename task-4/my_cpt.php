<?php
/**
 * @Packege Wordpress
 * @Subpackege Nozhka
 * @Since 1.0.0
 */

class My_Custom_Post_Type
{
	/**
	 * @var string
	 */
	private $post_type;

	/**
	 * @var string
	 */
	public $post_type_name;

	/**
	 * @var array
	 */
	public $post_type_args;

	/**
	 * @var array
	 */
	public $post_type_labels;

	/**
	 * @param       $name
	 * @param array $args
	 * @param array $labels
	 */
	public function __construct()
	{
		$this->set_post_type( 'my_cpt' );
		$this->set_post_type_name( 'My CPT' );

		if( ! post_type_exists( $this->get_post_type() ) )
		{
			add_action( 'init', array( &$this, 'add_labels' ) );
			add_action( 'init', array( &$this, 'add_args' ) );
			add_action( 'init', array( &$this, 'register_post_type' ) );
			add_filter( 'manage_edit-'.$this->get_post_type().'_columns', array( &$this, 'add_thumbnail_column' ) );
			add_action( 'manage_posts_custom_column' , array( &$this, 'get_thumbnail' ), 10, 2 );
			add_action( 'add_meta_boxes', array( &$this, 'cpt_add_metaboxes' ) );
			add_action( 'save_post', array( &$this, 'cpt_post_save' ), 1, 2 );
			add_action( 'admin_head', array( &$this, 'add_media_manager' ) );
		}
	}

	public function add_labels()
	{
		$name   = $this->get_post_type_name();
		$plural = $this->get_post_type_name_plural();

		$this->set_post_types_labels(
			array(
				'name'                  => _x( $plural, 'post type general name', 'nozhka' ),
				'singular_name'         => _x( $name, 'post type singular name', 'nozhka' ),
				'add_new'               => _x( 'Add New', strtolower( $name ), 'nozhka' ),
				'add_new_item'          => __( 'Add New ' . $name, 'nozhka' ),
				'edit_item'             => __( 'Edit ' . $name, 'nozhka' ),
				'new_item'              => __( 'New ' . $name, 'nozhka' ),
				'all_items'             => __( 'All ' . $plural, 'nozhka' ),
				'view_item'             => __( 'View ' . $name, 'nozhka' ),
				'search_items'          => __( 'Search ' . $plural, 'nozhka' ),
				'not_found'             => __( 'No ' . strtolower( $plural ) . ' found', 'nozhka'),
				'not_found_in_trash'    => __( 'No ' . strtolower( $plural ) . ' found in Trash', 'nozhka'),
				'parent_item_colon'     => '',
				'menu_name'             => $plural
			)
		);
	}

	public function add_args()
	{
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

	/**
	 * Register post type
	 */
	public function register_post_type()
	{
		register_post_type( $this->get_post_type(), $this->get_post_types_args() );
	}

	/**
	 * @param $type
	 */
	private function set_post_type( $type )
	{
		$this->post_type = $type;
	}

	/**
	 * @return string
	 */
	private function get_post_type()
	{
		return $this->post_type;
	}

	/**
	 * @param $name
	 */
	public function set_post_type_name( $name )
	{
		$this->post_type_name = $name;
	}

	/**
	 * @return string
	 */
	public function get_post_type_name()
	{
		return $this->post_type_name;
	}

	/**
	 * @return string
	 */
	public function get_post_type_name_plural()
	{
		return $this->post_type_name . 's';
	}

	/**
	 * @param array $labels
	 */
	public function set_post_types_labels( $labels = array() )
	{
		$this->post_type_labels = $labels;
	}

	/**
	 * @return array
	 */
	public function get_post_types_labels()
	{
		return $this->post_type_labels;
	}

	/**
	 * @param array $args
	 */
	public function set_post_types_args( $args = array() )
	{
		$this->post_type_args = $args;
	}

	/**
	 * @return array
	 */
	public function get_post_types_args()
	{
		return $this->post_type_args;
	}

	/**
	 * @param $columns
	 *
	 * @return array
	 */
	public function add_thumbnail_column( $columns )
	{
		$cols['cb']              = $columns['cb'];
		$cols['thumbnail']       = __( 'Image', 'nozhka' );
		$cols['title']           = $columns['title'];
		$cols['date']            = $columns['date'];

		return $cols;
	}

	/**
	 * @param $columns
	 * @param $post_id
	 */
	public function get_thumbnail( $columns, $post_id )
	{
		switch( $columns ) {

			case ( 'thumbnail' ) :

				$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ) );
				$thumbnail = $thumbnail ? '<img src="' . $thumbnail[0] . '" width="' . $thumbnail[1] . '" heigth="' . $thumbnail[2] . '" class="nozhka-thumb" />' : '-';
				echo $thumbnail;

				break;
		}
	}

	/**
	 * Add metabox
	 */
	public function cpt_add_metaboxes()
	{
		add_meta_box(
			'cpt_options',
			__( 'Choice file', 'nozhka' ),
			array( &$this, 'cpt_options_metabox' ),
			$this->get_post_type()
		);
	}


	/**
	 * @param $post
	 */
	public function cpt_options_metabox( $post ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( plugin_basename( __FILE__ ), 'cpt_options_metabox_nonce' );
		?>

		<table>
			<tbody>
			<tr>
				<?php $this->cpt_metabox_control_upload( $post, $this->get_post_type(),  'document', __( 'Document:', 'nozhka' ), 'table', 50 ); ?>
			</tr>
			</tbody>
		</table>

	<?php
	}


	/**
	 * @param $post_id
	 */
	public function cpt_post_save( $post_id )
	{
		// Check if our nonce is set.
		if ( ! isset( $_POST['cpt_options_metabox_nonce'] ) ) {
			return;
		}

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $_POST['cpt_options_metabox_nonce'], plugin_basename( __FILE__ ) ) ) {
			return;
		}

		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if ( isset( $_POST['post_type'] ) && $this->get_post_type() == $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			}
		}

		// Check URL metabox postdata
		if ( ! $this->cpt_postdata_validate_document( $_POST['ais_'.$this->get_post_type().'_document'] ) ) {
			wp_die( __( 'Enter a valid .pdf file', 'nozhka' ) . '<br/><strong>' . $_POST['ais_'.$this->get_post_type().'_document'] . '</strong>' );
		}

		/* OK, it's safe for us to save the data now. */
		$this->cpt_metabox_save_postdata( $post_id, $this->get_post_type(), 'document' );
	}


	/**
	 * @param      $post_id
	 * @param      $post_type
	 * @param      $key
	 * @param bool $filter
	 *
	 * @return bool|int
	 */
	public function cpt_metabox_save_postdata( $post_id, $post_type, $key, $filter = false )
	{

		$value = $_POST['ais_' . $post_type . '_' . $key];

		if ( $filter ) {
			if ( $filter == 'int' ) {
				$value = intval( $value );
			}

			if ( $filter == 'float' ) {
				$value = floatval( $value );
			}

			if ( $filter == 'str' ) {
				$value = strval( $value );
			}
		}

		return $this->cpt_update_postmeta( $post_id, $post_type, $key, $value );
	}

	/**
	 * @param $post_id
	 * @param $post_type
	 * @param $key
	 * @param $value
	 *
	 * @return bool|int
	 */
	public function cpt_update_postmeta( $post_id, $post_type, $key, $value ) {
		return update_post_meta( $post_id, '_ais_' . $post_type . '_' . $key, $value );
	}


	/**
	 * @param      $post
	 * @param      $post_type
	 * @param      $name
	 * @param      $title
	 * @param bool $decorator
	 * @param bool $size
	 * @param bool $add_text
	 * @param bool $disabled
	 */
	public function cpt_metabox_control_upload( $post, $post_type, $name, $title, $decorator = false, $size = false, $add_text = false, $disabled = false )
	{

		$id = 'ais_' . $post_type . '_' . $name;
		$value = get_post_meta( $post->ID, '_' . $id, true );

		if ( $disabled ) {
			$disabled = 'disabled="disabled"';
		}

		$label   = '<label for="' . $id . '">' . $title . '</label> ';
		$control = '<input type="text" name="' . $id . '" id="' . $id . '" size="' . $size . '" value="' . esc_attr( $value ) . '" ' . $disabled . '>';
		$button  = '<input type="button" class="button add_media" id="button_'.$id.'" value="'. __( 'Choice file', 'nozhka' ) .'">';

		if ( $add_text ) {
			$control .= ' ' . $add_text;
		}

		if ( $decorator && ( $decorator == 'table' ) ) {
			$label   = '<td class="label">'   . $label . '</td>';
			$control = '<td class="control">' . $control . '</td>';
			$button  = '<td class="control">' . $button . '</td>';
		}

		$output = $label . $control . $button;
		echo $output;
	}


	/**
	 * @param $post_id
	 * @param $post_type
	 * @param $key
	 *
	 * @return mixed
	 */
	public function cpt_get_postmeta( $post_id, $post_type, $key ) {
		return get_post_meta( $post_id, '_ais_' . $post_type . '_' . $key, true );
	}



	/**
	 * @param $document
	 *
	 * @return bool
	 */
	public function cpt_postdata_validate_document( $document )
	{
		return true;
	}

	/**
	 * Add media manager
	 */
	public function add_media_manager()
	{
		?>
		<script type="text/javascript">

			jQuery(document).ready(function($){
				$('#button_ais_my_cpt_document').click(function(e) {
					e.preventDefault();
					var image = wp.media({
						title: 'Upload Image',
						multiple: false
					}).open()
						.on('select', function(e){
							var uploaded_image = image.state().get('selection').first();
							console.log(uploaded_image);
							var image_url = uploaded_image.toJSON().url;
							$('#ais_my_cpt_document').val(image_url);
						});
				});
			});
		</script>
		<?php
	}






}

// Run parent class
//$my_cpt = new My_Custom_Post_Type();