<?php
namespace App\Services;

use Codedge\Fpdf\Fpdf\Fpdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Imagick;

class PDF extends Fpdf
{
    // En-tête
    function Header()
    {
        // Logo
        $this->Image('images/logo.png', 10, 4, 12);
        
        $this->SetX(10);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(180, 6, utf8_decode(env('APP_NAME')), 'C', 0, 'C');
        
        $path = public_path('images/qrcode.svg');
        
        // Générer le QR code au format SVG
        QrCode::margin(4)
            ->backgroundColor(211,211,211, 80)
            ->size(100)
            ->generate(url()->current(), $path);
        // Conversing from svg to png format
    	$png = new Imagick();
        $png->readImageBlob(file_get_contents($path));
        $png->writeImages('qrcode.png', false);
        $png->resizeImage(80, 80, Imagick::FILTER_LANCZOS, 1); 
        
        $this->Image($png->getImageFilename(), 186, 3, 14, 0);
        
        // Police Arial gras 15
        $this->SetFont('Arial', 'B', 15);
        $this->Ln(7);
        // Décalage à droite
        $this->Cell(190, 0, '', 1);
        // Titre
        // Saut de ligne
        $this->Ln(4);
    }

    // Pied de page
    function Footer()
    {
        // Positionnement à 1,5 cm du bas
        $this->SetXY(40, -19.5);
        
        // Police Arial italique 8
        // Numéro de page
        $this->SetFont('Arial', 'IB', 8);
        $this->Cell(130, 2,'Page '.$this->PageNo(), 'LR', 1,'C');
        $this->SetX(40);
        $this->SetFont('Arial', 'I', 6.5);
        $this->Cell(130, 3, utf8_decode("Commune / Region"), 'LR', 1, 'C');
        $this->SetX(40);
        $this->Cell(130, 3, utf8_decode("Adresse / Siège National"), 'LR', 1, 'C');
        $this->SetX(40);
        $this->Cell(130, 3, utf8_decode("COMMUNE DE MATOTO - BP: 2024 Conakry - République de Guinée"), 'LR', 1, 'C');
        $this->SetX(40);
        $this->SetFont('Arial', 'IB', 6.5);
        $this->Cell(130, 3, utf8_decode("Tél: 00224 625 12 32 32 - Site Web: www.alsysecurite.com"), 'LR', 1, 'C');
        // Flag Guinea
        $this->Image('images/flag.png', 10, 277, 25);
        $this->Image('images/branding.png', 175, 277, 25);
    }

    // Tableau simple
    function BasicTable($header, $data)
    {
        // En-tête
        foreach($header as $col)
            $this->Cell(40,7,$col,1);
        $this->Ln();
        // Données
        foreach($data as $row)
        {
            foreach($row as $col)
                $this->Cell(40, 6, $col, 1);
            $this->Ln();
        }
    }

