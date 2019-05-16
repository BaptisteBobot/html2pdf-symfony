<?php


namespace App\Controller;
require_once "vendor/spipu/html2pdf/src/html2pdf.php";

use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;


class PDFController
{
    /**
     * @Route("/pdf", name="_pdf")
     */
    public function pdfAction(){
        $user = array(
            "id" => 1,
            "siret" => "152 356 785",
            "firstname" => "John",
            "lastname" => "Doe",
            "email" => "john.doe@gmail.com",
            "portable" => "06.25.35.45.35",
            "address" => "26 Avenue du Bourg\n75000 Paris"
        );

        $client = array(
            "id" => 1,
            "firstname" => "Luc",
            "lastname" => "Kennedy",
            "mail" => "luc.kennedy@gmail.com",
            "portable" => "06.32.23.15.58",
            "address" => "5 Avenue du Boulevard Maréchal Juin\n14000 Caen",
            "infos" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium eos tempora, magni delectus porro cum labore eligendi."
        );

        $project = array(
            "id" => 1,
            "name" => "Création d'un Portfolio",
            "status" => 1,
            "infos" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium eos tempora, magni delectus porro cum labore eligendi.",
            "created" => 1,
            "paid" => false,
            "client_id" => 1,
            "user_id" => 1
        );

        $tasks[] = array(
            "id" => 1,
            "ref" => "96ER1",
            "description" => "Veille technologique",
            "price" => 200,
            "quantity" => 1,
            "project_id" => 1
        );

        $tasks[] = array(
            "id" => 2,
            "ref" => "152DE",
            "description" => "Création et intégration d'un thème pour WordPress",
            "price" => 500,
            "quantity" => 1,
            "project_id" => 1
        );

        $tasks[] = array(
            "id" => 3,
            "ref" => "25365",
            "description" => "Développement d'un plugin WordPress sur mesure pour le client",
            "price" => 1000,
            "quantity" => 1,
            "project_id" => 1
        );

        $content = $this->renderview('::pdf.html.twig',[
            'user'          => $user,
            'client'        => $client,
            'project'       => $project,
        ]);


        try {
            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $html2pdf->pdf->SetAuthor('Do John');
            $html2pdf->pdf->SetTitle('Devis 14');
            $html2pdf->pdf->SetSubject('Création d\'un PorteFolio');
            $html2pdf->pdf->SetKeywords('HTML2PDF, Devis, PHP');
            $html2pdf->writeHTML($content);
            $html2pdf->output('Devis.pdf');
        } catch (Html2PdfException $e) {
            die($e);
        }


    }

}