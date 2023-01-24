 $(document).ready(function() {

            //plus cal
            $('.btn-plus').click(function() {
                $parentNode = $(this).parents('tr');

                total();

            });

            //minus cal
            $('.btn-minus').click(function() {
                $parentNode = $(this).parents('tr');

                total();

            });

            function total() {
                $price = Number($parentNode.find('#price').html().replace('kyats', ''));

                $qty = $parentNode.find('#qty').val();


                $total = $price * $qty;

                $parentNode.find('#total').html($total + "kyats");
                $totalPrice = 0;
                $("#dataTable tr").each(function(index, row) {
                    $totalPrice += Number($(row).find('#total').text().replace("kyats",
                        ""));
                });

                $("#totalPrice").html(`${$totalPrice} kyats`);
                $('#totalAll').html($totalPrice + 3000 + 'kyats');
            }


            //remove cart



        });
