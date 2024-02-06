<?php
require_once("BBDD.php");
class Product extends BBDD{
    private $code;
    private $name;
    private $description;
    private $category;
    private $photo;
    private $price;
    private $stock;
    private $active;
    private $outstanding;
    
    //Constructor
    public function __construct($code, $name, $description, $category, $photo, $price, $stock, $active, $outstanding){
        $this->code = $code;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->photo = $photo;
        $this->price = $price;
        $this->stock = $stock;
        $this->active = $active;
        $this->outstanding = $outstanding;
    }

    // public function __construct($code=null, $name=null, $description=null, $category=null, $photo=null, $price=null, $stock=null, $active=1, $outstanding=0){
    //     $this->code = $code;
    //     $this->name = $name;
    //     $this->description = $description;
    //     $this->category = $category;
    //     $this->photo = $photo;
    //     $this->price = $price;
    //     $this->stock = $stock;
    //     $this->active = $active;
    //     $this->outstanding = $outstanding;
    // }

    //Getters
    function getCode() {
        return $this->code;
    }
    function getName() {
        return $this->name;
    }
    function getDescription() {
        return $this->description;
    }
    function getCategory() {
        return $this->category;
    }
    function getPhoto() {
        return $this->photo;
    }
    function getPrice() {
        return $this->price;
    }
    function getStock() {
        return $this->stock;
    }
    function getActive() {
        return $this->active;
    }
    function getOutstanding() {
        return $this->outstanding;
    }


    //Setters
    function setCode($code) {
        $this->code = $code;
    }
    function setName($name) {
        $this->name = $name;
    }
    function setDescription($description) {
        $this->description = $description;
    }
    function setCategory($category) {
        $this->category = $category;
    }
    function setPhoto($photo) {
        $this->photo = $photo;
    }
    function setPrice($price) {
        $this->price = $price;
    }
    function setStock($stock) {
        $this->stock = $stock;
    }
    function setActive($active) {
        $this->active = $active;
    }
    function setOutstanding($outstanding) {
        $this->outstanding = $outstanding;
    }


