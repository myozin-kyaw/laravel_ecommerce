$(document).ready(function() {

    loadCart();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function loadCart() 
    {
        $.ajax({
            method : "GET",
            url : "/load-cart-data",
            success : function (response) {
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
            }
        })
    }

    $('.addToCartBtn').click(function(e) {
        e.preventDefault();

        let product_id = $(this).closest('.product_data').find('.prod_id').val();
        let product_qty = $(this).closest('.product_data').find('.qty-input').val();

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                'product_id' : product_id,
                'product_qty' : product_qty,
            },
            success: function(response) {
                swal(response.status);
                loadCart()
            }
        });
    });

    $('.increment-btn').click(function(e) {
        e.preventDefault();

        let inc_value = $(this).closest('.product_data').find('.qty-input').val();
        let value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    })

    $('.decrement-btn').click(function(e) {
        e.preventDefault();

        let dec_value = $(this).closest('.product_data').find('.qty-input').val();
        let value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $(this).closest('.product_data').find('.qty-input').val(value);
        }
    });

    $('.delete-cartItem').click(function(e) {
        e.preventDefault();

        let prod_id = $(this).closest('.product_data').find('.prod_id').val();

        $.ajax({
            method: "POST",
            url: "delete-cartItem",
            data: {
                'prod_id': prod_id,
            },
            success: function (response) {
                swal("", response.status, "success");
                window.location.reload();
                
            }
        })
    })

    $('.changeQuantity').click(function(e) {
        e.preventDefault();

        let prod_id = $(this).closest('.product_data').find('.prod_id').val();
        let qty = $(this).closest('.product_data').find('.qty-input').val();
        data = {
            'prod_id' : prod_id,
            'prod_qty' : qty,
        }

        $.ajax({
            method : "POST",
            url : "update-cartItem",
            data : data,
            success: function(response) {
                window.location.reload();
            }
        });
    });

});

