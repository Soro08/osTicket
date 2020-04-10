<?PHP
require('../client.inc.php');
// Change color by soro
// $servername = "localhost";
// $username = "root";
// $password = "root";
// $dbname = "osticket";
$servername = DBHOST;
$username = DBUSER;
$password = DBPASS;
$dbname = DBNAME;

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
    }
catch(PDOException $e)
    {
    // echo "Connection failed: " . $e->getMessage();
    }


$data = false /** whatever you're serializing **/;

if (isset($_POST["ticketid"]) && !empty($_POST["ticketid"])) { //Checks if ticketid value exists
    $ticketid = $_POST["ticketid"];
    $colorsid = intval($_POST["colorsid"]);
    try{
        foreach($ticketid as $myticket){

            // Code to be executed
            $idticket = intval($myticket);
            //===== CODE A MODIFIER ================================
            $sql = "UPDATE ost_ticket SET colors_id=? WHERE ticket_id=?";
    
            // Prepare statement
            $stmt = $conn->prepare($sql);
    
            // execute the query
            $stmt->execute(array($colorsid, $idticket));
        }
        $data = true;
    }catch(Exception $e){
        $data = $e->getMessage();
    }
    

    

    // echo a message to say the UPDATE succeeded
    // echo $stmt->rowCount() . " records UPDATED successfully";

    
}
header('Content-Type: application/json');
echo json_encode($data);