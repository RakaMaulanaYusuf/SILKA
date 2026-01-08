{{-- resources/views/pdf/kode-akun.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        
        .company-name {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .title {
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .period {
            font-size: 10px;
            margin-bottom: 15px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        th, td {
            border: 1px solid #000;
            padding: 4px;
            text-align: left;
            vertical-align: top;
        }
        
        th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
            font-size: 10px;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .total-row {
            font-weight: bold;
            background-color: #f9f9f9;
        }
        
        .empty-row {
            height: 20px;
        }
        
        .col-code {
            width: 12%;
        }
        
        .col-name {
            width: 40%;
        }
        
        .col-report {
            width: 16%;
        }
        
        .col-debit {
            width: 16%;
        }
        
        .col-credit {
            width: 16%;
        }
    </style>
</head>
<body>
    {{-- Header --}}
    <div class="header">
        <div class="company-name">{{ strtoupper($companyName) }}</div>
        <div class="title">{{ $title }}</div>
        <div class="period">Periode: {{ $periodName }}</div>
    </div>

    {{-- Table --}}
    <table>
        <thead>
            <tr>
                <th class="col-code">KODE<br>AKUN</th>
                <th class="col-name">NAMA AKUN</th>
                <th class="col-report">POS<br>LAPORAN</th>
                <th colspan="2" class="text-center">SALDO AWAL</th>
            </tr>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th class="col-debit">DEBET</th>
                <th class="col-credit">KREDIT</th>
            </tr>
        </thead>
        <tbody>
            {{-- Data Accounts --}}
            @foreach($accounts as $account)
            <tr>
                <td class="text-center">{{ $account['kode_akun'] }}</td>
                <td>{{ $account['nama_akun'] }}</td>
                <td class="text-center">{{ $account['pos_laporan'] }}</td>
                <td class="text-right">
                    @if($account['pos_saldo'] == 'DEBIT' && $account['debit'] > 0)
                        {{ number_format($account['debit'], 0, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
                <td class="text-right">
                    @if($account['pos_saldo'] == 'CREDIT' && $account['credit'] > 0)
                        {{ number_format($account['credit'], 0, ',', '.') }}
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach

            

            {{-- Total Row --}}
            <tr class="total-row">
                <td colspan="3" class="text-center"><strong>JUMLAH TOTAL</strong></td>
                <td class="text-right">
                    <strong>{{ number_format($totalDebit, 0, ',', '.') }}</strong>
                </td>
                <td class="text-right">
                    <strong>{{ number_format($totalCredit, 0, ',', '.') }}</strong>
                </td>
            </tr>
        </tbody>
    </table>
    <div style="margin-top: 50px; text-align: right; font-size: 10px;">
        <p>Dicetak pada: {{ now()->format('d F Y, H:i') }}</p>
    </div>
</body>
</html>