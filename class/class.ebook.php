<?php
class Ebook extends Connection
{
    private $id;
    private $name;
    private $file_path;
    private $result = false;
    private $message = '';

    public function __get($attribute)
    {
        if (property_exists($this, $attribute)) {
            return $this->$attribute;
        }
    }

    public function __set($attribute, $value)
    {
        if (property_exists($this, $attribute)) {
            $this->$attribute = $value;
        }
    }

    public function SelectAllEbooks()
    {
        $sql = "SELECT * FROM ebooks";
        $result = $this->connection->query($sql);

        $arrResult = [];
        if ($result->rowCount() > 0) {
            while ($data = $result->fetch(PDO::FETCH_OBJ)) {
                $objEbook = new Ebook();
                $objEbook->id = $data->id;
                $objEbook->name = $data->name;
                $objEbook->file_path = $data->file_path;
                $arrResult[] = $objEbook;
            }
        }
        return $arrResult;
    }

    public function SelectOneEbook()
    {
        $sql = "SELECT * FROM ebooks WHERE id = '$this->id'";
        $result = $this->connection->query($sql);

        if ($result->rowCount() == 1) {
            $data = $result->fetch(PDO::FETCH_OBJ);
            $this->id = $data->id;
            $this->name = $data->name;
            $this->file_path = $data->file_path;
        }
    }

    public function DeleteEbook()
    {
        $sql = "DELETE FROM ebooks WHERE id = '$this->id'";
        $this->result = $this->connection->exec($sql);
        $this->message = $this->result ? 'Data berhasil dihapus!' : 'Data gagal dihapus!';
    }

    // public function DeleteEbook()
    // {
    //     $this->SelectOneEbook();

    //     if ($this->file_path && file_exists($this->file_path)) {
    //         if (unlink($this->file_path)) {
    //             $this->message = 'File successfully deleted. ';
    //         } else {
    //             $this->message = 'Failed to delete file. ';
    //         }
    //     } else {
    //         $this->message = 'File not found. ';
    //     }

    //     $sql = "DELETE FROM ebooks WHERE id = '$this->id'";
    //     $this->hasil = $this->connection->exec($sql);

    //     if ($this->hasil) {
    //         $this->message .= 'Data successfully deleted!';
    //     } else {
    //         $this->message .= 'Data failed to delete!';
    //     }
    // }
}
