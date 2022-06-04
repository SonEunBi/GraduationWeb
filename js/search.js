 $(document).ready(function() {
  $("#checkAll").click(function(){
    if($("#checkAll").is(":checked"))
      $("input[class=chk]").prop("checked", true);
    else 
      $("input[class=chk]").prop("checked", false);
  });


    // 전체 선택 중 한개의 체크박스 선택 해제 시 전체선택 체크박스 해제
    $("input[class=chk]").click(function(){
      var total = $("input[class=chk]").length;
      var checked = $("input[class='chk']:checked").length;
      if(checked != total) $("#checkAll").prop("checked", false);
      else 
        $("#checkAll").prop("checked", true);
    });
  });

 if(!isset($_SESSION)) { 
  session_start(); 
} 
    //보이기, 안 보이기
    function find_normal1()  {
      row1 = document.getElementById('wrapper2');
      row1.style.display = 'none';

      row1 = document.getElementById('wrapper');
      row1.style.display = '';

    }

    function find_num1()  {
      row = document.getElementById('wrapper');
      row.style.display = 'none';


      row = document.getElementById('wrapper2');
      row.style.display = '';

    }


     //보이기, 안 보이기
     function find_normal()  {
      row1 = document.getElementById('wrapper2');
      row2 = document.getElementById('search_btn2');
      row1.style.display = 'none';
      row2.style.display = 'none';

      row1 = document.getElementById('wrapper');
      row2 = document.getElementById('search_btn');
      row2.style.display = '';
      row1.style.display = '';

    }

    function find_num()  {
      row = document.getElementById('wrapper');
      row.style.display = 'none';

      row1 = document.getElementById('search_btn');
      row1.style.display = 'none';

      row = document.getElementById('wrapper2');
      row.style.display = '';

      row1 = document.getElementById('search_btn2');
      row1.style.display = '';

    }
    function chkprint(){
      var values = document.getElementByName("location");
      for(var i =0; i<values.length; i++){
        if(values[i].checked){
          // alert(values[i].value);
        }
      }
    }
