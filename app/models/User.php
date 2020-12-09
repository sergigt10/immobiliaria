<?php
  class User {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    /*  
      USUARI
    */

    // Login User
    public function login($username, $password){
      $this->db->query('SELECT * FROM usuari WHERE email = :nom_usuari');
      $this->db->bind(':nom_usuari', $username);

      $row = $this->db->single();

      $hashed_password = $row->contrasena;
      if(password_verify($password, $hashed_password) && $row->activat == 1){
        return $row;
      } else {
        return false;
      }
    }

    // Regsiter user
    public function register($data){
      $this->db->query('INSERT INTO usuari (email, contrasena, nom_cognoms, empresa, direccio, poblacio, codi_postal, telefon, web, descripcio_cat, descripcio_esp, descripcio_eng, logo, max_immobles, max_fotos, activat) VALUES(:email, :contrasena, :nom_cognoms, :empresa, :direccio, :poblacio, :codi_postal, :telefon, :web, :descripcio_cat, :descripcio_esp, :descripcio_eng, :logo, :max_immobles, :max_fotos, :activat)');
      // Bind values
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':contrasena', $data['contrasena']);
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

    // Find user by username
    public function findUserByUsername($username){
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
      $results = $this->db->resultSet();

      // Bind value
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    // Is activate ?
    public function getIsActivate(){
      $this->db->query('SELECT * FROM usuari WHERE activat = 1');
      $results = $this->db->resultSet();

      return $results;
    }

    // Get User by ID
    public function getUserById($id){
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

  }