<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Document;
use Knp\Snappy\Pdf;
use Dompdf\Options;
use Dompdf\Dompdf;

/**
 * DocumentToPdf class
 * 
 * @Route("/document")
 */
class DocumentToPdf extends AbstractController
{
    /**
    * @Route("/pdf/{slug}", name="document_to_pdf", methods={"GET"})
    *
    *
    *
    * @return void
    */
    public function actionToPdf(Document $document, Request $request, \Knp\Snappy\Pdf $snappy)
    { 
        $slug = $document->getSlug();

        
        $path = $request->getPathInfo();
        //dd($request);

      // Configure Dompdf according to your needs
      //$pdfOptions = new Options();
      //$pdfOptions->set('defaultFont', 'Arial');
     
      // Instantiate Dompdf with our options
      //$dompdf = new Dompdf($pdfOptions);
    //   $dompdf = new Dompdf();
    //   // Retrieve the HTML generated in our twig file
    //   $html = $this->renderView('document/pdf.view.html.twig', [
    //       'document' => $document
    //   ]);

    //   $html .='<link type="text/css" href="C:\Users\admin.ETUDIANT\Desktop\Marketdigidoc\public\css\style.css" rel="stylesheet" />';
      
    //   // Load HTML to Dompdf
    //   $dompdf->loadHtml($html);
     
    //   // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
    //   $dompdf->setPaper('A4', 'portrait');

    //   // Render the HTML as PDF
    //   $dompdf->render();

    //   // Output the generated PDF to Browser (inline view)
    //   $dompdf->stream("mypdf.pdf", [
    //       "Attachment" => false
    //   ]);
 
      $snappy = new Pdf("\"C:\\Program Files\\wkhtmltopdf\\bin\\wkhtmltopdf.exe\"");
      
      $filename = 'myFirstSnappyPDF';
      $url = '127.0.0.1:8000'.$path;
      //$pageUrl = $this->generateUrl('document_to_pdf'.$slug, array(), UrlGeneratorInterface::ABSOLUTE_URL);
      $html = $this->renderView('document/pdf.view.html.twig', array(
        'document' => $document
    ));

      // use absolute path !
    //   $pageUrl = $this->generateUrl('127.0.0.1:8000/document/pdf/'.$slug, array(), UrlGeneratorInterface::ABSOLUTE_URL);
    //   dd($pageUrl);
    //   return new Response(
    //     $snappy->getOutput($pageUrl),
    //     200,
    //     array(
    //         'Content-Type'          => 'application/pdf',
    //         'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
    //     )
    // );
    
         return new Response(
             $snappy->getOutputFromHtml($html),
             200,
            array(
                 'Content-Type'          => 'application/pdf',
                 'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
             )
         );
    }
}