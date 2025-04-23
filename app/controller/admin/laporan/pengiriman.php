<?php
//loading library
$vendorDirPath = (SEMEROOT . 'kero/lib/phpoffice/vendor/');
$vendorDirPath = realpath($vendorDirPath);


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * Controller untuk Pengiriman
 *
 * @version 1.0.0
 *
 * @package Laporan\Admin
 * @since 1.0.0
 */
class Pengiriman extends \JI_Controller
{
    public $use_cache = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setTheme('admin');
        $this->current_parent = 'laporan';
        $this->current_page = 'laporan_pengiriman';
        $this->load('admin/c_arrival_model', 'cam');
        $this->load('admin/c_departure_model', 'crm');
        $this->load('admin/b_driver_model', 'bdm');
        $this->load('admin/d_kirim_model', 'dkm');
        $this->load('a_vehicle_concern');
        $this->load('admin/a_vehicle_model', 'avm');
        $this->load('admin/c_muatan_model', 'cmm');
        $this->load('admin/d_pengiriman_model', 'dpm');
    }

    public function index()
    {
        $data = $this->__init();
        if (!$this->admin_login) {
            redir(base_url_admin('login'));
            die();
        }

        $this->setTitle('Laporan: Pengiriman ' . $this->config->semevar->admin_site_suffix);
        $this->putThemeContent("laporan/pengiriman/home_modal", $data);
        $this->putThemeContent("laporan/pengiriman/home", $data);
        $this->putJsContent("laporan/pengiriman/home_bottom", $data);
        $this->loadLayout('col-2-left', $data);
        $this->render();
    }

    public function download_xls()
    {
        $data = $this->__init();
        if (!$this->admin_login) {
            redir(base_url_admin('login'));
            die();
        }

        $beli_mindate = $this->input->request('mindate');
        $beli_maxdate = $this->input->request('maxdate');

        if (strlen($beli_mindate) != 10 || strlen($beli_maxdate) != 10) {
            echo 'Rentang waktu tanggal wajib diisi';
            die();
        }

        $beli_mindate = date("Y-m-d", strtotime($beli_mindate));
        $beli_maxdate = date("Y-m-d", strtotime($beli_maxdate));

        // Prepare date range
        $tgl_save = str_replace('-', '', $beli_mindate) . '-' . str_replace('-', '', $beli_maxdate);
        $tgl = 'Periode: ' . $this->__dateIndonesia($beli_mindate, 'tanggal') . ' - ' . $this->__dateIndonesia($beli_maxdate, 'tanggal');

        //filename builder
        $save_dir = $this->__checkDir(date("Y/m", strtotime($beli_maxdate)));
        $save_file = 'laporan-pengiriman-barang' . '-' . $tgl_save;
        $save_file = str_replace(' ', '', str_replace('/', '', strtolower($save_file)));

        //preset array gaya kolom
        
        $styleborder = array(
            'borders' => array(
                'outline' => array(
                    
                )
            )
        );
        $judul_utama_sty = array(
            'font'  => array(
                'bold'  => true,
                'size'  => 12,
                'name'  => 'Arial'
            ),
            
        );
        $judul_bold = array(
            'font'  => array(
                'bold'  => true
            ),
            'borders' => array(
                'outline' => array(
                    
                )
            ),
            
        );

        //create object xls
        
        

            
            
        //set baris secara programming
        $i = 6;
        $nomor = 1;

        $kirim = $this->dkm->getKirimXls($beli_mindate, $beli_maxdate);

        //cek data ada ga nya
        if (count($kirim)) {
            //iterasikan data
            foreach ($kirim as $row) {
                
                

                //set border ke masing2 kolom
                

                $i++;
                $nomor++;
            }
        } else {
           
        }

        
        if (file_exists($save_dir . '/' . $save_file . '.xlsx')) {
            unlink($save_dir . '/' . $save_file . '.xlsx');
        }
        

        $this->__forceDownload($save_dir . '/' . $save_file . '.xlsx');
    }
}