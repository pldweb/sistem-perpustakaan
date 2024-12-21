@extends(web_layout())
@section('content')

    <div id="hero-section">
        <div class="container">
            <div class="flex-hero">
                <div class="bg-hero"></div>
                <div class="hero-side-1 white">
                    <a id="lp-logo" href="{{url('')}}">
                        <img src="{{assets_url('img/web/logo-marketplace.png')}}" alt="{{kantor()->nama_perusahaan}}">
                    </a>
                    <div class="title-hero">
                        <h1>Sistem Manajemen Travel Umrah & Haji Terintegrasi & Terlengkap Nomor #1 di Dunia</h1>
                    </div>
                    <div class="desc-hero">
                        <p>Dikembangkan khusus untuk memaksimalkan performa bisnis travel Anda untuk transformasi
                            digital secara cepat, tepat, efektif, efisien, dan menyeluruh</p>
                    </div>
                    <div class="cta-link-white">
                        <a href="#" class="btn btn-primary">Gabung Sekarang</a>
                    </div>
                </div>
                <div class="hero-side-2">
                    <div class="image-hero">
                        <img src="{{assets_url('img/gabung-partner/mockup.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="flow-section">
        <div class="container">
            <div class="flex-flow">
                <div class="bg-hero"></div>
                <div class="title-flow center">
                    <h1>Bagaimana <span>Caranya Bergabung?</span></h1>
                </div>
                <div class="subtitle-flow subtitle center">
                    <h3>Segera dapatkan sistemnya!</h3>
                </div>
                <div class="flow-row">
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                            <div class="card-flow center">
                                <div class="icon-flow">
                                    <img src="{{assets_url('img/gabung-partner/step-4.png')}}" alt="" class="">
                                </div>
                                <div class="title-card-flow">
                                    Daftar di Erahajj
                                </div>
                                <div class="desc-card-flow">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, dolorem iure minus
                                    mollitia quod temporibus.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="card-flow center">
                                <div class="icon-flow">
                                    <img src="{{assets_url('img/gabung-partner/step-2.png')}}" alt="" class="">
                                </div>
                                <div class="title-card-flow">
                                    Entri Data Paket
                                </div>
                                <div class="desc-card-flow">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, dolorem iure minus
                                    mollitia quod temporibus.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="card-flow center">
                                <div class="icon-flow">
                                    <img src="{{assets_url('img/gabung-partner/step-3.png')}}" alt="" class="">
                                </div>
                                <div class="title-card-flow">
                                    Paket Terintegrasi
                                </div>
                                <div class="desc-card-flow">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem, dolorem iure minus
                                    mollitia quod temporibus.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="feature-section">
        <div class="container">
            <div class="flex-feature">
                <div class="title-feature center">
                    <h1>Fitur yang dapat <span>Anda gunakan</span></h1>
                </div>
                <div class="subtitle-feature subtitle center">
                    <h3>Beberapa pertanyaan yang membantu Anda</h3>
                </div>
                <div class="feature-row">
                    <div class="row">
                        <ul id="nav-benefit" class="nav nav-tabs custom-pills" aria-labelledby="pills">
                            <li class="col-md-3 col-sm-6 col-xs-12 feature-item">
                                <div class="tab-link">
                                    <a data-toggle="tab" onclick="displayInformasiFiturMC(this)" href="#feature-1"
                                       class="feature-content" aria-expanded="false">
                                        <div class="feature-description ubslitmzrsvldssixieu"
                                             style="min-height: 167px;">
                                            <img src="{{assets_url('img/gabung-partner/icon-1.png')}}"
                                                 alt="" class="icon-image">
                                            <div class="feature-title">Terlengkap &amp; Terintegrasi</div>
                                            <p class="klik-detail">Klik Untuk Detail</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="col-md-3 col-sm-6 col-xs-12 feature-item">
                                <div class="tab-link">
                                    <a data-toggle="tab" onclick="displayInformasiFiturMC(this)" href="#feature-2"
                                       class="feature-content" aria-expanded="false">
                                        <div class="feature-description ubslitmzrsvldssixieu"
                                             style="min-height: 167px;">
                                            <img src="{{assets_url('img/gabung-partner/icon-2.png')}}"
                                                 alt="" class="icon-image">
                                            <div class="feature-title">Akuntansi &amp; Keuangan</div>
                                            <p class="klik-detail">Klik Untuk Detail</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="col-md-3 col-sm-6 col-xs-12 feature-item">
                                <div class="tab-link">
                                    <a data-toggle="tab" onclick="displayInformasiFiturMC(this)" href="#feature-3"
                                       class="feature-content" aria-expanded="false">
                                        <div class="feature-description ubslitmzrsvldssixieu"
                                             style="min-height: 167px;">
                                            <img src="{{assets_url('img/gabung-partner/icon-3.png')}}"
                                                 alt="" class="icon-image">
                                            <div class="feature-title">Manajemen Inventory</div>
                                            <p class="klik-detail">Klik Untuk Detail</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="col-md-3 col-sm-6 col-xs-12 feature-item">
                                <div class="tab-link">
                                    <a data-toggle="tab" onclick="displayInformasiFiturMC(this)" href="#feature-4"
                                       class="feature-content">
                                        <div class="feature-description ubslitmzrsvldssixieu"
                                             style="min-height: 167px;">
                                            <img src="{{assets_url('img/gabung-partner/icon-4.png')}}"
                                                 alt="" class="icon-image">
                                            <div class="feature-title">Manajemen Pelanggan (CRM)</div>
                                            <p class="klik-detail">Klik Untuk Detail</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="col-md-3 col-sm-6 col-xs-12 feature-item active">
                                <div class="tab-link">
                                    <a data-toggle="tab" onclick="displayInformasiFiturMC(this)" href="#feature-5"
                                       class="feature-content" aria-expanded="true">
                                        <div class="feature-description ubslitmzrsvldssixieu"
                                             style="min-height: 167px;">
                                            <img src="{{assets_url('img/gabung-partner/icon-5.png')}}"
                                                 alt="" class="icon-image">
                                            <div class="feature-title">Manajemen SDM (HRIS)</div>
                                            <p class="klik-detail">Klik Untuk Detail</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="col-md-3 col-sm-6 col-xs-12 feature-item">
                                <div class="tab-link">
                                    <a data-toggle="tab" onclick="displayInformasiFiturMC(this)" href="#feature-6"
                                       class="feature-content" aria-expanded="false">
                                        <div class="feature-description ubslitmzrsvldssixieu"
                                             style="min-height: 167px;">
                                            <img src="{{assets_url('img/gabung-partner/icon-6.png')}}"
                                                 alt="" class="icon-image">
                                            <div class="feature-title">Manajemen Operasional</div>
                                            <p class="klik-detail">Klik Untuk Detail</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="col-md-3 col-sm-6 col-xs-12 feature-item">
                                <div class="tab-link">
                                    <a data-toggle="tab" onclick="displayInformasiFiturMC(this)" href="#feature-7"
                                       class="feature-content" aria-expanded="false">
                                        <div class="feature-description ubslitmzrsvldssixieu"
                                             style="min-height: 167px;">
                                            <img src="{{assets_url('img/gabung-partner/icon-7.png' )}}"
                                                 alt="" class="icon-image">
                                            <div class="feature-title">Cabang, Agen, &amp; Sales</div>
                                            <p class="klik-detail">Klik Untuk Detail</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                            <li class="col-md-3 col-sm-6 col-xs-12 feature-item">
                                <div class="tab-link">
                                    <a data-toggle="tab" onclick="displayInformasiFiturMC(this)" href="#feature-8"
                                       class="feature-content" aria-expanded="false">
                                        <div class="feature-description ubslitmzrsvldssixieu"
                                             style="min-height: 167px;">
                                            <img src="{{assets_url('img/gabung-partner/icon-8.png')}}"
                                                 alt="" class="icon-image">
                                            <div class="feature-title">Modul Transaksi Terlengkap</div>
                                            <p class="klik-detail">Klik Untuk Detail</p>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="tab-content hidden-sm hidden-xs">
                        <div id="feature-1" class="tab-pane fade">
                            <div class="row d-flex benefit-container feature-right">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="benefit-content benefit-left">
                                        <h2 class="benefit-title">
                                            Sistem Terlengkap, Terintegrasi, &amp; Fleksibel
                                        </h2>
                                        <div class="center hidden-lg">
                                            <div class="image-benefit">
                                                <img src="{{assets_url('img/gabung-partner/fitur-1.png')}}"
                                                     alt="">
                                                <img src="{{assets_url('img/gabung-partner/fitur-1-parallax.png')}}"
                                                     class="parallax-image" alt="">
                                            </div>
                                        </div>
                                        <p>
                                            Cukup dengan satu sistem, berbagai kebutuhan travel Anda dari hulu ke hilir
                                            dapat tertangani dengan sangat baik, rapi, saling terintegrasi, dan dapat
                                            disesuaikan dengan model bisnis Anda
                                        </p>
                                        <p>
                                            Sistem Erahajj dilengkapi dengan berbagai fitur dan layanan yang mendukung
                                            performa perusahaan Anda dalam bertransformasi digital, mengantarkan bisnis
                                            travel Anda tetap unggul dan terus maju menjadi lebih baik dari waktu ke
                                            waktu
                                        </p>
                                        <div class="button-benefit mb10">
                                            <a href="https://erahajj.co.id/produk-layanan" class="btn btn-primary"
                                               data-original-title="" title="">Info Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12 center hidden-md hidden-sm hidden-xs">
                                    <div class="image-benefit">
                                        <img src="{{assets_url('img/gabung-partner/fitur-1.png')}}"
                                             alt="">
                                        <img src="{{assets_url('img/gabung-partner/fitur-1-parallax.png')}}"
                                             class="parallax-image" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="feature-2" class="tab-pane fade">
                            <div class="row d-flex benefit-container benefit-left">
                                <div class="col-lg-6 col-sm-12 center hidden-md hidden-sm hidden-xs">
                                    <div class="image-benefit">
                                        <img src="{{assets_url('img/gabung-partner/fitur-2.png')}}"
                                             alt="">
                                        <img src="{{assets_url('img/gabung-partner/fitur-2-parallax.png')}}"
                                             class="parallax-image" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="benefit-content benefit-right">
                                        <h2 class="benefit-title">
                                            Integrasi Sistem Keuangan Standar Akuntansi
                                        </h2>

                                        <div class="center hidden-lg">
                                            <div class="image-benefit">
                                                <img src="{{assets_url('img/gabung-partner/fitur-2.png')}}"
                                                     alt="">
                                                <img src="{{assets_url('img/gabung-partner/fitur-2-parallax.png')}}"
                                                     class="parallax-image" alt="">
                                            </div>
                                        </div>
                                        <p>
                                            Erahajj dilengkapi dengan sistem manajemen akuntansi &amp; keuangan
                                            perusahaan yang terintegrasi dalam sistem, yang mengacu pada standar kaidah
                                            akuntansi keuangan yang baku.
                                        </p>
                                        <p>
                                            Seluruh data keuangan berupa transaksi dan operasional perusahaan Anda
                                            tercatat secara otomatis dengan baik berdasarkan standar akuntansi keuangan
                                            yang baku, mengacu pada SAK ETAP
                                        </p>
                                        <div class="button-benefit mb10">
                                            <a href="https://erahajj.co.id/produk-layanan/akuntansi-keuangan"
                                               class="btn btn-primary" data-original-title="" title="">Info
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="feature-3" class="tab-pane fade">
                            <div class="row d-flex benefit-container benefit-right">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="benefit-content benefit-left">
                                        <h2 class="benefit-title">
                                            Integrasi Sistem Manajemen Inventori
                                        </h2>

                                        <div class="center hidden-lg">
                                            <img src="{{assets_url('img/gabung-partner/fitur-3.png')}}"
                                                 alt="">
                                            <img src="{{assets_url('img/gabung-partner/fitur-3-parallax.png')}}"
                                                 class="parallax-image" alt="">
                                        </div>
                                    </div>
                                    <p>
                                        Manajemen persediaan yang tepat merupakan salah satu mata rantai dalam
                                        supply chain management yang cukup vital dan memiliki nilai resiko yang
                                        tidak dapat dikesampingkan.
                                    </p>
                                    <p>
                                        Untuk itulah sistem Erahajj dilengkapi dengan sistem manajemen persediaan,
                                        yang dapat menangani mulai dari : pembelian barang, transfer barang antar
                                        gudang, monitoring persediaan barang dan nilai persediaan, kerusakan barang,
                                        kehilangan barang dan lain sebagainya.
                                    </p>
                                    <div class="button-benefit mb10">
                                        <a href="https://erahajj.co.id/produk-layanan/manajemen-persediaan"
                                           class="btn btn-primary" data-original-title="" title="">Info
                                            Selengkapnya</a>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 center hidden-md hidden-sm hidden-xs">
                                    <div class="image-benefit">
                                        <img src="{{assets_url('img/gabung-partner/fitur-3.png')}}"
                                             alt="">
                                        <img src="{{assets_url('img/gabung-partner/fitur-3-parallax.png')}}"
                                             class="parallax-image" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="feature-4" class="tab-pane fade">
                            <div class="row d-flex benefit-container benefit-left">
                                <div class="col-lg-6 col-sm-12 center hidden-md hidden-sm hidden-xs">
                                    <div class="image-benefit">
                                        <img src="{{assets_url('img/gabung-partner/fitur-4.png')}}"
                                             alt="">
                                        <img src="{{assets_url('img/gabung-partner/fitur-4-parallax.png')}}"
                                             class="parallax-image" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="benefit-content benefit-right">
                                        <h2 class="benefit-title">Integrasi Sistem Manajemen Pelanggan (CRM)</h2>

                                        <div class="center hidden-lg">
                                            <div class="image-benefit">
                                                <img src="{{assets_url('img/gabung-partner/fitur-4.png')}}"
                                                     alt="">
                                                <img src="{{assets_url('img/gabung-partner/fitur-4-parallax.png')}}"
                                                     class="parallax-image" alt="">
                                            </div>
                                        </div>
                                        <p>
                                            Sistem CRM di Erahajj memudahkan travel Anda dalam mengelola berbagai
                                            aktivitas interaksi dan hubungan calon jamaah maupun jamaah Anda, baik itu
                                            aktivitas marketing, dukungan pelanggan, maupun penanganan komplain atau
                                            keluhan jamaah
                                        </p>
                                        <p>
                                            Hubungan pelanggan yang baik dapat menciptakan repeat order, yang membuat
                                            jamaah Anda kembali berangkat bersama travel Anda di kemudian hari.
                                        </p>
                                        <div class="button-benefit mb10">
                                            <a href="https://erahajj.co.id/produk-layanan/manajemen-pelanggan"
                                               class="btn btn-primary" data-original-title="" title="">Info
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="feature-5" class="tab-pane fade active in">
                            <div class="row d-flex benefit-container benefit-right">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="benefit-content benefit-left">
                                        <h2 class="benefit-title">Integrasi Sistem Manajemen SDM (HRIS)</h2>

                                        <div class="center hidden-lg">
                                            <div class="image-benefit">
                                                <img src="{{assets_url('img/gabung-partner/fitur-5.png')}}"
                                                     alt="">
                                                <img src="{{assets_url('img/gabung-partner/fitur-5-parallax.png')}}"
                                                     class="parallax-image" alt="">
                                            </div>
                                        </div>
                                        <p>
                                            Sumber daya manusia (SDM) merupakan salah satu dari pilar bisnis yang
                                            menunjang performa perusahaan Anda. Manajemen SDM yang tidak rapi dan tidak
                                            tersistem dapat menghambat laju bisnis travel Anda.
                                        </p>
                                        <p>
                                            Sistem Human Resource Information System (HRIS) di Erahajj dikembangkan
                                            untuk meningkatkan efisiensi bisnis travel Anda dalam proses manajemen SDM,
                                            seperti : monitoring presensi/absensi, monitoring aktivitas harian,
                                            perhitungan gaji, penilaian kinerja, dan lain sebagainya.
                                        </p>
                                        <div class="button-benefit mb10">
                                            <a href="https://erahajj.co.id/produk-layanan/manajemen-sdm"
                                               class="btn btn-primary" data-original-title="" title="">Info
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-12 center hidden-md hidden-sm hidden-xs">
                                    <div class="image-benefit">
                                        <img src="{{assets_url('img/gabung-partner/fitur-5.png')}}"
                                             alt="">
                                        <img src="{{assets_url('img/gabung-partner/fitur-5-parallax.png')}}"
                                             class="parallax-image" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="feature-6" class="tab-pane fade">
                            <div class="row d-flex benefit-container benefit-left">
                                <div class="col-lg-6 col-sm-12 center hidden-md hidden-sm hidden-xs">
                                    <div class="image-benefit">
                                        <img src="{{assets_url('img/gabung-partner/fitur-6.png')}}"
                                             alt="">
                                        <img src="{{assets_url('img/gabung-partner/fitur-6-parallax.png')}}"
                                             class="parallax-image" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="benefit-content benefit-right">
                                        <h2 class="benefit-title">Integrasi Sistem Manajemen Operasional &amp; Mutu
                                            Standar ISO 9001:2015</h2>

                                        <div class="center hidden-lg">
                                            <div class="image-benefit">
                                                <img src="{{assets_url('img/gabung-partner/fitur-6.png')}}"
                                                     alt="">
                                                <img src="{{assets_url('img/gabung-partner/fitur-6-parallax.png')}}"
                                                     class="parallax-image" alt="">
                                            </div>
                                        </div>
                                        <p>
                                            Sistem manajemen yang rapi dan terstruktur merupakan salah satu komponen
                                            dari <i>Service Excellence</i>. Dengan administrasi dan operasional yang
                                            rapi, tim Anda akan lebih mudah dan nyaman dalam bekerja, sehingga jamaah
                                            Anda pun juga lebih tenang terlayani dengan baik oleh travel Anda.
                                        </p>
                                        <p>
                                            Erahajj dilengkapi dengan sistem manajemen administrasi dan operasional yang
                                            mengacu ke manajemen mutu ISO 9001:2015, yang mencakup : standar kerapian
                                            administrasi dokumen, kontrol operasional, hingga menyediakan kuesioner dan
                                            evaluasi kepuasan jamaah.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="feature-7" class="tab-pane fade">
                            <div class="row d-flex benefit-container benefit-right">
                                <div class="col-lg-6 col-sm-12">
                                    <div class="benefit-content benefit-left">
                                        <h2 class="benefit-title">
                                            Integrasi Manajemen Cabang, Agen, &amp; Sales
                                        </h2>

                                        <div class="center hidden-lg">
                                            <div class="image-benefit">
                                                <img src="{{assets_url('img/gabung-partner/fitur-7.png')}}"
                                                     alt="">
                                                <img src="{{assets_url('img/gabung-partner/fitur-7-parallax.png')}}"
                                                     class="parallax-image" alt="">
                                            </div>
                                        </div>
                                        <p>
                                            Sistem Erahajj memudahkan Anda mengelola cabang, agen, dan sales Anda, mulai
                                            dari : manajemen komisi, evaluasi target penjualan, hingga membantu
                                            memaksimalkan penjualan masing-masing melalui digital marketing
                                        </p>
                                        <p>
                                            Dengan sistem transparan dan terintegrasi, cabang, agen, maupun sales yang
                                            bekerjasama dengan travel Anda dapat bekerja dengan lebih tenang, nyaman,
                                            dan profesional, karena seluruh sistem komisi dan penjualannya telah
                                            tercover dengan baik dalam satu sistem.
                                        </p>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12 center hidden-md hidden-sm hidden-xs">
                                    <div class="image-benefit">
                                        <img src="{{assets_url('img/gabung-partner/fitur-7.png')}}"
                                             alt="">
                                        <img src="{{assets_url('img/gabung-partner/fitur-7-parallax.png')}}"
                                             class="parallax-image" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="feature-8" class="tab-pane fade">
                            <div class="row d-flex benefit-container benefit-left">
                                <div class="col-lg-6 col-sm-12 center hidden-md hidden-sm hidden-xs">
                                    <div class="image-benefit">
                                        <img src="{{assets_url('img/gabung-partner/fitur-8.png')}}"
                                             alt="">
                                        <img src="{{assets_url('img/gabung-partner/fitur-8-parallax.png')}}"
                                             class="parallax-image" alt="">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="benefit-content benefit-right">
                                        <h2 class="benefit-title">
                                            Modul Transaksi Terlengkap &amp; Terintegrasi
                                        </h2>

                                        <div class="center hidden-lg">
                                            <div class="image-benefit">
                                                <img src="{{assets_url('img/gabung-partner/fitur-8.png')}}"
                                                     alt="">
                                                <img src="{{assets_url('img/gabung-partner/fitur-8-parallax.png')}}"
                                                     class="parallax-image" alt="">
                                            </div>
                                        </div>
                                        <p>
                                            Erahajj tidak hanya menangani transaksi umrah, wisata, &amp; haji, tetapi
                                            juga berbagai komponen-komponen umrah &amp; haji seperti : land arrangement,
                                            hotel, visa, tiket pesawat, dan lain sebagainya.
                                        </p>
                                        <p>
                                            Dengan modul transaksi yang lengkap dari Erahajj, maka bisnis travel Anda
                                            dapat melayani lebih banyak jenis transaksi secara lebih rapi dan
                                            profesional, karena sudah tidak ada lagi pencatatan administrasi dan
                                            keuangan yang diproses secara manual. Semua sudah terkelompok dengan rapi
                                            dan terstruktur.
                                        </p>
                                        <div class="button-benefit mb10">
                                            <a href="https://erahajj.co.id/produk-layanan/modul-transaksi"
                                               class="btn btn-primary" data-original-title="" title="">Info
                                                Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="testimoni-section">
        <div class="bg-paket">
            <img src="{{assets_url('img/web/kakbah-icon.png')}}" alt="">
        </div>
        <div class="flex-testimoni">
            <div class="title-testimoni center">
                <h1>Testimoni Pengguna <span>Sistem Erahajj</span></h1>
            </div>
            <div class="subtitle-testimoni subtitle center">
                <h3>Beberapa pertanyaan yang membantu Anda</h3>
            </div>
            <div class="testimoni-row">
                <div class="row">
                    <div class="testimonial">
                        <div class="container">
                            <div class="testimonial-slider">
                                <div class="testimonial-slide">
                                    <div class="testimonial_box">
                                        <p>Alhamdulillah dengan sistem aplikasi Erahajj ini saya sangat terbantu
                                            menjalankan usaha saya. Semua fitur yg saya butuhkan telah tersedia, up
                                            to date, user friendly, dan secure. Apalagi dijaman modern ini menyimpan
                                            data di PC sudah bukan trend lagi. Disamping itu, masing masing karyawan
                                            saya bisa mengoperasikan sesuai dengan ruang lingkup pekerjaannya</p>
                                        <h4>Agung Hapsah</h4>
                                    </div>
                                </div>
                                <div class="testimonial-slide">
                                    <div class="testimonial_box">
                                        <p>Alhamdulillah dengan sistem aplikasi Erahajj ini saya sangat terbantu
                                            menjalankan usaha saya. Semua fitur yg saya butuhkan telah tersedia, up
                                            to date, user friendly, dan secure. Apalagi dijaman modern ini menyimpan
                                            data di PC sudah bukan trend lagi. Disamping itu, masing masing karyawan
                                            saya bisa mengoperasikan sesuai dengan ruang lingkup pekerjaannya</p>
                                        <h4>Agung Hapsah</h4>
                                    </div>
                                </div>
                                <div class="testimonial-slide">
                                    <div class="testimonial_box">
                                        <p>Alhamdulillah dengan sistem aplikasi Erahajj ini saya sangat terbantu
                                            menjalankan usaha saya. Semua fitur yg saya butuhkan telah tersedia, up
                                            to date, user friendly, dan secure</p>
                                        <h4>Agung Hapsah</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="faq-section">
        <div class="container">
            <div class="flex-faq center">
                <div class="title-faq white center">
                    <h1>Pertanyaan Yang Sering Ditanyakan</h1>
                </div>
                <div class="subtitle-faq subtitle white center">
                    <h3>Beberapa pertanyaan yang membantu Anda</h3>
                </div>
                <div class="faq-row">
                    <div class="rowss">
                        <div class="faq-container">
                            <div class="faq-item">
                                <div class="faq-question">
                                    <h2>Apa itu UmrahMudah</h2>
                                    <span class="faq-toggle"><i class="fa fa-angle-down	"></i></span>
                                </div>
                                <div class="faq-answer">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. At eos quisquam sint.
                                        Est expedita incidunt molestiae necessitatibus nesciunt quibusdam voluptas?</p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <h2>Bagaimana pembayaran melalui UmrahMudah</h2>
                                    <span class="faq-toggle"><i class="fa fa-angle-down	"></i></span>
                                </div>
                                <div class="faq-answer">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus esse explicabo
                                        incidunt minus, nihil placeat provident rem temporibus. Dolores, similique!</p>
                                </div>
                            </div>

                            <div class="faq-item">
                                <div class="faq-question">
                                    <h2>Pendaftarannya kemana?</h2>
                                    <span class="faq-toggle"><i class="fa fa-angle-down	"></i></span>
                                </div>
                                <div class="faq-answer">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate dicta neque
                                        porro. A at, consequuntur illum incidunt non rem velit?</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="partner-section">
        <div class="bg-hero"></div>
        <div class="container">
            <div class="flex-partner">
                <div class="bg-hero"></div>
                <div class="title-partner center">
                    <h1>Travel Yang Telah <span>Bergabung</span></h1>
                </div>
                <div class="subtitle-partner subtitle center">
                    <h3>Bekerja sama dengan travel yang terpercaya dan amanah</h3>
                </div>
                <div class="row-partner">
                    <div class="carousel-container">
                        <div class="slick-carousel">
                            <div class="carousel-item">
                                <img src="{{assets_url('img/gabung-partner/partner-1.png')}}" alt="Logo 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{assets_url('img/gabung-partner/partner-2.png')}}" alt="Logo 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{assets_url('img/gabung-partner/partner-3.png')}}" alt="Logo 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{assets_url('img/gabung-partner/partner-2.png')}}" alt="Logo 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{assets_url('img/gabung-partner/partner-1.png')}}" alt="Logo 1">
                            </div>
                            <div class="carousel-item">
                                <img src="{{assets_url('img/gabung-partner/partner-1.png')}}" alt="Logo 1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="{{assets_url('css/slick.css')}}"/>
    <script src="{{assets_url('script/slick.min.js')}}"></script>

    <script>

        function isBreakpoint(alias) {
            return $('.device-' + alias).is(':visible');
        }

        function displayInformasiFiturMC(t) {
            if (isBreakpoint('lg') || isBreakpoint('md')) {
                return false;
            }

            var link = $(t).attr('href');
            var title = $(t).find('div.feature-title').html();
            var konten = $(link).find('.benefit-container').html();
            modalAlert(title, konten);
        }

        function frontResponsiveToggler() {
            var navbar = $('#main-top-navbar');
            var state = $(navbar).attr('class');
            if (state.indexOf('responsive-open') === -1) {
                $(navbar).addClass('responsive-open');
            } else {
                $(navbar).removeClass('responsive-open');
            }
        }

        function closeResponsiveMenu() {
            $('#main-top-navbar').removeClass('responsive-open');
        }

        $(document).ready(function () {
            $(document).on('click', 'a.internal-link[href^="#"]', function (event) {
                event.preventDefault();

                $('html, body').animate({
                    scrollTop: $($.attr(this, 'href')).offset().top - 80
                }, 1000);
            });
        });
    </script>

    <script>

        $(document).ready(function () {

            $('.slick-carousel').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 1000,
                arrows: false,
                dots: false,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: false
                        }
                    },
                    {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            var width = $('.testimonial-slider').outerWidth();
            var padding = 15 / 100 * width;

            var params = {
                centerMode: true,
                centerPadding: padding + 'px',
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
            };

            $('.testimonial-slider').slick(params);

            $(".faq-question").click(function () {
                var faqItem = $(this).parent();
                faqItem.toggleClass("active");
                faqItem.find(".faq-answer").slideToggle(300);
            });
        });


    </script>

@endsection
