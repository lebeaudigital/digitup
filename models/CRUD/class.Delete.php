<?php
class Delete {
    public $table;
    public $where;
    public $params;

    public function __construct($table, $where, $params = []) {
        $this->table = $table;
        $this->where = $where;
        $this->params = $params;
    }

    public function delete() {
        global $PDO;

        $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $this->where;
        
        $query = $PDO->prepare($sql);

        // Lier les paramètres à la requête préparée
        foreach ($this->params as $key => &$value) {
            $paramType = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;
            $query->bindParam($key, $value, $paramType);
        }

        // Exécuter la requête et retourner true si réussie, sinon false
        return $query->execute();
    }
}
