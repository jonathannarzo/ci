<?php

class MY_Controller Extends CI_Controller
{
	private $templates_folder = 'templates';
	private $view_styles = array();
	private $view_scripts = array();

	protected $template_view = 'app';
	protected $content_view;
	protected $content_title;
	protected $content_title_sub;
	protected $view_data = array();
	protected $body_tag_id;
	protected $body_tag_class;
	protected $page_title = 'App';
	protected $default_session_redirect = 'profile';
	
	public $_user; // variable containing ['id', 'user_type_code', ...] of the current logged in user
	public $_print_user;

	public function __construct()
	{
		parent::__construct();
		$this->_user = $this->session->userdata('logged_in');
		$this->_session_check();
		$this->_print_user();
		$this->_page_defaults();
	}

	public function _output($output)
    {
		$this->view_data['_elapsed_time'] = $this->benchmark->elapsed_time('total_execution_time_start', 'total_execution_time_end');
		$this->view_data['_page_title'] = $this->page_title;

		$this->view_data['_styles'] = $this->_view_styles();
		$this->view_data['_scripts'] = $this->_view_scripts();

		$this->view_data['_body_id'] = $this->body_tag_id;
		$this->view_data['_body_class'] = $this->body_tag_class;

		$this->view_data['_content_title'] = $this->content_title;
		$this->view_data['_content_title_sub'] = $this->content_title_sub;

		if (empty($this->content_view)) $this->content_view = $this->router->class . '/' . $this->router->method;

		$view_path = APPPATH . 'views/' . $this->content_view . '.php';
		if (file_exists($view_path)) $main_content = $this->load->view($this->content_view, $this->view_data, true);
		else die("'{$view_path}' Does not exist.");

		if($this->template_view)
		{
			echo $this->load->view($this->templates_folder . '/' . $this->template_view, array('main_content' => $main_content), true);
			echo $output;
		}
	}

	private function _page_defaults()
	{
		// Styles
		$this->view_styles[] = '/assets/css/all.css';
		$this->view_styles[] = '/assets/css/custom.css';

		// Scripts
		$this->view_scripts[] = '/assets/js/all.js';
		$this->view_scripts[] = '/assets/plugins/fastclick/fastclick.min.js';
		$this->view_scripts[] = '/assets/js/app.min.js'; // Admin LTE
		$this->view_scripts[] = '/assets/js/ci.js';
		$this->view_scripts[] = '/assets/js/custom.js';

		// Body class
		$this->body_tag_class = 'hold-transition skin-black sidebar-mini';
	}

	/**
	 * Adding style or scripts
	 * @param (string) $type -> css, js
	 * @param (string, array) $path -> path of the resource
	 */
	public function _add_resource($type, $path)
	{
		switch($type)
		{
			case 'css':
				if (is_array($path)) foreach ($path as $p) $this->view_styles[] = $p;
				else $this->view_styles[] = $path;
				break;
			case 'js':
				if (is_array($path)) foreach ($path as $p) $this->view_scripts[] = $p;
				else $this->view_scripts[] = $path;
				break;
			default:
				die("'{$type}' is unknown resource (css,js) are the only one accepted.");
				break;
		}
	}

	private function _view_styles()
	{
		if ( ! is_array($this->view_styles)) die('$this->view_styles must be an array!');
		$styles = '';
		foreach ($this->view_styles as $style)
		{
			$styles .= link_tag($style);
		}
		return $styles;
	}

	private function _view_scripts()
	{
		if ( ! is_array($this->view_scripts)) die('$this->view_scripts must be an array!');
		$scripts = '';
		foreach ($this->view_scripts as $script)
		{
			$scripts .= script_tag($script);
		}
		return $scripts;
	}

	public function _app_msg($type = false, $message = false, $redirect = false, $val_name = 'app_message')
	{
		$type = strtolower($type);
		switch($type)
		{
			case 'success':
				$template = "<div class='alert alert-success alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h4><i class='icon fa fa-check'></i> Success!</h4>{$message}</div>";
				break;
			case 'warning':
				$template = "<div class='alert alert-warning alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h4><i class='icon fa fa-warning'></i> Warning!</h4>{$message}</div>";
				break;
			case 'error':
				$template = "<div class='alert alert-danger alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h4><i class='icon fa fa-ban'></i> Error!</h4>{$message}</div>";
				break;
			case 'info':
				$template = "<div class='alert alert-info alert-dismissible' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h4><i class='icon fa fa-info'></i> Notice!</h4>{$message}</div>";
				break;
			default:
				$template = $message;
				break;
		}
		
		if ($type && $message && $redirect)
		{
			$this->session->set_flashdata($val_name, $template);
			redirect($redirect);
		}
		elseif ($type && $message && $redirect == false)
		{
			$this->session->set_flashdata($val_name, $template);
			redirect_back();
		}
		
		if($redirect == false && $message == false && $redirect == false)
		{
			return $this->session->flashdata($val_name);
		}
	}

	public function _app_callout($type = false, $title = 'Notice!', $message = false, $redirect = false, $val_name = 'app_callout')
	{
		$type = strtolower($type);
		switch($type)
		{
			case 'success':
				$template = "<div class='callout callout-success'><h4>{$title}</h4><p>{$message}</p></div>";
				break;
			case 'warning':
				$template = "<div class='callout callout-warning'><h4>{$title}</h4><p>{$message}</p></div>";
				break;
			case 'error':
				$template = "<div class='callout callout-danger'><h4>{$title}</h4><p>{$message}</p></div>";
				break;
			case 'info':
				$template = "<div class='callout callout-info'><h4>{$title}</h4><p>{$message}</p></div>";
				break;
			default:
				$template = $message;
				break;
		}
		
		if ($type && $message && $redirect)
		{
			$this->session->set_flashdata($val_name, $template);
			redirect($redirect);
		}
		elseif ($type && $message && $redirect == false)
		{
			return $template;
		}
		
		if($redirect == false && $message == false && $redirect == false)
		{
			return $this->session->flashdata($val_name);
		}
	}

	private function _session_check()
	{
		if ( ( ($this->router->class === 'authentication') && ($this->router->method === 'index') ) && $this->_user )
		{
			redirect($this->default_session_redirect);
		}
	}

	private function _print_user()
	{
		if ( ! empty($this->_user->first_name))
		{
			$this->_print_user = ucfirst($this->_user->first_name);
		}
		elseif ( ! empty($this->_user->username))
		{
			$this->_print_user = ucfirst($this->_user->username);
		}
	}
}