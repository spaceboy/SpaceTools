# SpaceTools

Some functions for PHP/Nette



## getSizeInBytes

Přepočítává velikosti zadané ve stringu typu "10KB", "20MiB" atd. na bajty
* @param string $sizeStr Zadaná velikost ve stringu typu "10KB", "20MiB"
* @return integer Přepočtená velikost v bajtech



## getIniSize

Zjišťuje čísla z parametru v PHP.INI zadaná ve strigu typu "10KB", "20Mib" atd.
* @param string $item Zadaná položka PHP.INI
* @param integer $formatDecimals Počet des. čísel
* @param string $formatDecPoint Oddělovač des. čísel
* @param string $formatThousandsSeparator: Oddělovač tisíců
* @return array
 - original => Původně zapsaný string
 - bytes    => Původně zapsaný string přepočtený na bajty
 - formated => Původně zapsaný string přepočtený na bajty v zadaném formátu



## getMaxFileSize

Zjišťuje maximální velikost uploadovatelného souboru z PHP.INI
* @param integer $formatDecimals Počet des. čísel
* @param string $formatDecPoint Oddělovač des. čísel
* @param string $formatThousandsSeparator: Oddělovač tisíců
* @return array
* - original => Původně zapsaný string
* - bytes    => Původně zapsaný string přepočtený na bajty
* - formated => Původně zapsaný string přepočtený na bajty v zadaném formátu



## arrayRemap

Přeindexuje pole podle zadaných parametrů
* @param array $source Zdrojové pole
* @param array $map Popis "přemapování": pole ve tvaru array( původní_index => nový_index, původní_index2 => nový_index2 ... )
* @param boolean $preserveUnset Pokud TRUE, vrací i prvky, které v původním poli nejsou definovány, ty mají hodnotu $default
* @param $mixed $default Hodnota prvků, které nebyly v původním poli definovány
* @return array



## isPathAbsolute

Zjistí, zda je zadaná cesta (filesystem) absolutní
* @param string filepath
* @return boolean
* @throws \Exception



## toArray

Sjednotí vstupy do neindexovaného pole
* @param array $args vstupní pole, může obsahovat skaláry a pole (i pole polí); ostatní se ignoruje
* @return array


## arrayIsAssoc

Zjistí, zda je pole asociativní (s pojmenovanými indexy)
* @param array $arr
* @return boolean
