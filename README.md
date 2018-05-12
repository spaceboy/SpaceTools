# SpaceTools

Some functions for PHP/Nette


## Function list:

### getSizeInBytes

Recomputes filesizes from "INI" type strings ("10KB", "20MiB" etc.) to bytes
* @param string $sizeStr Given size in string like "10KB" or "20MiB"
* @return integer Recalculated size in bytes



### getIniSize

Finds number from PHP.INI file ("10KB", "20MiB") and returns it in given format
* @param string $item Given PHP.INI key
* @param integer $formatDecimals Decimal numbers count
* @param string $formatDecPoint Decimal separator
* @param string $formatThousandsSeparator: Thousands separator
* @return array
  - original => Original string
  - bytes    => Original string in bytes
  - formated => Original string in bytes in given format



### getMaxFileSize

Finds maximum size of uploadable file (as given in PHP.INI)
* @param integer $formatDecimals Decimal numbers count
* @param string $formatDecPoint Decimal separator
* @param string $formatThousandsSeparator: Thousands separator
* @return array
  - original => Original string
  - bytes    => Original string in bytes
  - formated => Original string in bytes in given format


### arrayRemap

Remaps array
* @param array $source Source array
* @param array $map "Map" for reindexing: array of items, where input index is key and output index value (original_index => new_index, original_index2 => new_index2 ... )
* @param boolean $preserveUnset When TRUE, method returns indexes undefined in source array (with $default value)
* @param $mixed $default Value for unset items
* @return array



### isPathAbsolute

Checks whether path (of filesystem) is absolute (c:\something | /something)
* @param string $path
* @return boolean
* @throws \Exception (when no path or path is NULL)



### toArray

Merges items of input array to unindexed array
* @param array $args input array - can contain scalars and arrays (or arrays of arrays); other items (such objects, closures) are ignored
* @return array


### arrayIsAssoc

Checks whether array is associative (with named indexes)
* @param array $arr
* @return boolean


### purgeDir

Clears dir incl. files and subdirectories
* @param string $dir
* @return void


### findMethodInPhp

Finds use of given method in PHP file
* @param string $phpFile
* @param string $methodName
* @return array (line number => part of line where method [$methodName] is used)
* @throws \InvalidArgumentException


### parseLineFromFile

Returns array of line(s) with specified numbers from given file
* @param string $fileName
* @param integer|array $line
* @return array
* @throws \InvalidArgumentException


### isFile
If given file does not exists OR is not a file, throws InvalidArgumentException exception
* @param string $fileName
* @return void
* @throws \InvalidArgumentException
