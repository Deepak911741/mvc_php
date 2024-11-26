<?php

class Database
{
    public $servername = SERVER_NAME;
    public $username = USER_NAME;
    public $database = DATABASE;
    public $password = PASSWORD;
    public $connection;
    public $result;

    public function __construct()
    {
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->database);

        if ($this->connection->connect_error) {
            die("Database connection error: " . $this->connection->connect_error);
        }
    }

    public function query($query, $params = [])
    {
        $stmt = $this->connection->prepare($query);

        if ($stmt === false) {
            die("Query preparation failed: " . $this->connection->error);
        }

        if (!empty($params)) {
            $stmt->bind_param(...$this->bindParams($params));
        }

        if (!$stmt->execute()) {
            die("Query execution failed: " . $stmt->error);
        }

        $this->result = $stmt;

        if (preg_match('/^\s*(SELECT|SHOW|DESCRIBE|EXPLAIN)/i', $query)) {
            $stmt->store_result();
        }

        return $this->result;
    }

    public function rowCount()
    {
        if ($this->result) {
            return $this->result->num_rows > 0 ? $this->result->num_rows : $this->connection->affected_rows;
        }
        return 0;
    }

    public function fetchAll()
    {
        $rows = [];
        if ($this->result instanceof mysqli_stmt) {
            $metadata = $this->result->result_metadata();
            $fields = [];
            $data = [];

            while ($field = $metadata->fetch_field()) {
                $fields[] = &$data[$field->name];
            }

            call_user_func_array([$this->result, 'bind_result'], $fields);

            while ($this->result->fetch()) {
                $row = [];
                foreach ($data as $key => $val) {
                    $row[$key] = $val;
                }
                $rows[] = $row;
            }
        }
        return $rows;
    }

    private function bindParams($params)
    {
        $types = '';
        $values = [];

        foreach ($params as $param) {
            $types .= is_int($param) ? 'i' : (is_float($param) ? 'd' : 's');
            $values[] = $param;
        }

        return array_merge([$types], $values);
    }
}
