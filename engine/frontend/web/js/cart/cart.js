$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    //смена кооличества (отправка)
    function changeCount(id, count) {
        var data = {cart_id: id, count: count, _csrf: csrfToken};

        $.ajax({
            method: "POST",
            url: "/cart/a/set-count/",
            data: data
        })
            .done(function (data) {
                var answer = JSON.parse(data);

                reload(answer.cart, answer.totalSum,answer.totalCount, id, answer.amount);

            });
    }

    //удаление из корзины (отправка)
    function removeProduct(id) {

        $.ajax({
            method: "POST",
            url: "/cart/a/delete-from-cart/",
            data: {cart_id: id, _csrf: csrfToken}
        })
            .done(function (data) {
                var answer = JSON.parse(data);

                reload(answer.cart, answer.totalSum, answer.totalCount);

                $('#product_' + id).remove();

                if ($(document).find('.row').length <= 1) {
                    location.reload(true)
                }
            });
    }

    //обновление данных
    function reload (cart, totalSum, totalCount, id, amount) {

        var cartElem = $(document).find('#cart');

        cartElem.html(cart);

        if (isNaN(amount)){
            $('#total_' + id).fadeOut(100).html(amount).fadeIn(100);
        }
        $('#prod-price').fadeOut(100).html(totalSum).fadeIn(100);
        $('#total-count').html(totalCount);
        $('#total-price').html(totalSum);
    }

    //смена колличества (на клике)
    $(document).on('click', '.count-select__item_button', function () {
        var prodID = parseInt($(this).attr('id')),
            countField = $('#count_field__' + prodID),
            count = countField.val(),
            action = $(this).hasClass('count-select__item_button_minus');

        if (action) {
            count++;
        } else {
            count--;
        }
        if (count > 0) {
            countField.val(count);
            changeCount(prodID,count);
        }
    });
    //смена колличества (на инпуте)
    $(document).on('input', '.count-select__input', function () {
        var prodID = parseInt($(this).attr('prodID')),
            count = $(this).val();

        if (count > 0) {
            changeCount(prodID,count);
        }
    });

    //удаление из корзины
    $(document).on('click', '.button-large', function () {
        var prodID = parseInt($(this).attr("prodID"));

        removeProduct(prodID);
    });



});