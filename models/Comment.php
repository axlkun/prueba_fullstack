<?php
namespace Model;

class Comment extends ActiveRecord{

    protected static $tabla = 'user_comment';

//este arreglo permite identificar que columnas tendran los registros
   protected static $columnasDB = ['id','user','coment_text','likes','creation_date','update_date'];

   public $id;
   public $user; //fk
   public $fullname;
   public $coment_text;
   public $likes;
   public $creation_date;
   public $update_date;

   public function __construct($args = [])
   {
      $this->id = $args['id'] ?? null;
      $this->user = $args['user'] ?? '';
      $this->fullname = $args['fullname'] ?? '';
      $this->coment_text = $args['coment_text'] ?? '';
      $this->likes = $args['likes'] ?? '';
      $this->creation_date = $args['creation_date'] ?? date('Y-m-d H:i:s');
      $this->update_date = date('Y-m-d H:i:s');
   }

   public function validate(){
      if(!$this->user){
         self::$errores[] = "User is required";
     }
      if(!$this->coment_text){
         self::$errores[] = "Text is required";
     }
      if(!$this->likes){
         self::$errores[] = "Likes required";
     }

     return self::$errores;
   }

}