    //Methods
    //Insert product
    public function insert(){
        try {
            $code = $this->code;
            $name = $this->name;
            $description = $this->description;
            $category = $this->category;
            $photo = $this->photo;
            $price = $this->price;
            $stock = $this->stock;
            $active = $this->active;
            $outstanding = $this->outstanding;
            $connect = $this->connect();
            $stmt = $connect->prepare("INSERT INTO Product (code, name, description, category, photo, price, stock, active, outstanding) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $success = $stmt->execute([$code, $name, $description, $category, $photo, $price, $stock, $active, $outstanding]);
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

    //Desactivate product
    public function desactivate() {
        $code = $this->code;
        try {
            $connect = $this->connect();
            $stmt = $connect->prepare("UPDATE Product SET active = NOT active WHERE code = :code");
            $stmt->bindParam(':code', $code, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        // Close connection
        $connect = null;
    }

    //Product info
    public function info() {
        $code = $this->category;
        try {
            $connect = $this->connect();
            $stmt = $connect->prepare("SELECT name FROM Category WHERE code = :code");
            $stmt->bindParam(':code', $code, PDO::PARAM_INT);
            $result = $stmt->execute();
            $categoryName = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return [$this->code, $this->name, $this->description, $this->category, $this->photo, $this->price, $this->stock, $categoryName['name']];
            } else {
                return "Category not found.";
            }
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        // Close connection
        $connect = null;
    }

    //Update product
    public function update() {
        $code = $this->code;
        $name = $this->name;
        $description = $this->description;
        $category = $this->category;
        $photo = $this->photo;
        $price = $this->price;
        $stock = $this->stock;
        try {
            $connect = BBDD::connect();
            $stmt = $connect->prepare("UPDATE Product SET name = :name, description = :description, category = :category, photo = :photo, price = :price, stock = :stock WHERE code = :code");
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':category', $category, PDO::PARAM_INT);
            $stmt->bindParam(':photo', $photo, PDO::PARAM_STR);
            $stmt->bindParam(':price', $price, PDO::PARAM_INT);
            $stmt->bindParam(':stock', $stock, PDO::PARAM_STR);
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
            $query = "SELECT p.*, c.name as category_name FROM Product p JOIN Category c ON p.category = c.code::varchar WHERE LOWER(p.name) LIKE LOWER(:keyword)";
            $statement = $connect->prepare($query);
            $statement->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
            $statement->execute();
            $products = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (PDOException $e) {
            echo "Error of connection: " . $e->getMessage();
        } finally {
            // Cierra la conexión
            $connect = null;
        }
    } 

    //Specific category
    public static function specificCategory($code) {
        try {
            $connect = BBDD::connect();
            $query = "SELECT p.*, c.name as category_name FROM Product p JOIN Category c ON p.category = c.code::integer WHERE CAST(p.category AS TEXT) LIKE :code";
            $statement = $connect->prepare($query);
            $statement->bindValue(':code', '%' . $code . '%', PDO::PARAM_STR);
            $statement->execute();
            $products = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (PDOException $e) {
            echo "Error of connection: " . $e->getMessage();
        } finally {
            // Cierra la conexión
            $connect = null;
        }
    }

    //Statics
    //Obtain products
    public static function obtain() {
        try {
            $connect = BBDD::connect();
            $query = "SELECT p.*, c.name as category_name FROM Product p JOIN Category c ON p.category = c.code";
            $statement = $connect->query($query);

            $products = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $products;
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        //Close connection
        $connect = null;
    }
    //Obtain active products
    public static function obtainActiveProducts() {
        $connect = BBDD::connect();
        $query = "SELECT * FROM product WHERE active = true";
        $statement = $connect->query($query);
    
        // Verifica si la consulta fue exitosa
        if ($statement) {
            // Inicializa un array para almacenar objetos de tipo Product
            $activeProducts = [];
    
            // Recorre los resultados y crea objetos Product
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $product = new Product(
                    $row['code'],
                    $row['name'],
                    $row['description'],
                    $row['category'],
                    $row['photo'],
                    $row['price'],
                    $row['stock'],
                    $row['active'],
                    $row['outstanding']
                );
    
                // Agrega el objeto Product al array
                $activeProducts[] = $product;
            }
    
            // Devuelve el array de productos
            return $activeProducts;
        } else {
            // Manejar el caso en el que la consulta no fue exitosa
            echo "Error en la consulta SQL";
            return [];
        }
    }
    //Initialize the attributs of the class
    public static function initialize($code) {
        try {
            $connect = BBDD::connect();
            $stmt = $connect->prepare("SELECT name, description, category, photo, price, stock FROM Product WHERE code = :code");
            $stmt->bindParam(':code', $code, PDO::PARAM_INT);
            $res = $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return [$result['name'], $result['description'], $result['category'], $result['photo'], $result['price'], $result['stock']];
            } else {
                echo "Product not found.";
            }
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        // Close connection
        $connect = null;
    }

    // Hottests picks
    public static function hottestPicks(){
        try {
            $connect = BBDD::connect();
            $query = "SELECT p.*, c.name as category_name FROM Product p JOIN Category c ON p.category = c.code LIMIT 10";
            $statement = $connect->query($query);

            $products = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $products;
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        //Close connection
        $connect = null;
    }

    // Other categories
    public static function otherCategories(){
        try {
            $connect = BBDD::connect();
            $query = "SELECT c.name AS category_name, p.photo AS product_photo FROM Category c LEFT JOIN (SELECT DISTINCT ON (category) category, photo FROM Product WHERE active = true ORDER BY category, code) p ON c.code = p.category WHERE c.active = true";
            $statement = $connect->query($query);

            $products = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $products;
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        //Close connection
        $connect = null;
    }

    //Move image
    public static function moveImage($name) {
        $originalName = $_FILES['photo']['name'];
        $imagen_ext = pathinfo($originalName, PATHINFO_EXTENSION);
        $imagen_path = 'sources/products/'. $name .'.'. $imagen_ext;
        move_uploaded_file($_FILES['photo']['tmp_name'], $imagen_path);
        return $imagen_path;
    }

    //Remove image
    public static function removeImage($path) {
        if (file_exists($path)) {
            unlink($path);
        }
    }

    //Count products from one category
    public static function count($category) {
        try {
            $connect = BBDD::connect();
            $stmt = $connect->prepare("SELECT COUNT(*) FROM Product WHERE category = :category");
            $stmt->bindParam(':category', $category, PDO::PARAM_INT);
            $res = $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['count'];
            } else {
                echo "Product not found.";
            }
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        //Close connection
        $connect = null;
    }

    //Zero fill
    public static function zeroFill($number) {
        $numberString = (string)$number;
        $numberOfDigits = strlen($numberString);
        if($numberOfDigits == 1) {
            return "00" . $numberString;
        } else if ($numberOfDigits == 2) {
            return "0" . $numberString;
        } else {
            return $number;
        }
    }

    //Outstanding productos
    public static function outstandingProducts() {
        try {
            $connect = BBDD::connect();
            $query = "SELECT p.*, c.name as category_name FROM Product p JOIN Category c ON p.category = c.code WHERE outstanding=true";
            $statement = $connect->query($query);

            $products = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $products;
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        //Close connection
        $connect = null;
    }
    //Get product with code
    public static function getProductByCode($code){
        try {
            $connect = BBDD::connect();
            $query = "SELECT * FROM product WHERE code = '$code'";
            $statement = $connect->query($query);

            $product = $statement->fetchAll(PDO::FETCH_ASSOC);

            return $product;
        } catch (PDOException $e) {
            echo "Error of connexion: " . $e->getMessage();
        }
        //Close connection
        $connect = null;
    }
}
?>