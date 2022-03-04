<?php

namespace App\Services;

use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Alignment\LabelAlignmentCenter;
use Endroid\QrCode\Label\Margin\Margin;

/**Classe Qrcode sservice */
class QrcodeService
{
    /**
     * Undocumented variable
     *
     * @var BuilderInterface
     */
    protected $builder;
    public function __construct(BuilderInterface $builder)
    {
       $this->builder = $builder;
    }

    public function qrcode($query)
    {
        $url = "https://www.google.com/search?q=";

        $objDateTime = new \DateTime('NOW');
        $dateString = $objDateTime->format('d-m-Y H:i:s');

        $path = \dirname(__DIR__, 2).'/public/assets/';

        // set Qrcode
        $result = $this->builder
            ->data($url.$query)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(400)
            ->margin(10)
            ->labelText($dateString)
            ->labelAlignment( new LabelAlignmentCenter())
            ->labelMargin(new Margin(15, 5,5,5))
            ->logoPath($path.'img/logo1.png')
            ->logoResizeToWidth('100')
            ->logoResizeToHeight('100')
            ->backgroundColor(new Color(243, 189, 16))
            ->build()
        ;

        // Generate name
        $namePng = uniqid('', ''). '.png';

        // Save the img png 
        $result->saveToFile($path.'qr-code/'.$namePng);

        // return the reponse
        return $result->getDataUri();
    }

}