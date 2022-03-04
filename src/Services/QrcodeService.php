<?php

namespace App\Services;

use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;


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

        // set Qrcode
        $result = $this->builder
            ->data($url.$query)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(400)
            ->margin(10)
            ->labelText($dateString)
            ->backgroundColor(new Color(243, 189, 16))
            ->build()
        ;

        // Generate name
        $namePng = uniqid('', ''). '.png';

        // Save the img png 
        $result->saveToFile((\dirname(__DIR__, 2).'/public/assets/qr-code/'.$namePng));

        // return the reponse
        return $result->getDataUri();
    }

}