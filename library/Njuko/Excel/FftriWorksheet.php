<?php

namespace Njuko\Excel;

/**
 * @author      Yoann Yviquel <yoann.yviquel@njuko.com>
 * @codeQuality ★★★★★
 * @copyright   Copyright © Anewco - All rights reserved
 * @date        2013-07-17
 * 
 * @file        FftriWorksheet.php
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class FftriWorksheet extends \PHPExcel_Worksheet {
    /**
     * Fill worksheet from values in array
     *
     * @param array                     $source                 Source array
     * @param mixed                     $nullValue              Value in source array that stands for blank cell
     * @param string                    $startCell              Insert array starting from this cell address as the top left coordinate
     * @param boolean                   $strictNullComparison   Apply strict comparison when testing for null values in the array
     * @param PHPExcel_Cell_DataType    $defaultDataTupe
     * @param boolean                   $inverseColumnToRow     Inverse row to column
     * @throws PHPExcel_Exception
     * @return PHPExcel_Worksheet
     */
    public function fromArray($source = null, $nullValue = null, $startCell = 'A1', $strictNullComparison = false, $defaultDataType = \PHPExcel_Cell_DataType::TYPE_STRING, $inverseColumnToRow = false) {
        if (is_array($source)) {
            //    Convert a 1-D array to 2-D (for ease of looping)
            if (!is_array(end($source))) {
                $source = array($source);
            }

            // start coordinate
            list ($startColumn, $startRow) = \PHPExcel_Cell::coordinateFromString($startCell);

            $currentRow = $startRow;
            $currentColumn = $startColumn;

            // Loop through $source
            foreach ($source as $rowData) {
                if ($inverseColumnToRow) {
                    $currentRow = $startRow;
                }
                else {
                    $currentColumn = $startColumn;
                }

                foreach($rowData as $cellValue) {
                    if ($strictNullComparison) {
                        if ($cellValue !== $nullValue) {
                            // Set cell value
                            $this->getCell($currentColumn . $currentRow)->setValueExplicit($cellValue, $defaultDataType);
                        }
                    } else {
                        if ($cellValue != $nullValue) {
                            // Set cell value
                            $this->getCell($currentColumn . $currentRow)->setValueExplicit($cellValue, $defaultDataType);
                        }
                    }
                    $inverseColumnToRow ? ++$currentRow : ++$currentColumn;
                }
                $inverseColumnToRow ? ++$currentColumn : ++$currentRow;
            }
        } else {
            throw new \PHPExcel_Exception("Parameter \$source should be an array.");
        }
        return $this;
    }
}

?>
