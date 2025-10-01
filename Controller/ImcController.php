<?php

namespace Controller;

use Model\Imcs;

use Exception;

class ImcController
{
    private $imcsModel;

    public function __construct(Imcs $imcsModel)
    {
        $this->imcsModel = $imcsModel;
    }

    // CALCULO E CLASSIFICAÇÃO
    public function calculateImc($weight,$height)
    {
        try {

            $result = [];
            if (isset($weight) or isset($height)) {
                if ($weight > 0 and $height > 0) {
                    $imc = round($weight / ($height * $height), 2);
                    $result['imc'] = $imc;

                    // switch (true) {
                    //     case ($imc < 18.5):
                    //         $result["BMIrange"] = "Baixo peso";
                    //         break;
                    //     case ($imc >= 18.5 and $imc < 25):
                    //         $result["BMIrange"] = "Peso normal";
                    //         break;
                    //     case ($imc >= 25 and $imc < 30):
                    //         $result["BMIrange"] = "Sobrepeso";
                    //         break;
                    //     case ($imc >= 30 and $imc < 35):
                    //         $result["BMIrange"] = "Obesidade grau I";
                    //         break;
                    //     case ($imc >= 35 and $imc < 40):
                    //         $result["BMIrange"] = "Obesidade grau II";
                    //         break;
                    //     default:
                    //         $result["BMIrange"] = "Obesidade grau III";
                    //         break;
                    // }

                    $result["BMIrange"] = match (true) {
                        $imc < 18.5 => "Baixo peso",
                        $imc >= 18.5 and $imc < 25 => "Peso normal",
                        $imc >= 25 and $imc < 30 => "Sobrepeso",
                        $imc >= 30 and $imc < 35 => "Obesidade grau I",
                        $imc >= 35 and $imc < 40 => "Obesidade grau II",
                        $imc >= 40 and $imc < 45 => "Obesidade grau III",
                        default => "Obesidade grau III"
                    };

                } else {
                    $result["BMIrange"] = "O peso e a altura devem conter valores positivos";
                }

                return $result;

            } else {
                $result["BMIrange"] = "Por favor, informe peso e altura para obter o seu IMC.";
            }

        } catch (Exception $error) {
            echo "Erro ao calcular IMC: " . $error->getMessage();
            return false;
        }
    }

    // SALVAR IMC NA TABELA imcs
    public function saveIMC($weight, $height, $IMCresult) {
        return $this->imcsModel->createImc($weight, $height, $IMCresult);
    }
}


?>