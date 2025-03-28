<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

</head>
<body>
    <h2>Search SKU</h2>
    <input type="text" id="search" placeholder="Search Sku..." autocomplete="off">
    <div id="search-results"></div>

    {{-- <script>
        $(document).ready(function () {
            $('#search').on('keyup', function () {
                let query = $(this).val();

                if (query.length > 0) {
                    $.ajax({
                        url: "{{ route('search') }}",
                        type: "GET",
                        data: { query: query },
                        success: function (data) {
                            let output = '<ul>';
                            if (data.length > 0) {
                                data.forEach(user => {
                                    output += `<li>${user.itemName}</li>`;
                                    output += `<img src="${'storage'.$user.image}">`;
                                });
                            } else {
                                output += '<li>No results found</li>';
                            }
                            output += '</ul>';
                            $('#search-results').html(output);
                        }
                    });
                } else {
                    $('#search-results').html('');
                }
            });
        });
    </script> --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#search').on('keyup', function () {
                let query = $(this).val();

                if (query.length > 0) {
                    $.ajax({
                        url: "{{ route('sku_search') }}",
                        type: "GET",
                        data: { query: query },
                        success: function (data) {
                            let output = '<ul>';
                            if (data.length > 0) {
                                data.forEach(product => {
                                    output += `<li>${product.sku_name}</li>`;
                                });
                            } else {
                                output += '<li>No results found</li>';
                            }
                            output += '</ul>';
                            $('#search-results').html(output);
                        }
                    });
                } else {
                    $('#search-results').html('');
                }
            });
        });
    </script>


</body>
</html>
