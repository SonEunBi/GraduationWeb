<?php
$con = mysqli_connect("localhost", "user1", "12345", "userdata");
            $sql="select location, count(location) as count 
            from board 
            group by location";

        $v_location=array("서울","부산","대구","인천","광주","대전","울산","강원","경기","경남","경북","전남","전북","제주","충남","충북");

            $result = mysqli_query($con, $sql);
            $row=mysqli_fetch_array($result);
            while($row=mysqli_fetch_assoc($result)){
                $data_array2[] = ($row);
            }
            $chart2 = json_encode($data_array2);

            ?>

        <script type="text/javascript">

            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawVisualization);

            function drawVisualization() {
    var chart_array2 = <?php echo $chart2; ?>; //차트에 넣는 데이터
    var header = ['location', 'count']; //헤더 종류에 대한 배열
    var row = "";
    var rows = new Array();
    jQuery.each(chart_array2, function (i, d) {
        row = [
            d.location,    //출력되는 데이터1
            Number(d.count)    //출력되는 데이터2
            ];
        rows.push(row);    //rows 에 row(배열)을 push 하기 
    });
    var jsonData = [header].concat(rows);
//data 설정 끝
var data = google.visualization.arrayToDataTable(jsonData);
var options = {
    title: '전체 지역별 데이터 개수'
    // vAxis: {
    //         title: '개수'    //y 축 이름
    //     },
    //     hAxis: {
    //         title: '부품명'   //x 축 이름
    //     },
    //     seriesType: 'pies',
    //     showRowNumber: 'false'
    };
    var chart2 = new google.visualization.PieChart(document.getElementById('chartOfMine2'));
    chart2.draw(data, options);
}

</script>
<div id="chartOfMine2" style="width: 350px;  border: 2px solid #444;height: 300px; float: left;"></div>
