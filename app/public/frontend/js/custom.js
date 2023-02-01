$(document).ready(function () {
    // loadcart();
    // loadwishlist();

    function loadcart()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "get",
            url: "/load-cart-data",
            success: function (response) {
                // $('.cart-count').html('');
                $('.cart-count').html(response.count);
            },
        });
    }

    function loadwishlist()
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "get",
            url: "/load-wishlist-data",
            success: function (response) {
                $('.wishlist-count').html(response.count);
            },
        })
    }

    $('#addtoWishlist').click(function (e) {
        e.preventDefault();
        let prod_id = $('#prod_id').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/add-to-wishlist",
            data: {
                'product_id': prod_id,
            },
            success: function (response) {
                loadwishlist();
                Swal.fire({
                    title: response.status,
                    confirmButtonText: 'OK',
                });
            }
        });
    });

    $('#addtoCart').click(function (e) {
        e.preventDefault();
        let prod_id = $('#prod_id').val();
        let prod_qty = $('#quantity').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/add-to-cart",
            data: {
                'prod_id': prod_id,
                'prod_qty': prod_qty,
            },
            success: function (response) {
                loadcart();
                Swal.fire({
                    title: response.status,
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    $(document).on('click','.incrementbtn', function (e) {
        e.preventDefault();
        let max = parseInt($(this).closest('.product-data').find('.maxquantity').val());
        let inc_value = $(this).closest('.product-data').find('.quantity').val();
        let value = parseInt(inc_value, 10);

        value = isNaN(value) ? 0 : value;

        if (value < max)
        {
            value++;
        }

        $(this).closest('.product-data').find('.quantity').val(value);
    });

    $(document).on('click','.decrementbtn', function (e) {
        // const max = $(this).closest('product-data').find('.maxquantity').val();
        e.preventDefault();

        let inc_value = $(this).closest('.product-data').find('.quantity').val();
        let value = parseInt(inc_value, 10);

        value = isNaN(value) ? 0 : value;

        if (value > 1)
        {
            value--;
        }

        $(this).closest('.product-data').find('.quantity').val(value);
    });

    $('.quantity').change(function (e) {
        e.preventDefault();
        const max = $(this).closest('.product-data').find('.maxquantity').val();
        let value = parseInt($(this).closest('.product-data').find('.quantity').val());

        if (value > max)
        {
            $(this).closest('.product-data').find('.quantity').val(max);
        }
    });

    $(document).on('click','.delete-cart-item', function (e) {

        e.preventDefault();
        let prod_id = $(this).closest('.product-data').find('.prod_id').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "post",
            url: "/delete-cart-item",
            data: {
                'prod_id': prod_id,
            },
            success: function (response) {
                loadcart();
                loadwishlist();
                $('.cartitems').load(location.href + ' .cartitems');
                Swal.fire({
                    title: response.status,
                    confirmButtonText: 'OK'
                });
            }
        });
    });

    $(document).on('click', '.changeQuantity', function (e) {
        e.preventDefault();
        let prod_id = $(this).closest('.product-data').find('.prod_id').val();
        let qty = $(this).closest('.product-data').find('.quantity').val();
        let price = $(this).closest('.product-data').find('.selling-price').html();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "post",
            url: "/update-cart",
            data: {
                'prod_id' : prod_id,
                'prod_qty': qty,
            },
            failure: function (response) {
                return;
            }
        });

        $('.total-price').html('$' + price * qty);
    });

    $('.delete-wishlist-item').click(function (e) {
        e.preventDefault();
        let prod_id = $(this).closest('.product-data').find('#prod_id').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "post",
            url: "/delete-wishlist-item",
            data: {
                'prod_id': prod_id,
            },
            success: function (response) {
                loadwishlist();
                loadcart();
                $('.product-data').load(location.href + ' .productd-data');
                Swal.fire({
                    title: response.status,
                    confirmButtonText: 'OK'
                });
            }
        });
    });
});
