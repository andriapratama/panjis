<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

    <title>PDF</title>
</head>
<body class="peminjaman-pdf__container">
    <div class="peminjaman-pdf__card">
        <div style="display: flex; margin-bottom: 38px;">
            <p style="width: 100px;">Hal</p>
            <p>: Pernyataan Peminjaman Iventaris</p>
        </div>

        <div style="margin-bottom: 60px;">
            <p style="margin-bottom: 10px;">Kepada Yth :</p>
            <p style="margin-bottom: 10px;">Bid. Humas & Pengembangan</p>
            <p style="margin-bottom: 10px;">Sabha Yowana Panji Saraswati</p>
            <p style="margin-bottom: 10px;">Di tempat</p>
        </div>

        <div style="margin-bottom: 20px;">
            <p style="margin-bottom: 20px;">Yang bertanda tangan di bawah ini :</p>
            
            <div style="display: flex; margin-bottom: 20px;">
                <p class="peminjaman-pdf__title">Nama <span>:</span></p>
                <p class="peminjaman-pdf__desc" id="name"></p>
            </div>
            
            <div style="display: flex; margin-bottom: 20px;">
                <p class="peminjaman-pdf__title">Alamat <span>:</span></p>
                <p class="peminjaman-pdf__desc" id="address"></p>
            </div>

            <div style="display: flex; margin-bottom: 20px;">
                <p class="peminjaman-pdf__title">No. Tlp <span>:</span></p>
                <p class="peminjaman-pdf__desc" id="phone"></p>
            </div>
            <div style="display: flex; margin-bottom: 20px;">
                <p class="peminjaman-pdf__title">Alat yang dipinjam <span>:</span></p>
                <p class="peminjaman-pdf__desc" id="product"></p>
            </div>
            <div style="display: flex; margin-bottom: 20px;">
                <p class="peminjaman-pdf__title">Masa Pinjam <span>:</span></p>
                <p class="peminjaman-pdf__desc" id="date"></p>
            </div>
        </div>

        <div style="margin-bottom: 45px; width: 100%;">
            <p style="width: 100%; text-align: justify; line-height: 1.8;">
                Bersedia bertanggung jawab atas alat yang telah dipinjam untuk digunakan sebaik-baiknya dan
                bersedia memberikan ganti rugi apabila terdapat kerusakan maupun kehilangan atas alat yang
                telah dipinjam.
            </p>
        </div>

        <div style="margin-bottom: 40px; width: 87%;">
            <p style="width: 100%; text-align: end;" id="dates"></p>
        </div>

        <div class="peminjaman-pdf__footer">
            <div class="peminjaman-pdf__footer-body">
                <p>Bid. Humas & Pengembangan</p>
                <p style="margin-bottom: 75px;">SY. Panji Saraswati</p>
                <p style="font-weight: bold;" id="humas-name"></p>
            </div>

            <div class="peminjaman-pdf__footer-body">
                <p style="margin-bottom: 92px;">Pemohon</p>
                <p style="font-weight: bold;" id="names"></p>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script>
    const id = '{{$id}}';

    $("document").ready(function() {
        showData();
    });

    function showData() {
        $.ajax({
            type: 'GET',
            url: '/loan/' + id,
            success: function(result) {
                const date = new Date(result.loan.created_at);
				const dateFormat = new Intl.DateTimeFormat('id', {year: 'numeric', month: 'long', day: 'numeric'}).format(date);

                $('#name').html(result.loan.name);
                $('#address').html(result.loan.address);
                $('#phone').html(result.loan.phone);
                $('#date').html(result.loan.start_date + " - " + result.loan.end_date);
                $('#dates').html("Semarapura, " + dateFormat);
                $('#humas-name').html("(" + result.loan.humas_name + ")");
                $('#names').html("(" + result.loan.name + ")");

                const product = $('#product').html("");
                const last = (result.detail.at(-1));
                result.detail.forEach((value, index) => {
                    if (value.name === last.name) {
                        product.append(
                            value.name
                        );
                    } else {
                        product.append(
                            value.name + ", "
                        );

                    }
                });

                window.print();
            }
        })
    }
</script>
</html>