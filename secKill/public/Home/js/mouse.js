window.onload=function () {
        var 
        //记录当前已经添加active类的li的索引号
        curIndex = 0,
        //查找所有被点击的元素对象
        goods = document.getElementsByClassName("goods"),

        //查找所有li元素对象
        cha = document.getElementsByClassName("cha");

    //为每个被点击的对象绑定单击事件
    for( var i = 0, len = goods.length; i < len; i++ ){
        (function( i ){
            goods[i].onmouseover = function(){
                //为被点击的时间点li添加active类
                cha[i].style.display = "block";

            };
            goods[i].onmouseout = function(){
                //为被点击的时间点li添加active类
                cha[i].style.display = "none";

            };
        })( i );
    } 
}