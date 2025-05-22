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
            <div style="text-align: center; margin: -15px 5px 0px 0px; font-size:14px;"><strong>JURUSAN {{ Str::upper($report->laboratory->name) }}</strong></div>
            <div style="text-align: center; margin: -15px 5px 0px 0px; font-size:14px;"><strong>POLITEKNIK NEGERI JEMBER</strong></div>
            <div style="text-align: center; margin: 5px; font-size:14px;"><strong>BERITA ACARA KERUSAKAN/HILANG</strong></div>
         </div>
        </br>

        </header>

        <footer>

        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <p style="margin-top: 0px;">
                Yang bertanda tangan dibawah ini :
             </p>
                <div class="nama" style="margin-bottom: 5px;">
                <div class="column" style="text-align:left; float: left; width: 30%;font-size:16px;line-height: 18px; padding-left:0px;">NAMA</div>
                <div class="column" style="text-align:left; float: left; width: 3%;font-size:16px;line-height: 18px;">:</div>
                <div class="column" style="text-align:left; float: left; width: 76%;font-size:16px;line-height: 18px;">{{$report->name}}</div>
            </div>
        </br>
            <div class="nip" style="margin-bottom: 5px;">
                <div class="column" style="text-align:left; float: left; width: 30%;font-size:16px;line-height: 18px; padding-left:0px;">NIM</div>
                <div class="column" style="text-align:left; float: left; width: 3%;font-size:16px;line-height: 18px;">:</div>
                <div class="column" style="text-align:left; float: left; width: 76%;font-size:16px;line-height: 18px;">{{$report->nim}}</div>
            </div>
        </br>

            <div class="prodi" style="margin-bottom: 5px;">
                <div class="column" style="text-align:left; float: left; width: 30%;font-size:16px;line-height: 18px; padding-left:0px;">Golongan/Kelompok</div>
                <div class="column" style="text-align:left; float: left; width: 3%;font-size:16px;line-height: 18px;">:</div>
                <div class="column" style="text-align:left; float: left; width: 76%;font-size:16px;line-height: 18px;">{{$report->group_class}}</div>
            </div>
        </br>



            <div class="" style="text-align:left; font-size:16px;line-height: 18px;margin-bottom:5px;">Telah menghilangkan alat:</div>


            @foreach ($report->LossDamageDetail as $key => $lossDamage)
                <div class="" style="text-align:left; font-size:16px;line-height: 18px; margin-bottom:5px; padding-left:25px;">
                    {{++$key.". ".$lossDamage->labItem->item->item_name." @".$lossDamage->amount_loss_damaged." ".$lossDamage->labItem->item->unit->satuan}}
                </div>
            @endforeach

            <div class="keterangan" style="margin-bottom: 5px;">
                <div class="" style="text-align:left; font-size:16px;line-height: 18px; margin-bottom:5px;">Dan sanggup untuk mengganti alat tersebut dengan spesifikasi dan jenis yang sama </strong></div>
                <div class="" style="text-align:left; font-size:16px;line-height: 18px; margin-bottom:5px;">paling lambat hari <strong>{{$report->return_day}}</strong> tanggal <strong>{{$report->return_date}}</strong></div>
                <div class="" style="text-align:left; font-size:16px;line-height: 18px;margin-bottom:5px;">Demikian pernyataan kami, agar dapat digunakan sebagaimana mestinya.</div>
            </div>



            <div class="column" style="text-align:left; float: left; width: 50%;font-size:16px;line-height: 18px; margin-top:40px;">
                <div>Teknisi/Dosen Pembimbing</div>
                <div>&nbsp;</div>
                <div style="margin-top: 50px;"><u>{{$report->labMember->staff->user->name}}</u></div>
                <div>NIP. {{$report->labMember->staff->user->code}}</div>
            </div>

            <div class="column" style="text-align:left; float: left; width: 50%;font-size:16px;line-height: 18px; margin-top:40px; padding-left:100px;">
                <div>Jember,  {{$report->return_date }}</div>
                <div>Pemohon,</div>
                <div style="margin-top: 50px;"><u>{{$report->name}}</u></div>
                <div>NIM. {{$report->nim}}</div>
            </div>
        </br>

        </main>
    </body>
</html>
