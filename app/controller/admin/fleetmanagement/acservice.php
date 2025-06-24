<?php

namespace Controller\Admin;

register_namespace(__NAMESPACE__);
$vendorDirPath = (SEMEROOT.'kero/lib/phpoffice/vendor/');
$vendorDirPath = realpath($vendorDirPath);
require_once $vendorDirPath.'/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
/**
* Admin scoped controller for jabatan item kpi
*
* Mostly for this controller will resulting HTTP Body Content in HTML format
*
* @version 1.0.0
*
* @package FleetManagement\jenismerkkendaraan\Admin
* @since 1.0.0
*/
class Acservice extends \JI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->setTheme('admin');
    $this->lib('seme_purifier');
    $this->load('c_acservice_concern');
    $this->load('admin/c_acservice_model', 'cam');
    $this->current_parent = 'fleetanagement';
    $this->current_page = 'fleetanagement_acservice';
  }

  public function index()
  {
    $data = $this->__init();
    if (!$this->admin_login) {
      redir(base_url_admin('login'));
      die();
    }

    $this->setTitle('Fleet Management: Pemeliharaan Dan Service '.$this->config->semevar->admin_site_suffix);
    $this->putThemeContent('fleetmanagement/acservice/home_modal', $data);
    $this->putThemeContent('fleetmanagement/acservice/home', $data);
    $this->putJsContent('fleetmanagement/acservice/home_bottom', $data);
    $this->loadLayout('col-2-left', $data);
    $this->render();
  }

  public function baru()
  {
    $data = $this->__init();
    if(!$this->admin_login){
      redir(base_url_admin('login'));
      die();
    }
    $pengguna = $data['sess']->admin;

    $this->setTitle('Fleet Management: Pemeliharaan Dan Service: Baru '.$this->config->semevar->admin_site_suffix);
    $this->putThemeContent("fleetmanagement/acservice/tambah_modal",$data);
    $this->putThemeContent("fleetmanagement/acservice/tambah",$data);
    $this->putJsContent("fleetmanagement/acservice/tambah_bottom",$data);
    $this->loadLayout('col-2-left',$data);
    $this->render();
  }

  public function edit($id)
  {
    $data = $this->__init();
    if(!$this->admin_login){
      redir(base_url_admin('login'));
      die();
    }

    $id = intval($id);
    if($id<=0){
      redir(base_url_admin('fleetmanagement/acservice/'));
      die();
    }

    $cam = $this->cam->id($id);
    if(!isset($cam->id)){
      redir(base_url_admin('fleetmanagement/acservice/'));
      die();
    }

    $pengguna = $data['sess']->admin;

    $this->setTitle('Fleet Management: Pemeliharaan Dan Service: Edit #'.$cam->id.' '.$this->config->semevar->admin_site_suffix);

    $data['cam'] = $cam;
    unset($cam);

    $this->putThemeContent("fleetmanagement/acservice/edit_modal",$data);
    $this->putThemeContent("fleetmanagement/acservice/edit",$data);
    $this->putJsContent("fleetmanagement/acservice/edit_bottom",$data);
    $this->loadLayout('col-2-left',$data);
    $this->render();
  }

  public function detail($id)
  {
    $data = $this->__init();
    if(!$this->admin_login){
      redir(base_url_admin('login'));
      die();
    }
    $id = (int) $id;
    if($id<=0){
      redir(base_url_admin('fleetmanagement/acservice/'));
      die();
    }
    $cam = $this->cam->id($id);
    if(!isset($cam->id)){
      redir(base_url_admin('fleetmanagement/acservice/'));
      die();
    }
    $this->setTitle('Fleet Management: Pemeliharaan Dan Service: Detail #'.$cam->id.' '.$this->config->semevar->admin_site_suffix);



    $data['cam'] = $cam;
    $data['cam']->parent = $this->cam->id($cam->id);
    // unset($acm);

    $this->putThemeContent("fleetmanagement/acservice/detail",$data);
    $this->putJsContent("fleetmanagement/acservice/detail_bottom",$data);
    $this->loadLayout('col-2-left',$data);
    $this->render();
  }
  public function download_xls()
  {
    $data = $this->__init();
    if (!$this->admin_login) {
      redir(base_url('login'));
      die();
    }

    $beli_mindate = $this->input->request('mindate');
    $beli_maxdate = $this->input->request('maxdate');
    $is_proses = $this->input->request('is_proses');

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
    $style = array('horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $styleborder = array(
      'borders' => array(
        'outline' => array(
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
        )
      )
    );
    $judul_utama_sty = array(
      'font'  => array(
        'bold'  => true,
        'size'  => 12,
        'name'  => 'Arial'
      ),
      'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
    );
    $judul_bold = array(
      'font'  => array(
        'bold'  => true
      ),
      'borders' => array(
        'outline' => array(
          'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
        )
      ),
      'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
    );

    //create object xls
    $objPHPExcel = new Spreadsheet();
    $objWorkSheet = $objPHPExcel->setActiveSheetIndex(0);

    //pengaturan lebar kolom
    $objWorkSheet->getColumnDimension('A')->setWidth(5);
    $objWorkSheet->getColumnDimension('B')->setWidth(20);
    $objWorkSheet->getColumnDimension('C')->setWidth(30);
    $objWorkSheet->getColumnDimension('D')->setWidth(25);
    $objWorkSheet->getColumnDimension('E')->setWidth(25);
    $objWorkSheet->getColumnDimension('F')->setWidth(50);
    $objWorkSheet->getColumnDimension('G')->setWidth(35);
    $objWorkSheet->getColumnDimension('H')->setWidth(25);
    $objWorkSheet->getColumnDimension('I')->setWidth(25);
    $objWorkSheet->getColumnDimension('J')->setWidth(25);
    $objWorkSheet->getColumnDimension('K')->setWidth(25);


    //building xlsx
    $objWorkSheet->setCellValue('A1', strtoupper('Laporan Service Ac'))->mergeCells('A1:K1');
    $objWorkSheet->getStyle('A1')->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('A1:K1')->applyFromArray($judul_utama_sty);

    $objWorkSheet->setCellValue('A2', $tgl)->mergeCells('A2:K2');
    $objWorkSheet->getStyle('A2')->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('A2:K2')->applyFromArray($style);

    //header
    $objWorkSheet
    ->setCellValue('A10', 'No.')
    ->setCellValue('B10', 'Tanggal')
    ->setCellValue('C10', 'Nama')
    ->setCellValue('D10', 'Remot Kode')
    ->setCellValue('E10', 'No Hp');

    //setting gaya untuk header
    $objWorkSheet->getStyle('A10')->applyFromArray($judul_bold)->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('B10')->applyFromArray($judul_bold)->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('C10')->applyFromArray($judul_bold)->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('D10')->applyFromArray($judul_bold)->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('E10')->applyFromArray($judul_bold)->getAlignment()->applyFromArray($style);

    //set baris secara programming
    $i = 11;
    $nomor = 1;

    $laporan_data = $this->cam->laporan_xls($beli_mindate, $beli_maxdate, $is_proses);
    //cek data ada ga nya
    if (count($laporan_data)) {
      //iterasikan data
      foreach ($laporan_data as $row) {
        $objWorkSheet->setCellValue('A' . $i, $nomor);
        $objWorkSheet->setCellValue('B' . $i, $row->tanggal_perbaikan);
        $objWorkSheet->setCellValue('C' . $i, $row->pelanggan_nama);
        $objWorkSheet->setCellValue('D' . $i, $row->remot_kode);
        $objWorkSheet->setCellValue('E' . $i, $row->telp);

        //set border ke masing2 kolom
        $objWorkSheet->getStyle('A' . $i)->applyFromArray($styleborder);
        $objWorkSheet->getStyle('B' . $i)->applyFromArray($styleborder);
        $objWorkSheet->getStyle('C' . $i)->applyFromArray($styleborder);
        $objWorkSheet->getStyle('D' . $i)->applyFromArray($styleborder);
        $objWorkSheet->getStyle('E' . $i)->applyFromArray($styleborder);

        $i++;
        $nomor++;
      }
    } else {
      $objWorkSheet->setCellValue('A' . $i, 'Tidak ada data')->mergeCells('A' . $i . ':K' . $i);
      $objWorkSheet->getStyle('A' . $i . ':K' . $i)->applyFromArray($styleborder);
    }

    $objWriter = new Xlsx($objPHPExcel);
    if (file_exists($save_dir . '/' . $save_file . '.xlsx')) {
      unlink($save_dir . '/' . $save_file . '.xlsx');
    }
    $objWriter->save($save_dir . '/' . $save_file . '.xlsx');

    $this->__forceDownload($save_dir . '/' . $save_file . '.xlsx');
  }
}
