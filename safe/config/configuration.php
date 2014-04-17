<?php

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'db'=> array('connections'=> array(                            
                                        'local' => 'mysql://root:49421702@localhost/sfc_carga',
 					'production' => 'mysql://root:RootMYSQL00!@localhost/sfc_carga',
                                      ),
        
                 'useConnection'=>'local',
                 'charset'=>'utf8',
                 ),
   'modules' => array(     
        'users',
        'awbs',
        'posiciones',
        'vuelos',
       
    ),
     'params' => array(
        'profiles' => array('SUPER' => 1,
                            'ADMIN' => 2,
                            
        )
    )
   
);
?>
