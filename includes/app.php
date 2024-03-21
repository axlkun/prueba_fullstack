<?php

require_once 'config/database.php';
require_once 'helpers.php';
require_once '../models/ActiveRecord.php';

//Conectarnos a la BDD
$db = connectDB();
 
use Model\ActiveRecord;

//Se crea un nuevo objeto. No requiere instancia por que el metodo y el atributo al que hace referencia son estaticos.
ActiveRecord::setDB($db);
