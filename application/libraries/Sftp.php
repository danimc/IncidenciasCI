<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** 
 * SFTP Class
 *
 * @author      Chris Kacerguis
 * @link        https://github.com/chriskacerguis/codeigniter-sftp
 */
class SFTP {

    var $hostname       = '';       // the hostname of the server
    var $username       = '';       // username of the server
    var $password       = '';       // password of the server
    var $pubkeyfile     = '';       // path to your public key file (e.g. /Users/username/.ssh/id_rsa.pub)
    var $prikeyfile     = '';       // path to your private key file (e.g. /Users/username/.ssh/id_rsa)
    var $passphrse      = '';       // the passphrase of your key (leave blank if you don't have one)
    var $port           = 22;
    var $method         = 'key';    // By default we will login via username/password
    var $debug          = FALSE;
    var $conn_id        = FALSE;
    var $sftp           = FALSE;


    /**
     * Constructor - Sets Preferences
     *
     * The constructor can be passed an array of config values
     * @version 1.0
     */
    public function __construct($config = array())
    {
        if (count($config) > 0)
        {
            $this->initialize($config);
        }

        log_message('debug', "sFTP Class Initialized");
        
        // Make sure that the SSH2 pecl is installed
        if (!function_exists('ssh2_connect'))
        {
            log_message('error', "SSH2 PECL is not installed");
            exit();
        }
    }

    // --------------------------------------------------------------------

    /**
     * Initialize preferences
     *
     * @access  public
     * @param   array
     * @return  void
     * @version 1.0
     */
    public function initialize($config = array())
    {
        foreach ($config as $key => $val)
        {
            if (isset($this->$key))
            {
                $this->$key = $val;
            }
        }

        // Prep the hostname
        $this->hostname = preg_replace('|.+?://|', '', $this->hostname);
    }

    // --------------------------------------------------------------------

    /**
     * sFTP Connect
     *
     * @access  public
     * @param   array    the connection values
     * @return  bool
     * @version 1.0
     */
    public function connect($config = array())
    {
        if (count($config) > 0)
        {
            $this->initialize($config);
        }

        if (FALSE === ($this->conn_id = @ssh2_connect($this->hostname, $this->port)))
        {
            if ($this->debug == TRUE)
            {
                $this->_error('sftp_unable_to_connect');
            }
            return FALSE;
        }       
        
        if ($this->method == 'auth')
        {
            if (!$this->_login_keys())
            {
                if ($this->debug == TRUE)
                {
                    $this->_error('sftp_unable_to_login');
                }
                return FALSE;
            }       
        } 
        
        else
        {
            if (!$this->_login_pass())
            {
                if ($this->debug == TRUE)
                {
                    $this->_error('sftp_unable_to_login');
                }
                return FALSE;
            }               
        }
        
        $this->sftp = @ssh2_sftp($this->conn_id);
    }

    // --------------------------------------------------------------------

    /**
     * sFTP Login via username/password
     *
     * @access  private
     * @return  bool
     * @version 1.0
     */
    private function _login_pass()
    {
        return @ssh2_auth_password($this->conn_id, $this->username, $this->password);
    }

    /**
     * sFTP Login via keys
     *
     * @access  private
     * @return  bool
     * @version 1.0
     */
    private function _login_keys()
    {
        if ($this->passphrse != '') 
        {
            return @ssh2_auth_pubkey_file($this->conn_id, $this->username, $this->pubkeyfile, $this->prikeyfile, $this->passphrse);
        }
        return @ssh2_auth_pubkey_file($this->conn_id, $this->username, $this->pubkeyfile, $this->prikeyfile);
    }


    // --------------------------------------------------------------------

    /**
     * Validates the connection ID (both SSH and SFTP)
     *
     * @access  private
     * @return  bool
     * @version 1.0
     */
    private function _is_conn()
    {
        if (!is_resource($this->conn_id) && !is_resource($this->sftp))
        {
            if ($this->debug == TRUE)
            {
                $this->_error('sftp_no_connection');
            }
            return FALSE;
        }
        return TRUE;
    }

    // --------------------------------------------------------------------


