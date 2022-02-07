
    <?php
    $host = 'localhost';
    $db = 'assignment_tracker';
    $user = 'root';
    $password = '';
    
    $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
    
        try{    
            $pdo = new PDO($dsn, $user, $password);
    
            if ($pdo) {
            }
            
        
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    
    ?>
