<?php
class User extends Connection
{
    private $id = '';
    private $username = '';
    private $password = '';
    private $result = false;

    public function __get($atribute)
    {
        if (property_exists($this, $atribute)) {
            return $this->$atribute;
        }
    }
    public function __set($atribut, $value)
    {
        if (property_exists($this, $atribut)) {
            $this->$atribut = $value;
        }
    }
    public function AddUser()
    {
        $sql = "INSERT INTO users(id, username, password) VALUES ('$this->id', '$this->username', '$this->password')";
        $this->result = $this->connection->exec($sql);
        $this->message = $this->result ? 'Data successfully added!' : 'Data failed to add!';
    }
    public function SelectOneUser()
    {
        $sql = "SELECT * FROM users WHERE id = '$this->id'";
        $result = $this->connection->query($sql);

        if ($result->rowCount() == 1) {
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $this->id = $data->id;
                $this->username = $data->username;
                $this->password = $data->password;
            }
        }
    }
    public function SelectOneUserByUsername()
    {
        $sql = "SELECT * FROM users WHERE username = '$this->username'";
        $result = $this->connection->query($sql);

        if ($result->rowCount() == 1) {
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $this->id = $data->id;
                $this->username = $data->username;
                $this->password = $data->password;
            }
        }
    }
    public function getMaxUserID()
    {
        $sql = 'SELECT MAX(id) AS max_userid FROM users';
        $result = $this->connection->query($sql);

        if ($result && $result->rowCount() == 1) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $maxUserID = $row['max_userid'];
            return $maxUserID;
        } else {
            return 0;
        }
    }
}
