<?php
  class Operacio {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getOperacions(){
      $this->db->query('SELECT * FROM operacio ORDER BY id ASC');
      // Devuelve más de una fila
      $results = $this->db->resultSet();

      return $results;
    }

    public function getOperacionsActives(){
      $this->db->query('SELECT * FROM operacio WHERE activat = 1 ORDER BY id ASC');
      // Devuelve más de una fila
      $results = $this->db->resultSet();

      return $results;
    }

    // Get operació by id
    public function getOperacioById($id){
      $this->db->query('SELECT * FROM operacio WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function add($data){
      $this->db->query('INSERT INTO operacio (nom_cat, nom_esp, nom_eng, activat) VALUES(:nom_cat, :nom_esp, :nom_eng, :activat)');
      // Bind values
      $this->db->bind(':nom_cat', $data['nom_cat']);
      $this->db->bind(':nom_esp', $data['nom_esp']);
      $this->db->bind(':nom_eng', $data['nom_eng']);
      $this->db->bind(':activat', $data['activat']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function update($data){
      $this->db->query('UPDATE operacio SET nom_cat = :nom_cat, nom_esp = :nom_esp, nom_eng = :nom_eng, activat = :activat WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':nom_cat', $data['nom_cat']);
      $this->db->bind(':nom_esp', $data['nom_esp']);
      $this->db->bind(':nom_eng', $data['nom_eng']);
      $this->db->bind(':activat', $data['activat']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function delete($id){
      $this->db->query('DELETE FROM operacio WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

  }