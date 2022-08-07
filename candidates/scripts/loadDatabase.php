<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->initDatabaseMaps(array (
  'candidates' => 
  array (
    0 => '\\Map\\CandidateTableMap',
    1 => '\\Map\\CategoryTableMap',
  ),
));
