<?php
  class Blog {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getBlogs(){
      $this->db->query('SELECT * FROM blog ORDER BY id_blog ASC');
      // Devuelve más de una fila
      $results = $this->db->resultSet();

      return $results;
    }

    public function addBlog($data){
      $this->db->query('INSERT INTO blog (titol_cat, id_tag, descripcio_cat, imatge1, imatge2, imatge3, imatge4, imatge5) VALUES (:titol_cat, :id_tag, :descripcio_cat, :imatge1, :imatge2, :imatge3, :imatge4, :imatge5)');
      // Bind values
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

    public function updateBlog($data){
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

    // Obtener post con la id
    public function getBlogById($id){
      $this->db->query('SELECT * FROM blog WHERE id_blog = :id_blog');
      $this->db->bind(':id_blog', $id);

      $row = $this->db->single();

      return $row;
    }

    public function deleteBlog($id){
      $this->db->query('DELETE FROM blog WHERE id_blog = :id_blog');
      // Bind values
      $this->db->bind(':id_blog', $id);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
  }