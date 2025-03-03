<?php
class Create {
    public $table;
    public $columns;
    public $params;

    public function __construct($table, $columns, $params = []) {
        $this->table = $table;
        $this->columns = $columns;
        $this->params = $params;
    }

    public function insert() {
        global $PDO;

        $columns = implode(', ', $this->columns);
        $placeholders = implode(', ', array_map(fn($column) => ':' . $column, $this->columns));

        $sql = 'INSERT INTO ' . $this->table . ' (' . $columns . ') VALUES (' . $placeholders . ')';
        
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
