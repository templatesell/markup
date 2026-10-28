<?php
/**
 * Recommended plugins notice.
 *
 * All plugins are optional and hosted on WordPress.org. Nothing is installed
 * automatically.
 *
 * @package Markup
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'markup_recommended_plugins' ) ) :
	/**
	 * Recommended plugins, in display order.
	 *
	 * @return array[] Each entry has a slug, plugin file and name.
	 */
	function markup_recommended_plugins() {

		return array(
			array(
				'slug' => 'one-click-demo-import',
				'file' => 'one-click-demo-import/one-click-demo-import.php',
				'name' => __( 'One Click Demo Import', 'markup' ),
			),
			array(
				'slug' => 'template-sell-demo-importer',
				'file' => 'template-sell-demo-importer/templatesell-demo-importer.php',
				'name' => __( 'Template Sell Demo Importer', 'markup' ),
			),
			array(
				'slug' => 'templatesell-gated-downloads',
				'file' => 'templatesell-gated-downloads/templatesell-gated-downloads.php',
				'name' => __( 'Gated Downloads', 'markup' ),
			),
			array(
				'slug' => 'templatesell-captchaflow',
				'file' => 'templatesell-captchaflow/captchaflow.php',
				'name' => __( 'CaptchaFlow', 'markup' ),
			),
		);
	}
endif;

if ( ! function_exists( 'markup_missing_recommended_plugins' ) ) :
	/**
	 * Recommended plugins that are not active yet.
	 *
	 * @return array[] Subset of markup_recommended_plugins(), with an 'installed' flag.
	 */
	function markup_missing_recommended_plugins() {

		if ( ! function_exists( 'is_plugin_active' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}

		$installed = array_keys( get_plugins() );
		$missing   = array();

		foreach ( markup_recommended_plugins() as $plugin ) {
			if ( is_plugin_active( $plugin['file'] ) ) {
				continue;
			}

			$plugin['installed'] = in_array( $plugin['file'], $installed, true );
			$missing[]           = $plugin;
		}

		return $missing;
	}
endif;

if ( ! function_exists( 'markup_plugin_action_url' ) ) :
	/**
	 * Install or activate URL for one recommended plugin.
	 *
	 * @param array $plugin One entry from markup_recommended_plugins().
	 * @return string Admin URL, or empty if the user cannot act on it.
	 */
	function markup_plugin_action_url( $plugin ) {

		if ( $plugin['installed'] ) {
			if ( ! current_user_can( 'activate_plugins' ) ) {
				return '';
			}

			return wp_nonce_url(
				self_admin_url( 'plugins.php?action=activate&plugin=' . rawurlencode( $plugin['file'] ) ),
				'activate-plugin_' . $plugin['file']
			);
		}

		if ( ! current_user_can( 'install_plugins' ) ) {
			return '';
		}

		return wp_nonce_url(
			self_admin_url( 'update.php?action=install-plugin&plugin=' . rawurlencode( $plugin['slug'] ) ),
			'install-plugin_' . $plugin['slug']
		);
	}
endif;

if ( ! function_exists( 'markup_plugin_notice' ) ) :
	/**
	 * Show the notice until dismissed or all plugins are active.
	 */
	function markup_plugin_notice() {

		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		if ( get_user_meta( get_current_user_id(), 'markup_plugin_notice_dismissed', true ) ) {
			return;
		}

		$missing = markup_missing_recommended_plugins();

		if ( empty( $missing ) ) {
			return;
		}

		// Active theme name, so child themes read correctly.
		$theme_name = wp_get_theme()->get( 'Name' );

		$names = array();
		foreach ( $missing as $plugin ) {
			$names[] = '<em>' . esc_html( $plugin['name'] ) . '</em>';
		}
		?>
		<div class="notice notice-info is-dismissible markup-plugin-notice">
			<p>
				<?php
				printf(
					/* translators: 1: theme name, 2: comma separated list of plugin names. */
					esc_html__( '%1$s recommends these free plugins: %2$s.', 'markup' ),
					esc_html( $theme_name ),
					wp_kses( implode( ', ', $names ), array( 'em' => array() ) )
				);
				?>
				<?php esc_html_e( 'None of them are required.', 'markup' ); ?>
			</p>
			<p>
				<?php
				foreach ( $missing as $plugin ) {
					$url = markup_plugin_action_url( $plugin );

					if ( '' === $url ) {
						continue;
					}

					printf(
						'<a href="%1$s" class="button button-secondary">%2$s</a> ',
						esc_url( $url ),
						$plugin['installed']
							/* translators: %s: plugin name. */
							? esc_html( sprintf( __( 'Activate %s', 'markup' ), $plugin['name'] ) )
							/* translators: %s: plugin name. */
							: esc_html( sprintf( __( 'Install %s', 'markup' ), $plugin['name'] ) )
					);
				}
				?>
			</p>
			<p>
			<a href="<?php echo esc_url( admin_url( 'themes.php?page=markup-theme' ) ); ?>"><?php esc_html_e( 'Theme options', 'markup' ); ?></a>
			<span aria-hidden="true">|</span>				<a href="<?php echo esc_url( markup_plugin_notice_dismiss_url() ); ?>"><?php esc_html_e( 'Dismiss this notice', 'markup' ); ?></a>
			</p>
		</div>
		<?php
	}
endif;
add_action( 'admin_notices', 'markup_plugin_notice' );

if ( ! function_exists( 'markup_plugin_notice_dismiss_url' ) ) :
	/**
	 * Nonce-protected URL that dismisses the notice.
	 *
	 * @return string
	 */
	function markup_plugin_notice_dismiss_url() {

		return wp_nonce_url(
			add_query_arg( 'markup_dismiss_plugins', '1' ),
			'markup_dismiss_plugins',
			'markup_plugins_nonce'
		);
	}
endif;

if ( ! function_exists( 'markup_plugin_notice_dismiss' ) ) :
	/**
	 * Store the dismissal against the user.
	 */
	function markup_plugin_notice_dismiss() {

		if ( ! isset( $_GET['markup_dismiss_plugins'] ) ) {
			return;
		}

		if ( ! isset( $_GET['markup_plugins_nonce'] )
			|| ! wp_verify_nonce( sanitize_key( wp_unslash( $_GET['markup_plugins_nonce'] ) ), 'markup_dismiss_plugins' )
		) {
			return;
		}

		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		update_user_meta( get_current_user_id(), 'markup_plugin_notice_dismissed', 1 );
	}
endif;
add_action( 'admin_init', 'markup_plugin_notice_dismiss' );
