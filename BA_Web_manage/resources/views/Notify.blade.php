<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>CẢM ƠN BẠN ĐÃ ĐẶT LỊCH KHÁM Ở MH CARE</h1>
    <P>EMAIL NÀY THÔNG BÁO TỚI BẠN THÔNG TIN LICH KHÁM CỦA BẠN</P>
    <P style="font-weight: bold">Thân gửi:Ông/Bà {{$data->fullname_main}}</P>
    <span style="font-size:16px; display:block">
    Chúng tôi gửi mail này để thông báo với Ông/Bà {{$data->fullname_main}} có lịch khám vào lúc {{ $data->name . "/" . $data->year }} - {{ $data->time }} 
    </span>
    <p>Vui lòng không phản hồi lại mail này, xin cảm ơn</p><br>
    <span>Cảm ơn bạn đã đăng ký tài khoản</span>
</body>
</html>