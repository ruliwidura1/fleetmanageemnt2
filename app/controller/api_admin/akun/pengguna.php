<?php
/**
* API Controller for `api_admin/akun/pengguna`
*
* @version 1.0.0
*
* @package Pengguna\Admin\Api
* @since 1.0.0
*/
class Pengguna extends JI_Controller
{
    public $media_pengguna = 'media/pengguna';

    /**
     * Constructor class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load('a_pengguna_concern');
        $this->load("api_admin/a_pengguna_model", 'apm');
    }

    private function __uploadFoto($admin_id)
    {
        //building path target
        $fldr = $this->media_pengguna;
        $folder = SEMEROOT.DIRECTORY_SEPARATOR.$fldr.DIRECTORY_SEPARATOR;
        $folder = str_replace('\\', '/', $folder);
        $folder = str_replace('//', '/', $folder);
        $ifol = realpath($folder);

        //check folder
        if(!$ifol) { mkdir($folder); //create folder
        }
        $ifol = realpath($folder); //get current realpath

        reset($_FILES);
        $temp = current($_FILES);
        if (is_uploaded_file($temp['tmp_name'])) {
            if (isset($_SERVER['HTTP_ORIGIN'])) {
                // same-origin requests won't set an origin. If the origin is set, it must be valid.
                header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
            }
            header('Access-Control-Allow-Credentials: true');
            header('P3P: CP="There is no P3P policy."');

            // Sanitize input
            if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                header("HTTP/1.0 500 Invalid file name.");
                return 0;
            }
            // Verify extension
            $ext = strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, array("gif", "jpg", "png"))) {
                header("HTTP/1.0 500 Invalid extension.");
                return 0;
            }
            if(mime_content_type($temp['tmp_name']) == 'image/webp') {
                header("HTTP/1.0 500 WebP unsupported.");
                $this->status = 1958;
                $this->message = 'Format gambar WebP saat ini tidak didukung pada sistem ini';
                
                die();
            }

            // Create magento style media directory
            $temp['name'] = md5($admin_id).date('is').'.'.$ext;
            $name  = $temp['name'];
            $name1 = date("Y");
            $name2 = date("m");

            //building directory structure
            if(PHP_OS == "WINNT") {
                if(!is_dir($ifol)) { mkdir($ifol);
                }
                $ifol = $ifol.DIRECTORY_SEPARATOR.$name1.DIRECTORY_SEPARATOR;
                if(!is_dir($ifol)) { mkdir($ifol);
                }
                $ifol = $ifol.DIRECTORY_SEPARATOR.$name2.DIRECTORY_SEPARATOR;
                if(!is_dir($ifol)) { mkdir($ifol);
                }
            }else{
                if(!is_dir($ifol)) { mkdir($ifol, 0775);
                }
                $ifol = $ifol.DIRECTORY_SEPARATOR.$name1.DIRECTORY_SEPARATOR;
                if(!is_dir($ifol)) { mkdir($ifol, 0775);
                }
                $ifol = $ifol.DIRECTORY_SEPARATOR.$name2.DIRECTORY_SEPARATOR;
                if(!is_dir($ifol)) { mkdir($ifol, 0775);
                }
            }

            // Accept upload if there was no origin, or if it is an accepted origin

            $filetowrite = $ifol . $temp['name'];

            if(file_exists($filetowrite)) { unlink($filetowrite);
            }
            move_uploaded_file($temp['tmp_name'], $filetowrite);
            if(file_exists($filetowrite)) {
                $this->lib("wideimage/WideImage", 'wideimage', "inc");
                WideImage::load($filetowrite)->resize(320)->saveToFile($filetowrite);
                return $fldr."/".$name1."/".$name2."/".$name;
            }else{
                return 0;
            }
        } else {
            // Notify editor that the upload failed
            //header("HTTP/1.0 500 Server Error");
            return 0;
        }
    }

    /**
     * Get list of data pengguna
     *
     * ```
     * GET api_admin/akun/pengguna/
     * ```
     *
     * @api
     *
     * @return void JSON in datatable format
     */
    public function index()
    {
        $d = $this->__init();
        $data = array();
        if(!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Diperlukan otorisasi';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }

        $draw = $this->input->post("draw");
        $sval = $this->input->post("search");
        $sSearch = $this->input->post("sSearch");
        $sEcho = $this->input->post("sEcho");
        $page = $this->input->post("iDisplayStart");
        $pagesize = $this->input->post("iDisplayLength");

        $iSortCol_0 = $this->input->post("iSortCol_0");
        $sSortDir_0 = $this->input->post("sSortDir_0");

        $sortCol = "date";
        $sortDir = strtoupper($sSortDir_0);
        if(empty($sortDir)) { $sortDir = "DESC";
        }
        if(strtolower($sortDir) != "desc") {
            $sortDir = "ASC";
        }

        switch($iSortCol_0){
        case 0:
            $sortCol = "id";
            break;
        case 1:
            $sortCol = "foto";
            break;
        case 2:
            $sortCol = "email";
            break;
        case 3:
            $sortCol = "username";
            break;
        case 4:
            $sortCol = "is_active";
            break;
        default:
            $sortCol = "id";
        }

        if(empty($draw)) { $draw = 0;
        }
        if(empty($pagesize)) { $pagesize=10;
        }
        if(empty($page)) { $page=0;
        }

        $keyword = $sSearch;

        //advanced filter
        $is_active = $this->input->post("is_active");
        if($is_active == "1") {
        }else if($is_active == "0") {
        }else{
            $is_active = "";
        }

        $this->status = 200;
        $this->message = 'Success';
        $jenis_count = $this->apm->countAll($keyword, $is_active);
        $jenis_data = $this->apm->getAll($page, $pagesize, $sortCol, $sortDir, $keyword, $is_active);

        foreach($jenis_data as &$gd){
            if(isset($gd->foto)) {
                if(!empty($gd->foto)) {
                    $gd->foto = '<img src='.base_url($gd->foto).' class="img-responsive" style="max-width: 128px;" onerror="this.null;this.src=\'http://localhost/cenah/erp/media/user-default.png\';" />';
                }else{
                    $gd->foto = '<img src='.base_url('media/user-default.png').' class="img-responsive" style="max-width: 128px;" />';
                }
            }
            if(isset($gd->is_active)) {
                if(!empty($gd->is_active)) {
                    $gd->is_active = '<label class="label label-success">Aktif</label>';
                }else{
                    $gd->is_active = '<label class="label label-default">Tidak Aktif</label>';
                }
            }
        }
        //sleep(3);
        $another = array();
        $this->__jsonDataTable($jenis_data, $jenis_count);
    }
    public function get_data()
    {
        $d = $this->__init();
        $data = array();
        if(!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Diperlukan otorisasi';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }

        $draw = $this->input->post("draw");
        $sval = $this->input->post("search");
        $sSearch = $this->input->post("sSearch");
        $sEcho = $this->input->post("sEcho");
        $page = $this->input->post("iDisplayStart");
        $pagesize = $this->input->post("iDisplayLength");

        $iSortCol_0 = $this->input->post("iSortCol_0");
        $sSortDir_0 = $this->input->post("sSortDir_0");


        $sortCol = "date";
        $sortDir = strtoupper($sSortDir_0);
        if(empty($sortDir)) { $sortDir = "DESC";
        }
        if(strtolower($sortDir) != "desc") {
            $sortDir = "ASC";
        }

        switch($iSortCol_0){
        case 0:
            $sortCol = "id";
            break;
        case 1:
            $sortCol = "foto";
            break;
        case 2:
            $sortCol = "email";
            break;
        case 3:
            $sortCol = "username";
            break;
        case 4:
            $sortCol = "is_active";
            break;
        default:
            $sortCol = "id";
        }

        if(empty($draw)) { $draw = 0;
        }
        if(empty($pagesize)) { $pagesize=10;
        }
        if(empty($page)) { $page=0;
        }

        $keyword = $sSearch;

        //advanced filter
        $is_active = "1";

        $this->status = 200;
        $this->message = 'Success';
        $jenis_count = $this->apm->countAll($keyword, $is_active);
        $jenis_data = $this->apm->getAll($page, $pagesize, $sortCol, $sortDir, $keyword, $is_active);

        foreach($jenis_data as &$gd){
            if(isset($gd->foto)) {
                if(!empty($gd->foto)) {
                    $gd->foto = '<img src='.base_url($gd->foto).' class="img-responsive" style="max-width: 128px;" />';
                }else{
                    $gd->foto = '<img src='.base_url('media/user-default.png').' class="img-responsive" style="max-width: 128px;" />';
                }
            }
            if(isset($gd->is_active)) {
                if(!empty($gd->is_active)) {
                    $gd->is_active = 'Active';
                }else{
                    $gd->is_active = 'Inactive';
                }
            }
        }
        $data['pengguna'] = $jenis_data;
        //sleep(3);
        $another = array();
        $this->__json_out($data);
    }
    public function tambah()
    {
        $d = $this->__init();
        $data = array();
        if(!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Diperlukan otorisasi';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }
        $di = $_POST;
        $pengguna = $d['sess']->admin;
        if(!isset($di['username'])) { $di['username'] = "";
        }
        if(!isset($di['email'])) { $di['email'] = "";
        }
        if(strlen($di['email'])>1  && strlen($di['username'])>1) {
            $check = $this->apm->checkusername($di['username']); //1 = sudah digunakan
            if(empty($check)) {
                if(isset($di['password'])) { $di['password'] = md5($di['password']);
                }
                $di['id'] = $this->apm->getLastId();
                $res = $this->apm->set($di);
                if($res) {
                    $last_pengguna_id = $di['id'];
                    $this->status = 200;
                    $this->message = 'Success';
                    $penguna_foto = $this->__uploadFoto($last_pengguna_id);
                    if(strlen($penguna_foto)>4) {
                        $du = array();
                        $du['foto'] = $penguna_foto;
                        $this->apm->update($last_pengguna_id, $du);
                        $this->message .= ', Profil berhasil di upload';
                    }
                }else{
                    $this->status = 900;
                    $this->message = 'Tidak dapat menambahkan data, silakan coba lagi nanti';
                }
            }else{
                $this->status = 104;
                $this->message = 'Nama pengguna sudah digunakan, silakan pilih nama pengguna lain';
            }
        }
        $this->__json_out($data);
    }

    public function detail($id)
    {
        $id = (int) $id;
        $d = $this->__init();
        $data = array();
        if(!$this->admin_login && empty($id)) {
            $this->status = 400;
            $this->message = 'Diperlukan otorisasi';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }
        $pengguna = $d['sess']->admin;

        $this->status = 200;
        $this->message = 'Success';
        $data = $this->apm->id($id);
        $this->__json_out($data);
    }

    public function edit($id)
    {
        $d = $this->__init();
        $data = array();
        if(!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Diperlukan otorisasi';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }
        $pengguna = $d['sess']->admin;
        $du = $_POST;
        if(!isset($du['id'])) { $du['id'] = 0;
        }
        $id = (int) $du['id'];
        unset($du['id']);
        if($id>0) {
            $check = 0;
            if(isset($du['username'])) {
                $check = $this->apm->checkusername($du['username'], $id); //1 = sudah digunakan
            }
            if(empty($check)) {
                $res = $this->apm->update($id, $du);
                if($res) {
                    $this->status = 200;
                    $this->message = 'Perubahan berhasil diterapkan';
                }else{
                    $this->status = 901;
                    $this->message = 'Gagal saat memperbarui data, silakan coba lagi nanti';
                }
            }else{
                $this->status = 104;
                $this->message = 'Nama pengguna sudah diambil, silakan coba nama pengguna lain';
            }
        }else{
            $this->status = 448;
            $this->message = 'ID not found';
        }
        $this->__json_out($data);
    }

    public function editpass()
    {
        $d = $this->__init();
        $data = array();
        if(!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Diperlukan otorisasi';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }
        $id = (int) $this->input->post("id");
        if($id<=0) {
            $this->status = 598;
            $this->message = 'Invalid PenggunaID';
            $this->__json_out($data);
            die();
        }
        $du = array();
        $du['password'] = $this->input->post("password");
        if(strlen($du['password'])) {
            $du['password'] = md5($du['password']);
            $res = $this->apm->update($id, $du);
            $this->status = 200;
            $this->message = 'Perubahan berhasil diterapkan';
        }else{
            $this->status = 901;
            $this->message = 'Password terlalu pendek';
        }
        $this->__json_out($data);
    }

    public function hapus($id)
    {
        $id = (int) $id;
        $d = $this->__init();
        $data = array();
        if(!$this->admin_login && empty($id)) {
            $this->status = 401;
            $this->message = 'Akses ditolak';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }

        $this->status = 200;
        $this->message = 'Success';
        $res = $this->apm->del($id);
        if(!$res) {
            $this->status = 902;
            $this->message = 'Gagal menghapus data dari basis data';
        }
        $this->__json_out($data);
    }

    public function edit_foto()
    {
        $d = $this->__init();
        $data = array();
        if(!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Diperlukan otorisasi';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }

        $id = (int) $this->input->post("id");
        if($id<=0) {
            $this->status = 598;
            $this->message = 'Invalid PenggunaID';
            $this->__json_out($data);
            die();
        }

        $pengguna = $this->apm->id($id);
        if($id>0 && isset($pengguna->id) ) {
            if(isset($_FILES['foto']['tmp_name'])) {
                if(mime_content_type($_FILES['foto']['tmp_name']) == 'image/webp') {
                    $this->status = 1958;
                    $this->message = 'Format gambar WebP saat ini tidak didukung pada sistem ini';
                    $this->__json_out($data);
                    die();
                }
            }
            $penguna_foto = $this->__uploadFoto($pengguna->id);
            if(!empty($penguna_foto)) {
                if(strlen($pengguna->foto)>4) {
                    $foto = SEMEROOT.DIRECTORY_SEPARATOR.$pengguna->foto;
                    if(file_exists($foto)) { unlink($foto);
                    }
                }
                $du = array();
                $du['foto'] = $penguna_foto;
                $res = $this->apm->update($id, $du);
                if($res) {
                    $this->status = 200;
                    $this->message = 'Profil berhasil diunggah';
                    if(($d['sess']->admin->id == $pengguna->id)) { $d['sess']->admin->foto = $penguna_foto;
                    }
                }else{
                    $this->status = 901;
                    $this->message = 'Gagal mengunggah profil';
                }
            }else{
                $this->status = 459;
                $this->message = 'Gagal mengunggah profil';
            }
        }else{
            $this->status = 550;
            $this->message = 'Dont hack this :P';
        }
        $this->__json_out($data);
    }

    //Temporary Select2 di Pengguna API
    public function select2()
    {
        $data = array();
        $d = $this->__init();
        if (!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Diperlukan otorisasi';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }

        $this->load("api_admin/b_user_model", 'bum');
        $d = $this->__init();
        $keyword = $this->input->request('q');
        $ddata = $this->bum->select2($keyword);
        $datares = array();
        $i = 0;
        foreach ($ddata as $key => $value) {
            $datares["results"][$i++] = array("id"=>$value->id,"text"=>$value->kode." - ".$value->fnama);
        }
        header('Content-Type: application/json');
        echo json_encode($datares);
    }

    public function hak_akses()
    {
        $d = $this->__init();
        $data = array();
        if (!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Diperlukan otorisasi';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }
        $pengguna = $d['sess']->admin;

        $this->load('api_admin/a_pengguna_module_model', 'apmm');

        //collect input
        $a_pengguna_id = (int) $this->input->post("a_pengguna_id");
        if($a_pengguna_id<=0) {
            $this->status = 520;
            $this->message = 'Invalid Pengguna ID';
            $this->__json_out($data);
            die();
        }

        $pengguna = $this->apm->id($a_pengguna_id);
        if(!isset($pengguna->id)) {
            $this->status = 521;
            $this->message = 'Pengguna ID not found';
            $this->__json_out($data);
            die();
        }

        $a_modules_identifier    = $this->input->post("a_modules_identifier");

        //open transaction
        $this->apmm->trans_start();

        //set all modules to tmp_active = N
        $this->apmm->updateModule(array('tmp_active' => 'N'),  $a_pengguna_id);
        $this->apmm->trans_commit();
        $this->apmm->delModule($pengguna->id);
        $this->apmm->trans_commit();

        //loop for another modules
        if(is_array($a_modules_identifier) && count($a_modules_identifier)) {
            foreach ($a_modules_identifier as $ami){
                $du = array();
                $du['a_pengguna_id'] = $a_pengguna_id;
                $du['a_modules_identifier'] = $ami;
                $du['rule'] = 'allowed';
                $du['tmp_active'] = 'Y';
                $check_ami = $this->apmm->check_access($a_pengguna_id, $ami);
                if ($check_ami == 0) {
                    //doing insert and obtain new ID
                    $di = $du;
                    $di['id'] = (int) $this->apmm->getLastId();
                    $this->apmm->set($di);
                    $this->apmm->trans_commit();
                }else{
                    //update ONLY!
                    $this->apmm->updateModule($du, $a_pengguna_id, $ami);
                    $this->apmm->trans_commit();
                }
            }
        }

        //deleting last modules where is TMP=N
        $res = $this->apmm->delModule($a_pengguna_id);
        if ($res) {
            $this->apmm->trans_commit();
            $this->status     = 200;
            $this->message     = 'Pembaruan hak akses berhasli. Silakan lakukan logout dan login untuk menerapkan perubahan.';
        } else {
            $this->apmm->trans_rollback();
            $this->status     = 901;
            $this->message     = 'Tidak dapat memperbarui hak administrator, silakan coba lagi';
        }
        $this->apmm->trans_end();
        $this->__json_out($data);
    }
    public function pengguna_module($id)
    {
        $data = array();
        $d = $this->__init();
        if (!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Diperlukan otorisasi';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }

        $id = (int) $id;
        $this->load('api_admin/a_pengguna_module_model', 'apmm');
        $d             = $this->__init();
        $ddata         = $this->apmm->pengguna_module($id);
        $datares     = array();
        $i             = 0;
        foreach ($ddata as $key => $value){
            $datares[$i++] = $value->a_modules_identifier;
        }
        header('Content-Type: application/json');
        echo json_encode($datares);
    }
    public function foto_reset($id)
    {
        $d = $this->__init();
        $data = array();
        if (!$this->admin_login) {
            $this->status = 400;
            $this->message = 'Diperlukan otorisasi';
            header("HTTP/1.0 400 Harus login");
            $this->__json_out($data);
            die();
        }
        $pengguna = $d['sess']->admin;
        $id = (int) $id;
        if($id<=0) {
            $this->status = 520;
            $this->message = 'Invalid Pengguna ID';
            $this->__json_out($data);
            die();
        }

        $pengguna = $this->apm->id($id);
        if(!isset($pengguna->id)) {
            $this->status = 521;
            $this->message = 'Pengguna ID tidak ditemukan';
            $this->__json_out($data);
            die();
        }

        //reset session profile picture
        if(($d['sess']->admin->id == $pengguna->id)) { $d['sess']->admin->foto = 'media/user-default.png';
        }

        $this->setKey($d['sess']);
        $du = array("foto"=>'');
        $this->apm->update($id, $du);
        $this->status = 200;
        $this->message = 'Success';
        $this->__json_out($data);
    }
}