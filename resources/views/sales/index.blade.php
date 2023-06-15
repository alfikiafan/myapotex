@extends('layouts.app')

@section('content')
<div class="container-fluid py-4 px-5">
    <div class="row">
        <div class="col-12">
            <div class="card border shadow-xs mb-4">
                <div class="card-header border-bottom pb-0">
                    <div class="d-sm-flex align-items-center mb-3">
                        <div>
                            <h6 class="font-weight-semibold text-lg mb-0">Sales Transaction</h6>
                            <p class="text-sm mb-sm-0">Record and process sales transaction</p>
                        </div>
                        <div class="ms-auto d-flex">
                            <div class="me-4">
                                <h6 class="font-weight-semibold text-m mb-0">ID Transaction: T0001</h6>
                            </div>
                            <a href="">
                                <button type="button" class="btn btn-sm btn-white btn-icon d-flex align-items-center mb-0 me-2">
                                    <span class="btn-inner--text">Reset‎ transaction</span>
                                </button>
                            </a>
                            <button type="button" id="add-item-btn" class="btn btn-sm btn-dark btn-icon d-flex align-items-center mb-0 me-2">
                                <span class="btn-inner--icon me-2">
                                    <i class="fa-solid fa-plus" style="color: #ffffff;"></i>
                                </span>
                                <span class="btn-inner--text">Add‎ item</span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 py-0">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="text-secondary text-xs font-weight-semibold">No.</th>
                                    <th class="text-secondary text-xs font-weight-semibold">ID</th>
                                    <th class="text-secondary text-xs font-weight-semibold">Medicine Name</th>
                                    <th class="text-secondary text-xs font-weight-semibold">Quantity</th>
                                    <th class="text-secondary text-xs font-weight-semibold">Discount</th>
                                    <th class="text-secondary text-xs font-weight-semibold">Price</th>
                                    <th class="text-secondary text-xs font-weight-semibold">Subtotal</th>
                                    <th class="text-secondary text-xs font-weight-semibold">Action</th>
                                </tr>
                            </thead>
                            <tbody id="items-container">
                                @foreach($sales as $sale)
                                    @foreach($sale->detailSales as $index => $detailSale)
                                        <tr>
                                            <td class="ps-4">{{ $index + 1 }}</td>
                                            <td>{{ $detailSale->medicine->id }}</td>
                                            <td>
                                                <select name="medicine_id[]" class="form-control">
                                                    <option value="">Select Medicine</option>
                                                    @foreach($medicines as $medicine)
                                                        <option value="{{ $medicine->id }}" data-discount="{{ $medicine->discount }}" data-price="{{ $medicine->price }}">{{ $medicine->name }} - {{ $medicine->brand }} - {{ $medicine->category }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" name="quantity[]" class="form-control" required>
                                            </td>
                                            <td>{{ $detailSale->medicine->discount }}</td>
                                            <td>{{ $detailSale->medicine->price }}</td>
                                            <td>{{ $detailSale->medicine->discount * $detailSale->medicine->price * $detailSale->quantity }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger delete-row">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                <tr id="new-row" style="display: none;">
                                    <td class="ps-4"></td>
                                    <td></td>
                                    <td>
                                    <input type="text" name="medicine_name[]" class="form-control autocomplete-medicine" data-discount="" data-price="" required>
                                    </td>
                                    <td>
                                        <input type="number" name="quantity[]" class="form-control" required>
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-danger delete-row">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="discount">Discount</label>
                            <input type="number" name="discount" class="form-control" id="discount" value="" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="number" name="total" class="form-control" id="total" value="" readonly>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-dark me-2">Pay</button>
                        <button type="button" class="btn btn-secondary me-2">Cancel</button>
                        <button type="button" class="btn btn-primary">Print Payment Receipt</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cash">Cash</label>
                            <input type="number" name="cash" class="form-control" id="cash" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="change">Change</label>
                            <input type="number" name="change" class="form-control" id="change" value="" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        // Add Item Button
        $('#add-item-btn').click(function () {
            var newRow = $('#new-row').clone().removeAttr('id').show();
            newRow.find('td:first').text($('#items-container tr').length);
            newRow.find('input[name="medicine_name[]"]').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: '{{ route("sales.search") }}',
                        dataType: 'json',
                        data: {
                            q: request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                minLength: 3,
                select: function(event, ui) {
                    newRow.find('input[name="medicine_name[]"]').val(ui.item.label);
                    newRow.find('input[name="medicine_name[]"]').attr('data-id', ui.item.id);
                    newRow.find('input[name="medicine_name[]"]').attr('data-discount', ui.item.discount);
                    newRow.find('input[name="medicine_name[]"]').attr('data-price', ui.item.price);
                    newRow.find('td:nth-child(2)').text(ui.item.id);
                    newRow.find('td:nth-child(5)').text(ui.item.discount);
                    newRow.find('td:nth-child(6)').text(ui.item.price);
                    updateSubtotal(newRow);
                }
            }).on("keyup", function () {
                var input = $(this);
                if (input.val().length >= 3) {
                input.autocomplete("search", input.val());
                }
            });

            newRow.find('input[name="quantity[]"]').on('input', function() {
                updateSubtotal(newRow);
            });
            $('#items-container').append(newRow);
        });

        // Delete Row Button
        $(document).on('click', '.delete-row', function () {
            $(this).closest('tr').remove();
            updateRowNumbers();
        });

        // Update row numbers
        function updateRowNumbers() {
            $('#items-container tr').each(function (index) {
                $(this).find('td:first').text(index + 1);
            });
        }

        // Update Subtotal
        function updateSubtotal(row) {
            var quantity = row.find('input[name="quantity[]"]').val();
            var discount = row.find('td:nth-child(5)').text();
            var price = row.find('td:nth-child(6)').text();
            var subtotal = quantity * price * (1 - discount);
            row.find('td:nth-child(7)').text(subtotal);
        }
    });
</script>

@endsection
