<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 220px 40px 10px 100px;
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
                top: -180px;
                left: 0px;
                right: 0px;
                height: 150px;

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
            <div style="float: left; padding-left:200px;">
                <p style="text-align: center; margin-bottom: 2px;line-height: 14px;font-size:12px;">Kode Dokumen : FR-JUR-003</p>
                <p style="text-align: center; margin: 0;line-height: 14px;font-size:12px;">Revisi &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: 0&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </div>
        </br>
            <div style="margin-top:15px;margin-bottom: 0px">
               <p style="text-align: center; margin-bottom: 5px; font-size:20px;"><strong>Perihal : Permohonan Menggunakan Fasilitas LBS</strong></p>
            </div>
        </header>

        <footer>

        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <p style="margin-top: -30px;">
                Yang Bertanda Tangan dibawah Ini saya:
            </p>
            <div class="nama" style="margin-bottom: 5px;">
                <div class="column" style="text-align:left; float: left; width: 30%;font-size:16px;line-height: 18px; padding-left:45px;">NAMA</div>
                <div class="column" style="text-align:left; float: left; width: 3%;font-size:16px;line-height: 18px;">:</div>
                <div class="column" style="text-align:left; float: left; width: 76%;font-size:16px;line-height: 18px;">{{ $name }}</div>
            </div>
            </br>
            <div class="nip" style="margin-bottom: 5px;">
                <div class="column" style="text-align:left; float: left; width: 30%;font-size:16px;line-height: 18px; padding-left:45px;">NIM/NIP</div>
                <div class="column" style="text-align:left; float: left; width: 3%;font-size:16px;line-height: 18px;">:</div>
                <div class="column" style="text-align:left; float: left; width: 76%;font-size:16px;line-height: 18px;">{{ $code }}</div>
            </div>
            </br>
            @if($permit->is_staff == 0)
                <div class="prodi" style="margin-bottom: 5px;">
                    <div class="column" style="text-align:left; float: left; width: 30%;font-size:16px;line-height: 18px; padding-left:45px;">Program Studi</div>
                    <div class="column" style="text-align:left; float: left; width: 3%;font-size:16px;line-height: 18px;">:</div>
                    {{-- <div class="column" style="text-align:left; float: left; width: 76%;font-size:16px;line-height: 18px;">{{ $permit->prodiData->program_studi }}</div> --}}
                    <div class="column" style="text-align:left; float: left; width: 76%;font-size:16px;line-height: 18px;"></div>
                </div>
                </br>
                <div class="jurusan" style="margin-bottom: 5px;">
                    <div class="column" style="text-align:left; float: left; width: 30%;font-size:16px;line-height: 18px; padding-left:45px;">Jurusan</div>
                    <div class="column" style="text-align:left; float: left; width: 3%;font-size:16px;line-height: 18px;">:</div>
                    <div class="column" style="text-align:left; float: left; width: 76%;font-size:16px;line-height: 18px;">{{ $permit->laboratory->department->department }}</div>
                </div>
                </br>
            @endif
            <div class="keterangan" style="margin-bottom: 5px;">
                <div class="" style="text-align:left; font-size:16px;line-height: 18px; margin-bottom:5px;">Bermaksud akan melaksanakan kegiatan Tugas Akhir / Penelitian yang dimulai :</div>
                <div class="" style="text-align:center; font-size:16px;line-height: 18px;margin-bottom:5px;"> <strong>{{ $permit->start }} </strong> s/d   <strong>{{ $permit->end }}</strong></div>
                <div class="" style="text-align:left; font-size:16px;line-height: 18px;margin-bottom:5px;">Adapun Sarana dan Prasarana yang saya perlukan selama kegiatan Tugas Akhir/Penelitian adalah sebagai berikut :</div>
            </div>

            @foreach ($permit->details as $key => $detail)
                <div class="" style="text-align:left; font-size:16px;line-height: 18px; margin-bottom:5px; padding-left:25px;">
                    {{++$key.". ".$detail->labItem->item->item_name." @".$detail->qty." ".$detail->labItem->item->unit->satuan}}
                </div>
            @endforeach
            <div class="" style="text-align:left; font-size:16px;line-height: 18px;margin-bottom:5px;">Demikian permohonan kami atas ijin yang diberikan, saya sampaikan terima kasih.</div>


            @if($permit->is_staff)
                <div class="column" style="text-align:left; float: left; width: 50%;font-size:16px;line-height: 18px; margin-top:20px;">
                    <div>Mengetahui</div>
                    <div>Ketua Jurusan,</div>
                    <div style="margin-top: 50px;"><u>{{ $permit->headOfDepartmentName }}</u></div>
                    <div>NIP. {{ $permit->headOfDepartmentName }}</div>
                </div>

                <div class="column" style="text-align:left; float: left; width: 50%;font-size:16px;line-height: 18px; margin-top:20px; padding-left:100px;">
                    <div>Jember, {{ $permit->start }}</div>
                    <div>Pemohon,</div>
                    <div style="margin-top: 50px;"><u>{{ $name }}</u></div>
                    <div>NIP. {{ $code }}</div>
                </div>
            @else
                <div class="column" style="text-align:left; float: left; width: 50%;font-size:16px;line-height: 18px; margin-top:20px;">
                    <div>&nbsp;</div>
                    <div>Dosen Pembimbing</div>
                    <div style="margin-top: 50px;"><u>{{$permit->mentor->user->name}}</u></div>
                    <div>NIP. {{$permit->mentor->user->code}}</div>
                </div>

                <div class="column" style="text-align:left; float: left; width: 50%;font-size:16px;line-height: 18px; margin-top:20px; padding-left:100px;">
                    <div>Jember, {{ $permit->start }}</div>
                    <div>Pemohon,</div>
                    <div style="margin-top: 50px;"><u>{{ $name }}</u></div>
                    <div>NIM. {{ $code }}</div>
                </div>
                </br>
                <div class="" style="text-align:left; width: 100%;font-size:16px;line-height: 18px; margin-top:30px; padding-left:200px;">
                    <div>Mengetahui</div>
                    <div>Ketua Jurusan,</div>
                    <div style="margin-top: 50px;"><u>{{ $permit->headOfDepartmentName }}</u></div>
                    <div>NIP. {{ $permit->headOfDepartmentName }}</div>
                </div>
            @endif
        </main>
    </body>
</html>
