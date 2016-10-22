<?php

function print_die($var)
{
	echo '<pre>'; print_r($var); echo '</pre>';
	die();
}

function dump_die($var)
{
	echo '<pre>'; var_dump($var); echo '</pre>';
	die();
}

function proper_case($str)
{
	return mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
}

function issetor(&$var, $default = FALSE)
{
	return isset($var) ? $var : $default;
}

function active_page($var = FALSE, $return = '')
{
	$CI =& get_instance();
	if ($var)
	{
		$check = FALSE;

		if ( ! is_array($var)) $var = explode('/', $var);

		if (count($var) === 2)
		{
			if (($var[0] == $CI->router->class) && ($var[1] == $CI->router->method))
			{
				$check = TRUE;
			}
		}
		elseif (count($var) === 1)
		{
			if ($var[0] == $CI->router->class)
			{
				$check = TRUE;
			}
		}

		if ( ! empty($return) && $check)
		{
			return $return;
		}

		return $check;
	}
	return FALSE;
}

function build_name()
{
	$args = func_get_args();
	return (func_num_args() > 2) ? "{$args[2]}, {$args[0]} {$args[1]}" : "{$args[0]} {$args[1]}";
}

if ( ! function_exists('script_tag'))
{
    function script_tag($src = '', $language = 'javascript', $type = 'text/javascript', $index_page = FALSE)
    {
        $CI =& get_instance();
        $script = '<script ';
        if (is_array($src))
        {
            foreach ($src as $k => $v)
            {
                if ($k == 'src' AND strpos($v, '://') === FALSE)
                {
                    if ($index_page === TRUE)
                    {
                        $script .= 'src="'.$CI->config->site_url($v).'"';
                    }
                    else
                    {
                        $script .= 'src="'.$CI->config->slash_item('base_url').$v.'"';
                    }
                }
                else
                {
                    $script .= "$k=\"$v\"";
                }
            }
            $script .= "></script>\n";
        }
        else
        {
            if (strpos($src, '://') !== FALSE)
            {
                $script .= 'src="'.$src.'" ';
            }
            elseif ($index_page === TRUE)
            {
                $script .= 'src="'.$CI->config->site_url($src).'" ';
            }
            else
            {
                $script .= 'src="'.$CI->config->slash_item('base_url').$src.'" ';
            }
            $script .= 'language="'.$language.'" type="'.$type.'"';
            $script .= ' /></script>'."\n";
        }
        return $script;
    }
}