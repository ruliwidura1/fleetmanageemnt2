<?php
/**
* Load manually Supporter class for data modelling
*/


/**
* Core class for all controller
*   contains general purpose methods that nice to have in all controllers
*
* @version 1.0.0
*
* @package Core\Controller
* @since 1.0.0
*/
class JI_Controller extends \SENE_Controller
{
    public $status = 404;
    public $message = 'Not found';
    public $page_current = '';
    public $menu_current = '';
    public $user_login = false;
    public $admin_login = false;
    public $module_path = '';

    public function __construct()
    {
        parent::__construct();
        $this->setLang("id-ID");
        $this->module_path = '';
    }

    /**
     * Get config_semevar configuration value, and return default value if not exists
     *
     * @param  string $config_key                     Key string from `$this->config->semevar`
     * @param  mixed  $default_value                  Default value if the seme framework variable was not exists
     *
     * @return mixed                                  Seme framework variable value
     */
    protected function config_semevar($config_key, $default_value = '')
    {
        if (isset($this->config->semevar->{$config_key})) {
            return $this->config->semevar->{$config_key};
        }

        return $default_value;
    }

    /**
     * Execute authentication check for API Admin controller
     *   Will return json output and render http response code
     *
     * @param mixed $data   can be anything
     * @return void
     */
    protected function api_admin_authentication($data)
    {
        if (!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Authenticated user required';
            header("HTTP/1.0 400 ".$this->message);
            $this->__json_out($data);
            return;
        }
    }

    /**
     * Execute authentication check for Admin controller
     *   Will return json output and render http response code
     *
     * @param mixed $data   can be anything
     * @return void
     */
    protected function admin_authentication()
    {
        if (!$this->admin_login) {
            redir(base_url_admin('login'));
            return;
        }
    }

    /**
     * Output the json formatted string
     *
     * @param  mixed $dt input object or array
     * @return string     sting json formatted with its header
     */
    public function __json_out($dt)
    {
        $this->lib('sene_json_engine', 'sene_json');
        $data = array();
        if (isset($_SERVER['SEME_MEMORY_VERBOSE'])) {
            $data["memory"] = round(memory_get_usage()/1024/1024, 5)." MBytes";
        }
        $data["status"]  = (int) $this->status;
        $data["message"] = $this->message;
        $data["data"]  = $dt;
        $this->sene_json->out($data);
        die();
    }

    /**
     * Output the json formatted string for select2
     *
     * @param  mixed $dt input object or array
     * @return string     sting json formatted with its header
     */
    public function __json_select2($dt)
    {
        $this->lib('sene_json_engine', 'sene_json');
        $this->sene_json->out($dt);
        die();
    }
    
    public function __json_event($dt)
    {
        $this->lib('sene_json_engine', 'sene_json');
        $this->sene_json->out($dt);
        die();
    }
    /**
     * Method initialization in controller scope
     *   Will return current defined array of data
     * 
     * @return array
     */
    public function initialize()
    {
        $data = array();
        $data['module_path'] = $this->module_path;
        $sess = $this->getKey();
        if (!is_object($sess)) {
            $sess = new stdClass();
        }
        if (!isset($sess->user)) {
            $sess->user = new stdClass();
        }
        if (isset($sess->user->id)) {
            $this->user_login = true;
        }

        if (!isset($sess->admin)) {
            $sess->admin = new stdClass();
        }
        $this->admin_login = false;
        if (isset($sess->admin->id)) {
            $this->admin_login = true;
        }
        $data['sess'] = $sess;
        $data['site_title'] = $this->config->semevar->site_title;

        $data['page_current'] = $this->page_current;
        $data['menu_current'] = $this->menu_current;


        $data['user_login'] = $this->user_login;
        $data['admin_login'] = $this->admin_login;

        $this->setTitle($this->config->semevar->site_title);

        $this->setRobots('INDEX,FOLLOW');
        
        $this->setIcon(base_url('favicon.png'));
        $this->setShortcutIcon(base_url('favicon.png'));

        return $data;
    }