    /**
     * Change directory
     *
     * The second parameter lets us momentarily turn off debugging so that
     * this function can be used to test for the existence of a folder
     * without throwing an error.  There's no FTP equivalent to is_dir()
     * so we do it by trying to change to a particular directory.
     * Internally, this parameter is only used by the "mirror" function below.
     *
     * @access  public
     * @param   string
     * @param   bool
     * @return  bool
     */
    public function changedir($path = '', $supress_debug = FALSE)
    {
        if ($path == '' OR ! $this->_is_conn())
        {
            return FALSE;
        }

        $result = @ssh2_sftp_stat($this->sftp, $path);

        if ($result === FALSE)
        {
            if ($this->debug == TRUE && $supress_debug == FALSE)
            {
                $this->_error('sftp_unable_to_changedir'); /// change this error
            }
            return FALSE;
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Create a directory
     *
     * @version 1.0
     * @access  public
     * @param   string
     * @return  bool
     */
    public function mkdir($path = '', $permissions = '0777')
    {
        if ($path == '' || !$this->_is_conn())
        {
            return FALSE;
        }       

        $result = @ssh2_sftp_mkdir($this->sftp, $path, $permissions, TRUE);

        if ($result === FALSE)
        {
            if ($this->debug == TRUE)
            {
                $this->_error('sftp_unable_to_mkdir');
            }
            return FALSE;
        }

        return TRUE;
    }
    

    // --------------------------------------------------------------------

    /**
     * Upload a file to the server
     *
     * @version 1.0
     * @access  public
     * @param   string
     * @param   string
     * @param   string
     * @return  bool
     */
    public function upload($locpath, $rempath, $mode = 'auto', $permissions = NULL)
    {
        if (!$this->_is_conn())
        {
            return FALSE;
        }

        if (!file_exists($locpath))
        {
            if ($this->debug == TRUE)
            {
                $this->_error('sftp_no_source_file');
            }           
            return FALSE;
        }

        // Set the mode if not specified
        if ($mode == 'auto')
        {
            // Get the file extension so we can set the upload type
            $ext    = $this->_getext($locpath);
            $mode   = $this->_settype($ext);
        }
        
        
        $file_to_send = @file_get_contents($locpath);
        
        $stream = @fopen("ssh2.sftp://$this->sftp$rempath", 'w');
        
        if (@fwrite($stream, $file_to_send) === FALSE)
        {
            if ($this->debug == TRUE)
            {
                $this->_error('ftp_unable_to_upload');
            }
            return FALSE;               
        }

        // Set file permissions if needed
        if (!is_null($permissions))
        {
            $this->ssh2_sftp_chmod($this->sftp, $rempath, (int)$permissions);
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Download a file from a remote server to the local server
     *
     * @version 1.0
     * @access  public
     * @param   string
     * @param   string
     * @param   string
     * @return  bool
     */
    public function download($rempath, $locpath, $mode = 'auto')
    {
        if ( ! $this->_is_conn())
        {
            return FALSE;
        }

        // Set the mode if not specified
        if ($mode == 'auto')
        {
            // Get the file extension so we can set the upload type
            $ext    = $this->_getext($rempath);
            $mode   = $this->_settype($ext);
        }
        
        $file_to_get = @file_get_contents("ssh2.sftp://{$this->sftp}{$rempath}");
        
        $stream = @fopen($locpath, 'w');

        if (@fwrite($stream, $file_to_get) === FALSE)
        {
            if ($this->debug == TRUE)
            {
                $this->_error('ftp_unable_to_download');
            }
            return FALSE;               
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Rename (or move) a file
     *
     * @version 1.0
     * @access  public
     * @param   string
     * @param   string
     * @param   bool
     * @return  bool
     */
    public function rename($old_file, $new_file, $move = FALSE)
    {
        if ( ! $this->_is_conn())
        {
            return FALSE;
        }

        $result = @ssh2_sftp_rename($this->sftp, $old_file, $new_file);

        if ($result === FALSE)
        {
            if ($this->debug == TRUE)
            {
                $msg = ($move == FALSE) ? 'ftp_unable_to_rename' : 'ftp_unable_to_move';

                $this->_error($msg);
            }
            return FALSE;
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Move a file
     *
     * @access  public
     * @param   string
     * @param   string
     * @return  bool
     */
    public function move($old_file, $new_file)
    {
        return $this->rename($old_file, $new_file, TRUE);
    }

    // --------------------------------------------------------------------

    /**
     * Rename (or move) a file
     *
     * @version 1.0
     * @access  public
     * @param   string
     * @return  bool
     */
    public function delete_file($filepath)
    {
        if ( ! $this->_is_conn())
        {
            return FALSE;
        }

        $result = @ssh2_sftp_unlink($this->sftp, $filepath);

        if ($result === FALSE)
        {
            if ($this->debug == TRUE)
            {
                $this->_error('ftp_unable_to_delete');
            }
            return FALSE;
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Delete a folder and recursively delete everything (including sub-folders)
     * containted within it.
     *
     * @version 1.0
     * @access  public
     * @param   string
     * @return  bool
     */
    public function delete_dir($filepath)
    {
        if ( ! $this->_is_conn())
        {
            return FALSE;
        }

        // Add a trailing slash to the file path if needed
        $filepath = preg_replace("/(.+?)\/*$/", "\\1/",  $filepath);

        $list = $this->list_files($filepath);

        if ($list !== FALSE AND count($list) > 0)
        {
            foreach ($list as $item)
            {
                // If we can't delete the item it's probaly a folder so
                // we'll recursively call delete_dir()
                if ( ! @ssh2_sftp_rmdir($this->sftp, $item))
                {
                    $this->delete_dir($item);
                }
            }
        }

        $result = @ssh2_sftp_rmdir($this->sftp, $filepath);

        if ($result === FALSE)
        {
            if ($this->debug == TRUE)
            {
                $this->_error('ftp_unable_to_delete');
            }
            return FALSE;
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * Set file permissions
     *
     * @version 1.0
     * @access  public
     * @param   string  the file path
     * @param   string  the permissions
     * @return  bool
     */
    public function chmod($path, $perm)
    {
        if (!$this->_is_conn())
        {
            return FALSE;
        }

        // Permissions can only be set when running PHP 5
        if (!function_exists('ssh2_sftp_chmod'))
        {
            if ($this->debug == TRUE)
            {
                $this->_error('ftp_unable_to_chmod');
            }
            return FALSE;
        }

        $result = @ssh2_sftp_chmod($this->sftp, $path, $perm);

        if ($result === FALSE)
        {
            if ($this->debug == TRUE)
            {
                $this->_error('ftp_unable_to_chmod');
            }
            return FALSE;
        }

        return TRUE;
    }

    // --------------------------------------------------------------------

    /**
     * sFTP List files in the specified directory
     *
     * @version 1.0
     * @access  public
     * @return  array
     */
    public function list_files($path = '.')
    {
        if (!$this->_is_conn())
        {
            return FALSE;
        }
        
        $results = array();
        
        $files = scandir("ssh2.sftp://{$this->sftp}{$path}");
        
        // exclude '.' and '..' from list of files
        foreach ($files as $file)
        {
            if ($file != '.' || $file != '..')
            {
                $results[] = $file;
            }
        }
        
        return $results;
    }

    // ------------------------------------------------------------------------

    /**
     * Read a directory and recreate it remotely
     *
     * This function recursively reads a folder and everything it contains (including
     * sub-folders) and creates a mirror via FTP based on it.  Whatever the directory structure
     * of the original file path will be recreated on the server.
     *
     * @access  public
     * @param   string  path to source with trailing slash
     * @param   string  path to destination - include the base folder with trailing slash
     * @return  bool
     */
    public function mirror($locpath, $rempath)
    {
        if ( ! $this->_is_conn())
        {
            return FALSE;
        }

        // Open the local file path
        if ($fp = @opendir($locpath))
        {
            // Attempt to open the remote file path.
            if ( ! $this->changedir($rempath, TRUE))
            {
                // If it doesn't exist we'll attempt to create the direcotory
                if ( ! $this->mkdir($rempath) OR ! $this->changedir($rempath))
                {
                    return FALSE;
                }
            }

            // Recursively read the local directory
            while (FALSE !== ($file = readdir($fp)))
            {
                if (@is_dir($locpath.$file) && substr($file, 0, 1) != '.')
                {
                    $this->mirror($locpath.$file."/", $rempath.$file."/");
                }
                elseif (substr($file, 0, 1) != ".")
                {
                    // Get the file extension so we can se the upload type
                    $ext = $this->_getext($file);
                    $mode = $this->_settype($ext);

                    $this->upload($locpath.$file, $rempath.$file, $mode);
                }
            }
            return TRUE;
        }

        return FALSE;
    }


    // --------------------------------------------------------------------

    /**
     * Extract the file extension
     *
     * @access  private
     * @param   string
     * @return  string
     */
    private function _getext($filename)
    {
        if (FALSE === strpos($filename, '.'))
        {
            return 'txt';
        }

        $x = explode('.', $filename);
        return end($x);
    }


    // --------------------------------------------------------------------

    /**
     * Set the upload type
     *
     * @access  private
     * @param   string
     * @return  string
     */
    private function _settype($ext)
    {
        $text_types = array(
                            'txt',
                            'text',
                            'php',
                            'phps',
                            'php4',
                            'js',
                            'css',
                            'htm',
                            'html',
                            'phtml',
                            'shtml',
                            'log',
                            'xml'
                            );


        return (in_array($ext, $text_types)) ? 'ascii' : 'binary';
    }

    // ------------------------------------------------------------------------

    /**
     * Close the connection
     *
     * @access  public
     * @param   string  path to source
     * @param   string  path to destination
     * @return  bool
     */
    public function close()
    {
        if ( ! $this->_is_conn())
        {
            return FALSE;
        }

        @ftp_close($this->conn_id);
    }

    // ------------------------------------------------------------------------

    /**
     * Display error message
     *
     * @access  private
     * @param   string
     * @return  bool
     */
    private function _error($line)
    {
        //$CI =& get_instance();
        //$CI->lang->load('ftp');
        show_error($line);
    }


}
// END SFTP Class

/* End of file Sftp.php */
/* Location: ./application/libraries/Sftp.php */
