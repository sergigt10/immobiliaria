<?php
  class Usuari {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Login usuari
    public function login($username, $password){
      $this->db->query('SELECT * FROM usuari WHERE email = :nom_usuari');
      $this->db->bind(':nom_usuari', $username);

      $row = $this->db->single();

      $hashed_password = $row->contrasenya;
      if(password_verify($password, $hashed_password) && $row->activat == 1){
        return $row;
      } else {
        return false;
      }
    }

    // Get all usuaris
    public function getUsuaris(){
      $this->db->query('SELECT * FROM usuari');
      // Bind value
      $results = $this->db->resultSet();

      return $results;
    }

    // Find usuari by username
    public function findUsuariByUsername($username){
      $this->db->query('SELECT * FROM usuari WHERE email = :nom_usuari');
      // Bind value
      $this->db->bind(':nom_usuari', $username);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }

    // Is activate by id
    public function getIsActivateById($id){
      $this->db->query('SELECT * FROM usuari WHERE id = :id && activat = 1');
      // Bind value
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }

    // Get usuari by id
    public function getUsuariById($id){
      $this->db->query('SELECT * FROM usuari WHERE id = :id');
      // Bind value
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    // Is admin by id
    public function getIsAdminById($id){
      $this->db->query('SELECT * FROM usuari WHERE id = :id && es_admin = 1');
      // Bind value
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    // Get max immobles by usuari
    public function getMaxImmobleByUser($id){
      $this->db->query(' SELECT max_immobles AS total_max_immobles FROM usuari WHERE id = :id ');
      // Bind value
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    // Add new usuari
    public function add($data){
      $this->db->query('INSERT INTO usuari (email, contrasenya, nom_cognoms, empresa, direccio, poblacio, codi_postal, telefon, web, descripcio_cat, descripcio_esp, descripcio_eng, logo, max_immobles, max_fotos, activat) VALUES (:email, :contrasenya, :nom_cognoms, :empresa, :direccio, :poblacio, :codi_postal, :telefon, :web, :descripcio_cat, :descripcio_esp, :descripcio_eng, :logo, :max_immobles, :max_fotos, :activat)');
      // Bind values
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':contrasenya', $data['contrasenya']);
      $this->db->bind(':nom_cognoms', $data['nom_cognoms']);
      $this->db->bind(':empresa', $data['empresa']);
      $this->db->bind(':direccio', $data['direccio']);
      $this->db->bind(':poblacio', $data['poblacio']);
      $this->db->bind(':codi_postal', $data['codi_postal']);
      $this->db->bind(':telefon', $data['telefon']);
      $this->db->bind(':web', $data['web']);
      $this->db->bind(':descripcio_cat', $data['descripcio_cat']);
      $this->db->bind(':descripcio_esp', $data['descripcio_esp']);
      $this->db->bind(':descripcio_eng', $data['descripcio_eng']);
      $this->db->bind(':logo', $data['logo']);
      $this->db->bind(':max_immobles', $data['max_immobles']);
      $this->db->bind(':max_fotos', $data['max_fotos']);
      $this->db->bind(':activat', $data['activat']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Update usuari
    public function update($data){
      $this->db->query('UPDATE usuari SET email = :email, contrasenya = :contrasenya, nom_cognoms = :nom_cognoms, empresa = :empresa, direccio = :direccio, poblacio = :poblacio, codi_postal = :codi_postal, telefon = :telefon, web = :web, descripcio_cat = :descripcio_cat, descripcio_esp = :descripcio_esp, descripcio_eng = :descripcio_eng, logo = :logo, max_immobles = :max_immobles, max_fotos = :max_fotos, activat = :activat WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':contrasenya', $data['contrasenya']);
      $this->db->bind(':nom_cognoms', $data['nom_cognoms']);
      $this->db->bind(':empresa', $data['empresa']);
      $this->db->bind(':direccio', $data['direccio']);
      $this->db->bind(':poblacio', $data['poblacio']);
      $this->db->bind(':codi_postal', $data['codi_postal']);
      $this->db->bind(':telefon', $data['telefon']);
      $this->db->bind(':web', $data['web']);
      $this->db->bind(':descripcio_cat', $data['descripcio_cat']);
      $this->db->bind(':descripcio_esp', $data['descripcio_esp']);
      $this->db->bind(':descripcio_eng', $data['descripcio_eng']);
      $this->db->bind(':logo', $data['logo']);
      $this->db->bind(':max_immobles', $data['max_immobles']);
      $this->db->bind(':max_fotos', $data['max_fotos']);
      $this->db->bind(':activat', $data['activat']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Delete usuari
    public function delete($id){
      $this->db->query('DELETE FROM usuari WHERE id = :id');
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