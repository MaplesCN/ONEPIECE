<?php remove_action('admin_print_scripts', 'print_emoji_detection_script'); remove_action('admin_print_styles', 'print_emoji_styles'); remove_action('wp_head', 'print_emoji_detection_script', 7); remove_action('wp_print_styles', 'print_emoji_styles'); remove_action('embed_head', 'print_emoji_detection_script'); remove_filter('the_content_feed', 'wp_staticize_emoji'); remove_filter('comment_text_rss', 'wp_staticize_emoji'); remove_filter('wp_mail', 'wp_staticize_emoji_for_email'); add_filter( 'emoji_svg_url', '__return_false' ); show_admin_bar( false ); function disable_search( $query, $error = true ) { if (is_search() && !is_admin()) { $query->is_search = false; $query->query_vars['s'] = false; $query->query['s'] = false; if ( $error == true ) $query->is_404 = true; } } add_action( 'parse_query', 'disable_search' ); add_filter( 'get_search_form', function($a){return null;}); function login_logo() { echo '<style type="text/css"> h1 a {background-image: url(https://res.1piece.cn/images/word.svg) !important; } </style>'; } add_action('login_head', 'login_logo'); function login_logo_url() { return home_url(); } add_filter( 'login_headerurl', 'login_logo_url' ); function add_security_question() { ?> <p> <label><?php _e('请回答：下列哪一位是中国作家？</br>泰戈尔、雪莱、巴金、海明威') ?><br /> <input type="text" name="user_proof" id="user_proof" class="input" size="25" tabindex="20" /></label> </p> <?php } add_action( 'register_post', 'add_security_question_validate', 10, 3 ); function add_security_question_validate( $sanitized_user_login, $user_email, $errors) { if (!isset($_POST[ 'user_proof' ]) || empty($_POST[ 'user_proof' ])) { return $errors->add( 'proofempty', '<strong>错误</strong>：您还没有回答问题。'); } elseif ( strtolower( $_POST[ 'user_proof' ] ) != '巴金' ) { return $errors->add( 'prooffail', '<strong>错误</strong>：您的答案不正确。'); } } add_action( 'register_form', 'add_security_question' ); function remove_login_title($login_title, $title){ return $title.' &lsaquo; '.get_bloginfo('name'); } add_filter('login_title', 'remove_login_title', 10, 2); function remove_admin_title($admin_title, $title){ return $title.' &lsaquo; '.get_bloginfo('name'); } add_filter('admin_title', 'remove_admin_title', 10, 2); function remove_dashboard_widgets() { global $wp_meta_boxes; unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']); } add_action('wp_dashboard_setup', 'remove_dashboard_widgets' ); remove_action('welcome_panel', 'wp_welcome_panel'); function admin_bar() { global $wp_admin_bar; $wp_admin_bar->remove_menu('wp-logo'); } add_action( 'wp_before_admin_bar_render', 'admin_bar' ); function remove_help($old_help, $screen_id, $screen){ $screen->remove_help_tabs(); return $old_help; } add_filter( 'contextual_help', 'remove_help', 999, 3 ); function url_filtered($fields) { if(isset($fields['url'])) unset($fields['url']); return $fields; } add_filter('comment_form_default_fields', 'url_filtered'); function add_my_allowed_tag($allowedtags) {array_push($allowedtags, ['emoji' => array('src' => true)]);return $allowedtags;} add_filter('wp_kses_allowed_html', 'add_my_allowed_tag');function push_to_baidu($post_id, $post, $update){ if( $post->post_status != 'publish'){ return; } $url = get_permalink($post_id); $api = 'http://data.zz.baidu.com/urls?site=https://1piece.cn&token=Abl34QMq9NjYjhQZ'; $ch = curl_init(); $options = array( CURLOPT_URL => $api, CURLOPT_POST => true, CURLOPT_RETURNTRANSFER => true, CURLOPT_POSTFIELDS => $url, CURLOPT_HTTPHEADER => array('Content-Type: text/plain'), ); curl_setopt_array($ch, $options); $baidulog = fopen("baidu.log", "a"); $n = "\n"; date_default_timezone_set("PRC"); fwrite($baidulog, date("Y-m-d H:i:s").$n.$url.$n.curl_exec($ch).$n.$n); fclose($baidulog); } add_action('publish_post', 'push_to_baidu', 10, 3); function my_remove_recent_comments_style() { global $wp_widget_factory; remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ,'recent_comments_style')); } add_action('widgets_init', 'my_remove_recent_comments_style'); remove_action('wp_head', 'index_rel_link'); remove_action('wp_head', 'feed_links_extra', 3); remove_action('wp_head', 'feed_links', 2 ); remove_action('wp_head', 'start_post_rel_link', 10, 0); remove_action('wp_head', 'parent_post_rel_link', 10, 0); remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 ); remove_action('wp_head', 'rel_canonical' ); remove_action('wp_head', 'icon' ); remove_action('wp_head','rsd_link'); remove_action('wp_head','wlwmanifest_link'); remove_filter('the_content', 'wptexturize'); remove_action( 'wp_head', 'wp_generator' ); remove_action( 'wp_footer', 'wp_print_footer_scripts' ); remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 ); remove_action( 'wp_head', 'locale_stylesheet' ); remove_action( 'wp_head', 'noindex', 1 );