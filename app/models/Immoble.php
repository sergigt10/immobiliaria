<?php
  class Immoble {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Get immoble by id
    public function getImmobleById($id){
      $this->db->query('SELECT * FROM immoble WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function getImmobles(){
      $this->db->query('SELECT immoble.id, immoble.titol_cat, categoria.nom_cat AS categoria, poblacio.nom_cat AS poblacio, immoble.portada, immoble.activat, usuari.email AS usuari
        FROM immoble
        INNER JOIN poblacio
            ON immoble.poblacio_id = poblacio.id
        INNER JOIN categoria
            ON immoble.categoria_id = categoria.id
        INNER JOIN usuari
            ON immoble.usuari_id = usuari.id
        ORDER BY immoble.id'
      );
      // Devuelve más de una fila
      $results = $this->db->resultSet();

      return $results;
    }

    public function getImmoblesByUsuari($id){
      $this->db->query('SELECT immoble.id, immoble.titol_cat, categoria.nom_cat AS categoria, poblacio.nom_cat AS poblacio, immoble.portada, immoble.activat, usuari.email AS usuari
      FROM immoble
      INNER JOIN poblacio
          ON immoble.poblacio_id = poblacio.id
      INNER JOIN categoria
          ON immoble.categoria_id = categoria.id
      INNER JOIN usuari
          ON immoble.usuari_id = usuari.id
      WHERE immoble.usuari_id = :id 
      ORDER BY immoble.id');
      $this->db->bind(':id', $id);
      // Devuelve más de una fila
      $results = $this->db->resultSet();

      return $results;
    }

    public function getTotalImmoblesPortada(){
      $this->db->query('SELECT COUNT(id) AS total_portada FROM immoble WHERE portada = 1');
      $row = $this->db->single();

      return $row;
    }

    public function getTotalImmoblesByUser($id){
      $this->db->query(' SELECT COUNT(id) AS total_immobles FROM immoble WHERE usuari_id = :id ');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function disableAllImmoblesByUsuari($id){
      $this->db->query(' UPDATE immoble SET activat = 0 WHERE usuari_id = :id ');
      $this->db->bind(':id', $id);

      $this->db->execute();
    }

    public function enableAllImmoblesByUsuari($id){
      $this->db->query(' UPDATE immoble SET activat = 1 WHERE usuari_id = :id ');
      $this->db->bind(':id', $id);

      $this->db->execute();
    }

    public function eliminateAllImmoblesByUsuari($id){
      $this->db->query(' DELETE FROM immoble WHERE usuari_id = :id ');
      $this->db->bind(':id', $id);

      $this->db->execute();
    }

    public function add($data){
      $this->db->query('INSERT INTO immoble (titol_cat, titol_esp, titol_eng, slug_cat, slug_esp, slug_eng, descripcio_cat, descripcio_esp, descripcio_eng, imatge_1, imatge_2, imatge_3, imatge_4, imatge_5, imatge_6, imatge_7, imatge_8, imatge_9, imatge_10, portada, preu, habitacio, banys, tamany, activat, poblacio_id, categoria_id, caracteristica_id, usuari_id) VALUES (:titol_cat, :titol_esp, :titol_eng, :slug_cat, :slug_esp, :slug_eng, :descripcio_cat, :descripcio_esp, :descripcio_eng, :imatge1, :imatge2, :imatge3, :imatge4, :imatge5, :imatge6, :imatge7, :imatge8, :imatge9, :imatge10, :portada, :preu, :habitacio, :banys, :tamany, :activat, :poblacio_id, :categoria_id, :caracteristica_id, :usuari_id)');
      // Bind values
      $this->db->bind(':titol_cat', $data['titol_cat']);
      $this->db->bind(':titol_esp', $data['titol_esp']);
      $this->db->bind(':titol_eng', $data['titol_eng']);
      $this->db->bind(':slug_cat', $data['slug_cat']);
      $this->db->bind(':slug_esp', $data['slug_esp']);
      $this->db->bind(':slug_eng', $data['slug_eng']);
      $this->db->bind(':descripcio_cat', $data['descripcio_cat']);
      $this->db->bind(':descripcio_esp', $data['descripcio_esp']);
      $this->db->bind(':descripcio_eng', $data['descripcio_eng']);
      $this->db->bind(':imatge1', $data['imatge1']);
      $this->db->bind(':imatge2', $data['imatge2']);
      $this->db->bind(':imatge3', $data['imatge3']);
      $this->db->bind(':imatge4', $data['imatge4']);
      $this->db->bind(':imatge5', $data['imatge5']);
      $this->db->bind(':imatge6', $data['imatge6']);
      $this->db->bind(':imatge7', $data['imatge7']);
      $this->db->bind(':imatge8', $data['imatge8']);
      $this->db->bind(':imatge9', $data['imatge9']);
      $this->db->bind(':imatge10', $data['imatge10']);
      $this->db->bind(':portada', $data['portada']);
      $this->db->bind(':preu', $data['preu']);
      $this->db->bind(':habitacio', $data['habitacio']);
      $this->db->bind(':banys', $data['banys']);
      $this->db->bind(':tamany', $data['tamany']);
      $this->db->bind(':activat', $data['activat']);
      $this->db->bind(':poblacio_id', $data['poblacio_id']);
      $this->db->bind(':categoria_id', $data['categoria_id']);
      $this->db->bind(':caracteristica_id', $data['caracteristica_id']);
      $this->db->bind(':usuari_id', $data['usuari_id']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function update($data){
      $this->db->query('UPDATE immoble SET titol_cat = :titol_cat, titol_esp = :titol_esp, titol_eng = :titol_eng, slug_cat = :slug_cat, slug_esp = :slug_esp, slug_eng = :slug_eng, descripcio_cat = :descripcio_cat, descripcio_esp = :descripcio_esp, descripcio_eng = :descripcio_eng, imatge_1 = :imatge1, imatge_2 = :imatge2, imatge_3 = :imatge3, imatge_4 = :imatge4, imatge_5 = :imatge5, imatge_6 = :imatge6, imatge_7 = :imatge7, imatge_8 = :imatge8, imatge_9 = :imatge9, imatge_10 = :imatge10, portada = :portada, preu = :preu, habitacio = :habitacio, banys = :banys, tamany = :tamany, activat = :activat, poblacio_id = :poblacio_id, categoria_id = :categoria_id, caracteristica_id = :caracteristica_id, usuari_id = :usuari_id WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':titol_cat', $data['titol_cat']);
      $this->db->bind(':titol_esp', $data['titol_esp']);
      $this->db->bind(':titol_eng', $data['titol_eng']);
      $this->db->bind(':slug_cat', $data['slug_cat']);
      $this->db->bind(':slug_esp', $data['slug_esp']);
      $this->db->bind(':slug_eng', $data['slug_eng']);
      $this->db->bind(':descripcio_cat', $data['descripcio_cat']);
      $this->db->bind(':descripcio_esp', $data['descripcio_esp']);
      $this->db->bind(':descripcio_eng', $data['descripcio_eng']);
      $this->db->bind(':imatge1', $data['imatge1']);
      $this->db->bind(':imatge2', $data['imatge2']);
      $this->db->bind(':imatge3', $data['imatge3']);
      $this->db->bind(':imatge4', $data['imatge4']);
      $this->db->bind(':imatge5', $data['imatge5']);
      $this->db->bind(':imatge6', $data['imatge6']);
      $this->db->bind(':imatge7', $data['imatge7']);
      $this->db->bind(':imatge8', $data['imatge8']);
      $this->db->bind(':imatge9', $data['imatge9']);
      $this->db->bind(':imatge10', $data['imatge10']);
      $this->db->bind(':portada', $data['portada']);
      $this->db->bind(':preu', $data['preu']);
      $this->db->bind(':habitacio', $data['habitacio']);
      $this->db->bind(':banys', $data['banys']);
      $this->db->bind(':tamany', $data['tamany']);
      $this->db->bind(':activat', $data['activat']);
      $this->db->bind(':poblacio_id', $data['poblacio_id']);
      $this->db->bind(':categoria_id', $data['categoria_id']);
      $this->db->bind(':caracteristica_id', $data['caracteristica_id']);
      $this->db->bind(':usuari_id', $data['usuari_id']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    public function delete($id){
      $this->db->query('DELETE FROM immoble WHERE id = :id');
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