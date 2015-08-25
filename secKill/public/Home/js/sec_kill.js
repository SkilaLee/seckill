
window.onload=function () {
    var 
    //查找所有被点击的元素对象
    secKill = document.getElementsByClassName("seckill"),
    gd_id = document.getElementsByClassName("gd_id");
    //为每个被点击的对象绑定单击事件
    for( var i = 0, len = secKill.length; i < len; i++ ){
        (function( i ){
            secKill[i].onclick = function(){
                //为被点击的时间点li添加active类
                var request = new XMLHttpRequest();
                request.open("POST", "secKill");
                var data = "gd_id=" + gd_id[i].innerHTML;
                request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                request.send(data);
                request.onreadystatechange = function() {
                    if (request.readyState===4) {
                        if (request.status===200) { 
                            document.getElementById("nav").style.display = "block";
                            document.getElementById("nav").innerHTML =  request.responseText ;
                            
                            // 为bug.....点了一个奖品之后,秒杀失败后,再点另一个两个奖品的剩余数都会减一..
                        } 
                        else {
                            alert("发生错误：" + request.status);
                        }
                    } 
                }
            };
        })( i );
    }



    // var cha = document.getElementById('cha1'); 
    // cha.onclick = function(){
    //     document.getElementById("nav").style.display = "none";
    // }
}