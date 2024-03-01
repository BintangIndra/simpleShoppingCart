@extends('welcome')

@section('content')
    <div class="row container-fluid" style="padding:1vh 2vw 1vh 2vw;">
        <table id="tableTransaksi">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Pilihan Harga</th>
                    <th>Kuantitas</th>
                    <th>Subtotal</th>
                    <th>Hapus</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>John Doe</td>
                    <td>Rp 100.000</td>
                    <td>2</td>
                    <td>Rp 120.000</td>
                    <td>X</td>
                </tr>
                <tr>
                    <td>Jane Smith</td>
                    <td>Rp 100.000</td>
                    <td>2</td>
                    <td>Rp 120.000</td>
                    <td>X</td>
                </tr>
                <tr>
                    <td>Mike Johnson</td>
                    <td>Rp 100.000</td>
                    <td>2</td>
                    <td>Rp 120.000</td>
                    <td>X</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        $('#tableTransaksi').DataTable();
    </script>
@endsection 

@push('scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
@endpush