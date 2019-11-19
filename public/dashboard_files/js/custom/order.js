$(document).ready(function(){

    'use strict';

    //Add Product btn
    $('body').on('click','.add-product-btn',function(e){
        e.preventDefault();
        var name    = $(this).data('name'),
            id      = $(this).data('id'),
            price   = $.number($(this).data('price'),2);

        $(this).removeClass('btn-success').addClass('btn-default disabled');
        var html =`
            <tr>
                <td>${name}</td>
                <td><input type="number" data-price="${price}"  name="quanities[]" class="form-control input-sm product-quantity" min="1" value="1" /></td>
                <td class="product-price">${price}</td>
                <td><button data-id=${id} class="btn btn-danger btn-sm remove-product-btn"><span class="fa fa-trash"></span></button></td>
                </tr>
        `;
        $('.order-list').append(html);
        //Cacl Total
        calculateTotal();
    });
    //Remove Product btn
    $('body').on('click','.remove-product-btn',function(e){
        e.preventDefault();
        $(this).closest('tr').remove();
        var id = $(this).data('id');
        $('#product-'+id).removeClass('btn-default disabled').addClass('btn-success');
        //Cacl Total
        calculateTotal();
    });
    //Change Price by Quantity Product
    $('body').on('keyup change','.product-quantity',function(e){
        e.preventDefault();
        var quantity    = Number($(this).val());
        var unitPrice   =  $(this).data('price');
        console.log(unitPrice)
        $(this).closest('tr').find('.product-price').html($.number(quantity * unitPrice,2));
        calculateTotal();
    });

});//End of document Ready

//Calculate Total
function calculateTotal(){
    var price =0;
    $('.order-list .product-price').each(function(){
        price = parseFloat($(this).html().replace(/,/g, ''));
    })
    $('.total-price').html($.number(price,2));
}