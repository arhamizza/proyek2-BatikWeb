<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="{{ asset('Assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('Assets/css/input.css') }}">
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image:  url('../Assets/img/bg-01.jpg');">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="post" enctype="multipart/form-data" action="">
                    <span class="login100-form-title p-b-34 p-t-27">
                        Input data batik
                    </span>
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form__group field">
                                <input type="input" class="form__field" placeholder="nama" name="nama" id='nama' required />
                                <label for="name" class="form__label">Nama</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form__group field">
                                <input type="input" class="form__field" placeholder="warna" name="warna" id='warna' required />
                                <label for="warna" class="form__label">Warna</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form__group field">
                                <input type="input" class="form__field" placeholder="motif" name="motif" id='motif' required />
                                <label for="motif" class="form__label">Motif</label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form__group field">
                                <input type="input" class="form__field" placeholder="asaldaerah" name="asaldaerah" id='asaldaerah' required />
                                <label for="asaldaerah" class="form__label">Asal Daerah</label>
                            </div>
                            <div style="visibility:hidden;">
                                <input type="input" class="form__field" placeholder="asaldaerah" name="status" id='status' required value="new" />
                            </div>
                        </div>
                    </div>
                    <div class="form__group field">
                        <textarea rows="3" class="form__field" name="deskripsi" id='deskripsi' required></textarea>
                        <label for="deskripsi" class="form__label">Deskripsi</label>
                    </div>

                    <!-- Upload image input--><br>
                    <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                        <input name="gambar" id="upload" type="file" onchange="readURL(this);" class="form-control border-0">
                        <label id="upload-label" for="upload" class="font-weight-light text-muted">Pilih gambar</label>
                        <div class="input-group-append">
                            <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Pilih gambar</small></label>
                        </div>
                    </div>

                    <!-- Uploaded image area-->
                    <div class="image-area mt-4">
                        <img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block">
                    </div>
                    <div class="row">
                        <button class="login100-form-btn" style="margin-left: 250px; margin-top: 50px;" type="submit">Submit</button>
                        <button class="login100-form-btn" style="margin-left: 250px; margin-top: 50px;"><a href="{{ URL::to('/') }}">Kembali</a></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('Assets/js/jquery-1.11.3.min.js') }}"></script>
    <script src="{{ asset('Assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('Assets/js/bootstrap.min.js') }}"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imageResult')
                        .attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $(function() {
            $('#upload').on('change', function() {
                readURL(input);
            });
        });

        /*  ==========================================
            SHOW UPLOADED IMAGE NAME
        * ========================================== */
        var input = document.getElementById('upload');
        var infoArea = document.getElementById('upload-label');

        input.addEventListener('change', showFileName);

        function showFileName(event) {
            var input = event.srcElement;
            var fileName = input.files[0].name;
            infoArea.textContent = 'File name: ' + fileName;
        }
    </script>
    <script>
        function adjustHeightOfPage(pageNo) {

            // Get the page height
            var totalPageHeight = 15 + $('.cd-slider-nav').height() +
                $(".cd-hero-slider li:nth-of-type(" + pageNo + ") .js-tm-page-content").height() + 160 +
                $('.tm-footer').height();

            // Adjust layout based on page height and window height
            if (totalPageHeight > $(window).height()) {
                $('.cd-hero-slider').addClass('small-screen');
                $('.cd-hero-slider li:nth-of-type(' + pageNo + ')').css("min-height", totalPageHeight + "px");
            } else {
                $('.cd-hero-slider').removeClass('small-screen');
                $('.cd-hero-slider li:nth-of-type(' + pageNo + ')').css("min-height", "100%");
            }

        }

        /*
            Everything is loaded including images.
        */
        $(window).load(function() {

            adjustHeightOfPage(1); // Adjust page height

            /* Gallery pop up
            -----------------------------------------*/
            $('.tm-img-gallery').magnificPopup({
                delegate: 'a', // child items selector, by clicking on it popup will open
                type: 'image',
                gallery: {
                    enabled: true
                }
            });

            /* Collapse menu after click 
            -----------------------------------------*/
            $('#tmNavbar a').click(function() {
                $('#tmNavbar').collapse('hide');

                adjustHeightOfPage($(this).data("no")); // Adjust page height       
            });

            /* Browser resized 
            -----------------------------------------*/
            $(window).resize(function() {
                var currentPageNo = $(".cd-hero-slider li.selected .js-tm-page-content").data("page-no");
                adjustHeightOfPage(currentPageNo);
            });

            // Remove preloader
            // https://ihatetomatoes.net/create-custom-preloading-screen/
            $('body').addClass('loaded');

        });
    </script>
</body>

</html>