    /**
     * Output array of array for datatable response api
     *
     * @param array $data    array of object
     * @param int   $count   number of counted row
     * @param array $another array of array for addition information
     */
    public function __jsonDataTable($data, $count, $another=array())
    {
        $this->lib('sene_json_engine', 'sene_json');
        $rdata = array();
        if (!is_array($data)) {
            $data = array();
        }
        $dt1 = array();
        $dt2 = array();
        if (!is_array($data)) {
            trigger_error('jsonDataTable first params need array!');
            die();
        }
        foreach ($data as $dat) {
            $dt2 = array();
            if (is_int($dat)) {
                trigger_error('[ERROR: '.$dat.'] Data table not well performed because a query execution error!');
            }
            foreach ($dat as $dt) {
                $dt2[] = $dt;
            }
            $dt1[] = $dt2;
        }

        if (is_array($another)) {
            $rdata = $another;
        }
        $rdata['data'] = $dt1;
        $rdata['recordsFiltered'] = $count;
        $rdata['recordsTotal'] = $count;
        $rdata['status'] = (int) $this->status;
        $rdata['message'] = $this->message;
        $this->sene_json->out($rdata);
        die();
    }

    /**
     * Generates date and time in Indonesian local
     *
     * @param  string $datetime String with datetime formatted
     * @param  string $utype    output type (hari|hari_tanggal|hari_tangal_jam|jam|tanggal_jam)
     * @return string           date and/or time in Indonesia
     */
    public function __dateIndonesia($datetime, $utype='hari_tanggal')
    {
        if (is_null($datetime) || empty($datetime)) {
            $datetime='now';
        }
        $stt = strtotime($datetime);
        $bulan_ke = date('n', $stt);
        $bulan = 'Desember';
        switch ($bulan_ke) {
        case '1':
            $bulan = 'Januari';
            break;
        case '2':
            $bulan = 'Februari';
            break;
        case '3':
            $bulan = 'Maret';
            break;
        case '4':
            $bulan = 'April';
            break;
        case '5':
            $bulan = 'Mei';
            break;
        case '6':
            $bulan = 'Juni';
            break;
        case '7':
            $bulan = 'Juli';
            break;
        case '8':
            $bulan = 'Agustus';
            break;
        case '9':
            $bulan = 'September';
            break;
        case '10':
            $bulan = 'Oktober';
            break;
        case '11':
            $bulan = 'November';
            break;
        default:
            $bulan = 'Desember';
        }
        $hari_ke = date('N', $stt);
        $hari = 'Minggu';
        switch ($hari_ke) {
        case '1':
            $hari = 'Senin';
            break;
        case '2':
            $hari = 'Selasa';
            break;
        case '3':
            $hari = 'Rabu';
            break;
        case '4':
            $hari = 'Kamis';
            break;
        case '5':
            $hari = 'Jumat';
            break;
        case '6':
            $hari = 'Sabtu';
            break;
        default:
            $hari = 'Minggu';
        }
        $utype == strtolower($utype);
        if ($utype=="hari") {
            return $hari;
        }
        if ($utype=="jam") {
            return date('H:i', $stt).' WIB';
        }
        if ($utype=="jam2") {
            return date('H:i:s', $stt);
        }
        if ($utype=="bulan") {
            return $bulan;
        }
        if ($utype=="tahun") {
            return date('Y', $stt);
        }
        if ($utype=="tanggal_bulan") {
            return date('d-m-Y', $stt);
        }
        if ($utype=="tgl") {
            return date('d', $stt);
        }
        if ($utype=="bulan_tahun") {
            return $bulan.' '.date('Y', $stt);
        }
        if ($utype=="tanggal") {
            return ''.date('d', $stt).' '.$bulan.' '.date('Y', $stt);
        }
        if ($utype=="tanggal_jam") {
            return ''.date('d', $stt).' '.$bulan.' '.date('Y H:i', $stt).' WIB';
        }
        if ($utype=="hari_tanggal") {
            return $hari.', '.date('d', $stt).' '.$bulan.' '.date('Y', $stt);
        }
        if ($utype=="hari_tanggal_jam") {
            return $hari.', '.date('d', $stt).' '.$bulan.' '.date('Y H:i', $stt).' WIB';
        }
    }

