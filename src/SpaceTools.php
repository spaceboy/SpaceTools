<?php
/**
 * @author Spaceboy
 */

namespace Spaceboy;


class SpaceTools extends \stdClass {

    /**
     * Přepočítává velikosti zadané ve stringu typu "10KB", "20MiB" atd. na bajty
     * @param string $sizeStr Zadaná velikost ve stringu typu "10KB", "20MiB"
     * @return integer Přepočtená velikost v bajtech
     */
    public static function getSizeInBytes ($sizeStr) {
        return (int)preg_replace_callback('#([0-9]+)[\s]*([a-z]+)?#i', function ($match) {
            if (sizeof($match) < 3) {
                return $match[1];
            }
            switch (strtolower($match[2])) {
                case 'k':
                case 'kb':
                    return (int)$match[1] * 1024;
                case 'kib':
                    return (int)$match[1] * 1000;
                case 'm':
                case 'mb':
                    return (int)$match[1] * 1048576;
                case 'mib':
                    return (int)$match[1] * 1000000;
                case 'g':
                case 'gb':
                    return (int)$match[1] * 1073741824;
                case 'gib':
                    return (int)$match[1] * 1000000000;
            }
        }, $sizeStr);
    }

    /**
     * Zjišťuje čísla z parametru v PHP.INI zadaná ve strigu typu "10KB", "20Mib" atd.
     * @param string $item Zadaná položka PHP.INI
     * @param integer $formatDecimals Počet des. čísel
     * @param string $formatDecPoint Oddělovač des. čísel
     * @param string $formatThousandsSeparator: Oddělovač tisíců
     * @return array
     * - original => Původně zapsaný string
     * - bytes    => Původně zapsaný string přepočtený na bajty
     * - formated => Původně zapsaný string přepočtený na bajty v zadaném formátu
     */
    public static function getIniSize ($item, $formatDecimals = 0, $formatDecPoint = '.', $formatThousandsSeparator = ',') {
        $original = ini_get($item);
        $bytes = self::getSizeInBytes($original);
        return array(
            'original'  => $original,
            'bytes'     => $bytes,
            'formated'  => number_format($bytes, $formatDecimals, $formatDecPoint, $formatThousandsSeparator),
        );
    }

    /**
     * Zjišťuje maximální velikost uploadovatelného souboru z PHP.INI
     * @param integer $formatDecimals Počet des. čísel
     * @param string $formatDecPoint Oddělovač des. čísel
     * @param string $formatThousandsSeparator: Oddělovač tisíců
     * @return array
     * - original => Původně zapsaný string
     * - bytes    => Původně zapsaný string přepočtený na bajty
     * - formated => Původně zapsaný string přepočtený na bajty v zadaném formátu
     */
    public static function getMaxFileSize ($formatDecimals = 0, $formatDecPoint = '.', $formatThousandsSeparator = ',') {
        return self::getIniSize('upload_max_filesize', $formatDecimals, $formatDecPoint, $formatThousandsSeparator);
    }

    /**
     * Přeindexuje pole podle zadaných parametrů
     * @param array $source Zdrojové pole
     * @param array $map Popis "přemapování": pole ve tvaru array( původní_index => nový_index, původní_index2 => nový_index2 ... )
     * @param boolean $preserveUnset Pokud TRUE, vrací i prvky, které v původním poli nejsou definovány, ty mají hodnotu $default
     * @param $mixed $default Hodnota prvků, které nebyly v původním poli definovány
     * @return array
     */
    public static function arrayRemap ($source, $map, $preserveUnset = false, $default = null) {
        $out = array();
        foreach ($map AS $key => $val) {
            if (array_key_exists($key, $source)) {
                $out[$val] = $source[$key];
            } elseif ($preserveUnset) {
                $out[$val] = $default;
            }
        }
        return $out;
    }

    /**
     * Zjistí, zda je zadaná cesta (filesystem) absolutní
     * @param string filepath
     * @return boolean
     * @throws \Exception
     */
    public static function isPathAbsolute ($path) {
        if ($path === null || $path === '') {
            throw new \Exception('Empty path');
        }
        return $path[0] === DIRECTORY_SEPARATOR || preg_match('~\A[A-Z]:(?![^/\\\\])~i', $path) > 0;
    }

    /**
     * Sjednotí vstupy do neindexovaného pole
     * @param array $args vstupní pole, může obsahovat skaláry a pole (i pole polí); ostatní se ignoruje
     * @return array
     */
    public static function toArray ($args) {
        $out = array();
        foreach ($args AS $item) {
            if (is_scalar($item)) {
                $out[] = $item;
            } elseif (is_array($item)) {
                $out = array_merge($out, self::toArray($item));
            }
        }
        return $out;
    }

    /**
     * Odstraní adresář včetně souborů v něm
     * @param string $dir
     * @return void
     */
    public static function purge ($dir) {
        if (!is_dir($dir)) {
            return;
        }
        foreach (scandir($dir) AS $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }
            $fileName = $dir . DIRECTORY_SEPARATOR . $file;
            if (is_dir($fileName)) {
                self::purge($fileName);
            } else {
                unlink($fileName);
            }
        }
        rmdir($dir);
    }

    /**
     * Zjistí, zda je pole asociativní
     * @param array $arr
     * @return boolean
     */
    public static function arrayIsAssoc ($arr) {
        if (!($len = sizeof($arr))) {
            return FALSE;
        }
        return (bool)sizeof(array_diff_key($arr, range(0, $len - 1)));
    }

}