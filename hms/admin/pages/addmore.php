<!doctype html>
<html lang="en">

<head>
    <title>Add More Section</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row my-4">
            <div class="col-lg-10 mx-auto">
                <div class="card shadow">
                    <div class="card shadow">
                        <div class="card-header">
                            <h4>Add items</h4>
                        </div>
                        <div class="card-body p-4">
                            <form action="#" method="POST" id="add_form">
                                <div id="show_item">
                                    <div class="row">
                                        <div class="col-md-4 nb-3">
                                            <input type="text" name="product_name[]" class="form-control"
                                                placeholder="Item Name" required>
                                        </div>
                                        <div class="col-md-3 nb-3">
                                            <input type="number" name="product_price[]" class="form-control"
                                                placeholder="Item Price" required>
                                        </div>
                                        <div class="col-md-3 nb-3">
                                            <input type="number" name="product_quantity[]" class="form-control"
                                                placeholder="Item Quantity" required>
                                        </div>
                                        <div class="col-md-2 nb-3" d-grid>
                                            <button type="button" class="btn btn-success add_item_btn">Add More</button>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                <input type="submit" value="Submit" class="btn btn-primary w-25" id="add_btn">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <script>
    $(document).ready(function(){
    // Function to add items
    $(".add_item_btn").click(function(e){
        e.preventDefault();
        $("#show_item").prepend('<div class="row">' +
                                '<div class="col-md-4 nb-3">' +
                                    '<input type="text" name="product_name[]" class="form-control"' +
                                        'placeholder="Item Name" required>' +
                                '</div>' +
                                '<div class="col-md-3 nb-3">' +
                                    '<input type="number" name="product_price[]" class="form-control"' +
                                        'placeholder="Item Price" required>' +
                                '</div>' +
                                '<div class="col-md-3 nb-3">' +
                                    '<input type="number" name="product_quantity[]" class="form-control"' +
                                        'placeholder="Item Quantity" required>' +
                                '</div>' +
                                '<div class="col-md-2 nb-3" d-grid>' +
                                    '<button type="button" class="btn btn-danger remove_item_btn">Remove</button>' +
                                '</div>' +
                            '</div>');
    });

    // Function to remove items
    $("#show_item").on("click", ".remove_item_btn", function() {
        $(this).closest('.row').remove();
        console.log("Item removed"); // Add this line for debugging
    });
});




    </script>
</body>

</html>