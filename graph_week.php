<?php

            $sql="select partname, avg(price) as avg from board where DATE > date_add(now(),interval -7 day)
            group by partname";

            $result = mysqli_query($con, $sql);
            $row=mysqli_fetch_array($result);
            while($row=mysqli_fetch_assoc($result)){
                $data_array[] = ($row);
            }
            $chart = json_encode($data_array);

            ?>

        <script type="text/javascript">

            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawVisualization);

            function drawVisualization() {
    var chart_array = <?php echo $chart; ?>; //차트에 넣는 데이터
    var header = ['partname', 'avg']; //헤더 종류에 대한 배열
    var row = "";
    var rows = new Array();
    jQuery.each(chart_array, function (i, d) {
        row = [
            d.partname,    //출력되는 데이터1
            Number(d.avg)    //출력되는 데이터2
            ];
        rows.push(row);    //rows 에 row(배열)을 push 하기 
    });
    var jsonData = [header].concat(rows);
//data 설정 끝
var data = google.visualization.arrayToDataTable(jsonData);
var options = {
    title: '전체 부품명별 데이터 개수'
    vAxis: {
            title: '개수'    //y 축 이름
        },
        hAxis: {
            title: '부품명'   //x 축 이름
        },
        seriesType: 'pies',
        showRowNumber: 'false'
    };
    var chart = new google.visualization.PieChart(document.getElementById('chartOfMine11'));
    chart.draw(data, options);
}

</script>
<div id="chartOfMine11" style="width: 500px; border: 2px solid #444; height: 500px; float: left;"></div>
