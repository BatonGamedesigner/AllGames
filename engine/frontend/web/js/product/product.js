$(document).ready(function () {
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    function addProduct(id, count) {
        var paramsArray = [],
            paramTotalCost = 0;

        $('.params__field').each(function () {
            var paramID = parseInt($(this).attr('id')),
                paramName = $('#label_' + paramID).text(),
                paramVal = $("#select_" + paramID + " option:selected").text(),
                paramCost = parseInt($("#select_" + paramID + " option:selected").attr('cost'));

            if (!isNaN(paramCost)) {
                paramTotalCost += paramCost;
            };

            paramsArray.push({id: paramID, name: paramName, value: paramVal, cost: paramCost});
        });

        paramsArray = JSON.stringify(paramsArray);

        var data = {product_id: id, count: count, params: paramsArray, paramTotalCost: paramTotalCost, _csrf: csrfToken};

        $.ajax({
            method: "POST",
            url: "/cart/a/add-in-cart/",
            data: data
        })
            .done(function (data) {
                var answer = JSON.parse(data),
                    cart = $(document).find('#cart');

                cart.fadeOut(600);
                cart.html(answer.cart);
                cart.fadeIn(300);

            });
    }

    //обновление данных
    function reload () {

        var paramTotalCost = 0,
            costOldNone = parseInt($('.price__old').attr('cost-none')),
            costCurNone = parseInt($('.price__current').attr('cost-none')),
            count =  $('#count_field').val();

        $('.params__field').each(function () {
            var paramID = parseInt($(this).attr('id')),
                paramPrice = parseInt($("#select_" + paramID + " option:selected").attr('cost'));

            if (!isNaN(paramPrice)) {
                paramTotalCost += paramPrice;
            };
        });

        var costOldNew = (costOldNone + paramTotalCost) * count,
            costCurNew = (costCurNone + paramTotalCost) * count;

        costOldNew = number_format(costOldNew, 0, '', ' ');
        costCurNew = number_format(costCurNew, 0, '', ' ');

        $('.price__old').fadeOut(100).html(costOldNew + ' р.').fadeIn(100);
        $('.price__current').fadeOut(100).html(costCurNew + ' р.').fadeIn(100);
    }

    //обновить при выборе параметра
    $('.select__input').change(function() {
        reload();
    });
    //смена колличества (на клике)
    $(document).on('click', '.count-select__item_button', function () {
        var prodID = parseInt($(this).attr('id')),
            countField = $('#count_field'),
            count = countField.val(),
            action = $(this).hasClass('count-select__item_button_minus');

        if (action) {
            count++;
        } else {
            count--;
        }
        if (count > 0) {
            countField.val(count);
            reload();
        }
    });


    //Добавить в корзину
    $('#add-to-cart').on('click', function () {
        var id = $(this).attr('prodID'),
            count = $('#count_field').val();

        addProduct(id, count);
    });



    function number_format( number, decimals, dec_point, thousands_sep ) {	// Format a number with grouped thousands
        //
        // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
        // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // +	 bugfix by: Michael White (http://crestidg.com)

        var i, j, kw, kd, km;

        // input sanitation & defaults
        if( isNaN(decimals = Math.abs(decimals)) ){
            decimals = 2;
        }
        if( dec_point == undefined ){
            dec_point = ",";
        }
        if( thousands_sep == undefined ){
            thousands_sep = ".";
        }

        i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

        if( (j = i.length) > 3 ){
            j = j % 3;
        } else{
            j = 0;
        }

        km = (j ? i.substr(0, j) + thousands_sep : "");
        kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
        //kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
        kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");


        return km + kw + kd;
    }

});