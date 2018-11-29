<?php   require_once MODPINN_PLUGIN_DIR . '/functions.php';
        
register_activation_hook(__FILE__, 'modpinn_activation');
function modpinn_activation(){
	add_option('modpinn_version', MODPINN_VERSION);
	flush_rewrite_rules();
    }

class Modpinn_Plugin {

	static $instance;

	public function __construct() {
		//add_filter( 'set-screen-option', [ __CLASS__, 'set_screen' ], 10, 3 );
		add_action( 'admin_menu', [ $this, 'modpinn_admin_menu' ] );
	}

    function modpinn_admin_menu() {
    	global $wp_version;
  
    	add_menu_page(__('Image Crawler','img-api-menu'), __('Modpinn Api','img-api-menu'), 'manage_options', 'modpinn-top-level-handle', 'modpinn_dash', '', 3);
   	
      	add_submenu_page('modpinn-top-level-handle', __('Options','img-api-menu'), __('Options','img-api-menu'), 'manage_options', 'modpinn-options', 'modpinn_options');
    }

    public static function get_instance() {
        	if ( ! isset( self::$instance ) ) {
		        self::$instance = new self();
        	}

    	return self::$instance;
        }
}
add_action( 'plugins_loaded', function () {	Modpinn_Plugin::get_instance(); } ); 

function mp_img_post() {
    register_post_type( 'img_remote_post',
    array(
      'labels' => array(
        'name' => __( 'Remote Photo Posts' ),
        'singular_name' => __( 'MPhoto' )
      ),
      'public' => true,
      'has_archive' => true,
      'menu_position' => 4,
      'menu_icon' => 'dashicons-admin-site',
    )
  );
}
add_action( 'init', 'mp_img_post' );

function save_mp_node_meta( $post_id, $post, $update ) {
$post_type = get_post_type($post_id);

    if ( "img_remote_post" != $post_type ) return;
        if ( isset( $_POST['remote_img_author'] ) ) {
            update_post_meta( $post_id, 'remote_img_author', sanitize_text_field( $_POST['remote_img_author'] ) );
        }
    }
add_action( 'save_post', 'save_mp_node_meta', 10, 3 );

function modpinn_options() {
?>
    <?php echo '<h1>Options</h1><div class="ht25"></div><ul class="list-group">';

    echo '</ul>'; ?><?php
}

function modpinn_dash() {

    echo '<div class="container"><div class="row">
          <h1>Remote Site</h1><div class="ht25"></div>
        <form id="mp-add-Form" action="" method="post">
    	  <div class="form-group">
    	  <label for="InputUrl">Url</label>
    ';
	if ( isset( $_POST['InputUrl'] ) ) { 
	    
            $url = trim($_POST[ 'InputUrl' ]); 
            $obj = mp_curl($url); 
            $imgs = mp_imgs($obj); 

	}
    ?>
    
      <input type="text" class="form-control" id="Urlid" name="InputUrl" aria-describedby="urlHelp" value="<?php if ( isset($url) ){echo $url;} ?>" placeholder="Enter Url">
    	<small id="urlHelp" class="form-text text-muted">Enter a valid link.</small>
    	</div>

    	<input type="hidden" name="uri" value="<?php if ( isset($url) ){echo $url;} ?>">
    	<input type="hidden" name="status" value="active">

      <button type="submit" name="imgs_uri" id="imgs" class="btn btn-success">imgs?</button>
	    

	<?php if ( isset($imgs) ){echo '<div class="ht25"></div>'.$imgs;} ?>

<?php 

       echo '</form><div class="ht25"></div></div></div>';

}
?>
