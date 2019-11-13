$(document).ready(function(){

    'use strict';

    $('body').on('click','.add-product-btn',function(e){
        e.preventDefault();
        var name    = $(this).data('name'),
            id      = $(this).data('id'),
            price   = $(this).data('price');

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
    });//End of add Product

    $('body').on('click','.remove-product-btn',function(e){
        e.preventDefault();
        $(this).closest('tr').remove();
        var id = $(this).data('id');
        $('#product-'+id).removeClass('btn-default disabled').addClass('btn-success');
        //Cacl Total
        calculateTotal();
    });//End of Remove btn

    $('body').on('keyup change','.product-quantity',function(e){
        e.preventDefault();
        var quantity    = $(this).val(),
            unitPrice   = $(this).data('price');
        $(this).closest('tr').find('.product-price').html(quantity * unitPrice);
        calculateTotal();
    });//End of Change Price by Quantity Product

});//End of document Ready

//Calculate Total
function calculateTotal(){
    var price =0;
    $('.order-list .product-price').each(function(){
        price += parseInt($(this).html());
    })
    $('.total-price').html(price);
}