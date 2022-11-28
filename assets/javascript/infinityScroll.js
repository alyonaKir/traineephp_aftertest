
    $(document).ready(function(){

    $(window).scroll(function (){
        if ($(window).scrollTop() + $(window).height() >= $(document).height())
        {
            fetchPostDataLive();
        }
    });

    function fetchPostDataLive()
{
    var ids= $('.web-post:last').attr("id");
    $.ajax({
    type: 'post',
    asynch: false,
    url: '/users',
    cache: false,
    data: {
    getproductdata:ids
},
    success: function (response) {
    //appending the result fetch_product_list page result with div id data_preview
    $('#data_preview').append(response);
}
});
}
});