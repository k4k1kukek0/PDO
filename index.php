<?php

$server = 'localhost' ;
$user   ='root' ;
$password = '' ;
$dbname = 'pdo_SK' ;

$paket  = "mysql:host=$server;dbname=$dbname" ;  // gabungan dari server dan dbname

try{
$link = new PDO($paket,$user,$password);
$link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOExpection $e)
{
    echo $e->getMessage();
}

        

//   1 . menampilkan datanya

// $result = $link->query("SELECT * FROM users") ;  

// // FETCH BERDASARKAn
// // ANGKA :
// // die(var_dump( $result->fetch(PDO::FETCH_NUM))) ;

// // BERDASARKAN NAMA KOLOM NYA :
// // die(var_dump( $result->fetch(PDO::FETCH_ASSOC))) ;

// // BERDASARKAN OBJECT :
// // die(var_dump( $result->fetch(PDO::FETCH_OBJ))) ;

// while($row = $result->fetch(PDO::FETCH_OBJ)) {
// echo $row->password . '<br>' ;
// }

//   2 . PREPARE STATEMENT (part 1) 

// $name = "imam" ;
// $pass = 123 ;

// $sql = "INSERT INTO users(username,password) VALUE (:name, :pass)" ;
// $query = $link->query($sql) ;

// $params = array(
//     ':name' => $name, 
//     ':pass'  => $pass
// ) ;
// $query->execute($params) ;


// //  2 . PREPARE STATEMENT (part 2)
// $name = 'sultan' ;
// $pass = '123' ;
// // injection
// // $name = "apapun' OR '1' = '1'" ;
// // $query = "SELECT * FROM users WHERE username = '$name' " ;

// // var_dump($link->query($query)->fetch(PDO::FETCH_ASSOC)) ;

// // $sql = "SELECT * FROM users WHERE username = :name " ;   //opsi pertama
// // $query = $link->prepare($sql) ;
// // $params =array(':name' => $name) ;
// // $query->execute($params) ;


// $sql = "SELECT * FROM users WHERE username = ? AND password = ?" ;   //opsi kedua (yang bagus)
// $query = $link->prepare($sql) ;
// $params =array($name,$pass) ;
// $query->execute($params) ;


// var_dump($query->fetch(PDO::FETCH_ASSOC)) ;

                            
                            
                            //=== fetch class 
class User 
{
    public $username, $password, $biodata ;

    public function __construct() {
        $this->biodata = $this->username .  ' passwordnya adalah ' . $this->password ;
    }

    public function getLink() {
        return $this->link = '<a href="user/' .$this->username . '">'. $this->username . '</a>' ;
    }
}


$query = $link->query("SELECT * FROM users") ;
$query->setFetchMode(PDO::FETCH_CLASS, 'User') ;

//1.// var_dump($query->fetch()) ;

while($row = $query->fetch()){
    // 2.var_dump($row->biodata) ;
    //username adalah nama dari database
    echo $row->getLink() . '<br>' ;
}


?>