    // Tableau amélioré
    function ImprovedTable($header, $data)
    {
        // Largeurs des colonnes
        $w = array(40, 35, 45, 40);
        // En-tête
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i], 7, utf8_decode($header[$i]), 1, 0, 'C');
        $this->Ln();
        // Données
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row[0],'LR');
            $this->Cell($w[1],6,$row[1],'LR');
            $this->Cell($w[2],6,number_format($row[2],0,',',' '),'LR',0,'R');
            $this->Cell($w[3],6,number_format($row[3],0,',',' '),'LR',0,'R');
            $this->Ln();
        }
        // Trait de terminaison
        $this->Cell(array_sum($w),0,'','T');
    }

    // Tableau coloré
    function FancyTable($header, $data, $isReceipt, $others = [], $isDiama = false)
    {
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(150, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'IB');
        // En-tête
        $w = array(10, 80, 35, 30, 35);
        for($i=0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, utf8_decode($header[$i]), 1, 0, 'C', true);
        $this->Ln();
        // Restauration des couleurs et de la police
        $this->SetFillColor(224, 215, 215);
        $this->SetTextColor(0);
        $this->SetLineWidth(.1);
        // Données
        $fill = false;
        $this->SetFont('Arial', 'I', 8);
        $sum = 0;
        $taxs = 0;
        foreach($data as $key => $row)
        {
            $this->Cell($w[0], 6, ++$key, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, utf8_decode($row->employee->matricule." - ".(!empty($row->employee->currentAffectation()->location) ? $row->employee->currentAffectation()->location : 'Non défini')), 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, moneyFormat($row->price), 'LR', 0, 'C', $fill);
            $this->Cell($w[3], 6, moneyFormat($row->tva*0.01*$row->price), 'LR', 0, 'C', $fill);
            $this->Cell($w[4], 6, moneyFormat($row->price+$row->tva*0.01*$row->price), 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
            $sum += $row->price;
            $taxs += $row->tva*0.01*$row->price;
        }
        // Trait de terminaison
        $this->Cell(array_sum($w), 0, '', 'T', 1);
        $this->Ln();
        $this->SetFont('Arial', 'I', 9);
        $supp = ['TOTAL HT'=>moneyFormat($sum), 'TOTAL TVA'=>moneyFormat($taxs)];
        $ttc = $sum+$taxs;
        if(!empty($others['discount'])) {
            $ttc -= $others['discount']; 
            $supp['TOTAL REMISE / HT'] = moneyFormat($others['discount']);
        }
        if(!empty($others['arrears'])) {
            $ttc += $others['arrears']; 
            $supp['TOTAL ARRIERES'] = moneyFormat($others['arrears']);
        }
        $supp['MONTANT TTC'] = moneyFormat($ttc);
        
        foreach($supp as $key => $item)
        {
            $this->setX(115);
            $this->Cell(40, 9, $key, 'LRT', 0, 'L', $fill);
            $this->Cell(45, 9, utf8_decode($item), 'LRT', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->setX(115);
        $this->Cell(85, 0, '', 'T');
        
        $this->SetFont('Arial', 'I', 8);
        $this->setXY(10, $this->getY()-24);
        $this->Cell(80, 0, 'Conakry le '.date('d/m/Y'), '');
        $this->Image('images/signature.png', 10, $this->getY()+2, 30, 0);
        
        $this->Ln(25);
        $this->SetFont('Arial', 'I', 7.8);
        $txt = "Sauf Erreur ou Omission, le montant de ".($isReceipt == 1 ? 'ce reçu' : 'cette facture')." s'élève à ".$supp['MONTANT TTC']." comme TTC ".(!empty($supp['TOTAL ARRIERES']) ? "avec ".$supp['TOTAL ARRIERES']." comme arriérés sur le total HT " : "") . (!empty($supp['TOTAL REMISE']) ? "et ".$supp['TOTAL REMISE']." comme remise sur le total HT " : ""). "Payable en liquidité, ";
        
        if(strlen($txt) <= 110) 
            $txt .= "par chèque ou virement bancaire à l'ordre de: ";
        if(strlen($txt) <= 147 && strlen($txt) > 110) 
            $txt .= "par chèque,";
        // if(strlen($txt) <= 191 && strlen($txt) > 144){
        //     $txt = str_replace("sur le total HT Payable en liquidité, ", '', $txt);
        // } 
        
        $this->Cell(190, 6, utf8_decode($txt), '', 1, 'L');
        if(strlen($txt) <= 110) 
            $this->setXY(10, $this->getY());
        
        // if(strlen($txt) <= 156 && strlen($txt) > 110 && strlen($txt) != 149) {
        //     $this->setX(10);
        //     $this->Cell(30, 3, utf8_decode("par virement bancaire à l'ordre de: "), '', 0, 'L');
        //     $this->setX(53);
        // }
        // dd( strlen($txt) );
        if(strlen($txt) <= 191 && strlen($txt) > 144){
            $this->setX(10);
            $this->Cell(40, 3, utf8_decode("par chèque ou par virement bancaire à l'ordre de: "), '', 0, 'L');
            $this->setX(71);
        } 
        
        $bankname = "JAGUAR SECURITY SERVICES SARL - RIB: ". ($isDiama ? '0010330009-04 - DIAMA BANK' : '036.001.0100002646.43 - ACCESS BANK GUINEE');
        // if(strlen($txt) <= 191 && strlen($txt) > 144) {
        //     $bankname = str_replace("ISLAMIQUE DE GUINEE (BIG)", '', $bankname);
        // } 
        $this->SetFont('Arial', 'IB', 6.5);
        $this->Cell(80, 3, utf8_decode($bankname), '', 1, 'L');
        // if(strlen($txt) <= 191 && strlen($txt) > 144) {
        //     $this->setX(10);
        //     $this->Cell(40, 5, utf8_decode("ISLAMIQUE DE GUINEE (BIG)"), '', 1, 'L');
        // }
    }
    
    function bankTransfer($header, $data)
    {
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(150, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.6);
        $this->SetFont('','B');
        // En-tête
        $w = array(10, 75, 35, 35, 35);
        for($i=0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, utf8_decode($header[$i]), 1, 0, 'C', true);
        $this->Ln();
        // Restauration des couleurs et de la police
        $this->SetFillColor(224, 215, 215);
        $this->SetTextColor(0);
        $this->SetLineWidth(.1);
        $this->SetFont('');
        // Données
        $fill = false;
        $this->SetFont('Arial', 'I', 9);
        $sum = 0; $tva = 0;
        foreach($data as $key => $row)
        {
            $this->Cell($w[0], 6, ++$key, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, utf8_decode($row->firstname." ".$row->name), 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, utf8_decode($row->matricule), 'LR', 0, 'C', $fill);
            $this->Cell($w[3], 6, utf8_decode($row->rib), 'LR', 0, 'C', $fill);
            $this->Cell($w[4], 6, moneyFormat(($row->salary+$row->prime)-($row->acompte+$row->sanction)-($row->salary+$row->prime)*($row->cnss+$row->rts)*0.01), 'LR', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill; 
            $sum += ($row->salary+$row->prime)-($row->acompte+$row->sanction)-($row->salary+$row->prime)*($row->cnss+$row->rts)*0.01; 
            $tva += ($row->salary+$row->prime-$row->acompte-$row->sanction)*($row->cnss+$row->rts)*0.01; 
        }
        // Trait de terminaison
        $this->Cell(array_sum($w), 0, '', 'T', 1);
        $this->Ln(2);
        $this->SetFont('Arial', 'I', 9);
        foreach(array('TOTAL HT'=>moneyFormat($sum+$tva), 'TAXES (CNSS & RTS)'=>moneyFormat($tva), 'MONTANT TTC'=>moneyFormat($sum)) as $key => $item)
        {
            $this->setX(105);
            $this->Cell(50, 9, $key, 'LRT', 0, 'L', $fill);
            $this->Cell(45, 9, utf8_decode($item), 'LRT', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->setX(105);
        $this->Cell(95, 0, '', 'T');
        $this->Ln(5);
        $this->setX(160);
        $this->Cell(80, 0, 'Conakry, le '.date('d/m/Y'), '');
        // $this->Image('images/signature.png', 70, $this->getY()-30, 30, 0);
        
        // $this->setX(30);
        // $this->Image('images/cachet.png', 10, $this->getY()-30, 20, 0);
        // $this->Image('images/signature_only.png', 35, $this->getY()-15, 50, 0);
        
        $this->setX(100);
        
    }
    
    function getEmployeesAffected($header, $data)
    {
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(150, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('','IB');
        // En-tête
        $w = array(10, 35, 40, 105);
        for($i=0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, utf8_decode($header[$i]), 1, 0, 'C', true);
        $this->Ln();
        // Restauration des couleurs et de la police
        $this->SetFillColor(224, 215, 215);
        $this->SetTextColor(0);
        $this->SetLineWidth(.1);
        $this->SetFont('');
        // Données
        $fill = false;
        $this->SetFont('Arial', 'I', 11);
        $sum = 0; $tva = 0;
        foreach($data as $key => $row)
        {
            $this->Cell($w[0], 6, ++$key, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, utf8_decode($row->matricule), 'LR', 0, 'C', $fill);
            $this->Cell($w[2], 6, moneyFormat(($row->salary+$row->prime)-($row->acompte+$row->sanction)-($row->salary+$row->prime)*($row->cnss+$row->rts)*0.01), 'LR', 0, 'C', $fill);
            $this->Cell($w[3], 6, utf8_decode($row->affectations->first()->customer->name), 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill; 
            $sum += ($row->salary+$row->prime)-($row->acompte+$row->sanction)-($row->salary+$row->prime)*($row->cnss+$row->rts)*0.01; 
            $tva += ($row->salary+$row->prime)*($row->cnss+$row->rts)*0.01; 
        }
        // Trait de terminaison
        $this->Cell(array_sum($w), 0, '', 'T', 1);
        $this->Ln(2);
        $this->SetFont('Arial', 'I', 10);
        foreach(array('TOTAL HT'=>moneyFormat($sum+$tva), 'TAXES (CNSS & RTS)'=>moneyFormat($tva), 'MONTANT TTC'=>moneyFormat($sum)) as $key => $item)
        {
            $this->setX(115);
            $this->Cell(40, 9, $key, 'LRT', 0, 'L', $fill);
            $this->Cell(45, 9, utf8_decode($item), 'LRT', 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        $this->setX(115);
        $this->Cell(85, 0, '', 'T');
        $this->Ln(5);
        $this->setX(160);
        $this->Cell(80, 0, 'PDG', '');
        // $this->Image('images/signature_pdg.png', 140, $this->getY()+3, 70, 0);
    }
    
    function getHiredAffected($header, $data)
    {
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(150, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('','IB');
        // En-tête
        $w = [8, 88, 75, 18];
        for($i=0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, utf8_decode($header[$i]), 1, 0, 'C', true);
        $this->Ln();
        // Restauration des couleurs et de la police
        $this->SetFillColor(224, 215, 215);
        $this->SetTextColor(0);
        $this->SetLineWidth(.1);
        $this->SetFont('');
        // Données
        $fill = false;
        $this->SetFont('Arial', 'I', 8);
        $sum = 0; $tva = 0;
        foreach($data as $key => $row)
        {
            $this->Cell($w[0], 6, ++$key, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, utf8_decode($row->firstname." ".$row->name." (".$row->matricule.")"), 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, utf8_decode($row->affectations->first()->customer->name), 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, utf8_decode(date('d/m/Y', strtotime($row->affectations->first()->created_at))), 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill; 
        }
        // Trait de terminaison
        $this->Cell(array_sum($w), 0, '', 'T', 1);
        $this->Ln(5);
        $this->setX(160);
        $this->Cell(80, 0, 'PDG', '');
        // $this->Image('images/signature_pdg.png', 140, $this->getY()+3, 70, 0);
    }
    
    function getApplicant($header, $data)
    {
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(150, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('','IB');
        // En-tête
        $w = [8, 88, 75, 18];
        for($i=0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, utf8_decode($header[$i]), 1, 0, 'C', true);
        $this->Ln();
        // Restauration des couleurs et de la police
        $this->SetFillColor(224, 215, 215);
        $this->SetTextColor(0);
        $this->SetLineWidth(.1);
        $this->SetFont('');
        // Données
        $fill = false;
        $this->SetFont('Arial', 'I', 8);
        $sum = 0; $tva = 0;
        foreach($data as $key => $row)
        {
            $this->Cell($w[0], 6, ++$key, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, utf8_decode($row->firstname." ".$row->name." (".$row->applicationid.")"), 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, utf8_decode($row->phone." / ".$row->address), 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, utf8_decode(date('d/m/Y', strtotime($row->created_at))), 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill; 
        }
        // Trait de terminaison
        $this->Cell(array_sum($w), 0, '', 'T', 1);
        $this->Ln(5);
        $this->setX(160);
        $this->Cell(80, 0, 'PDG', '');
        // $this->Image('images/signature_pdg.png', 140, $this->getY()+3, 70, 0);
    }
    
    function getPartners($header, $data)
    {
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(150, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('','IB');
        // En-tête
        $w = [8, 82, 63, 12, 25];
        for($i=0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, utf8_decode($header[$i]), 1, 0, 'C', true);
        $this->Ln();
        // Restauration des couleurs et de la police
        $this->SetFillColor(224, 215, 215);
        $this->SetTextColor(0);
        $this->SetLineWidth(.1);
        $this->SetFont('');
        // Données
        $fill = false;
        $this->SetFont('Arial', 'I', 8);
        $sum = 0; $affectation = 0;
        foreach($data as $key => $row)
        {
            $this->Cell($w[0], 6, ++$key, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, utf8_decode($row->name), 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, utf8_decode(substr($row->phone." / ".$row->address, 0, 38)), 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, utf8_decode($row->affectations->count()), 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, utf8_decode(moneyFormat($row->amount)), 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill; 
            $sum += $row->amount;
            $affectation += $row->affectations->count();
        }
        $this->Cell(153, 9, utf8_decode("TOTAL"), 'LRT', 0, 'L', $fill);
        $this->Cell(12, 9, utf8_decode($affectation), 'LRT', 0, 'C', $fill);
        $this->Cell(25, 9, utf8_decode(moneyFormat($sum)), 'LRT', 0, 'C', $fill);
        $this->Ln();
        // Trait de terminaison
        $this->Cell(array_sum($w), 0, '', 'T', 1);
        $this->Ln(5);
        $this->setX(160);
        $this->Cell(80, 0, 'PDG', '');
        // $this->Image('images/signature_pdg.png', 140, $this->getY()+3, 70, 0);
    }
    
    function getAppointments($header, $data)
    {
        // Couleurs, épaisseur du trait et police grasse
        $this->SetFillColor(150, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(0, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('','IB');
        // En-tête
        $w = [8, 56, 45, 18, 31, 35];
        for($i=0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, utf8_decode($header[$i]), 1, 0, 'C', true);
        $this->Ln();
        // Restauration des couleurs et de la police
        $this->SetFillColor(224, 215, 215);
        $this->SetTextColor(0);
        $this->SetLineWidth(.1);
        $this->SetFont('');
        // Données
        $fill = false;
        $this->SetFont('Arial', 'I', 8);
        $sum = 0; $affectation = 0;
        foreach($data as $key => $row)
        {
            $this->Cell($w[0], 6, ++$key, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, utf8_decode($row->visitor), 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, utf8_decode($row->company), 'LR', 0, 'L', $fill);
            $this->Cell($w[3], 6, utf8_decode(date('d/m/Y', strtotime($row->expected_at))), 'LR', 0, 'L', $fill);
            $this->Cell($w[4], 6, utf8_decode($row->start_time." A ".$row->end_time), 'LR', 0, 'L', $fill);
            $this->Cell($w[5], 6, utf8_decode(""), 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill; 
        }
        // Trait de terminaison
        $this->Cell(array_sum($w), 0, '', 'T', 1);
        $this->Ln(5);
        $this->setX(160);
        $this->Cell(80, 0, 'PDG', '');
        // $this->Image('images/signature_pdg.png', 140, $this->getY()+3, 70, 0);
    }
}