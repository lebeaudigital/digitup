<?php
class Read {
    public $columns;
    public $table;
    public $where;
    public $orderby;
    public $filter;
    public $data;
    public $params; // Nouveau paramètre pour les valeurs de liaison

    public function __construct($columns, $table, $where = null, $orderby = null, $filter = 'DESC', $params = []) {
        $this->columns = $columns;
        $this->table = $table;
        $this->where = $where;
        $this->orderby = $orderby;
        $this->filter = $filter;
        $this->params = $params; // Initialiser les paramètres de liaison
    }

    public function select($fetchMethode = 'fetch') {
        global $PDO;
        $sql = 'SELECT ' . $this->columns . ' FROM ' . $this->table;
    
        if ($this->where) {
            $sql .= ' WHERE ' . $this->where;
        }
    
        if ($this->orderby) {
            $sql .= ' ORDER BY ' . $this->orderby;
    
            // Ajouter le filtre seulement si ORDER BY est présent
            if ($this->filter) {
                $sql .= ' ' . $this->filter;
            }
        }
    
        $query = $PDO->prepare($sql);
    
        // Lier les paramètres à la requête préparée
        foreach ($this->params as $key => &$value) {
            $query->bindParam($key, $value); 
        }
    
        $query->execute();
        
        if ($fetchMethode === 'fetch') {
            $this->data = $query->fetch(PDO::FETCH_OBJ);
        } else {
            $this->data = $query->fetchAll(PDO::FETCH_OBJ);
        }
    }
}
