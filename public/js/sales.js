$(document).ready(function () {
    const itemsContainer = $('#items-container');
    const addItem = $('#add-item-btn');
    addItem.click(function () {
        const newRow = $('#new-row').clone().removeAttr('id').show();
        newRow.find('td:first').text(itemsContainer.find('tr').length - 1);
        newRow.find('input[name="medicine_name[]"]').autocomplete({
            source: function (request, response) {
                $.ajax({
                    url: '{{ route("sales.search") }}',
                    dataType: 'json',
                    data: {
                        q: request.term
                    },
                    success: function (data) {
                        response(data);
                    }
                });
            },
            minLength: 3,
            select: function (event, ui) {
                const medicineInput = newRow.find('input[name="medicine_name[]"]');
                medicineInput.val(ui.item.label);
                medicineInput.attr('data-id', ui.item.id);
                medicineInput.attr('data-discount', ui.item.discount);
                medicineInput.attr('data-price', ui.item.price);
                newRow.find('td:nth-child(2)').text(ui.item.id);
                newRow.find('td:nth-child(5)').text((ui.item.discount * 100) + '%');
                newRow.find('td:nth-child(6)').text('Rp' + ui.item.price);
                updateSubtotal(newRow);
            },
            autofocus: true
        });

        newRow.find('input[name="quantity[]"]').on('input', function () {
            updateSubtotal(newRow);
        });
        newRow.find('.delete-row').click(function () {
            $(this).closest('tr').remove();
            updateRowNumbers();
        });

        itemsContainer.append(newRow);
        updateRowNumbers();

        const hiddenElement = $('.ui-helper-hidden-accessible');
        hiddenElement.remove();
    });

    // Delete Row Button
    $(document).on('click', '.delete-row', function () {
        $(this).closest('tr').remove();
        updateRowNumbers();
    });

    // Add Row on Enter
    $(document).on('keydown', 'input[name="quantity[]"]', function (e) {
        if (e.keyCode === 13) {
            e.preventDefault();
            addItem.click();
        }
    });

    // Update row numbers
    function updateRowNumbers() {
        itemsContainer.find('tr').each(function (index) {
            $(this).find('td:first').text(index + 1);
        });
    }

    // Update Subtotal
    function updateSubtotal(row) {
        const quantity = row.find('input[name="quantity[]"]').val();
        const discount = row.find('input[name="medicine_name[]"]').data('discount');
        const price = row.find('input[name="medicine_name[]"]').data('price');
        const subtotal = quantity * price * (1 - discount);
        row.find('td:nth-child(7)').text(`Rp${subtotal.toFixed(2)}`);
    }

    // Store Sale in database
    function storeSale(success) {
        const cash = $('#cash').val();
        const discount = $('#discount').val();
        const total = $('#total').val();
        const change = $('#change').val();
        const is_success = Number(success);

        if (!is_success) {
            cash = 0;
            change = 0;
        }

        if (is_success && Number(cash) < Number(total)) {
            alert('Insufficient cash amount. Please enter a higher value.');
            return;
        }

        const formData = new FormData();
        formData.append('cash', cash);
        formData.append('discount', discount);
        formData.append('total', total);
        formData.append('change', change);
        formData.append('is_success', is_success);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{ route("sales.store") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                const saleId = response.sale_id;
                const isSuccess = response.is_success;

                const medicineIds = itemsContainer.find('.medicine-id').map(function (_, el) {
                    return el.textContent;
                });
                const quantities = itemsContainer.find('.quantity').map(function (_, el) {
                    return Number(el.value);
                });
                const prices = itemsContainer.find('.price').map(function (_, el) {
                    return parseFloat($(el).text().replace('Rp', '').replace(',', ''));
                }).get();
                const discounts = itemsContainer.find('input[name="medicine_name[]"]').map(function () {
                    return parseFloat($(this).data('discount'));
                }).get();
                const subtotals = itemsContainer.find('.subtotal').map(function (_, el) {
                    return parseFloat($(el).text().replace('Rp', '').replace(',', ''));
                }).get();

                const detailFormData = new FormData();
                detailFormData.append('sale_id', saleId);
                detailFormData.append('is_success', isSuccess);

                for (let i = 0; i < medicineIds.length; i++) {
                    detailFormData.append('medicine_id[]', medicineIds[i]);
                    detailFormData.append('quantity[]', quantities[i]);
                    detailFormData.append('price[]', prices[i]);
                    detailFormData.append('discount[]', discounts[i]);
                    detailFormData.append('subtotal[]', subtotals[i]);
                }

                $.ajax({
                    url: '{{ route("detailsales.store", ":sale_id") }}'.replace(':sale_id', saleId),
                    method: 'POST',
                    data: detailFormData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        if (response.status === 'nostock') {
                            alert('One or more medicine stock is empty.');
                            response.message.forEach(function (item) {
                                alert(item + '\n');
                            });
                            return;
                        }
                        alert(response.message);
                        location.reload();
                    },
                    error: function (error) {
                        alert('Failed to add transaction details. Please try again.');
                    }
                });
            },
            error: function (error) {
                alert('Failed to add transaction. Please try again.');
            }
        });
    }

    $(document).on('input', 'input[name="quantity[]"]', function () {
        let discount = 0;
        let total = 0;
        itemsContainer.find('tr').each(function () {
            const quantity = $(this).find('input[name="quantity[]"]').val();
            const price = $(this).find('input[name="medicine_name[]"]').data('price');
            const itemDiscount = $(this).find('input[name="medicine_name[]"]').data('discount');
            const subtotal = quantity * price * (1 - itemDiscount);
            total += subtotal;
            discount += quantity * price * itemDiscount;
        });

        $('#discount').val(discount);
        $('#total').val(total);
    });

    $(document).on('input', '#cash', function () {
        const cash = $(this).val();
        const total = parseFloat($('#total').val());
        const change = cash - total;

        $('#change').val(change);
    });

    $('#pay-btn').click(function () {
        storeSale(true);
    });

    $('#cancel-btn').click(function () {
        storeSale(false);
    });

    $('#reset-transaction-btn').click(function () {
        itemsContainer.empty();
    });
});