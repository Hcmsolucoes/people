<?php
$client = new SoapClient('http://201.94.148.59:8080/g5-senior-services/rubi_Synccom_senior_g5_rh_fp_relatorios?wsdl');
 
$function = 'Relatorios';
 
$arguments= array('Relatorios' => array(
                        'user'   => senior,
                        'password'   => 'senior',
                        'password'   => 'senior',
                        'encryption'      => 0,
                        'encryption'      => 0,
                        'parameters'        => array(
                                            'prExecFmt'=> 'tefFile',
                                            'prFileName'=> 'relatoriotestes',
                                            'prRelatorio'=> 'FPRE300.COL',
                                            'prFileExt'=> '<![CDATA[Arquivo Formato PDF]]>',
                                            'prSaveFormat'=> 'tsfPDF',
					    'prEntranceIsXML'=> 'F',
					    'prEntrada'=> '<![CDATA[<EAbrCad=32,2,24><EAbrEmp=1><EAbrTcl=1>]]>')

                ));
$options = array('location' => 'http://201.94.148.59:8080/g5-senior-services/rubi_Synccom_senior_g5_rh_fp_relatorios');
 
$result = $client->__soapCall($function, $arguments, $options);
 
echo 'Response: ';
print_r($result);
?>