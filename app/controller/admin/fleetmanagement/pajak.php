<?php

namespace Controller\Admin;

register_namespace(__NAMESPACE__);

/**
 * Admin scoped controller for jabatan item kpi
 *
 * Mostly for this controller will resulting HTTP Body Content in HTML format
 *
 * @version 1.0.0
 *
 * @package FleetManagement\pajak\Admin
 * @since 1.0.0
 */
class pajak extends \JI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setTheme('admin');
        $this->lib('seme_purifier');
        $this->load('admin/b_pajak_model', 'bpm');
        $this->load('a_vehicle_concern');
        $this->load('admin/a_vehicle_model', 'avm');
        $this->current_parent = 'fleetanagement';
        $this->current_page = 'fleetanagement_pajak';
    }

    public function index()
    {
        $data = $this->__init();
        if (!$this->admin_login) {
            redir(base_url_admin('login'));
            die();
        }
        $data['vehicle_list'] = $this->avm->get();
        $data['utype_list'] = $this->avm->get();
        $data['nopol_list'] = $this->avm->get();

        $this->setTitle('Fleet Management: pajak ' . $this->config->semevar->admin_site_suffix);
        $this->putThemeContent('fleetmanagement/pajak/home_modal', $data);
        $this->putThemeContent('fleetmanagement/pajak/home', $data);
        $this->putJsContent('fleetmanagement/pajak/home_bottom', $data);
        $this->loadLayout('col-2-left', $data);
        $this->render();
    }
    public function detail($id)
    {
        $data = $this->__init();
        if (!$this->admin_login) {
            redir(base_url_admin('login'));
            die();
        }
        $id = (int) $id;
        if ($id <= 0) {
            redir(base_url_admin('fleetmanagement/pajak/'));
            die();
        }
        $bpm = $this->bpm->id($id);
        $avm = $this->avm->id($bpm->a_vehicle_id);

        if (!isset($bpm->id) || !isset($avm->id)) {
            redir(base_url_admin('fleetmanagement/pajak/'));
            die();
        }

        $pengguna = $data['sess']->admin;

        $data['bpm'] = $bpm;
        $data['avm'] = $avm;

        $this->setTitle('Fleet Management: Pajak: Detail '.$this->config->semevar->admin_site_suffix);
        $this->putThemeContent("fleetmanagement/pajak/detail", $data);
        $this->putJsContent("fleetmanagement/pajak/detail_bottom", $data);
        $this->loadLayout('col-2-left', $data);
        $this->render();
    }
}