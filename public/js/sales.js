$(document).ready(function () {
    const itemsContainer = $('#items-container');
    const addItem = $('#add-item-btn');

    const ajax_meds_search = function (request, response) {
        $.ajax({
            url: '/sales/search',
            dataType: 'json',
            data: {
                q: request.term
            },
            success: function (data) {
                response(data);
            }
        });
    }

    const ajax_meds_select = function (newRow, event, ui ) {
        const medicineInput = newRow.find('.autocomplete-medicine');
        medicineInput.val(ui.item.label);
        medicineInput.attr('data-id', ui.item.id);
        medicineInput.attr('data-discount', ui.item.discount);
        medicineInput.attr('data-price', ui.item.price);
        newRow.find('.medicine-id').text(ui.item.id);
        newRow.find('.discount').text((ui.item.discount * 100) + '%');
        newRow.find('.price').text('Rp' + ui.item.price);
        updateSubtotal(newRow);
    }

    addItem.click(function () {
        const newRow = $('#new-row').clone().removeAttr('id').show();
        newRow.find('.autocomplete-medicine').autocomplete({
            source: ajax_meds_search,
            minLength: 3,
            select: ajax_meds_select.bind(this, newRow),
            autofocus: true
        });

        newRow.find('.item-quantity input').on('input', function () {
            updateSubtotal(newRow);
        });
        newRow.find('.delete-row').click(function () {
            newRow.remove();
            updateRowNumbers();
        });

        itemsContainer.append(newRow);
        updateRowNumbers();

        $('.ui-helper-hidden-accessible').remove();
    });

    // Delete Row Button
    $(document).on('click', '.delete-row', function () {
        $(this).closest('tr').remove();
        updateRowNumbers();
    });

    // Add Row on Enter
    $(document).on('keydown', '.item-quantity input', function (e) {
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
        const quantity = row.find('.item-quantity input').val();
        const discount = row.find('.medicine-data input').data('discount');
        const price = row.find('.medicine-data input').data('price');
        const subtotal = quantity * price * (1 - discount);

        row.find('.subtotal').text(`Rp${subtotal.toFixed(2)}`);
    }

    // Store Sale in database
    function storeSale(success) {
        let  cash = $('#cash').val();
        const discount = $('#discount').val();
        const total = $('#total').val();
        let change = $('#change').val();
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
        formData.append('is_success', is_success.toString());

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/sales',
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
                const quantities = itemsContainer.find('.item-quantity input').map(function (_, el) {
                    return Number(el.value);
                });
                const prices = itemsContainer.find('.medicine-data input').map(function (_, el) {
                    return Number(el.getAttribute('data-price'));
                });
                const discounts = itemsContainer.find('.medicine-data input').map(function (_, el) {
                    return Number(el.getAttribute('data-discount'));
                });
                const subtotals = itemsContainer.find('.subtotal').map(function (_, el) {
                    return prices[_] * quantities[_] * (1 - discounts[_]);
                });

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
                console.log('saleid' + saleId);
                for (var pair of detailFormData.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]);
                }

                $.ajax({
                    url: '/sales/' + saleId,
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
                        if (response.status === 'weird') {
                            alert('Data manipulation detected');
                            response.weirdMessage.forEach(function (item) {
                                alert(item + '\n');
                            });
                            alert('Please don\'t do that again');
                        }
                        alert(response.message);
                        if (response.status === 'notenough') {
                            return;
                        }
                        location.reload();
                    },
                    error: function (error) {
                        alert('(detailsale/store) Failed to add transaction details. Please try again.');
                    }
                });
            },
            error: function (error) {
                console.log(error);
                alert('(sale/store) Failed to add transaction. Please try again.');
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
