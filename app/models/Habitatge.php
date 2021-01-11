<?php
  class Habitatge {
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

    public function getImmobleDetallById($id){
      $this->db->query('SELECT immoble.id as id_immoble, immoble.titol_cat, immoble.titol_esp, immoble.titol_eng, immoble.referencia, immoble.descripcio_cat, immoble.descripcio_esp, immoble.descripcio_eng, immoble.imatge_1, immoble.imatge_2, immoble.imatge_3, immoble.imatge_4, immoble.imatge_5, immoble.imatge_6, immoble.imatge_7, immoble.imatge_8, immoble.imatge_9, immoble.imatge_10, immoble.preu, immoble.habitacio, immoble.banys, immoble.tamany, immoble.activat, immoble.caracteristica_id, immoble.operacio_id, immoble.poblacio_id, immoble.categoria_id, operacio.nom_cat AS operacio_cat, operacio.nom_esp AS operacio_esp, operacio.nom_eng AS operacio_eng, categoria.nom_cat AS categoria_cat, categoria.nom_esp AS categoria_esp, categoria.nom_eng AS categoria_eng, poblacio.nom_cat AS poblacio, provincia.nom_cat AS provincia, usuari.id as id_usuari, usuari.email, usuari.nom_cognoms, usuari.empresa, usuari.direccio, usuari.poblacio AS poblacio_usuari, usuari.codi_postal, usuari.telefon, usuari.web, usuari.logo, certificat.nom_cat AS certificat
      FROM immoble
      INNER JOIN poblacio
          ON immoble.poblacio_id = poblacio.id
      INNER JOIN provincia
          ON poblacio.provincia_id = provincia.id
      INNER JOIN operacio
          ON immoble.operacio_id = operacio.id
      INNER JOIN categoria
          ON immoble.categoria_id = categoria.id
      INNER JOIN usuari
          ON immoble.usuari_id = usuari.id
      INNER JOIN certificat
          ON immoble.certificat_id = certificat.id
      WHERE immoble.id = :id && immoble.activat = 1');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    // Get immobles by admin
    public function getImmobles(){
      $this->db->query('SELECT immoble.id as id_immoble, immoble.titol_esp, immoble.referencia, operacio.nom_cat AS operacio, categoria.nom_cat AS categoria, poblacio.nom_cat AS poblacio, immoble.portada, immoble.activat, usuari.empresa AS usuari_empresa, usuari.nom_cognoms AS usuari_nom
      FROM immoble
      INNER JOIN poblacio
          ON immoble.poblacio_id = poblacio.id
      INNER JOIN operacio
          ON immoble.operacio_id = operacio.id
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

    // Get immobles by user
    public function getImmoblesByUsuari($id){
      $this->db->query('SELECT immoble.id as id_immoble, immoble.titol_cat, immoble.titol_esp, immoble.titol_eng, immoble.referencia, immoble.imatge_1, immoble.imatge_2, immoble.imatge_3, immoble.preu, immoble.habitacio, immoble.banys, immoble.tamany, immoble.portada, immoble.activat, operacio.nom_cat AS operacio_cat, operacio.nom_esp AS operacio_esp, operacio.nom_eng AS operacio_eng, categoria.nom_cat AS categoria_cat, categoria.nom_esp AS categoria_esp, categoria.nom_eng AS categoria_eng, poblacio.nom_cat AS poblacio, provincia.nom_cat AS provincia, usuari.id as id_usuari, usuari.empresa, usuari.logo
      FROM immoble
      INNER JOIN poblacio
          ON immoble.poblacio_id = poblacio.id
      INNER JOIN provincia
          ON poblacio.provincia_id = provincia.id
      INNER JOIN operacio
          ON immoble.operacio_id = operacio.id
      INNER JOIN categoria
          ON immoble.categoria_id = categoria.id
      INNER JOIN usuari
          ON immoble.usuari_id = usuari.id
      WHERE immoble.usuari_id = :id
      ORDER BY immoble.id DESC');
      $this->db->bind(':id', $id);
      // Devuelve más de una fila
      $results = $this->db->resultSet();

      return $results;
    }

    // Get immobles portada
    public function getTotalImmoblesPortada(){
      $this->db->query('SELECT COUNT(id) AS total_portada FROM immoble WHERE portada = 1');
      $row = $this->db->single();

      return $row;
    }

    // Get all about immobles by portada
    public function getInfoImmoblesPortada(){
      $this->db->query('SELECT immoble.id, immoble.titol_cat, immoble.titol_esp, immoble.titol_eng, immoble.referencia, immoble.imatge_1, immoble.preu, immoble.habitacio, immoble.banys, immoble.tamany, immoble.portada, immoble.activat, operacio.nom_cat AS operacio_cat, operacio.nom_esp AS operacio_esp, operacio.nom_eng AS operacio_eng, categoria.nom_cat AS categoria_cat, categoria.nom_esp AS categoria_esp, categoria.nom_eng AS categoria_eng, poblacio.nom_cat AS poblacio, provincia.nom_cat AS provincia
      FROM immoble
      INNER JOIN poblacio
          ON immoble.poblacio_id = poblacio.id
      INNER JOIN provincia
          ON poblacio.provincia_id = provincia.id
      INNER JOIN operacio
          ON immoble.operacio_id = operacio.id
      INNER JOIN categoria
          ON immoble.categoria_id = categoria.id
      WHERE immoble.portada = 1 && immoble.activat = 1
      ORDER BY immoble.id ASC');

      $results = $this->db->resultSet();

      return $results;
    }

    // Get immobles by operacio i categoria
    public function getImmoblesOperacioCategoria($idOperacio, $idCategoria){
      $this->db->query('SELECT immoble.id as id_immoble, immoble.titol_cat, immoble.titol_esp, immoble.titol_eng, immoble.referencia, immoble.imatge_1, immoble.imatge_2, immoble.imatge_3, immoble.preu, immoble.habitacio, immoble.banys, immoble.tamany, immoble.activat, operacio.nom_cat AS operacio_cat, operacio.nom_esp AS operacio_esp, operacio.nom_eng AS operacio_eng, categoria.nom_cat AS categoria_cat, categoria.nom_esp AS categoria_esp, categoria.nom_eng AS categoria_eng, poblacio.nom_cat AS poblacio, provincia.nom_cat AS provincia, usuari.id as id_usuari, usuari.empresa, usuari.logo
      FROM immoble
      INNER JOIN poblacio
          ON immoble.poblacio_id = poblacio.id
      INNER JOIN provincia
          ON poblacio.provincia_id = provincia.id
      INNER JOIN operacio
          ON immoble.operacio_id = operacio.id
      INNER JOIN categoria
          ON immoble.categoria_id = categoria.id
      INNER JOIN usuari
          ON immoble.usuari_id = usuari.id
      WHERE immoble.operacio_id = :idOperacio && immoble.categoria_id = :idCategoria && immoble.activat = 1
      ORDER BY immoble.id DESC');
      $this->db->bind(':idOperacio', $idOperacio);
      $this->db->bind(':idCategoria', $idCategoria);

      $results = $this->db->resultSet();

      return $results;
    }

    // Get total immobles
    public function getImmoblesCercar($idOperacio, $idCategoria, $idPoblacio){
      $this->db->query('SELECT immoble.id as id_immoble, immoble.titol_cat, immoble.titol_esp, immoble.titol_eng, immoble.referencia, immoble.imatge_1, immoble.imatge_2, immoble.imatge_3, immoble.preu, immoble.habitacio, immoble.banys, immoble.tamany, immoble.activat, operacio.nom_cat AS operacio_cat, operacio.nom_esp AS operacio_esp, operacio.nom_eng AS operacio_eng, categoria.nom_cat AS categoria_cat, categoria.nom_esp AS categoria_esp, categoria.nom_eng AS categoria_eng, poblacio.nom_cat AS poblacio, provincia.nom_cat AS provincia, usuari.id as id_usuari, usuari.empresa, usuari.logo
      FROM immoble
      INNER JOIN poblacio
          ON immoble.poblacio_id = poblacio.id
      INNER JOIN provincia
          ON poblacio.provincia_id = provincia.id
      INNER JOIN operacio
          ON immoble.operacio_id = operacio.id
      INNER JOIN categoria
          ON immoble.categoria_id = categoria.id
      INNER JOIN usuari
          ON immoble.usuari_id = usuari.id
      WHERE immoble.operacio_id = :idOperacio && immoble.categoria_id = :idCategoria && immoble.poblacio_id = :idPoblacio && immoble.activat = 1
      ORDER BY immoble.id DESC');
      $this->db->bind(':idOperacio', $idOperacio);
      $this->db->bind(':idCategoria', $idCategoria);
      $this->db->bind(':idPoblacio', $idPoblacio);

      $results = $this->db->resultSet();

      return $results;
    }

    // Get total immobles
    public function getImmoblesFiltrar($idOperacio, $idCategoria, $idPoblacio, $preuMinim, $preuMaxim, $numHabitacions, $numBanys, $superficieMinima, $superficieMaxima){
      $this->db->query('SELECT immoble.id as id_immoble, immoble.titol_cat, immoble.titol_esp, immoble.titol_eng, immoble.referencia, immoble.imatge_1, immoble.imatge_2, immoble.imatge_3, immoble.preu, immoble.habitacio, immoble.banys, immoble.tamany, immoble.activat, immoble.caracteristica_id, operacio.nom_cat AS operacio_cat, operacio.nom_esp AS operacio_esp, operacio.nom_eng AS operacio_eng, categoria.nom_cat AS categoria_cat, categoria.nom_esp AS categoria_esp, categoria.nom_eng AS categoria_eng, poblacio.nom_cat AS poblacio, provincia.nom_cat AS provincia, usuari.id as id_usuari, usuari.empresa, usuari.logo
      FROM immoble
      INNER JOIN poblacio
          ON immoble.poblacio_id = poblacio.id
      INNER JOIN provincia
          ON poblacio.provincia_id = provincia.id
      INNER JOIN operacio
          ON immoble.operacio_id = operacio.id
      INNER JOIN categoria
          ON immoble.categoria_id = categoria.id
      INNER JOIN usuari
          ON immoble.usuari_id = usuari.id
      WHERE immoble.operacio_id = :idOperacio && 
            immoble.categoria_id = :idCategoria && 
            immoble.poblacio_id = :idPoblacio &&
            immoble.preu BETWEEN :preuMinim AND :preuMaxim &&
            immoble.habitacio >= :numHabitacions &&
            immoble.banys >= :numBanys &&
            immoble.tamany BETWEEN :superficieMinima AND :superficieMaxima && 
            immoble.activat = 1
      ORDER BY immoble.id DESC');

      $this->db->bind(':idOperacio', $idOperacio);
      $this->db->bind(':idCategoria', $idCategoria);
      $this->db->bind(':idPoblacio', $idPoblacio);
      $this->db->bind(':preuMinim', $preuMinim);
      $this->db->bind(':preuMaxim', $preuMaxim);
      $this->db->bind(':numHabitacions', $numHabitacions);
      $this->db->bind(':numBanys', $numBanys);
      $this->db->bind(':superficieMinima', $superficieMinima);
      $this->db->bind(':superficieMaxima', $superficieMaxima);

      $results = $this->db->resultSet();

      return $results;
    }

    // Get total immobles
    public function getTotalImmobles(){
      $this->db->query('SELECT COUNT(*) AS total FROM immoble WHERE activat = 1');
      $row = $this->db->single();

      return $row;
    }

    // Get 4 recomended immobles
    public function getRecomendedImmobles($idImmobleOrigen, $idOperacio, $idCategoria, $idPoblacio){
      $this->db->query('SELECT immoble.id as id_immoble, immoble.titol_cat, immoble.titol_esp, immoble.titol_eng, immoble.referencia, immoble.imatge_1, immoble.preu, immoble.habitacio, immoble.banys, immoble.tamany, immoble.activat, operacio.nom_cat AS operacio_cat, operacio.nom_esp AS operacio_esp, operacio.nom_eng AS operacio_eng, categoria.nom_cat AS categoria_cat, categoria.nom_esp AS categoria_esp, categoria.nom_eng AS categoria_eng, poblacio.nom_cat AS poblacio, provincia.nom_cat AS provincia, usuari.id as id_usuari, usuari.empresa, usuari.logo
      FROM immoble
      INNER JOIN poblacio
          ON immoble.poblacio_id = poblacio.id
      INNER JOIN provincia
          ON poblacio.provincia_id = provincia.id
      INNER JOIN operacio
          ON immoble.operacio_id = operacio.id
      INNER JOIN categoria
          ON immoble.categoria_id = categoria.id
      INNER JOIN usuari
          ON immoble.usuari_id = usuari.id
      WHERE immoble.id != :idImmobleOrigen && immoble.operacio_id = :idOperacio && immoble.categoria_id = :idCategoria && immoble.poblacio_id = :idPoblacio && immoble.activat = 1
      ORDER BY immoble.id DESC LIMIT 4');
      $this->db->bind(':idImmobleOrigen', $idImmobleOrigen);
      $this->db->bind(':idOperacio', $idOperacio);
      $this->db->bind(':idCategoria', $idCategoria);
      $this->db->bind(':idPoblacio', $idPoblacio);

      $results = $this->db->resultSet();

      return $results;
    }

    // Get quantity of immobles by usuari
    public function getTotalImmoblesByUsuari($id){
      $this->db->query(' SELECT COUNT(id) AS total_immobles FROM immoble WHERE usuari_id = :id ');
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    // Get imatges of the immobles by usuari
    public function getImatgeImmoblesByUsuari($id){
      $this->db->query(' SELECT imatge_1,imatge_2,imatge_3,imatge_4,imatge_5,imatge_6,imatge_7,imatge_8,imatge_9,imatge_10 FROM immoble WHERE usuari_id = :id ');
      $this->db->bind(':id', $id);

      $results = $this->db->resultSet();

      return $results;
    }

    // Disable all immobles by usuari
    public function disableAllImmoblesByUsuari($id){
      $this->db->query(' UPDATE immoble SET activat = 0 WHERE usuari_id = :id ');
      $this->db->bind(':id', $id);

      $this->db->execute();
    }

    // Enable all immobles by usuari
    public function enableAllImmoblesByUsuari($id){
      $this->db->query(' UPDATE immoble SET activat = 1 WHERE usuari_id = :id ');
      $this->db->bind(':id', $id);

      $this->db->execute();
    }

    // Delete all immobles by usuari
    public function deleteAllImmoblesByUsuari($id){
      $this->db->query(' DELETE FROM immoble WHERE usuari_id = :id ');
      $this->db->bind(':id', $id);

      $this->db->execute();
    }

    // Add immoble
    public function add($data){
      $this->db->query('INSERT INTO immoble (titol_cat, titol_esp, titol_eng, slug_cat, slug_esp, slug_eng, referencia, descripcio_cat, descripcio_esp, descripcio_eng, imatge_1, imatge_2, imatge_3, imatge_4, imatge_5, imatge_6, imatge_7, imatge_8, imatge_9, imatge_10, portada, preu, habitacio, banys, tamany, activat, operacio_id, poblacio_id, categoria_id, caracteristica_id, certificat_id, usuari_id) VALUES (:titol_cat, :titol_esp, :titol_eng, :slug_cat, :slug_esp, :slug_eng, :referencia, :descripcio_cat, :descripcio_esp, :descripcio_eng, :imatge1, :imatge2, :imatge3, :imatge4, :imatge5, :imatge6, :imatge7, :imatge8, :imatge9, :imatge10, :portada, :preu, :habitacio, :banys, :tamany, :activat, :operacio_id, :poblacio_id, :categoria_id, :caracteristica_id, :certificat_id, :usuari_id)');
      // Bind values
      $this->db->bind(':titol_cat', $data['titol_cat']);
      $this->db->bind(':titol_esp', $data['titol_esp']);
      $this->db->bind(':titol_eng', $data['titol_eng']);
      $this->db->bind(':slug_cat', $data['slug_cat']);
      $this->db->bind(':slug_esp', $data['slug_esp']);
      $this->db->bind(':slug_eng', $data['slug_eng']);
      $this->db->bind(':referencia', $data['referencia']);
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
      $this->db->bind(':operacio_id', $data['operacio_id']);
      $this->db->bind(':poblacio_id', $data['poblacio_id']);
      $this->db->bind(':categoria_id', $data['categoria_id']);
      $this->db->bind(':caracteristica_id', $data['caracteristica_id']);
      $this->db->bind(':certificat_id', $data['certificat_id']);
      $this->db->bind(':usuari_id', $data['usuari_id']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Update immoble
    public function update($data){
      $this->db->query('UPDATE immoble SET titol_cat = :titol_cat, titol_esp = :titol_esp, titol_eng = :titol_eng, slug_cat = :slug_cat, slug_esp = :slug_esp, slug_eng = :slug_eng, referencia = :referencia, descripcio_cat = :descripcio_cat, descripcio_esp = :descripcio_esp, descripcio_eng = :descripcio_eng, imatge_1 = :imatge1, imatge_2 = :imatge2, imatge_3 = :imatge3, imatge_4 = :imatge4, imatge_5 = :imatge5, imatge_6 = :imatge6, imatge_7 = :imatge7, imatge_8 = :imatge8, imatge_9 = :imatge9, imatge_10 = :imatge10, portada = :portada, preu = :preu, habitacio = :habitacio, banys = :banys, tamany = :tamany, activat = :activat, operacio_id = :operacio_id, poblacio_id = :poblacio_id, categoria_id = :categoria_id, caracteristica_id = :caracteristica_id, certificat_id = :certificat_id, usuari_id = :usuari_id WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':titol_cat', $data['titol_cat']);
      $this->db->bind(':titol_esp', $data['titol_esp']);
      $this->db->bind(':titol_eng', $data['titol_eng']);
      $this->db->bind(':slug_cat', $data['slug_cat']);
      $this->db->bind(':slug_esp', $data['slug_esp']);
      $this->db->bind(':slug_eng', $data['slug_eng']);
      $this->db->bind(':referencia', $data['referencia']);
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
      $this->db->bind(':operacio_id', $data['operacio_id']);
      $this->db->bind(':poblacio_id', $data['poblacio_id']);
      $this->db->bind(':categoria_id', $data['categoria_id']);
      $this->db->bind(':caracteristica_id', $data['caracteristica_id']);
      $this->db->bind(':certificat_id', $data['certificat_id']);
      $this->db->bind(':usuari_id', $data['usuari_id']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Delete immoble
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