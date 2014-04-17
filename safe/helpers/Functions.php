<?php

/**
 * Esta clase contiene funciones internas de uso comun.

 */
class Functions {

    /**
     * Retorna un nombre aleatrorio de archivo concatenado con la extension pasada como parametro.
     * @param $extensionName ExtensiÃ³n del archivo sin punto, ej: doc, ppt, pdf
     * @return String
     *  @author r.a.p (02/08/2009)
     */
    public static function randFileName($extensionName, $fileName='') {
        mt_srand();
        if ($fileName != '') {
            return self::formatUrl($fileName) . '_' . mt_rand(10, 99) . '.' . strtolower($extensionName);
        } else {
            return date('YmdHis') . '_' . mt_rand(10, 99) . '.' . strtolower($extensionName);
        }
    }

    /**
     * Cambia la fecha del formato Español(08/07/2009) al formato de BD(2009-07-08)
     * @param $date Fecha en formato "08/07/2009"
     * @return String
     * @author Rap (02/08/2009)
     */
    public static function date2db($date, $form = "-") {
        //Si la fecha viene de la forma 24-11-2009 entonces reemplaza los - por /
        $date = str_replace($form, '/', $date);

        if (strpos($date, "/")) {
            $fec = explode("/", $date);
            return $fec[2] . "-" . $fec[1] . "-" . $fec[0];
        }else
            return false;
    }

    /**
     * Cambia la fecha del formato Español(08/07/2009) al formato de BD(2009-07-08)
     * @param $date Fecha en formato "08/07/2009"
     * @return String
     * @author Rap (02/08/2009)
     */
    public static function db2date($date, $form = "-") {
        //Si la fecha viene de la forma 24-11-2009 entonces reemplaza los - por /
        $date = str_replace($form, '-', $date);

        if (strpos($date, "-")) {
            $fec = explode("-", $date);
            return $fec[2] . "/" . $fec[1] . "/" . $fec[0];
        }else
            return false;
    }

    /**
     * Convierte un arreglo en una cadena separada con <br>
     * @param $data es el array() que se va a convertir en texto
     * @return String
     * @author Rap (02/08/2009)
     */
    public static function array2text($data,$id='') {
        $text = '<ul>';
        foreach ($data as $row)
            $text .= '<li>' . $row . '<li>';
        $text .='</ul>';
        return $text;
    }

