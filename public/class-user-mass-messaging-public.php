<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/wbimran/
 * @since      1.0.0
 *
 * @package    User_Mass_Messaging
 * @subpackage User_Mass_Messaging/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    User_Mass_Messaging
 * @subpackage User_Mass_Messaging/public
 * @author     Mohammad Imran <mimran034mohd@gmail.com>
 */
class User_Mass_Messaging_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in User_Mass_Messaging_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The User_Mass_Messaging_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/user-mass-messaging-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in User_Mass_Messaging_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The User_Mass_Messaging_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/user-mass-messaging-public.js', array( 'jquery' ), $this->version, false );

	}

	// add button to send message to the connection - mass messaging on user profile
	public function mi_add_send_message_button_user_connection_tab() {
		if (bp_is_my_profile() ) {
			$compose_url = bp_loggedin_user_domain() . bp_get_messages_slug() . '/compose/?all_connections=1';
		?>
		<div class="bp-connections-send-message">
			<a href="<?php echo esc_url($compose_url); ?>" class="button send-message-to-connections">
				<?php _e('Send Message', 'user-mass-messaging'); ?>
			</a>
		</div>
		<?php
		}
	}

	// manage rediretion on click the send button on use profile under connection tab - mass messaging on user profile
	public function mi_handle_message_redirect() {
		if (isset($_GET['all_connections']) && ! isset($_GET['component']) && $_GET['all_connections'] == 1 && bp_is_messages_component() && bp_is_current_action('compose')) {						
			add_action('wp_footer', array($this, 'mi_pre_select_connections_on_compose'));
		} elseif( isset($_GET['component']) && $_GET['component'] == 'team' ){			
			add_action('wp_footer', array($this, 'mi_pre_select_connections_on_compose'));
		}
	}


	// manage auto select the connection on the compose - mass messaging on user profile
	public function mi_pre_select_connections_on_compose() {
		$current_url = home_url(add_query_arg(array(), $_SERVER['REQUEST_URI']));
		parse_str(parse_url($current_url, PHP_URL_QUERY), $params); 
		$has_team = isset($params['component']) && $params['component'] === 'team';		

		if ($has_team) {
			$referel_url = home_url(add_query_arg(array(), $_SERVER['HTTP_REFERER']));		
			$path = parse_url($referel_url, PHP_URL_PATH); 
			$segments = explode('/', trim($path, '/')); 
			$circle_id = end($segments);
			$connections = bcircles_get_circle_users( $circle_id );
		} else {
			// Get the current user's connections (friend IDs)
			$connections = friends_get_friend_user_ids(bp_loggedin_user_id());
		}

		// If no connections, exit early
		if (empty($connections)) {
			return;
		}

		// Prepare an array of connection data with BuddyBoss-style values and first names
		$connection_data = array_map(function($user_id) {
			// Get the first name from user meta
			$first_name = get_user_meta($user_id, 'first_name', true);

			// Fallback to nicename if first name is empty
			$display_name = !empty($first_name) ? $first_name : bp_core_get_username($user_id);

			// Get the raw username (nicename) without any prefixes
			$user = get_userdata($user_id);
			$username = $user->user_login; // Use user_login to ensure raw username            
			return [
				'id' => '@' . $username,    // Apply @bb- prefix once (e.g., @bb-nicolina)
				'text' => $display_name        // First name (or nicename as fallback) for display
			];
		}, $connections);

		// Encode the connection data as JSON
		$connections_json = json_encode($connection_data);
		?>
		<script type="text/javascript">
			jQuery(document).ready(function($) {
				var connections = <?php echo $connections_json; ?>;

				// Wait for Select2 to initialize
				var checkSelect2 = setInterval(function() {
					if ($('#send-to-input').hasClass('select2-hidden-accessible')) {
						clearInterval(checkSelect2);

						// Pre-select connections by BuddyBoss-style values
						var selectedIds = connections.map(function(item) {
							return item.id; // e.g., @bb-nicolina
						});

						// Set the selected values in the Select2 field
						$('#send-to-input').val(selectedIds);

						// Add the options to Select2 with first names as the visible text
						connections.forEach(function(item) {
							var option = new Option(item.text, item.id, true, true);
							$('#send-to-input').append(option);
						});

						// Trigger change to update the Select2 display
						$('#send-to-input').trigger('change');
					}
				}, 100);
			});
		</script>
		<?php
	}

}
