<?php session_start(); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/inc/var.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT']."/inc/db.php"); ?>



<html>
<head>
<meta charset='UTF-8'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
table {margin : 0 auto; border-collapse:collapse;}
tr:nth-child(odd){background:#ddd;}
th {padding:3px; border:2px solid #ccc; height:36px; text-align:center; background:#555; color:white;}
td {padding:2px; border:2px solid #ccc; height:30px; text-align:center;}
.aln_lt {text-align:left;}
</style>
</head>

<body>
<table width='98%'>
    <tr>
        <th width='10%'>cNo</th>
        <th width='10%'>nation_id</th>
        <th width='20%'>name</th>
        <th width='10%'>number</th>
        <th width='50%'>memo</th>
    </tr>

    <?php    
    

    $query = "select * from nations order by number desc"; 
    $Result = mysqli_query($dbcon,$query);

    $cNo=0; 
    while($rows=mysqli_fetch_array($Result)){ 
        $cNo++; 
        $nation_id=$rows['nation_id'];   
        $name=$rows['name'];   
        $number=$rows['number'];  

        echo "<tr>";
        echo "<td>{$cNo}</td>";
        echo "<td>{$nation_id}</td>";
        echo "<td>{$name}</td>";
        echo "<td>{$number}</td>";
        echo "<td class='aln_lt'>&nbsp;[Update]&nbsp;&nbsp;&nbsp;[Delete]</td>";
        echo "</tr>";
    }
    ?>
    <tr>
        <td colspan='5'>[<a href="read.php">Read</a>]&nbsp;&nbsp;&nbsp;[<a href="update.php">Update_all??</a>]&nbsp;&nbsp;&nbsp;[Create]</td>
    </tr>
</table>
<br />
<br />
<?php ###구글파이챠트 소스(시작)?>
<?php    
// $dbhost="localhost";   
// $dbuser="corona2020"; 
// $dbpass="corona2020ftd01";
// $dbname="corona2020";
// $dbcon = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// $query = "select * from nations order by number desc"; 
$Result = mysqli_query($dbcon,$query);

$cNo=0; 
while($rows=mysqli_fetch_array($Result)){ 
    $name=$rows['name'];   
    $number=$rows['number'];  
    $data[$cNo][0]=$name;            
    $data[$cNo][1]=intval($number);    
    $cNo++; 
}
?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'name');
    data.addColumn('number', 'number');
    data.addRows(<?php echo json_encode($data);?>);
    var options = {
        'title':'국가별 확진자 수',
        'width':800,
        'height':500
    };
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
}
</script>
<div id="chart_div"></div>
<?php ###구글파이챠트 소스(마침)?>

<table>
    <tr>
        <td><a href="../index.php">[HOME]</a></td>
    </tr>
</table>
</body>
</html>
<?php include('showMeTheSource.php'); // highlight_file() : 서버소스코드보기?>