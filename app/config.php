<?php
date_default_timezone_set('Asia/Makassar');
$now = date("Y-m-d H:i:s");

session_start();

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {
    // request 30 minates ago
    session_destroy();
    session_unset();
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time

include_once "configtables.php";
$con = mysqli_connect($con['host'], $con['user'], $con['pass'], $con['db']);
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}


function base_url($url = null)
{
    $base_url = "http://localhost/pln";
    if ($url != null) {
        return $base_url . "/" . $url;
    } else {
        return $base_url;
    }
}

function tgl($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $pecahkan = explode('-', $tanggal);

    // variabel pecahkan 0 = tanggal
    // variabel pecahkan 1 = bulan
    // variabel pecahkan 2 = tahun

    return $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
}

function bulan($number)
{
    $bulan = array(
        '01' => 'Januari',
        '02' => 'Februari',
        '03' => 'Maret',
        '04' => 'April',
        '05' => 'Mei',
        '06' => 'Juni',
        '07' => 'Juli',
        '08' => 'Agustus',
        '09' => 'September',
        '10' => 'Oktober',
        '11' => 'November',
        '12' => 'Desember'
    );

    return $bulan[$number];
}

function tglWaktu($datetime)
{
    $bulan = array(
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    $pecahkan = explode(' ', $datetime);
    $tanggal = explode('-', $pecahkan[0]);
    $waktu = explode(':', $pecahkan[1]);

    return $tanggal[2] . ' ' . $bulan[(int)$tanggal[1]] . ' ' . $tanggal[0] . ' | ' . $waktu[0] . ':' . $waktu[1] . ':' . $waktu[2];
}

// ... kode lainnya ...

function rupiah($angka)
{
    $hasil_rupiah = "Rp. " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}

function angka($input)
{
    return preg_replace('/[^0-9]/', '', $input);
}

function isActive($currentPage, $menuItems)
{
    if (is_array($menuItems)) {
        return in_array($currentPage, $menuItems) ? 'active' : '';
    }
    return $currentPage === $menuItems ? 'active' : '';
}

function isOpenActive($currentPage, $menuItems)
{
    return in_array($currentPage, $menuItems) ? 'active open' : '';
}

function usia($tgl_lahir)
{
    $birthDate = new DateTime($tgl_lahir);
    $today = new DateTime('today');
    $diff = $birthDate->diff($today);

    $years = $diff->y;
    $months = $diff->m;
    $days = $diff->d;

    $age = [];

    if ($years > 0) {
        $age[] = $years . ' ' . ($years > 1 ? 'Tahun' : 'Tahun');
    }

    if ($months > 0) {
        $age[] = $months . ' ' . ($months > 1 ? 'Bulan' : 'Bulan');
    }

    if ($days > 0) {
        $age[] = $days . ' ' . ($days > 1 ? 'Hari' : 'Hari');
    }

    if (empty($age)) {
        return '0 Hari';
    }

    return implode(' ', $age);
}

function hari($tanggal)
{
    $hari = array(
        1 =>    "Senin",
        "Selasa",
        "Rabu",
        "Kamis",
        "Jum'at",
        "Sabtu",
        "Minggu"
    );

    $num = date('N', strtotime($tanggal));
    return $hari[$num];
}

function hari_ini()
{
    $hari = date("D");

    switch ($hari) {
        case 'Sun':
            $hari_ini = "Minggu";
            break;

        case 'Mon':
            $hari_ini = "Senin";
            break;

        case 'Tue':
            $hari_ini = "Selasa";
            break;

        case 'Wed':
            $hari_ini = "Rabu";
            break;

        case 'Thu':
            $hari_ini = "Kamis";
            break;

        case 'Fri':
            $hari_ini = "Jumat";
            break;

        case 'Sat':
            $hari_ini = "Sabtu";
            break;
    }
    return $hari_ini;
}

function tgl_indo($tanggal)
{
    $hari = array(
        1 =>    'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );

    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );

    $split     = explode('-', $tanggal);
    $tgl = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];


    $num = date('N', strtotime($tanggal));
    return $hari[$num] . ', ' . $tgl;
}

function set_form_data($data)
{
    $_SESSION['form_data'] = $data;
}

function get_form_data($key = null)
{
    if (isset($_SESSION['form_data'])) {
        if ($key === null) {
            $data = $_SESSION['form_data'];
            unset($_SESSION['form_data']);
            return $data;
        } elseif (isset($_SESSION['form_data'][$key])) {
            $value = $_SESSION['form_data'][$key];
            unset($_SESSION['form_data'][$key]);
            return $value;
        }
    }
    return null;
}

function form_value($key, $default = '')
{
    $value = get_form_data($key);
    return $value !== null ? htmlspecialchars($value) : $default;
}

