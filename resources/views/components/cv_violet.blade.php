<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Riwayat Hidup (Rirekisho)</title>
    <!-- Tailwind CSS dihapus, diganti dengan CSS murni di bawah -->
    <style>
        /* Menggunakan font Noto Sans JP untuk tampilan karakter Jepang yang lebih baik */
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap');
        
        body {
            font-family: 'Noto Sans JP', sans-serif;
            background-color: #f4f4f7;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }
        
        .rirekisho-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 0.75rem; /* rounded-xl */
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1); /* shadow-lg */
            width: 100%;
            max-width: 800px; /* max-w-4xl */
        }

        .rirekisho-table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 1rem; /* mt-4 atau mt-8 */
        }
        
        /* Gaya dasar sel tabel */
        .rirekisho-table th, .rirekisho-table td {
            border: 1px solid #000;
            padding: 4px 8px;
            height: 30px;
            vertical-align: middle;
            font-size: 0.875rem; /* text-sm */
            font-weight: 400; /* font-normal */
        }
        
        /* Styling untuk baris Judul Utama */
        .title-row th {
            font-size: 2rem;
            font-weight: 700;
            text-align: left;
            padding: 10px;
            border-bottom: none !important;
            border-top: none !important;
            border-left: none !important;
            border-right: none !important;
        }

        /* Container untuk 日現在 */
        .date-container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 4px; /* gap-1 */
            font-size: 0.875rem;
            font-weight: 400;
            padding-right: 0;
            vertical-align: bottom;
            border-top: none !important;
            border-left: none !important;
            border-right: none !important;
            border-bottom: none !important;
        }
        
        /* Styling untuk garis putus-putus */
        .dotted-border {
            border-style: dotted !important;
            border-width: 0 1px 1px 0 !important;
        }

        /* Bagian Nama dan Gender */
        .name-row .family-name {
            width: 25%; /* w-1/4 */
            text-align: center;
            font-weight: 600; /* font-semibold */
            text-transform: uppercase;
            font-size: 0.75rem; /* text-xs */
            border-right: none;
        }

        .name-row .given-name {
            width: 50%; /* w-2/4 */
            text-align: center;
            font-weight: 600; /* font-semibold */
            text-transform: uppercase;
            font-size: 0.75rem; /* text-xs */
            border-left: none;
            border-right: none;
        }

        /* Baris input nama */
        .input-name-row .dotted-border {
            height: 3rem; /* h-12 */
            text-align: center;
            border-bottom: 0 !important;
        }
        
        /* Kelas untuk sel Gender */
        .gender-cell {
            writing-mode: vertical-rl;
            text-orientation: upright;
            width: 20px;
            padding: 0;
            text-align: center;
        }

        /* Baris Tanggal Lahir */
        .birthdate-row .label-cell {
            width: 120px; /* w-[120px] */
            text-align: center;
            font-weight: 400;
        }
        .birthdate-row .year-cell {
            width: 20%; /* w-1/5 */
            text-align: center;
        }
        .birthdate-row .narrow-cell {
            width: 50px;
            text-align: center;
        }

        /* Bagian Keluarga dan Pendapatan */
        .family-header th {
            text-align: center;
            font-weight: 700; /* font-bold */
            font-size: 1rem; /* text-base */
            padding: 0.5rem; /* p-2 */
            background-color: #f9fafb; /* bg-gray-50 */
        }
        .family-header .subtitle {
            font-size: 0.75rem; /* text-xs */
            font-weight: 400;
            margin-top: 0.25rem; /* mt-1 */
        }
        .family-row .narrow-left {
            width: 30px; /* w-[30px] */
        }
        .family-row .main-cell {
            width: 50%; /* w-1/2 */
            height: 2.5rem; /* h-10 */
        }
        .family-row .narrow-right {
            width: 30px; /* w-[30px] */
        }
        .income-row .label-cell {
            width: 25%; /* w-1/4 */
            text-align: center;
            background-color: #f9fafb; /* bg-gray-50 */
            font-weight: 400;
        }
        .income-row .data-cell {
            height: 2.5rem; /* h-10 */
        }
    </style>
</head>
<body class="flex justify-center items-start min-h-screen">

    <div class="rirekisho-container">
        
        <div class="rirekisho-content-wrapper">
            

            <!-- BAGIAN KELUARGA DAN PENDAPATAN -->
            <table class="rirekisho-table" style="margin-top: 2rem;">
                <thead>
                    <tr class="family-header">
                        <th colspan="4">
                            家族構成(及び年齢) 
                            <div class="subtitle">(Komposisi Keluarga dan Usia)</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Baris data keluarga (4 baris kosong) -->
                    <tr class="family-row">
                        <td class="narrow-left"></td>
                        <td class="main-cell"></td>
                        <td class="main-cell"></td>
                        <td class="narrow-right"></td>
                    </tr>
                     <tr class="family-row">
                        <td class="narrow-left"></td>
                        <td class="main-cell"></td>
                        <td class="main-cell"></td>
                        <td class="narrow-right"></td>
                    </tr>
                    <tr class="family-row">
                        <td class="narrow-left"></td>
                        <td class="main-cell"></td>
                        <td class="main-cell"></td>
                        <td class="narrow-right"></td>
                    </tr>
                    <tr class="family-row">
                        <td class="narrow-left"></td>
                        <td class="main-cell"></td>
                        <td class="main-cell"></td>
                        <td class="narrow-right"></td>
                    </tr>
                    
                    <!-- Baris Pendapatan Keluarga -->
                    <tr class="income-row">
                        <td colspan="2" class="label-cell">
                            家族の収入 
                            <div class="subtitle">(Pendapatan Keluarga)</div>
                        </td>
                        <td colspan="2" class="data-cell"></td>
                    </tr>
                </tbody>
            </table>

        </div>

    </div>

</body>
</html>