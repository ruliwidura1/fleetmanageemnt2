<?php
/**
 * Defined global constants for the app
 *
 * @package Application\Constant
 * @version 1.0.3
 *
 * @since 1.0.0
 */
define('SEME_VERBOSE', true);
if(!defined('DATATABLES_AJAX_FAILED_MSG')) define('DATATABLES_AJAX_FAILED_MSG', '<h4>Error</h4><p>Tidak dapat mengambil data dari server, silakan coba lagi nanti</p>');
if(!defined('DATATABLES_AJAX_FAILED_CLASS')) define('DATATABLES_AJAX_FAILED_CLASS', 'warning');
if(!defined('AJAX_CREATE_SUCCESS_MSG')) define('AJAX_CREATE_SUCCESS_MSG', '<h4>Berhasil</h4><p>Data baru berhasil disimpan</p>');
if(!defined('AJAX_CREATE_SUCCESS_CLASS')) define('AJAX_CREATE_SUCCESS_CLASS', 'success');
if(!defined('AJAX_CREATE_FAILED_CLASS')) define('AJAX_CREATE_FAILED_CLASS', 'danger');
if(!defined('AJAX_CREATE_ERROR_MSG')) define('AJAX_CREATE_ERROR_MSG', '<h4>Error</h4><p>Untuk saat ini tidak dapat menambahkan data baru, silakan coba beberapa saat lagi</p>');
if(!defined('AJAX_CREATE_ERROR_CLASS')) define('AJAX_CREATE_ERROR_CLASS', 'warning');
if(!defined('AJAX_UPDATE_SUCCESS_MSG')) define('AJAX_UPDATE_SUCCESS_MSG', '<h4>Berhasil</h4><p>Pembaruan data berhasil disimpan</p>');
if(!defined('AJAX_UPDATE_SUCCESS_CLASS')) define('AJAX_UPDATE_SUCCESS_CLASS', 'success');
if(!defined('AJAX_UPDATE_FAILED_CLASS')) define('AJAX_UPDATE_FAILED_CLASS', 'danger');
if(!defined('AJAX_UPDATE_ERROR_MSG')) define('AJAX_UPDATE_ERROR_MSG', '<h4>Error</h4><p>Untuk saat ini tidak dapat memperbarui data, silakan coba beberapa saat lagi</p>');
if(!defined('AJAX_UPDATE_ERROR_CLASS')) define('AJAX_UPDATE_ERROR_CLASS', 'warning');
if(!defined('AJAX_DELETE_SUCCESS_MSG')) define('AJAX_DELETE_SUCCESS_MSG', '<h4>Berhasil</h4><p>Data berhasil dihapus</p>');
if(!defined('AJAX_DELETE_SUCCESS_CLASS')) define('AJAX_DELETE_SUCCESS_CLASS', 'success');
if(!defined('AJAX_DELETE_FAILED_CLASS')) define('AJAX_DELETE_FAILED_CLASS', 'danger');
if(!defined('AJAX_DELETE_ERROR_MSG')) define('AJAX_DELETE_ERROR_MSG', '<h4>Error</h4><p>Tidak dapat melakukan penghapusan data sekarang, coba lagi nanti</p>');
if(!defined('AJAX_DELETE_ERROR_CLASS')) define('AJAX_DELETE_ERROR_CLASS', 'warning');

if(!defined('USER_DEFAULT_IMAGE')) define('USER_DEFAULT_IMAGE', 'media/user-default.png');

if (!defined('API_ADMIN_ERROR_CODES')) {
    define('API_ADMIN_ERROR_CODES', [
        104 => 'SKU sudah digunakan',
        200 => 'OK',
        204 => 'No content',
        400 => 'Harus login',
        401 => 'Harus login',
        404 => 'Not found',
        414 => 'Data with supplied ID is not exists',
        428 => 'Referrence ID is invalid',
        444 => 'One or more parameter are required',
        520 => 'Invalid ID',
        521 => 'ID tidak ditemukan atau telah dihapus',
        522 => 'Data tidak ditemukan atau telah dihapus',
        900 => 'Tidak dapat menambahkan data baru',
        901 => 'Tidak dapat melakukan perubahan ke basis data',
        902 => 'Tidak dapat melakukan penghapusan data',
        1001 => 'Nominal harus diisi',
    ]);
}
if (!defined('API_ADMIN_SUCCESS_MESSAGES')) {
    define('API_ADMIN_SUCCESS_MESSAGES', [
        'edit' => 'Perubahan data berhasil disimpan!',
    ]);
}
if (!defined('API_ADMIN_ERROR_MESSAGES')) {
    define('API_ADMIN_ERROR_MESSAGES', [
        'edit' => 'Proses edit data tidak bisa dilakukan, coba beberapa saat lagi',
        'datatable' => 'Tidak dapat mengambil data dari server, cobalah beberapa saat lagi',
    ]);
}
