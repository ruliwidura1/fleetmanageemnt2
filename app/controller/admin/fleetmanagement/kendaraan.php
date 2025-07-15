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
class Kendaraan extends \JI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->setTheme('admin');
    $this->lib('seme_purifier');
    $this->load('a_vehicle_concern');
    $this->load('admin/a_vehicle_model', 'avm');
    $this->current_parent = 'fleetanagement';
    $this->current_page = 'fleetanagement_kendaraan';
  }

  public function index()
  {
    $data = $this->__init();
    if (!$this->admin_login) {
      redir(base_url_admin('login'));
      die();
    }

    $this->setTitle('Fleet Management: Pemeliharaan Dan Service '.$this->config->semevar->admin_site_suffix);
    $this->putThemeContent('fleetmanagement/kendaraan/home_modal', $data);
    $this->putThemeContent('fleetmanagement/kendaraan/home', $data);
    $this->putJsContent('fleetmanagement/kendaraan/home_bottom', $data);
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
    $this->putThemeContent("fleetmanagement/kendaraan/tambah_modal",$data);
    $this->putThemeContent("fleetmanagement/kendaraan/tambah",$data);
    $this->putJsContent("fleetmanagement/kendaraan/tambah_bottom",$data);
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
      redir(base_url_admin('fleetmanagement/kendaraan/'));
      die();
    }

    $avm = $this->avm->id($id);
    if(!isset($avm->id)){
      redir(base_url_admin('fleetmanagement/kendaraan/'));
      die();
    }

    $pengguna = $data['sess']->admin;

    $this->setTitle('Fleet Management: Pemeliharaan Dan Service: Edit #'.$avm->id.' '.$this->config->semevar->admin_site_suffix);

    $data['avm'] = $avm;
    unset($avm);

    $this->putThemeContent("fleetmanagement/kendaraan/edit_modal",$data);
    $this->putThemeContent("fleetmanagement/kendaraan/edit",$data);
    $this->putJsContent("fleetmanagement/kendaraan/edit_bottom",$data);
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
      redir(base_url_admin('fleetmanagement/kendaraan/'));
      die();
    }
    $avm = $this->avm->id($id);
    if(!isset($avm->id)){
      redir(base_url_admin('fleetmanagement/kendaraan/'));
      die();
    }
    $this->setTitle('Fleet Management: data Kendaraan: Detail #'.$avm->id.' '.$this->config->semevar->admin_site_suffix);



    $data['avm'] = $avm;
    $data['avm']->parent = $this->avm->id($avm->id);
    // unset($acm);

    $this->putThemeContent("fleetmanagement/kendaraan/detail",$data);
    $this->putJsContent("fleetmanagement/kendaraan/detail_bottom",$data);
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

    $created_at_from = $this->input->request('created_at_from');
    $created_at_to = $this->input->request('created_at_to');
    $is_active = $this->input->request('is_active');

    if (strlen($created_at_from) != 10 || strlen($created_at_to) != 10) {
      echo 'Rentang waktu tanggal wajib diisi';
      die();
    }

    $created_at_from = date("Y-m-d", strtotime($created_at_from));
    $created_at_to = date("Y-m-d", strtotime($created_at_to));
    

    // Prepare date range
    $tgl_save = str_replace('-', '', $created_at_from) . '-' . str_replace('-', '', $created_at_to);
    $tgl = 'Periode: ' . $this->__dateIndonesia($created_at_from, 'tanggal') . ' - ' . $this->__dateIndonesia($created_at_to, 'tanggal');

    //filename builder
    $save_dir = $this->__checkDir(date("Y/m", strtotime($created_at_from)));
    $save_file = 'data-kendaraan' . '-' . $tgl_save;
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
    $objWorkSheet->setCellValue('A1', strtoupper('Data Kendaraan'))->mergeCells('A1:J1');
    $objWorkSheet->getStyle('A1')->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('A1:J1')->applyFromArray($judul_utama_sty);

    $objWorkSheet->setCellValue('A2', $tgl)->mergeCells('A2:J2');
    $objWorkSheet->getStyle('A2')->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('A2:J2')->applyFromArray($style);

    //header
    $objWorkSheet
    ->setCellValue('A10', 'No.')
    ->setCellValue('B10', 'Nama')
    ->setCellValue('C10', 'Utype')
    ->setCellValue('D10', 'No Polisi')
    ->setCellValue('E10', 'Merk')
    ->setCellValue('F10', 'Warna')
    ->setCellValue('G10', 'Kapasitas Mesin')
    ->setCellValue('H10', 'Kapasitas Angkutan')
    ->setCellValue('I10', 'Availability')
    ->setCellValue('J10', 'Tanggal')
    ->setCellValue('K10', 'Status');    

    //setting gaya untuk header
    $objWorkSheet->getStyle('A10')->applyFromArray($judul_bold)->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('B10')->applyFromArray($judul_bold)->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('C10')->applyFromArray($judul_bold)->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('D10')->applyFromArray($judul_bold)->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('E10')->applyFromArray($judul_bold)->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('F10')->applyFromArray($judul_bold)->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('G10')->applyFromArray($judul_bold)->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('H10')->applyFromArray($judul_bold)->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('I10')->applyFromArray($judul_bold)->getAlignment()->applyFromArray($style);
    $objWorkSheet->getStyle('J10')->applyFromArray($judul_bold)->getAlignment()->applyFromArray($style);    
    $objWorkSheet->getStyle('K10')->applyFromArray($judul_bold)->getAlignment()->applyFromArray($style);    

    //set baris secara programming
    $i = 11;
    $nomor = 1;

    $laporan_data = $this->avm->laporan_xls($created_at_from, $created_at_to, $is_active);
    //cek data ada ga nya
    if (count($laporan_data)) {
      //iterasikan data
      foreach ($laporan_data as $row) {
        $objWorkSheet->setCellValue('A' . $i, $nomor);
        $objWorkSheet->setCellValue('B' . $i, $row->nama);
        $objWorkSheet->setCellValue('C' . $i, $row->utype);
        $objWorkSheet->setCellValue('D' . $i, $row->no_pol);
        $objWorkSheet->setCellValue('E' . $i, $row->merk);
        $objWorkSheet->setCellValue('F' . $i, $row->warna);
        $objWorkSheet->setCellValue('G' . $i, $row->kapasitas_mesin);
        $objWorkSheet->setCellValue('H' . $i, $row->kapasitas_angkutan);
        $objWorkSheet->setCellValue('I' . $i, $row->availability);
        $objWorkSheet->setCellValue('J' . $i, $row->is_active);
        $objWorkSheet->setCellValue('K' . $i, $row->is_active);


        //set border ke masing2 kolom
        $objWorkSheet->getStyle('A' . $i)->applyFromArray($styleborder);
        $objWorkSheet->getStyle('B' . $i)->applyFromArray($styleborder);
        $objWorkSheet->getStyle('C' . $i)->applyFromArray($styleborder);
        $objWorkSheet->getStyle('D' . $i)->applyFromArray($styleborder);
        $objWorkSheet->getStyle('E' . $i)->applyFromArray($styleborder);
        $objWorkSheet->getStyle('F' . $i)->applyFromArray($styleborder);
        $objWorkSheet->getStyle('G' . $i)->applyFromArray($styleborder);
        $objWorkSheet->getStyle('H' . $i)->applyFromArray($styleborder);
        $objWorkSheet->getStyle('I' . $i)->applyFromArray($styleborder);
        $objWorkSheet->getStyle('J' . $i)->applyFromArray($styleborder);
        $objWorkSheet->getStyle('K' . $i)->applyFromArray($styleborder);

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
