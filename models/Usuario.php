<?php

namespace Model;

class Usuario extends ActiveRecord
{
   protected static $tabla = 'user';

   //este arreglo permite identificar que columnas tendran los registros
   protected static $columnasDB = ['id', 'fullname', 'email', 'pass', 'openid', 'creation_date', 'update_date'];

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

   public function validate()
   {
      //    if(!$this->fullname){
      //       self::$errores[] = "Full name required";
      //   }
      if (!$this->email) {
         self::$errores[] = "Email required";
      }
      if (!$this->pass) {
         self::$errores[] = "Pass required";
      }
      //    if(!$this->openid){
      //       self::$errores[] = "Openid required";
      //   }

      return self::$errores;
   }

   public function exists()
   {
      //Revisar si un usuario existe
      $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

      $resultado = self::$db->query($query);

      if (!$resultado->num_rows) {
         self::$errores[] = "El usuario no existe";
         return;
      }
      return $resultado;
   }

   public function validatePass($resultado)
   {
      $usuario = $resultado->fetch_object(); //resultado es una instancia de $db o de la base de datos tenemos acceso al metodo fetch_object el cual va a retornar lo que encuentre en la base de datos

      //debuguear($usuario); retorna el id, email y contraseña 

      if ($this->pass === $usuario->pass) {
         return true;
      } else {
         self::$errores[] = 'La contraseña es incorrecta';
         return false;
      }
   }

   public function authenticate()
   {
      if (session_status() === PHP_SESSION_NONE) {
         session_start();
      }

      $query = "SELECT id, fullname FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
      $resultado = self::$db->query($query);

      if ($resultado->num_rows > 0) {
         $usuario = $resultado->fetch_assoc();
         $_SESSION['fullname'] = $usuario['fullname'];
         $_SESSION['id'] = $usuario['id'];
         $_SESSION['login'] = true;
         header('Location: /home');
      } else {
         // Error al obtener los datos del usuario
         $_SESSION = []; // Limpiar la sesión
         $errores[] = "Error al autenticar al usuario";
         header('Location: /home');
      }
   }
}
