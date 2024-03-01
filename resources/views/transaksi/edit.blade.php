@extends('welcome')

@section('content')
    <style>
        .trtotal td{
            border-bottom: none !important;
        }
    </style>
    <div class="row container-fluid" style="padding:1vh 2vw 1vh 2vw;">
        <table id="tableTransaksi">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Pilihan Harga</th>
                    <th>Kuantitas</th>
                    <th>Subtotal</th>
                    <th style="text-align: center !important;">Hapus</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaksi as $val)
                    <tr id="tr{{$val->id}}">
                        <td>{{$val->master_data->nama}}</td>
                        <td>{{$val->master_data->harga}}</td>
                        <td><input type="number" value="{{$val->jumlah}}" id="qty{{$val->id}}" data-id="{{$val->id}}" data-master_data="{{$val->master_data->id}}" class="qty"></td>
                        <td>{{$val->jumlah * $val->master_data->harga}}</td>
                        <td style="text-align: center !important;"><button class="btn delete" data-id="{{$val->id}}">X</button></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td colspan="2"><button class="btn" style="color:green;" data-bs-toggle="modal" data-bs-target="#diskonModal"><b>Gunakan Code Diskon / Reward</b></button></td>
                    <td></td>
                </tr>
                <tr class="trtotal">
                    <td></td>
                    <td></td>
                    <td colspan="2"><p id="cardTotal">Total</p></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>


        <div class="modal fade" id="diskonModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content" style="color:black;">
                <div class="modal-header">
                    <h5 class="modal-title">Kode Diskon</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                <div class="modal-body d-flex justify-content-start">
                    <input type="text" id="diskonVal" placeholder="Diskon Code" class="form-control" style="border-radius: 0px !important;">
                    <button class="btn" id="addDiskon" style="background-color:coral;color:white;border-radius: 0px !important;">Terapkan</button>
                </div>
            </div>
            </div>
        </div>

    </div>
    <script>
        function updateData(element){
            var url = '{{ route('transaksi.update','@@@@') }}';
            url = url.replace('@@@@', element.data('id'));
            var formData = {
                id : element.data('id'),
                master_data_id : element.data('master_data'),
                jumlah : element.val()
            }
            
            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    data: formData
                },
                success: function(response) {
                    console.log('Success:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        function deleteData(element){
            var url = '{{ route('transaksi.destroy','@@@@') }}';
            url = url.replace('@@@@', element.data('id'));
            
            $.ajax({
                url: url,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('Success:', response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        $(document).on('change', '.qty', function() {
            updateData($(this));
            getTotal()
        });

        $('.delete').click(function() {
            var confirm = window.confirm('Are You Sure to Delete?')
            if (confirm) {
                deleteData($(this));
                getTotal()
            }
        })

        function getTotal(){
            var url = '{{ route('transaksi.getTotal') }}';
            var formData = {
                diskon: $('#diskonVal').val(),
                idTransaksi: '{{$idTransaksi}}'
            }

            $.ajax({
                url: url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    data: formData
                },
                success: function(response) {
                    console.log('Success:', response);
                    $('#cardTotal').text('Total : ' + response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        $('#addDiskon').click(function() {
            getTotal()
        })
        
        getTotal()

    </script>
@endsection 