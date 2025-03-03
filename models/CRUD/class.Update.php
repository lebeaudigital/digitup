<?php
class Update {
    public $table;
    public $columns;
    public $where;
    public $params;

    public function __construct($table, $columns, $where, $params = []) {
        $this->table = $table;
        $this->columns = $columns;
        $this->where = $where;
        $this->params = $params;
    }

    public function update() {
        global $PDO;

        $setClause = implode(', ', array_map(fn($column) => $column . ' = :' . $column, $this->columns));
        
        $sql = 'UPDATE ' . $this->table . ' SET ' . $setClause . ' WHERE ' . $this->where;
        
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