    /**
     * Trunca un texto largo para cuando se necesita solo una parte
     * @param $string Texto que va a ser truncado
     * @param $length Este determina para cuantos caracteres truncar.
     * @param $etc Este es el texto para adicionar si el truncamiento ocurre. La longitud NO se incluye para la logitud del truncamiento
     * @param $break_words Este determina cuando truncar o no o al final de una palabra(false), o un caracter exacto(true).
     * @param $middle Este determina cuando ocurre el truncamiento al final de la cadena(false), o en el centro de la cadena(true). Nota cuando este es true, entonces la palabra limite es ignorada.
     * @return String
     * @author Rap (02/08/2009)
     */
    public static function truncate($string, $length = 80, $etc = '...', $break_words = false, $middle = false) {
        if ($length == 0)
            return '';

        if (strlen($string) > $length) {
            $length -= strlen($etc);
            if (!$break_words && !$middle) {
                $string = preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $length + 1));
            }
            if (!$middle) {
                return substr($string, 0, $length) . $etc;
            } else {
                return substr($string, 0, $length / 2) . $etc . substr($string, -$length / 2);
            }
        } else {
            return $string;
        }
    }

    /**
     * Le da formato a un texto que va a ser utilizado en url semantica.
     * @param $str es la cadena que queremos utilizar en la url
     * @return String
     * @author Rap (02/08/2009)
     * @author Rap (03/03/2010)
     */
    public static function formatUrl($str) {
        if (@preg_match('/.+/u', $str))
            $str = utf8_decode($str);

        $str = htmlentities($str);
        $str = preg_replace('/&([a-zA-Z])(uml|acute|grave|circ|tilde);/', '$1', $str);
        $str = html_entity_decode($str);
        $str = strtolower($str);
        $str = str_replace("Ã§", "c", $str);
        $str = preg_replace('@[ =()/\'\"\:\+\!\â€œ\â€�\â€˜\â€™\Â¡\Â¿\?\Âº\,\;\$\&\#\%\Â´\Â·\.\@\Â«\Â»]+@', '-', trim($str));
        $str = preg_replace('@[\W]+@', '-', $str);
        $str = preg_replace('@[-]*[^A-Za-z0-9._,]@', '-', $str);
        $str = preg_replace('@^[-]@', '', $str);
        $str = preg_replace('@([-])$@', '', $str);

        $str = strtolower($str);
        if (empty($str))
            $str = 'none';

        return $str;
    }
    
    public static function formatString($str, $separator="-", $cant = 0) {
        if (@preg_match('/.+/u', $str))
            $str = utf8_decode($str);

        $str = htmlentities($str);
        $str = preg_replace('/&([a-zA-Z])(uml|acute|grave|circ|tilde);/', '$1', $str);
        $str = html_entity_decode($str);
        $str = strtolower($str);
        $str = str_replace("Ã§", "c", $str);
        $str = preg_replace('@[ =()/\'\"\:\+\!\â€œ\â€�\â€˜\â€™\Â¡\Â¿\?\Âº\,\;\$\&\#\%\Â´\Â·\.\@\Â«\Â»]+@', $separator, trim($str));
        $str = preg_replace('@[\W]+@',$separator, $str);
        $str = preg_replace('@[-]*[ñÑ]@', 'n', $str);
        $str = preg_replace('@^[-]@', '', $str);
        $str = preg_replace('@([-])$@', '', $str);

        if ($cant > 0) {
            $arr = explode($separator, $str);
            if (count($arr) > 2) {
                if ($cant <= count($arr)) {
                    $data = array();
                    for ($i = 0; $i <= $cant; $i++) {
                        $data[$i] = $arr[$i];
                    }
                    $str = implode($separator, $data);
                }
            }
        }

        $str = strtolower($str);
        if (empty($str))
            $str = 'none';

        return $str;
    }

    /**
     * Retorna el nombre del navegador que el usuario esta usando para acceder a la Web.
     * @return String
     * @author Rap (15/04/2010)
     */
    public static function getBrowser() {
        $httpUserAgent = strtolower($_SERVER["HTTP_USER_AGENT"]);

        if (substr_count($httpUserAgent, 'msie'))//Internet explorer
            return 'IE';
        elseif (substr_count($httpUserAgent, 'chrome'))
            return 'Chrome';
        elseif (substr_count($httpUserAgent, 'firefox'))
            return 'Firefox';
        elseif (substr_count($httpUserAgent, 'safari'))
            return 'Safari';
        else
            return 'Otro';
    }

    public static function lastDay($month, $year) {
        return strftime("%d", mktime(0, 0, 0, $month + 1, 0, $year));
    }

    public static function date_diff($d1, $d2) {
        /* compares two timestamps and returns array with differencies (year, month, day, hour, minute, second)
         */
        //check higher timestamp and switch if neccessary
        if ($d1 < $d2) {
            $temp = $d2;
            $d2 = $d1;
            $d1 = $temp;
        } else {
            $temp = $d1; //temp can be used for day count if required
        }
        $d1 = date_parse(date("Y-m-d H:i:s", $d1));
        $d2 = date_parse(date("Y-m-d H:i:s", $d2));
        //seconds
        if ($d1['second'] >= $d2['second']) {
            $diff['second'] = $d1['second'] - $d2['second'];
        } else {
            $d1['minute']--;
            $diff['second'] = 60 - $d2['second'] + $d1['second'];
        }
        //minutes
        if ($d1['minute'] >= $d2['minute']) {
            $diff['minute'] = $d1['minute'] - $d2['minute'];
        } else {
            $d1['hour']--;
            $diff['minute'] = 60 - $d2['minute'] + $d1['minute'];
        }
        //hours
        if ($d1['hour'] >= $d2['hour']) {
            $diff['hour'] = $d1['hour'] - $d2['hour'];
        } else {
            $d1['day']--;
            $diff['hour'] = 24 - $d2['hour'] + $d1['hour'];
        }
        //days
        if ($d1['day'] >= $d2['day']) {
            $diff['day'] = $d1['day'] - $d2['day'];
        } else {
            $d1['month']--;
            $diff['day'] = date("t", $temp) - $d2['day'] + $d1['day'];
        }
        //months
        if ($d1['month'] >= $d2['month']) {
            $diff['month'] = $d1['month'] - $d2['month'];
        } else {
            $d1['year']--;
            $diff['month'] = 12 - $d2['month'] + $d1['month'];
        }
        //years
        $diff['year'] = $d1['year'] - $d2['year'];
        return $diff;
    }

    /**
     * Crea un resize de una imagen
     *
     * @param integer $width Ancho.
     * @param integer $height Alto.
     * @param string $path ruta donde se guarda la iamgen y resizes
     * @param string $name Nombre del archivo.
     * @author randrade
     */
    public static function createResize($width, $height, $path, $name, $crop=0) {
        $src = $path . '/' . $name;
        $dst = $path . $width . 'x' . $height . '/' . $name;
        self::image_resize($src, $dst, $width, $height, $crop);
    }

    public static function image_resize($src, $dst, $width, $height, $crop=0) {

        if (!list($w, $h) = getimagesize($src))
            return "Unsupported picture type!";

        $type = strtolower(substr(strrchr($src, "."), 1));
        if ($type == 'jpeg')
            $type = 'jpg';
        switch ($type) {
            case 'bmp': $img = imagecreatefromwbmp($src);
                break;
            case 'gif': $img = imagecreatefromgif($src);
                break;
            case 'jpg': $img = imagecreatefromjpeg($src);
                break;
            case 'png': $img = imagecreatefrompng($src);
                break;
            default : return "Unsupported picture type!";
        }

        // resize
        if ($crop) {
            if ($w < $width or $h < $height)
                return "Picture is too small!";
            $ratio = max($width / $w, $height / $h);
            $h = $height / $ratio;
            $x = ($w - $width / $ratio) / 2;
            $w = $width / $ratio;
        }
        else {
            if ($w < $width and $h < $height)
                return "Picture is too small!";
            $ratio = min($width / $w, $height / $h);
            $width = $w * $ratio;
            $height = $h * $ratio;
            $x = 0;
        }

        $new = imagecreatetruecolor($width, $height);

        // preserve transparency
        if ($type == "gif" or $type == "png") {
            imagecolortransparent($new, imagecolorallocatealpha($new, 0, 0, 0, 127));
            imagealphablending($new, false);
            imagesavealpha($new, true);
        }

        imagecopyresampled($new, $img, 0, 0, $x, 0, $width, $height, $w, $h);

        switch ($type) {
            case 'bmp': imagewbmp($new, $dst);
                break;
            case 'gif': imagegif($new, $dst);
                break;
            case 'jpg': imagejpeg($new, $dst);
                break;
            case 'png': imagepng($new, $dst);
                break;
        }
        return true;
    }

    public static function downloadFile($fullPath) {

        // Must be fresh start
        if (headers_sent())
            die('Headers Sent');

        // Required for some browsers
        if (ini_get('zlib.output_compression'))
            ini_set('zlib.output_compression', 'Off');

        // File Exists?
        if (file_exists($fullPath)) {

            // Parse Info / Get Extension
            $fsize = filesize($fullPath);
            $path_parts = pathinfo($fullPath);
            $ext = strtolower($path_parts["extension"]);

            // Determine Content Type
            switch ($ext) {
                case "pdf": $ctype = "application/pdf";
                    break;
                case "exe": $ctype = "application/octet-stream";
                    break;
                case "zip": $ctype = "application/zip";
                    break;
                case "doc": $ctype = "application/msword";
                    break;
                case "xls": $ctype = "application/vnd.ms-excel";
                    break;
                case "ppt": $ctype = "application/vnd.ms-powerpoint";
                    break;
                case "gif": $ctype = "image/gif";
                    break;
                case "png": $ctype = "image/png";
                    break;
                case "jpeg":
                case "jpg": $ctype = "image/jpg";
                    break;
                default: $ctype = "application/force-download";
            }

            header("Pragma: public"); // required
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private", false); // required for certain browsers
            header("Content-Type: $ctype");
            header("Content-Disposition: attachment; filename=\"" . basename($fullPath) . "\";");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . $fsize);
            ob_clean();
            flush();
            readfile($fullPath);
        } else
            die('File Not Found');
    }

    public static function viewPdfInline() {
        if (file_exists($fullPath)) {

            header("Content-Disposition: inline; filename=\"" . basename($fullPath) . "\";");
        }
    }

}