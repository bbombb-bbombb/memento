<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="css/w3.css">
<link href='https://fonts.googleapis.com/css?family=Kanit' rel='stylesheet'>
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->
<?php include 'header.php';?>

    <head>

    </head>
    <body>
        
        <center>
        <h1 >Hello World</h1>
        <div class="w3-border w3-round">
            <form name="myForm" id="myForm" method="post" enctype="multipart/form-data">
                <table >
                    <tr><td>เพศ</td><td>
                        <select id="gender" name="gender">
                            <option value="0">none</option>
                            <option value="1" selected>หญิง</option>
                            <option value="2">ชาย</option></select></td></tr>
                    <tr><td>ช่วงอายุ</td><td>
                        <select id="ageRange" name="ageRange">
                            <option value="0" >none</option>
                            <option value="1" >18-24</option>
                            <option value="2" >25-35</option>
                            <option value="3" >36-46</option>
                            <option value="4">47-60</option></select></td></tr>
                    <tr><td>ชื่อ</td><td><input type="text" id="name" name="name"></td></tr>
                    <tr><td>ที่อยู่</td><td><textarea rows="4" id="address" name="address"></textarea></td></tr>
                    <tr><td>เบอร์โทร</td><td><input type="text" id="phoneNumber" name="phoneNumber"></td></tr>
                    <tr><td>ค่าส่ง</td><td><input type="text" id="shippingPrice" name="shippingPrice"></td></tr>
                    <tr><td>สั่งผ่านทาง</td><td>
                        <select id="orderBy" name="orderBy"><option value="1">Inbox</option>
                            <option value="2" >Shopify</option>
                            <option value="3" >Line My Shop</option>
                            <option value="4" >Shopee</option>
                            <option value="5" >Lazada</option></select></td></tr>
                
                </table>
                <tr><td><input type="submit" id="btnSubmit" value="ยืนยัน" onclick="submitForm()" tabindex="<?php echo $tabindex++;?>"></td>
                <button type="reset">ยกเลิก</button>
            </form>
        </div>
        <p>จัดส่งแล้ววันนี้</p>
        <?php 
            $date=(date('Y')+543).(date('-m-d')); //today
            $sql = "SELECT * FROM `order` WHERE `date`='$date'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $i=0;
                echo "<table><tr><td>เพศ</td><td>ช่วงอายุ</td><td>ชื่อ</td><td>ที่อยู่</td><td>เบอร์โทร</td><td>ค่าส่ง</td><td>จัดส่งโดย</td>";
                while($row = $result->fetch_assoc()) {
                    echo   "<tr><td>".$row["gender"]."</td>
                                <td>".$row["ageRange"]."</td>
                                <td>".$row["name"]."</td>
                                <td>".$row["address"]."</td>
                                <td>".$row["phoneNumber"]."</td>
                                <td>".$row["shippingPrice"]."</td>
                                <td>".$row["orderBy"]."</td>
                                <td><button id='row'".$i++."> ลบ </button></td></tr>
                            ";
                }
                echo "</table>";
            }
        ?>
        <div>
            <table>
                
            </table>
        </div>
        </center>






    </body>
</html>
<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript" src="javascript/sweetAlert.js"></script>
<script type="text/javascript" src="javascript/goBack.js"></script>
<script type="text/javascript">

function submitForm(){
          //stop submit the form, we will post it manually.
          event.preventDefault();
   
          // Get form
          var form = $('#myForm')[0];
   
         // Create an FormData object 
          var data = new FormData(form);
          // disabled the submit button
          //$("#btnSubmit").prop("disabled", true);
   
          $.ajax({
              type: "POST",
              enctype: 'multipart/form-data',
              url: "orderInsert.php",
              data: data,
              processData: false,
              contentType: false,
              cache: false,
              timeout: 800000,
              success: function (data) {
   
                  //$("#output").text(data);
                  console.log("SUCCESS : ", data);
                  //$("#btnSubmit").prop("disabled", false);
                  

                  swal({
                    buttons: ["อยู่ต่อ", "กลับหน้าแรก"],
                    title: "ข้อมูลได้ถูกบันทึกแล้ว",
                    icon: "success",
                    dangerMode: false, //focus on the okay
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      location.href="index.html";
                    } else {
                      form.reset();
                    }
                  });

              },
              error: function (e) {
   
                  //$("#output").text(e.responseText);
                  console.log("ERROR : ", e);
                  $("#btnSubmit").prop("disabled", false);

                  swal({
                    buttons: ["อยู่ต่อ", "กลับหน้าแรก"],
                    title: "ไม่สำเร็จ",
                    icon: "error",
                    dangerMode: false, //focus on the okay
                  })
                  .then((willDelete) => {
                    if (willDelete) {
                      location.href="index.html";
                    } else {
                      //form.reset();
                    }
                  });
              }
          });
}
</script>