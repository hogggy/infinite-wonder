
$(function() {

    changeCartTotal();

    var quantInput = $('.change-quantity');
    quantInput.keypress(function(){
        if ($(this).val().length > 1) {
            return false;
        }
    });
    var paymentUrl = "";

    quantInput.change(function(){
        if ($(this).val() > 99) {
            $(this).val(99)
        }
        console.log(parseInt($(this).val()));
        if (isNaN(parseInt($(this).val())) || parseInt($(this).val()) < 1) {
            $(this).val(1)
        }
        var quantity = parseInt($(this).val());
        $(this).val(quantity);
        var id = $(this).closest('.row').attr("id");
        $.ajax({
            method: "put",
            url: "/cart/items",
            data: {
                quantity: quantity,
                itemId: id
            }
        });
        changeCartTotal();
        changeItemCountHeader();
    });

    $('.nav li').removeClass('active');
    $('#cart_menu_item').addClass('active');

    $('.order').click(function(){
        if ($(this).hasClass('empty') == false) {
            $('.summary').slideUp(1000);
            $('.shippingInfo').show();
        }
    });

    function changeItemCountHeader() {
        var total = 0;
        $('.change-quantity').each(function() {
            total += parseInt($(this).val());
        });
        $('.itemCount').text(total);
    }

    function changeCartTotal() {
        var totalPrice = 0;
        $('.cart-item').each(function() {
            var count = $(this).find('.change-quantity').val();
            var price = parseFloat($(this).find('.price').text().substring(1));
            totalPrice += price * count
        });

        totalPrice = totalPrice.toFixed(2);
        if (totalPrice <= 0) {
            var orderButton = $('.order');
            orderButton.addClass('empty');
            orderButton.css('color', 'grey');
        }

        $('.totals').find('.price').text('$' + totalPrice);
    }

    $('.remove').click(function(){
        var parent = $(this).parent();
        var id = parent.attr("id");
        var count = parent.find('.change-quantity').val();
        var price = parseFloat(parent.find('.price').text().substring(1));
        console.log(price + " " + count);
        $.ajax({
            method: "delete",
            url: "/cart/items/" + id,
            success: function() {
                parent.remove();
                changeItemCountHeader();
                changeCartTotal();
            }
        })
    });

    $('#payment-form').validator().on('submit', function(e){
        if (e.isDefaultPrevented()) {
            return false;
        }

        saveBillingAddress();
        var month = $(this).find("[name='month']");
        var year = $(this).find("[name='year']");
        var ccNumber = $(this).find("[name='billing-cc-number']").val();
        var last4 =  ccNumber.substr(ccNumber.length - 4);
        $.ajax({
            method: "post",
            url: "/cart/card",
            data: {
                expMonth: month.val(),
                expYear: year.val(),
                lastFour: last4,
                sameAsShipping: $('#same-as-shipping').is(':checked')
            }
        });

        var exp = $(this).find("[name='billing-cc-exp']");
        exp.val(month.val() + year.val());
        month.remove();
        year.remove();

        return true;
    });

    function saveBillingAddress() {
        if ($('#same-as-shipping').is(':checked') == false) {
            var form = $('#payment-form');
            $.ajax({
                method: "post",
                url: "/address",
                data: {
                    type: "billing",
                    name: form.find("[name='billing-account-name']").val(),
                    address1: form.find("[name='billing-address1']").val(),
                    address2: form.find("[name='billing-address2']").val(),
                    city: form.find("[name='billing-city']").val(),
                    state: form.find("[name='billing-state']").val(),
                    postal: form.find("[name='billing-postal']").val(),
                    country: form.find("[name='billing-country']").val()
                }
            })
        }
    }

    function copyShippingAddress() {
        var shippingInfo = $('#shipping-form').serializeArray();
        $.each(shippingInfo, function(index, item) {
            var el = $('.billing-address').find("[name='billing-" + item.name + "']");
            if (el) {
                el.val(item.value);
            }
        });
    }

    $('#shipping-form').validator().on('submit', function(e){
        if (e.isDefaultPrevented()) {

        }
        else {
            var addressReview = $('#address-review');
            addressReview.empty();
            $.ajax({
                method: "post",
                url: "/address",
                data: $(this).serialize()
            }).done(function(data){
                $('.shippingInfo').slideUp(1000);
                $('.billingInfo').show();
                copyShippingAddress();
                $('#payment-form').attr("action", data.url);
            });
        }

        return false;
    });

    $('#same-as-shipping').change(function(){
        if(this.checked) {
            $('.billing-address').hide();
            copyShippingAddress();
        }
        else {
            var ba = $('.billing-address');
            ba.show();
            ba.find(":input").val('');
        }
    });

    $('#edit-address').click(function(){
        $('.shippingInfo').slideDown(1000, function(){
            $('.review').hide();
        });
    });

    $('#edit-cart').click(function(){
        $('.summary').slideDown(1000, function(){
            $('.review').hide();
        });
    });

    $('#edit-billing').click(function(){
        $('.billingInfo').slideDown(1000, function(){
            $('.review').hide();
        });
    });

});