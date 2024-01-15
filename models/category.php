<?php
require_once("BBDD.php");
class Category extends BBDD{
    private $code;
    private $name;
    private $active;
    
    //Constructor
    public function __construct($code, $name, $active){
        $this->code = $code;
        $this->name = $name;
        $this->active = $active;
    }

    //Getters
    function getCode() {
        return $this->code;
    }
    function getName() {
        return $this->name;
    }
    function getActive() {
        return $this->active;
    }

    //Setters
    function setCode($code) {
        $this->code = $code;
    }
    function setName($name) {
        $this->name = $name;
    }
    function setActive($active) {
        $this->active = $active;
    }

    //Methods
    //Insert category
    public function add() {
        try {
            $name = $this->name;
            $connect = BBDD::connect();
            $stmt = $connect->prepare("INSERT INTO Category (name, active) VALUES (?, ?)");
            $success = $stmt->execute([$name, 1]);
            if ($success && $stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        // Cerrar la conexión
        $connect = null;    
    }

    //Desactivate category
    public function desactivate() {
        $code = $this->code;
        try {
            $connect = BBDD::connect();
            $stmt = $connect->prepare("UPDATE Category SET active = NOT active WHERE code = :code");
            $stmt->bindParam(':code', $code, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        // Close connection
        $connect = null;
    }

    //Category info
    public function info() {
        return [$this->code, $this->name];
    }

    //Update category
    public function update() {
        $code = $this->code;
        $name = $this->name;
        try {
            $connect = BBDD::connect();
            $stmt = $connect->prepare("UPDATE Category SET name = :name WHERE code = :code");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':code', $code, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        // Close connection
        $connect = null;
    }

    //Search bar
    public static function search($keyword) {
        try {
            $connect = BBDD::connect();
            $query = "SELECT * FROM Category WHERE LOWER(name) LIKE LOWER(:keyword)";
            $statement = $connect->prepare($query);
            $statement->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
            $statement->execute();
            $categories = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $categories;
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
        } finally {
            // Cierra la conexión
            $connect = null;
        }
    }    

    //Statics
    //Obtain categories
    public static function obtain() {
        try {
            $connect = BBDD::connect();
            $query = "SELECT * FROM Category";
            $statement = $connect->query($query);
            $categorias = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $categorias;
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        // Close connection
        $connect = null;
    }

    //Initialize the attributs of the class
    public static function initialize($code) {
        try {
            $connect = BBDD::connect();
            $stmt = $connect->prepare("SELECT name FROM Category WHERE code = :code");
            $stmt->bindParam(':code', $code, PDO::PARAM_INT);
            $res = $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['name'];
            } else {
                echo "Category not found.";
            }
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        // Close connection
        $connect = null;
    }
}
?>