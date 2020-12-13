<?php
  class Immoble {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getImmobles(){
      $this->db->query('SELECT immoble.id, immoble.titol_cat, categoria.nom_cat AS categoria, poblacio.nom_cat AS poblacio, immoble.portada, immoble.activat, usuari.nom_cognoms AS usuari
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
      $this->db->query('SELECT immoble.id, immoble.titol_cat, categoria.nom_cat AS categoria, poblacio.nom_cat AS poblacio, immoble.portada, immoble.activat, usuari.nom_cognoms AS usuari
      FROM immoble
      INNER JOIN poblacio
          ON immoble.poblacio_id = poblacio.id
      INNER JOIN categoria
          ON immoble.categoria_id = categoria.id
      INNER JOIN usuari
          ON immoble.usuari_id = usuari.id
      WHERE immoble.usuari_id = '.$id.' 
      ORDER BY immoble.id');
      // Devuelve más de una fila
      $results = $this->db->resultSet();

      return $results;
    }

    public function getTotalImmobles($id){
      $this->db->query('');
      // Devuelve más de una fila
      $results = $this->db->resultSet();

      return $results;
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
      $this->db->query('UPDATE blog SET titol_cat = :titol_cat, id_tag = :id_tag, descripcio_cat = :descripcio_cat, imatge1 = :imatge1, imatge2 = :imatge2, imatge3 = :imatge3, imatge4 = :imatge4, imatge5 = :imatge5 WHERE id_blog = :id_blog');
      // Bind values
      $this->db->bind(':id_blog', $data['id_blog']);
      $this->db->bind(':titol_cat', $data['titol_cat']);
      $this->db->bind(':id_tag', $data['id_tag']);
      $this->db->bind(':descripcio_cat', $data['descripcio_cat']);
      $this->db->bind(':imatge1', $data['imatge1']);
      $this->db->bind(':imatge2', $data['imatge2']);
      $this->db->bind(':imatge3', $data['imatge3']);
      $this->db->bind(':imatge4', $data['imatge4']);
      $this->db->bind(':imatge5', $data['imatge5']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Get immoble by id
    public function getImmobleById($id){
      $this->db->query('SELECT * FROM immoble WHERE id = :id');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function deleteImmoble($id){
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