    public function __validateDate($date, $format="Y-m-d H:i:s")
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function __format($str, $format="text")
    {
        $format = strtolower($format);
        if ($format == 'richtext') {
            $allowed_tags = '<div><h1><h2><h3><h4><u><hr><p><br><b><i><ul><ol><li><em><strong><quote><blockquote><p><time><sup><sub><table><tr><td><th><thead><tbody><tfoot>';
            return strip_tags($str, $allowed_tags);
        } elseif ($format == 'text') {
            return filter_var(trim($str), FILTER_SANITIZE_STRING);
        } else {
            return $str;
        }
    }

    public function __e($str, $format="text")
    {
        echo $this->__format($str, $format);
    }
    public function __f($str, $format="text")
    {
        return filter_var($str, FILTER_SANITIZE_SPECIAL_CHARS);
    }
    public function __g($str, $format="text")
    {
        return filter_var($str, FILTER_SANITIZE_STRING);
    }



    /**
     * String replacer for push notif payload
     *   Push notif string obtained from a_notification table
     *   variable string encountered with double curly brackets
     *
     * @param  string $message   unformated string from database
     * @param  array  $replacers key value array that will be replaced the string if matched
     * @return string            formatted and replaced var message
     */
    protected function __nRep($message, $replacers=array())
    {
        if (is_array($replacers) && count($replacers)) {
            foreach ($replacers as $key=>$val) {
                $message = str_replace("{{".$key."}}", $val, $message);
            }
        }
        return $message;
    }

    /**
     * Google Push notif for FCM or GCM
     *
     * @param  string $device  device type
     * @param  array  $tokens  tokens in array
     * @param  string $title   fcm title
     * @param  string $message message content
     * @param  string $type    type of message
     * @param  string $image   image icon
     * @param  object $extras  mixed value that overpassed standar limit of required parameter
     * @return string          [description]
     */
    public function __pushNotif($device, $tokens, $title, $message, $type, $image, $extras)
    {
        if (!isset($this->fcm_server_token)) {
            trigger_error('$this->fcm_server_token undefined!');
            die();
        }
        if (strlen($this->fcm_server_token)<=10) {
            trigger_error('$this->fcm_server_token invalid!');
            die();
        }
        if (!is_array($tokens)) {
            trigger_error('Token not array, aborted!');
            die();
        }
        if (!is_object($extras)) {
            trigger_error('Datas not object, aborted!');
            die();
        }
        if (strlen($image)<=4) {
            $image = 'media/pemberitahuan/default.png';
        }
        $url = 'https://fcm.googleapis.com/fcm/send';

        $this->lib("seme_log");
        //filter by device
        if (strtolower($device) == "ios") {
            //build payload
            $payload = array(
            'title' => $title,
            'body' => $message,
            'message' => $message,
            'image' => $image,
            'type' => $type,
            'sound' => 'default',
            'cdate' => date("Y-m-d H:i:s"),
            'extras' => json_encode($extras),
            'mutable_content' => true
            );
            $fields = array('registration_ids'=>$tokens, 'notification'=>$payload);
        //$this->seme_log->write('iOS: Push Notif FIELDS: '.json_encode($fields));
        } else {
            //build payload
            $payload = array(
            'title' => $title,
            'body' => $message,
            'message' => $message,
            'image' => $image,
            'type' => $type,
            'sound' => 'default',
            'cdate' => date("Y-m-d H:i:s"),
            'extras' => json_encode($extras),
            );
            $fields = array('registration_ids'=>$tokens, 'notification'=>null, 'data'=>($payload));
            //$this->seme_log->write('Android: Push Notif FIELDS: '.json_encode($fields));
        }

        $headers = array(
        'Authorization:key = '.$this->fcm_server_token,
        'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === false) {
            //die('Curl failed: ' . c
        }
        curl_close($ch);
        //error_log('FCM FIRE: '.$result);
        $jres = json_decode($result);
        if (isset($jres->success)) {
            return $jres;
        } else {
            $jres =  new stdClass();
            $jres->success = 0;
            $jres->failure = 1;
            return $jres;
        }
    }

