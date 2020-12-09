<?php
  class Menu {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getMenus(){
      $this->db->query('SELECT * FROM menu ORDER BY id_menu ASC');
      // Devuelve más de una fila
      $results = $this->db->resultSet();

      return $results;
    }

    public function addMenu($data){
      $this->db->query('INSERT INTO menu (primers, segons, postres, preu, dia) VALUES(:primers, :segons, :postres, :preu, :dia)');
      // Bind values
      $this->db->bind(':primers', $data['primers']);
      $this->db->bind(':segons', $data['segons']);
      $this->db->bind(':postres', $data['postres']);
      $this->db->bind(':preu', $data['preu']);
      $this->db->bind(':dia', $data['dia']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function updateMenu($data){
      $this->db->query('UPDATE menu SET primers = :primers, segons = :segons, postres = :postres, preu = :preu, dia = :dia  WHERE id_menu = :id_menu');
      // Bind values
      $this->db->bind(':id_menu', $data['id_menu']);
      $this->db->bind(':primers', $data['primers']);
      $this->db->bind(':segons', $data['segons']);
      $this->db->bind(':postres', $data['postres']);
      $this->db->bind(':preu', $data['preu']);
      $this->db->bind(':dia', $data['dia']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Obtener post con la id
    public function getMenuById($id){
      $this->db->query('SELECT * FROM menu WHERE id_menu = :id_menu');
      $this->db->bind(':id_menu', $id);

      $row = $this->db->single();

      return $row;
    }

    public function deleteMenu($id){
      $this->db->query('DELETE FROM menu WHERE id_menu = :id_menu');
      // Bind values
      $this->db->bind(':id_menu', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }