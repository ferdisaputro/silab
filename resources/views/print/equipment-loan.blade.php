<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 270px 70px 10px 100px;
            }

            footer {
                position: fixed;
                bottom: -200px;
                left: 0px;
                right: 0px;
                height: 200px;

                /** Extra personal styles **/
                background-color: white;
                color: black;
                text-align: center;
                line-height: 35px;
            }

            header {
                position: fixed;
                width: 100%;
                top: -230px;
                left: 0px;
                right: 0px;
                height: 200px;

                /** Extra personal styles **/
                background-color: white;
                color: black;
                text-align: center;
                line-height: 35px;
            }

            .column {
                float: left;
                width: 33.33%;
            }

            /* Clear floats after the columns */
            .row:after {
                clear: both;
            }
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            <div style="float: left; margin-bottom:0px;">
                <img src="{{ public_path('assets/images/print/header1.jpg') }}" style="width: 260px; height: 33px">
            </div>
        </br>
        <div style="float: left; padding-left:170px;">
            <p style="text-align: center; margin-bottom: 2px;line-height: 14px;font-size:12px;">Kode Dokumen : FR-JUR-10</p>
            <p style="text-align: center; margin: 0;line-height: 14px;font-size:12px;"> &nbsp;&nbsp;Revisi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 0&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        </div>
        </br>
        <div style="margin-top:25px;margin-bottom: 0px">
            <div style="text-align: center; margin: 01px 5px 0px 0px; font-size:14px; width:100%;"><strong>LABORATORIUM/BENGKEL/STUDIO</strong></div>
            <div style="text-align: center; margin: -15px 5px 0px 0px; font-size:14px;"><strong>JURUSAN {{ Str::upper($department) }}</strong></div>
            <div style="text-align: center; margin: -15px 5px 0px 0px; font-size:14px;"><strong>POLITEKNIK NEGERI JEMBER</strong></div>
            <div style="text-align: center; margin: 5px; font-size:14px;"><strong>BON ALAT / BAHAN</strong></div>
         </div>
        </br>

        </header>

        <footer>

        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <div class="nama" style="margin-bottom: 5px;">
                <div class="column" style="text-align:left; float: left; width: 30%;font-size:16px;line-height: 18px; padding-left:0px;">NAMA</div>
                <div class="column" style="text-align:left; float: left; width: 3%;font-size:16px;line-height: 18px;">:</div>
                <div class="column" style="text-align:left; float: left; width: 76%;font-size:16px;line-height: 18px;">{{ $name }}</div>
            </div>
        </br>
            <div class="nip" style="margin-bottom: 5px;">
                <div class="column" style="text-align:left; float: left; width: 30%;font-size:16px;line-height: 18px; padding-left:0px;">NIM/NIP</div>
                <div class="column" style="text-align:left; float: left; width: 3%;font-size:16px;line-height: 18px;">:</div>
                <div class="column" style="text-align:left; float: left; width: 76%;font-size:16px;line-height: 18px;">{{ explode('.', $code)[1] }}</div>
            </div>
        </br>
            @if($equipmentLoan->is_staff == 0)
                <div class="prodi" style="margin-bottom: 5px;">
                    <div class="column" style="text-align:left; float: left; width: 30%;font-size:16px;line-height: 18px; padding-left:0px;">Golongan/Kelompok</div>
                    <div class="column" style="text-align:left; float: left; width: 3%;font-size:16px;line-height: 18px;">:</div>
                    <div class="column" style="text-align:left; float: left; width: 76%;font-size:16px;line-height: 18px;">{{$equipmentLoan->group_class}}</div>
                </div>
                </br>
            @endif

            <table style="width: 100%;">
                <tr>
                    <td style="text-align: center">NO</td>
                    <td style="text-align: center">ALAT/MESIN - BAHAN</td>
                    <td style="text-align: center">JUMLAH</td>
                </tr>
                @foreach ($equipmentLoan->loanDetails as $index => $loanDetail)
                    <tr>
                        <td style="text-align: center">{{++$index}}</td>
                        <td>{{$loanDetail->labItem->item->item_name}}</td>
                        <td style="text-align: center">{{$loanDetail->qty}}</td>
                    </tr>
                @endforeach
            </table>



            {{-- <div class="column" style="text-align:left; float: left; width: 50%;font-size:16px;line-height: 18px; margin-top:20px;">
                <div>Teknisi</div>
                <div>&nbsp;</div>
                <div style="margin-top: 50px;"><u>{{$equipmentLoan->memberLabOut->StaffData->nama}}</u></div>
                <div>NIP. {{$equipmentLoan->memberLabOut->StaffData->kode}}</div>
            </div>

            <div class="column" style="text-align:left; float: left; width: 50%;font-size:16px;line-height: 18px; margin-top:20px; padding-left:100px;">
                <div>Jember, {{$equipmentLoan->TanggalBon }}</div>
                <div>Peminjam,</div>
                <div style="margin-top: 50px;"><u>{{$equipmentLoan->StaffData->nama}}</u></div>
                <div>NIP. {{$equipmentLoan->StaffData->kode}}</div>
            </div> --}}

            <div class="column" style="text-align:left; float: left; width: 50%;font-size:16px;line-height: 18px; margin-top:20px;">
                <div>Teknisi/Dosen Pembimbing</div>
                <div>&nbsp;</div>
                <div style="margin-top: 50px;"><u>{{$equipmentLoan->memberBorrow->user->name}}</u></div>
                <div>NIP. {{$equipmentLoan->memberBorrow->user->code}}</div>
            </div>

            <div class="column" style="text-align:left; float: left; width: 50%;font-size:16px;line-height: 18px; margin-top:20px; padding-left:100px;">
                <div>Jember,  {{$equipmentLoan->borrowing_date }}</div>
                <div>Pemohon,</div>
                <div style="margin-top: 50px;"><u>{{ $name }}</u></div>
                <div>{{ $code }}</div>
            </div>
        </br>
        @if($equipmentLoan->status==2)
            <div class="" style="text-align:left; width: 100%;font-size:16px;line-height: 18px; margin-top:30px; ">
                &nbsp;
                <div class="column" style="text-align:left; float: left; width: 50%;font-size:16px;line-height: 18px; margin-top:20px;">
                    <div>Teknisi/Dosen Pembimbing</div>
                    <div>&nbsp;</div>
                    <div style="margin-top: 50px;"><u>{{ $equipmentLoan->memberReturn->user->name }}</u></div>
                    <div>NIP. {{ $equipmentLoan->memberReturn->user->code }}</div>
                </div>

                <div class="column" style="text-align:left; float: left; width: 50%;font-size:16px;line-height: 18px; margin-top:0px; padding-left:100px;">
                    <div>Yang Mengembalikan</div>
                    <div>&nbsp;</div>
                    <div style="margin-top: 50px;"><u>{{ $returnerName }}</u></div>
                    <div>{{ $returnerCode }}</div>
                </div>
            </div>
            @endif
        </main>
    </body>
</html>
