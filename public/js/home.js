$(function() {

    $('.to-cart').click(function(){
        var id = $(this).attr('id');
        var that = this;
        $.ajax({
            method: "post",
            url: "/cart/items",
            data: { itemId: id },
            success: function() {
                $('#myModal').modal('show');
                var el = $('.itemCount');
                var count = parseInt(el.text());
                el.text(count + 1)
            }
        })
    });

    $('#go-to-cart').click(function(){
        window.location.href = "/my-cart";
    })
});