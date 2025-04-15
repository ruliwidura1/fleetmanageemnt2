<?php
namespace Model\Admin;

register_namespace(__NAMESPACE__);
/**
 * Scoped `admin` model for `a_pengguna` table
 *
 * @version 1.0.0
 *
 * @package Model\Admin
 * @since 1.0.0
 */
class A_Pengguna_Model extends \Model\A_Pengguna_Concern
{

    public function __construct()
    {
        parent::__construct();
    }
}