<?php

namespace Model;

class ActiveRecord
{
   protected static $db;

   protected static $tabla = '';

   protected static $columnasDB = [];

   protected static $errores = [];

   //definir la conexion a la BD
   public static function setDB($database)
   {
      self::$db = $database;
   }

   public function store()
   {
      // prevenir inyeccion
      $atributos = $this->santizarAtributos();

      $llaves = join(', ', array_keys($atributos));
      $valores = join("', '", array_values($atributos));

      $query = "INSERT INTO " . static::$tabla . " ( ";
      $query .= $llaves;
      $query .= " ) VALUES (' ";
      $query .= $valores;
      $query .= " ')";

      try {

         return self::$db->query($query);
      } catch (\mysqli_sql_exception $e) {

         return false;
      }
   }

   public function update()
   {
      $atributos = $this->santizarAtributos();

      $valores = [];

      foreach ($atributos as $key => $value) {
         $valores[] = "{$key}='{$value}'";
      }

      $query = "UPDATE " . static::$tabla . " SET ";
      $query .= join(', ', $valores);
      $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
      $query .= " LIMIT 1";

      try {

         return self::$db->query($query);

      } catch (\mysqli_sql_exception $e) {

         return false;
      }
   }

   public function destroy()
   {
      $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

      try {

         return self::$db->query($query);

      } catch (\mysqli_sql_exception $e) {

         return false;
      }
   }

   //une los nombres columnasDB con su valor registrado en el objeto
   public function atributos()
   {
      $atributos = [];

      foreach (static::$columnasDB as $columna) {
         //ignora la columna id por que todavia no la tenemos (se genera automaticamente en la BDD)
         if ($columna === 'id') continue;
         $atributos[$columna] = $this->$columna;
      }
      return $atributos;
   }

   public function santizarAtributos()
   {
      $atributos = $this->atributos();

      //arreglo donde se almacenaran los datos ya sanitizados los cuales se ingresarán a la base de datos
      $sanitizado = [];

      foreach ($atributos as $key => $value) {

         //escape_string previene de sql injection
         $sanitizado[$key] = self::$db->escape_string($value);
      }
      return $sanitizado;
   }

   // va a la clase a retornar el array errores
   public function validar()
   {
      static::$errores = []; //limpiar arreglo
      return static::$errores;
   }

   // buscar un registro por id
   public static function find($id)
   {
      $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";
      $resultado = self::consultarSQL($query);
      return array_shift($resultado); //primer elemento de un array
   }

   public static function allComments(){
      
      $query = "SELECT uc.id, u.fullname, uc.coment_text, uc.likes
      FROM user u
      JOIN user_comment uc ON u.id = uc.user";

      $resultado = self::consultarSQL($query);

      return $resultado;
   }



   public static function consultarSQL($query)
   {
      //Consultar la base de datos
      $resultado = self::$db->query($query);

      $array = [];

      //Retorna un arreglo asociativo, por eso llamamos una funcion que convierte ese registro en un objeto y se lo asigna al array, por lo tanto tendriamos un array de objetos
      while ($registro = $resultado->fetch_assoc()) {
         $array[] = static::crearObjeto($registro);
      }

      //Liberar la memoria
      $resultado->free();

      //Retornar los resultados
      return $array;
   }

   //Active record trabaja con Objetos no con arreglos, entonces convertimos el arreglo arrojado por la consulta a un objeto
   protected static function crearObjeto($registro)
   {
      $objeto = new static; //Nuevo objeto de la clase heredada (usuario/comentario) de acuerdo a los atributos de su constructor

      foreach ($registro as $key => $value) {
         if (property_exists($objeto, $key)) { //detectar la $key y añadirle su $value
            $objeto->$key = $value;
         }
      }

      return $objeto;
   }

   //Actualiza el objeto en memoria con los nuevos valores recibidos
   public function updateObject($args = [])
   {
      //reescribe los valores recibidos en el objeto actual
      foreach ($args as $key => $value) {
         if (property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
         }
      }
   }
}