    /**
     * Sub string for non-multibytes characters
     *
     * @param  string  $str input non-multibytes string
     * @param  integer $len char length
     * @return string       Substringed string
     */
    public function __st($str, $len=30)
    {
        if (strlen($str)>$len) {
            return substr($str, 0, $len).'...';
        } else {
            return $str;
        }
    }

    /**
     * Sub string for multibytes characters
     *
     * @param  string  $str input multibytes string
     * @param  integer $len char length
     * @return string       Substringed string
     */
    public function __st2($str, $len=30)
    {
        if (mb_strlen($str)>$len) {
            return mb_substr($str, 0, $len).'...';
        } else {
            return $str;
        }
    }

    /**
     * check allowed modules
     *
     * @param  string $a_modules_identifier module id
     * @return int                            true or false
     */
    public function checkPermissionAdmin($a_modules_identifier)
    {
        $is_allowed = 0;
        $modules = array();
        $sess = $this->getKey();
        if (isset($sess->admin->modules)) {
            $modules = $sess->admin->modules;
        }
        if (isset($modules[$a_modules_identifier])) {
            $is_allowed = 1;
        }
        return $is_allowed;
    }


    /**
     * Get multibytes string length
     *
     * @param  string $str multibytes string
     * @return int      string length
     */
    protected function __mbLen($str)
    {
        return (int) mb_strlen($str, mb_detect_encoding($str));
    }

    /**
     * Convert string to utf-8 friendly for json encode
     *
     * @todo will move into a library
     *
     * @param  string $str String
     * @return string      Converted mismatched UTF-8 string into proper UTF-8 String
     */
    protected function __dconv($str)
    {
        $str = utf8_encode(trim($str));
        $enc = mb_detect_encoding($str, 'UTF-8');
        if ($enc == 'UTF-8') {
            $str = iconv($enc, 'ISO-8859-1//IGNORE', $str);
        } else {
            $str = iconv($enc, 'ASCII//IGNORE', $str);
        }
        return $str;
    }

