<?php
/**
 * Page
 *
 * @package     ${NAMESPACE}
 * @author      Yoann Yviquel < yoann.yviquel@njuko.com >
 * @creation    19/06/13
 * @copyright   Copyright (c) Anewco - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */

namespace Njuko\Pdf;

/**
 * Page
 * WARNING : need to be used with Njuko\Pdf\Document, not ZendPdf\PdfDocument
 * ZendPdf page with more draw methods
 *
 * @package     Njuko\Pdf
 * @author      Yoann Yviquel < yoann.yviquel@njuko.com >
 * @copyright   Copyright (c) Anewco - All rights reserved
 * @license     Unauthorized copying of this source code, via any medium is strictly
 *              prohibited, proprietary and confidential.
 */
class Page extends \ZendPdf\Page
{
    /**
     * @param sring                         $param1
     * @param \ZendPdf\Color\ColorInterface $defaultFillColor
     * @param \ZendPdf\Color\ColorInterface $defaultLineColor
     * @param float                         $defaultLineWidth
     */
    public function __construct($param1, \ZendPdf\Color\ColorInterface $defaultFillColor, \ZendPdf\Color\ColorInterface $defaultLineColor, $defaultLineWidth) {
        parent::__construct($param1, null, null);
        $style = new \ZendPdf\Style();
        $style->setFillColor($defaultFillColor);
        $style->setLineColor($defaultLineColor);
        $style->setLineWidth($defaultLineWidth);
        $this->setStyle($style);
    }
    
    
    
    
    /**
     * @param float                         $x1
     * @param float                         $y1
     * @param float                         $x2
     * @param float                         $y2
     * @param float                         $borderSize
     * @param \ZendPdf\Color\ColorInterface $borderColor
     */
    public function drawRectangularBorder($x1, $y1, $x2, $y2, $borderSize, \ZendPdf\Color\ColorInterface $borderColor)
    {
        if ($this->getStyle() instanceof \ZendPdf\Style) :
            $defaultLineColor = $this->getStyle()->getLineColor();
            $defaultLineWidth = $this->getStyle()->getLineWidth();
            $this->setLineColor($borderColor);
            $this->setLineWidth($borderSize);
            $this->drawLine($x1, $y1, $x2, $y1);
            $this->drawLine($x2, $y1, $x2, $y2);
            $this->drawLine($x2, $y2, $x1, $y2);
            $this->drawLine($x1, $y2, $x1, $y1);
            $this->setLineColor($defaultLineColor);
            $this->setLineWidth($defaultLineWidth);
        endif;
    }
    
    
    
    /**
     * 
     * @param float                         $x
     * @param float                         $y
     * @param float                         $radius
     * @param float                         $borderSize
     * @param \ZendPdf\Color\ColorInterface $borderColor
     * @param \ZendPdf\Color\ColorInterface $fillingColor
     */
    public function drawCircularBorder($x, $y, $radius, $borderSize, \ZendPdf\Color\ColorInterface $borderColor, \ZendPdf\Color\ColorInterface $fillingColor)
    {
        if ($this->getStyle() instanceof \ZendPdf\Style) :
            $defaultFillingColor = $this->getStyle()->getFillColor();
            $this->setFillColor($borderColor);
            $this->drawCircle($x, $y, $radius);
            $this->setFillColor($fillingColor);
            $this->drawCircle($x, $y, $radius-$borderSize);
            $this->setFillColor($defaultFillingColor);
        endif;
    }
}

?>
