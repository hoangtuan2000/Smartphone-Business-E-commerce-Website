<?php
function money_format($n){
    $n = (string)$n; //chuyển $n thành chuỗi
    $n = strrev($n); //đảo chuỗi
    $result = ''; //biến kết quả
    for($i = 0; $i < strlen($n); $i++ ){
        if($i%3 == 0 && $i != 0){
            $result.=',';
        }
        $result.=$n[$i];
    }
    $result = strrev($result);

    return $result;
}

//hàm trả giá khi đã khuyến mãi
function price_after_promotion($price_old, $promotion){
    $discount = $price_old * ($promotion / 100);
    $price_new = ceil($price_old - $discount);
    return $price_new;
}