if (!function_exists('form_dropdown')) {
    /**
     * Drop-down Menu
     *
     * @param	mixed	$data
     * @param	mixed	$options
     * @param	mixed	$selected
     * @param	mixed	$extra
     * @return	string
     */
    function form_dropdown($data = '', $options = array(), $selected = array(), $extra = '')
    {
        $defaults = array();

        if (is_array($data)) {
            if (isset($data['selected'])) {
                $selected = $data['selected'];
                unset($data['selected']); // select tags don't have a selected attribute
            }

            if (isset($data['options'])) {
                $options = $data['options'];
                unset($data['options']); // select tags don't use an options attribute
            }
        } else {
            $defaults = array('name' => $data);
        }

        is_array($selected) or $selected = array($selected);
        is_array($options) or $options = array($options);

        // If no selected state was submitted we will attempt to set it automatically
        if (empty($selected)) {
            if (is_array($data)) {
                if (isset($data['name'], $_POST[$data['name']])) {
                    $selected = array($_POST[$data['name']]);
                }
            } elseif (isset($_POST[$data])) {
                $selected = array($_POST[$data]);
            }
        }

        $extra = _attributes_to_string($extra);

        $multiple = (count($selected) > 1 && stripos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

        $form = '<select ' . rtrim(_parse_form_attributes($data, $defaults)) . $extra . $multiple . ">\n";

        foreach ($options as $key => $val) {
            $key = (string) $key;

            if (is_array($val)) {
                if (empty($val)) {
                    continue;
                }

                $form .= '<optgroup label="' . $key . "\">\n";

                foreach ($val as $optgroup_key => $optgroup_val) {
                    $sel = in_array($optgroup_key, $selected) ? ' selected="selected"' : '';
                    $form .= '<option value="' . html_escape($optgroup_key) . '"' . $sel . '>'
                        . (string) $optgroup_val . "</option>\n";
                }

                $form .= "</optgroup>\n";
            } else {
                $form .= '<option value="' . html_escape($key) . '"'
                    . (in_array($key, $selected) ? ' selected="selected"' : '') . '>'
                    . (string) $val . "</option>\n";
            }
        }

        return $form . "</select>\n";
    }
}
if (!function_exists('_parse_form_attributes')) {
    /**
     * Parse the form attributes
     *
     * Helper function used by some of the form helpers
     *
     * @param	array	$attributes	List of attributes
     * @param	array	$default	Default values
     * @return	string
     */
    function _parse_form_attributes($attributes, $default)
    {
        if (is_array($attributes)) {
            foreach ($default as $key => $val) {
                if (isset($attributes[$key])) {
                    $default[$key] = $attributes[$key];
                    unset($attributes[$key]);
                }
            }

            if (count($attributes) > 0) {
                $default = array_merge($default, $attributes);
            }
        }

        $att = '';

        foreach ($default as $key => $val) {
            if ($key === 'value') {
                $val = html_escape($val);
            } elseif ($key === 'name' && !strlen($default['name'])) {
                continue;
            }

            $att .= $key . '="' . $val . '" ';
        }

        return $att;
    }
}
if (!function_exists('_attributes_to_string')) {
    /**
     * Attributes To String
     *
     * Helper function used by some of the form helpers
     *
     * @param	mixed
     * @return	string
     */
    function _attributes_to_string($attributes)
    {
        if (empty($attributes)) {
            return '';
        }

        if (is_object($attributes)) {
            $attributes = (array) $attributes;
        }

        if (is_array($attributes)) {
            $atts = '';

            foreach ($attributes as $key => $val) {
                $atts .= ' ' . $key . '="' . $val . '"';
            }

            return $atts;
        }

        if (is_string($attributes)) {
            return ' ' . $attributes;
        }

        return FALSE;
    }
}
if (!function_exists('html_escape')) {
    /**
     * Returns HTML escaped variable.
     *
     * @param	mixed	$var		The input string or array of strings to be escaped.
     * @param	bool	$double_encode	$double_encode set to FALSE prevents escaping twice.
     * @return	mixed			The escaped string or array of strings as a result.
     */
    function html_escape($var, $double_encode = TRUE)
    {
        if (empty($var)) {
            return $var;
        }

        if (is_array($var)) {
            foreach (array_keys($var) as $key) {
                $var[$key] = html_escape($var[$key], $double_encode);
            }

            return $var;
        }

        return htmlspecialchars($var, ENT_QUOTES, config_item('charset'), $double_encode);
    }
}
if (!function_exists('config_item')) {
    /**
     * Returns the specified config item
     *
     * @param	string
     * @return	mixed
     */
    function config_item($item)
    {
        static $_config;

        if (empty($_config)) {
            // // references cannot be directly assigned to static variables, so we use an array
            // $_config[0] =& get_config();
        }

        return isset($_config[0][$item]) ? $_config[0][$item] : NULL;
    }
}

function cmb_dinamis($name, $table, $field, $pk, $selected = null, $extra = NULL)
{
    $sql_details = array(
        'user' => 'root',
        'pass' => '',
        'db'   => 'db_farmasi',
        'host' => 'localhost'
    );

    $con = $sql_details;
    $cont = mysqli_connect($con['host'], $con['user'], $con['pass'], $con['db']);

    $cmb = "<select name='$name'class='form-control'$extra>";
    $cmb .= "<option>---Pilih---</option>";
    $data = $cont->query(" SELECT * FROM $table ");

    foreach ($data as $row) {
        $cmb .= "<option value='" . $row[$pk] . "'";
        $cmb .= $selected == $row[$pk] ? 'selected' : '';
        $cmb .= ">" . $row[$field] . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}