    /**
     * Forced download file from a Full qualified filename
     *
     * @param  string $pathFile     Full qualified filename with is path
     * @return string $filename     Overriden filename
     *
     * @return void
     */
    protected function __forceDownload($pathFile, $filename="")
    {
        if (strlen($filename)<=0) {
            $filename = basename($pathFile);
        }
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($pathFile));
        ob_clean();
        flush();
        readfile($pathFile);
        exit;
    }

    /**
     * Check and Create directory for report temp
     *
     * @param  string $periode    string with year/month format
     * @param  string $media_path Default media_path location
     *
     * @return string                 Return media path with current periode
     */
    protected function __checkDir($periode, $media_path="media/laporan/")
    {
        if (!is_dir(SEMEROOT.'media/')) {
            mkdir(SEMEROOT.'media/', 0777);
        }
        if (!is_dir(SEMEROOT.$media_path)) {
            mkdir(SEMEROOT.$media_path, 0777);
        }
        $str = $periode.'/01';
        $periode_y = date("Y", strtotime($str));
        $periode_m = date("m", strtotime($str));
        if (!is_dir(SEMEROOT.$media_path.$periode_y)) {
            mkdir(SEMEROOT.$media_path.$periode_y, 0777);
        }
        if (!is_dir(SEMEROOT.$media_path.$periode_y.'/'.$periode_m)) {
            mkdir(SEMEROOT.$media_path.$periode_y.'/'.$periode_m, 0777);
        }
        return SEMEROOT.$media_path.$periode_y.'/'.$periode_m;
    }

    /**
     * Convert string to url friendly
     *
     * @param  string $s String
     * @return string       slug
     */
    protected function slugify($s)
    {
        // replace non letter or digits by -
        $s = preg_replace('~[^\pL\d]+~u', '-', $s);
        // transliterate
        $s = iconv('utf-8', 'us-ascii//TRANSLIT', $s);
        // remove unwanted characters
        $s = preg_replace('~[^-\w]+~', '', $s);
        // trim
        $s = trim($s, '-');
        // remove duplicate -
        $s = preg_replace('~-+~', '-', $s);
        // lowercase
        $s = strtolower($s);
        return $s;
    }

    /**
     * Get status text for status_progress on e_item_pekerjaan table
     *
     * @param  string $sp short text
     * @return string     Full text
     */
    protected function __spTeks($sp)
    {
        $sp = strtoupper($sp);
        if ($sp == "P") {
            return "Plan";
        } elseif ($sp == "C") {
            return "Code";
        } elseif ($sp == "B") {
            return "Build";
        } elseif ($sp == "T") {
            return "Test";
        } elseif ($sp == "D") {
            return "Deploy";
        } elseif ($sp == "O") {
            return "Operate";
        } elseif ($sp == "M") {
            return "Monitor";
        } else {
            return "Unknown";
        }
    }

    /**
     * Get status text for status_fitur on e_item_pekerjaan table
     *
     * @param  string $sp short text
     * @return string     Full text
     */
    protected function __sfTeks($sp)
    {
        $sp = strtoupper($sp);
        if ($sp == "NF") {
            return "New Feature";
        } elseif ($sp == "CR") {
            return "Change Request";
        } elseif ($sp == "EN") {
            return "Enhancement";
        } else {
            return "Unknown";
        }
    }

    protected function fitur_status_teks($status_teks)
    {
        switch (strtoupper($status_teks)) {
            case 'P':
                return "Plan";
                break;
            case 'C':
                return "Code";
                break;
            case 'B':
                return "Build";
                break;
            case 'T':
                return "Test";
                break;
            case 'D':
                return "Deploy";
                break;
            case 'O':
                return "Operate";
                break;
            case 'M':
                return "Monitor";
                break;
            default:
                return "unknown";
        }
    }

    protected function fitur_status_teks_color($status_teks)
    {
        switch (strtoupper($status_teks)) {
            case 'C':
                return "#2ab369";
                break;
            case 'B':
                return "#2ab369";
                break;
            case 'T':
                return "#2ab369";
                break;
            case 'D':
                return "#2ab369";
                break;
            case 'O':
                return "#2ab369";
                break;
            case 'M':
                return "#2ab369";
                break;
            default:
                return "#ededed";
        }
    }

    /**
     * return value that existed in an object
     *  otherwise, return default value '-'
     * @return void
     */
    public function _rv($key, $value, $default_value='-')
    {
        return isset($key->{$value}) ? $key->{$value} : $default_value;
    }

    protected function _api_auth_required($data = null, $pov='admin', $utype='session')
    {
        if ($utype == 'session' && !$this->{$pov.'_login'}) {
            $this->status = 400;
            $this->message = API_ADMIN_ERROR_CODES[$this->status];
            header("HTTP/1.0 $this->status $this->message");
            $this->__json_out($data);
            die();
        } else if ($utype == 'api') {

        }
    }

    /**
     * Abstract layer for bootstraping class or onboarding class
     *   this is *required*
     *
     * @return mixed server respose output
     */
    public function index()
    {
    }
}
