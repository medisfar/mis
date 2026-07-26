<?php

namespace App\Http\Controllers;

use App\CsaPdf;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    protected $pdf;
 
    public function __construct()
    {
        $this->pdf = new Fpdf;
    }
  

    public function projet($id) 
    {
      
        $pdf = new CsaPdf;
        $pj=\App\Models\Projet::findOrFail($id);
        
        $datef=date('Y-m-d');
        
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->AddPage("P", 'A4');
        $pdf->SetXY(10,10);
        $pdf->Image(public_path().'/logo.jpeg',30,30,30);

        $pdf->SetFont('Arial', 'B', 20);
        $pdf->SetXY(0,30);
        $pdf->Cell(0, 15, "Projet $pj->libelle - ".$datef,0,1,'C');  
        $pdf->Ln(10);

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetWidths([40,80,25,25,20]);
        $pdf->setAligns(['L','L','R','R','R']);
        $pdf->SetFont('Arial', '', 11);
        
        $pdf->SetFillColor(200,200,225);
        
        
        foreach($pj->composantes as $i=>$cp)
        {

                  $c=[
                    'Composante '.($i+1),
                    utf8_decode($cp->description),
                    $cp->budget,
                    $cp->decaisse,
                    $cp->budget > 0 ? (\number_format($cp->decaisse/$cp->budget*100,2,',',' ').'%') : '0%'

                ];
                $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(40,6,"Nom",1,0,'L',true);
        $pdf->Cell(80,6,"Description",1,0,'L',true);
        $pdf->Cell(25,6,"Budget",1,0,'L',true);
        $pdf->Cell(25,6,utf8_decode('Decaissé'),1,0,'L',true);
        $pdf->Cell(20,6,'%',1,1,'L',true); 
           $pdf->Row($c);  
           foreach($cp->activites as $i=>$ac)
            {
                $pdf->Ln(10);
                $pdf->SetWidths([40,80,25,25,20]);
        $pdf->setAligns(['L','L','R','R','R']);
        $pdf->SetFont('Arial', '', 11);
        
                  
            
         
                
               
                 $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetWidths([40,80,25,25,20]);
        $pdf->setAligns(['R','L','R','R','R']);
        $pdf->SetFont('Arial', 'B', 11);
              $pdf->Row(
                [   
                    'Activite '.($i+1),
                    utf8_decode($ac->activite),
                    $ac->budget,
                    $ac->decaisse,
                    $ac->budget>0?(\number_format($ac->decaisse/$ac->budget*100,2,',',' ').'%'):'0%',

                ]
            );
            
            if($ac->decomptes->count()>0){
            $s=-1;$n=0;$t=0;
            $pdf->Cell(40,6,"Date ",1,0,'L',true);
            $pdf->Cell(80,6,"Description ",1,0,'L',true);
            $pdf->Cell(25,6,"",1,0,'L',true);
            $pdf->Cell(25,6,"Decompte",1,1,'L',true);
            $pdf->SetFont('Arial', '', 11);
            foreach($ac->decomptes as $i=>$d)
            {
               $n++;
             

             
              $pdf->Row(
                [   $d->date_effective,
                   $d->libelle,
                    
                   '',//utf8_decode($d->site->nom),
                    $d->montant,
                    

                ]
            );
              $t+=$d->montant;
             }
            }
             
            
            }
           $pdf->AddPage("P", 'A4');
        }
        
         $pdf->Output();
        exit;
    }
}