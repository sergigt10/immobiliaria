<?php
  class Poblacio {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getPoblacions(){
      $this->db->query('SELECT * FROM poblacio ORDER BY id ASC');
      // Devuelve más de una fila
      $results = $this->db->resultSet();

      return $results;
    }

    public function getPoblacionsWithProvincies(){
      $this->db->query('SELECT poblacio.id, poblacio.nom_cat AS poblacio, provincia.nom_cat AS provincia 
      FROM poblacio
      INNER JOIN provincia
        ON poblacio.provincia_id = provincia.id
      WHERE poblacio.activat = 1
      ORDER BY id ASC');
      // Devuelve más de una fila
      $results = $this->db->resultSet();

      return $results;
    }

    // Get poblacio by id
    public function getPoblacioById($id){
      $this->db->query('SELECT * FROM poblacio WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function add($data){
      $this->db->query('INSERT INTO poblacio (nom_cat, activat, provincia_id) VALUES(:nom_cat, :activat, :provincia_id)');
      // Bind values
      $this->db->bind(':nom_cat', $data['nom_cat']);
      $this->db->bind(':activat', $data['activat']);
      $this->db->bind(':provincia_id', $data['provincia_id']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function update($data){
      $this->db->query('UPDATE poblacio SET nom_cat = :nom_cat, activat = :activat, provincia_id = :provincia_id WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':nom_cat', $data['nom_cat']);
      $this->db->bind(':activat', $data['activat']);
      $this->db->bind(':provincia_id', $data['provincia_id']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function delete($id){
      $this->db->query('DELETE FROM poblacio WHERE id = :id');
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