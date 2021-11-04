<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Surat Rekomendasi</title>
</head>
<style>
    body, html {
        height: 100%;
        font-family: Tahoma, Verdana, Segoe, sans-serif;
        margin: 0;
        /* -webkit-print-color-adjust: exact; */
    }
    @page {
        size: 2.9in 4in;
        /*size: 8.5in 13in;*/
        margin: 2mm;
    }
    p {
        margin: 0;
    }
    h5 {
        font-weight: normal;
    }
    @media print {
        @page {
            size: portrait;
            margin: 2mm;
            size: 2.9in 4in;
        }
        html {
            height: auto;
        }
        .header {
            page-break-before: always;
        }
    }
    .footer {
        page-break-after: always;
    }
    body {
        margin: 0;
    }
    .wrapper {
        padding-top: .25em;
        padding-bottom: .25em;
        display: table;
        width: 100%;
    }
    .wrapper div {
        padding-left: 1rem;
        padding-right: 1rem;
    }
    .col-1 {
        display: table-cell;
        width: 8.33333333333%;
    }
    .col-2 {
        display: table-cell;
        width: 16.6666666667%;
    }
    .col-3 {
        display: table-cell;
        width: 25%;
    }
    .col-4 {
        display: table-cell;
        width: 33.3333333333%;
    }
    .col-5 {
        display: table-cell;
        width: 41.6666666667%;
    }
    .col-6 {
        display: table-cell;
        width: 50%;
    }
    .col-7 {
        display: table-cell;
        width: 58.3333333333%;
    }
    .col-8 {
        display: table-cell;
        width: 66.6666666667%;
    }
    .col-9 {
        display: table-cell;
        width: 75%;
    }
    .col-10 {
        display: table-cell;
        width: 83.3333333333%;
    }
    .col-11 {
        display: table-cell;
        width: 91.6666666667%;
    }
    .col-12 {
        display: table-cell;
        width: 100%;
    }
    .top-wrapper {
        margin-top: 50px;
    }
    .text-top {
        vertical-align: top;
    }
    .text-center {
        text-align: center;
    }
    .text-justify {
        text-align: justify;
    }
    .text-left {
        text-align: left;
    }
    .bolder p {
        font-weight: 900;
    }
    .nomargin {
        margin: 0;
    }
    .notopmargin {
        margin-top: 0;
    }
    .nobottommargin {
        margin-bottom: 0;
    }
    .lgtopmargin {
        margin-top: 40px;
    }
    .mdtopmargin {
        margin-top: 20px;
    }
    .smtopmargin {
        margin-top: 10px;
    }
    .xstopmargin {
        margin-top: 5px;
    }
    .smbottommargin {
        margin-bottom: 10px;
    }
    .lgbottommargin {
        margin-bottom: 40px;
    }
    .nopadding {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }
    .mdpadding {
        padding-left: 2rem;
        padding-right: 2rem;
    }
    .smtoppadding {
        padding-top: 10px;
    }
    p, ul li, ol li {
        font-size: 10pt;
    }
    table {
        border-collapse: collapse;
    }
    table th, table td {
        border: 0px solid #000;
        font-size: 10pt;
        padding: 3px;
        text-align: center;
    }
    .sub-eng {
        font-style: italic;
    }
    p.sub-eng {
        /*font-size: 8pt;*/
        font-style: italic;
        font-weight: normal;
    }
    ul {
        list-style-type: none;
    }
    .with-border {
        border: solid 2px #000000;
        padding-left: 0.25rem;
        padding-right: 0.25rem;
        font-weight: bold;
    }
    .allborder {
        border: solid 1px #000000;
    }
    .bottomborder {
        border-bottom: solid 1px #000000;
    }
    .keterangan:before {
        content: "";
        position: absolute;
        left: 2rem;
        height: 1px;
        width: 15%; /* or 100px */
        border-top: 3px solid black;
    }
    .keterangan p {
        font-size: 7pt;
        margin: 0;
    }
    ol.nomargin {
        padding-left: 1.25rem;
        padding-right: 1.25rem;
    }
    .print:last-child {
        page-break-after: auto;
    }
    p.narrow {
        font-family: "Arial Narrow", Arial, sans-serif;
        font-size:10pt;
    }
    p.isi {
        font-family: Tahoma, Verdana, Segoe, sans-serif;
        font-size:10pt;
    }
    p.tab > span {
        display: inline-block;
        min-width: 185px;
    }
    p.form > span {
        display: inline-block;
        min-width: 275px;
    }
    p.subform:after {
        content: "";
        position: absolute;
        right: 5rem;
        height: 1px;
        width: 15%; /* or 100px */
        border-top: 1px solid black;
    }
    .box {
        border: solid 1px #000000;
        padding-top: 5px;
        padding-bottom: 5px;
    }
    ul.dash li {
        padding-left: 1em;
        position: relative;
    }
    ul.dash li:before {
        content: '-';
        position: absolute;
        left: 0;
    }
    hr {
        border: 1px solid black;
    }
    .note p {
        font-size: 10pt;
    }
    table.endorsement td, table.endorsement td div {
        padding: 1px 5px;
    }
</style>
<body>

    <!--HALAMAN 1-->
    <div class="print">
        <div class="wrapper">
            <div class="col-12 text-center nopadding">
                <h3 class="nopadding nomargin">Ticket Penjualan</h3>
                <h5 class="nomargin nopadding">{{ date('d/m/Y') }}</h5>
            </div>
        </div>

        <br>
        <div class="wrapper">
            <div class="col-12">
                <table width="100%">
                    <tr>
                        <td width="20%" class="text-left text-top">Kd Cust</td>
                        <td width="3%" class="text-top">:</td>
                        <td width="80%" class="text-justify">{{$mst->kd_cust}}</td>
                    </tr>
                    <tr>
                        <td width="20%" class="text-left text-top">Customer</td>
                        <td width="3%" class="text-top">:</td>
                        <td width="80%" class="text-justify">{{$mst->NM_CUST}}</td>
                    </tr>
                    <tr>
                        <td width="20%" class="text-left text-top">Total</td>
                        <td width="3%" class="text-top">:</td>
                        <td width="80%" class="text-justify">{{$mst->netto}}</td>
                    </tr>
                </table>
            </div>
        </div>

        <br>

        <div class="wrapper">
            <div class="col-12 text-center">
                <img src="data:image/svg;base64, {!! base64_encode(QrCode::format('svg')->size(150)->generate($mst->no_ent)) !!} ">
            </div>
        </div>
    </div>

</div>
</body>
</html>