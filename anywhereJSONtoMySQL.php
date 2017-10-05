 <?

   /*connect to DB*/
    $servername = "uvds365.active24.cz";
    $database = "previewaczmartin";
    $username = "previewaczmartin";
    $password = "4cu4BsDASC";
    
  // Create connection

    $con = mysqli_connect($servername, $username, $password, $database);

    #("uvds365.active24.cz" , "previewaczmartin", "4cu4BsDASC");  
    #($bd_host, $bd_user, $bd_password);
   /*control connection*/
   if (!$con) {

    die("Connection failed: " . mysqli_connect_error());

}
   /*select databese name*/
   mysqli_select_db($con, "previewaczmartin" );
   #($database, $con); 
   /*set encode to utf-8*/
   #mysqli_query('SET NAMES utf8');
   /**/

    $jsondata = file_get_contents('http://ws.meteocontrol.de/api/sites/P9JWT/data/energygeneration?apiKey=xVQfZ7HaA9');

    //convert json object to php associative array
    $data = json_decode($jsondata, true);
    $date=$data['chartData']['date'];
    $data=$data['chartData']['data'];
    /*print_r($data);*/

    echo 'TIME DATE  '.$date.'<br>';

    echo '<table style="width:100%"><tr><td>time stamp</td><td>data</td></tr>';
    foreach($data as $array) {
    echo '<tr><td>';
    print_r($array[0]);
    echo '</td><td>';
    print_r($array[1]);
    echo '</td></tr>';


            /*insert in db but you will have big quantity of queryes*/

            #$sql = "INSERT INTO tbl_power(date, data) VALUES('$array[0]',$array[1])";
            #mysql_query($sql,$con);
            $sql = "INSERT INTO wp_posts (post_content, post_title) VALUES('$array[0]',$array[1])";
            mysqli_query( $con , $sql );


    }
    echo '</table>';
    ?>  
    
    
    
    
    
    #$query = "INSERT INTO wp_posts (post_date, post_title) VALUES($date,$data);
            #$result = mysql_query($con,$sql);
#if(!$result) {
    #die('Error : ' . mysql_error());
#}

    #}
    #echo '</table>';
    #?>