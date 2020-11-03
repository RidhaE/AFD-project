<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\Entity\ContentFile;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('validatebyType', [$this, 'validatebyType']),
            new TwigFunction('validateall', [$this, 'validateall']),
        ];
    }

    public function validatebyType(string $type, ContentFile $data)
    {
         
         if ($type == 'nomprenon') {
                if ($this->verif_alpha(($data->getNomprenon())) && (strlen(trim($data->getNomprenon()))  <= 24)) { 
                    return true;
                } else { 
                    return false;
                }
            }
   

            if ($type == 'codebancque') {
                if (is_numeric($data->getCodebancque()) && (strlen(trim($data->getCodebancque()))  <= 5) ) { 
                    return true;
                } else { 
                    return false;
                }
            }
      

            if ($type == 'codeguichet') {
                if (is_numeric($data->getCodeguichet()) && (strlen(trim($data->getCodeguichet()))  <= 5) ) { 
                    return true;
                } else { 
                    return false;
                }
             }
     

             if ($type == 'numcompte') {
                if (is_numeric($data->getNumcompte()) && (strlen(trim($data->getNumcompte()))  <= 11) ) { 
                    return true;
                } else { 
                    return false;
                }
            }
    

            if ($type == 'montant') {
                if (is_numeric($data->getMontant()) && (strlen(trim($data->getMontant()))  <= 16) ) { 
                    return true;
                } else { 
                    return false;
                }
             }

             if ($type == 'motif') {
                if (strlen(trim($data->getMotif()))  <= 32 ) { 
                    return true;
                } else { 
                    return false;
                }    
             }   
      
    }

    public function validateall( ContentFile $data)
    {
         
        if 
        (
            $this->verif_alpha(($data->getNomprenon())) && (strlen(trim($data->getNomprenon()))  <= 24)
            && (is_numeric($data->getCodebancque()) && (strlen(trim($data->getCodebancque()))  <= 5))
            && (is_numeric($data->getCodeguichet()) && (strlen(trim($data->getCodeguichet()))  <= 5))
            && (is_numeric($data->getNumcompte()) && (strlen(trim($data->getNumcompte()))  <= 11))
            && (is_numeric($data->getMontant()) && (strlen(trim($data->getMontant()))  <= 16))
            && (strlen(trim($data->getMotif()))  <= 32)
        ) { 
            return true;
        } else { 
            return false;
        }
         
      
    }

    private  function verif_alpha($str){
        // On cherche tt les caractères autre que [A-z]
        preg_match("/([^A-Za-z\s])/",$str,$result);
        // si on trouve des caractère autre que A-z
        if(!empty($result)){
          return false;
        }
        return true;
      }
}