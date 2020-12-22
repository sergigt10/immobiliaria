<?php
  class Certificat {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getCertificats(){
      $this->db->query('SELECT * FROM certificat ORDER BY id ASC');
      // Devuelve más de una fila
      $results = $this->db->resultSet();

      return $results;
    }

    public function getCertificatsActivats(){
      $this->db->query('SELECT * FROM certificat WHERE activat = 1 ORDER BY id ASC');
      // Devuelve más de una fila
      $results = $this->db->resultSet();

      return $results;
    }

    // Get certificat by id
    public function getCertificatById($id){
      $this->db->query('SELECT * FROM certificat WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function add($data){
      $this->db->query('INSERT INTO certificat (nom_cat, activat) VALUES(:nom_cat, :activat)');
      // Bind values
      $this->db->bind(':nom_cat', $data['nom_cat']);
      $this->db->bind(':activat', $data['activat']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function update($data){
      $this->db->query('UPDATE certificat SET nom_cat = :nom_cat, activat = :activat WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':nom_cat', $data['nom_cat']);
      $this->db->bind(':activat', $data['activat']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function delete($id){
      $this->db->query('DELETE FROM certificat WHERE id = :id');
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