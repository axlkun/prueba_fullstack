<?php
namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'user';

//este arreglo permite identificar que columnas tendran los registros
   protected static $columnasDB = ['id','fullname','email','pass','openid','creation_date','update_date'];

   public $id;
   public $fullname;
   public $email;
   public $pass;
   public $openid;
   public $creation_date;
   public $update_date;

   public function __construct($args = [])
   {

      $this->id = $args['id'] ?? null;
      $this->fullname = $args['fullname'] ?? '';
      $this->email = $args['email'] ?? '';
      $this->pass = $args['pass'] ?? '';
      $this->openid = $args['openid'] ?? '';
      $this->creation_date = $args['creation_date'] ?? date('Y-m-d H:i:s');
      $this->update_date = date('Y-m-d H:i:s');
   }

   public function validate(){
      if(!$this->fullname){
         self::$errores[] = "Full name required";
     }
      if(!$this->email){
         self::$errores[] = "Email required";
     }
      if(!$this->pass){
         self::$errores[] = "Pass required";
     }
      if(!$this->openid){
         self::$errores[] = "Openid required";
     }

     return self::$errores;
   }

}