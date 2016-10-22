<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller
{
    protected $migrate_password = 'root';
    protected $current_migration;
    protected $entered_password;
    protected $migrate_version;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('migration');
        $this->_current_migration(); // check current migration version
    }

    public function index()
    {
        if ($this->input->is_cli_request())
        {
            if( ! $this->migration->latest())
            {
                show_error($this->migration->error_string());
            }
            else
            {
                echo 'Migration Successful.';
            }
        }
        else
        {
            echo 'Unable to access.';
        }
    }

    public function version($version = '')
    {
        if ($this->_authenticate())
        {
            $this->_run_version_migrate();
        }
        elseif ($this->input->is_cli_request())
        {
            if (empty($version))
                echo 'ERROR: Please provide a version to migrate';
            else
            {
                $this->migrate_version = $version;
                $this->_run_version_migrate();
            }
        }
        else
        {
            echo 'Unable to access.';
        }
    }

    private function _current_migration()
    {
        $query = $this->db->query("SELECT version FROM migrations");
        if ($query->num_rows())
        {
            $data = $query->row();
            $this->current_migration = $data->version;
        }
        else
        {
            $this->current_migration = 0;   
        }
    }

    private function _run_version_migrate()
    {
        if ($this->_migration_check())
        {
            $migration = $this->migration->version($this->migrate_version);
            if( ! $migration)
            {
                echo $this->migration->error_string();
            }
            else
            {
                if ($this->_authenticate())
                {
                    $this->session->set_flashdata('migration_message', '<b style="color:green;">Migration successful.</b>');
                    redirect('migrate/authenticate_migration');
                }
                else
                {
                    echo 'Migration(s) done'.PHP_EOL;
                }
            }
        }
        else
        {
            echo "Unable to run low version migration. current migration version is : <b>{$this->current_migration}</b>";
        }
    }

    private function _migration_check()
    {
        return (bool) ($this->migrate_version > $this->current_migration);
    }

    private function _authenticate()
    {
        return (bool) ($this->entered_password === $this->migrate_password);
    }

    private function _login_display()
    {
        $notice = $this->session->flashdata('migration_message');
        $next_migration = $this->current_migration + 1;
        $version_view = sprintf('%03d', $this->current_migration);
        $button_status = '';
        $message = '';
        if (count($this->_not_executed_migrations()) === 0)
        {
            $button_status = 'disabled';
            $message = '<b style="color:red;">Nothing to migrate.</b>';
        }

        echo '
        <b style="font-size:24px;">Database Migration</b><br/>
        Current Migration Version : <b style="color:green;">'.$version_view.'</b>
        <hr/>
        <form method="POST" onSubmit=\'return confirm("this will execute migrations from '.$next_migration.' - "+this.elements["version"].value)\'>
            <table>
                <tr>
                    <td></td><td>&nbsp;&nbsp;'.$message.'</td>
                </tr>
                <tr>
                    <td>Version</td>
                    <td>: <input type="number" name="version" autocomplete="off" placeholder="Enter version to migrate" required /></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>: <input type="password" name="password" placeholder="Enter password" required /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>&nbsp;&nbsp;<input type="submit" name="run_migration" value="Run migration" '.$button_status.' /></td>
                </tr>
                <tr><td></td><td>&nbsp;&nbsp;'.$notice.'</td></tr>
            </table>
        </form>';
    }

    public function authenticate_migration()
    {
        $this->_login_display();
        if (isset($_POST['run_migration'], $_POST['version'], $_POST['password']))
        {
            $this->migrate_version = $_POST['version'];
            $this->entered_password = $_POST['password'];
            $this->version();
        }
        $available_migration = $this->_not_executed_migrations();
        echo '<p>&nbsp;</p><hr/>';
        echo '<b>Available Migrations:</b><p></p>';
        echo '<b>Total count: '.count($available_migration).'</b>';
        echo '<pre>'; print_r($available_migration); echo '</pre>';
    }

    private function _not_executed_migrations()
    {
        $dir = new DirectoryIterator(APPPATH.'migrations/');
        $numbers = array();
        foreach ($dir as $fileinfo)
        {
            if ( ! $fileinfo->isDot())
            {
                $migrate_file = explode('_', $fileinfo->getFilename());
                $migrate_num = intval($migrate_file[0]);
                if ($migrate_num > $this->current_migration)
                {
                    $numbers[$migrate_file[0]] = $fileinfo->getFilename();
                }
            }
        }
        return $numbers;
    }
}