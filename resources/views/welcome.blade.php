<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lemon&family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"/>
    
    <style>
        .font-lemon {
            font-family: 'Lemon', cursive;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    {{-- navbar --}}
    <div class="navbar bg-base-300 px-10 justify-center">
        <button class="btn btn-ghost text-xl font-lemon"><span class="me-1"><i
            class="fa-solid fa-truck"></i></span>MyOngkir</button>
        </div>
    {{-- end navbar --}}
    {{-- content --}}
    <div class="flex flex-col justify-center text-center gap-5 items-center py-10">
        <h1 class="text-6xl "><b>Cek Ongkir Anda</b></h1>
        <p>Anda bisa mengecek ongkir kekota dan kabupaten diseluruh Indonesia</p>
        <div class="container flex justify-between gap-3 text-white">
            <div class="card w-96 bg-blue-500 shadow-xl">
                <i class="fa-solid fa-truck text-9xl py-10"></i>
                <div class="card-body">
                    <h2 class="card-title">Life hack</h2>
                    <p>How to park your car at your garage?</p>
                    <div class="card-actions justify-end">
                        <button
                            class="btn btn-primary bg-white text-blue-500 hover:bg-slate-500 hover:text-white border-none">Learn
                            now!</button>
                    </div>
                </div>
            </div>
            <div class="card w-96 bg-blue-500 shadow-xl">
                <i class="fa-solid fa-truck text-9xl py-10"></i>
                <div class="card-body">
                    <h2 class="card-title">Life hack</h2>
                    <p>How to park your car at your garage?</p>
                    <div class="card-actions justify-end">
                        <button
                            class="btn btn-primary bg-white text-blue-500 hover:bg-slate-500 hover:text-white border-none">Learn
                            now!</button>
                    </div>
                </div>
            </div>
            <div class="card w-96 bg-blue-500 shadow-xl">
                <i class="fa-solid fa-truck text-9xl py-10"></i>
                <div class="card-body">
                    <h2 class="card-title">Life hack</h2>
                    <p>How to park your car at your garage?</p>
                    <div class="card-actions justify-end">
                        <button
                            class="btn btn-primary bg-white text-blue-500 hover:bg-slate-500 hover:text-white border-none">Learn
                            now!</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container flex justify-center items-center mx-auto text-black mt-10">
            <div class="card card-compact bg-slate-50 shadow-xl rounded-2xl w-full mx-auto">
                <div class="bg-slate-300 rounded-t-2xl py-3 shadow"><b>Form Cek Ongkir</b></div>
                <div class="card-body">
                    <form action="{{ route('store') }}" method="POST" class="text-white m-auto">
                        @csrf
                        @method('POST')
                        <b class="text-black text-xl my-2">Asal Pengirim</b>
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text text-black">Provinsi</span>
                            </div>
                            <select class="select select-bordered" name="origin_provinsi">
                                <option disabled selected>Pick one</option>
                                @foreach ($provinsis as $provinsi)
                                    <option value="{{ $provinsi->code }}">{{ $provinsi->title }}</option>
                                @endforeach
                            </select>
                        </label>
                        <label class="form-control w-full max-w-xs mb-2">
                            <div class="label">
                                <span class="label-text text-black">Kota/Kabupaten</span>
                            </div>
                            <select class="select select-bordered" name="city_origin">
                                <option disabled selected>Pick one</option>
                            </select>
                        </label>
                        <b class="text-black text-xl">Tujuan Pengirim</b>
                        <label class="form-control w-full max-w-xs">
                            <div class="label">
                                <span class="label-text text-black">Kota/Kabupaten</span>
                            </div>
                            <select class="select select-bordered" id="destination_city" name="destination_city">
                                <option disabled selected>Pick one</option>
                            </select>
                        </label>
                        <div class="form-control">
                            <label class="label cursor-pointer flex flex-col items-start">
                                <div class="label-text text-black mb-2">Pilih Ekspedisi :</div>
                                <div class="text-black flex flex-col gap-2">
                                    @foreach ($kurirs as $kurir)    
                                    <div class="flex gap-1">
                                        <input type="checkbox" class="checkbox" id="kurir-{{ $kurir->id }}" value="{{ $kurir->code }}" name="kurir[]"/> <span
                                            class="flex items-center">{{ $kurir->title }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </label>
                        </div>
                        <button class="btn text-white hover:bg-slate-50 hover:">Cek</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
    {{-- end content --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $('select[name="origin_provinsi"]').on('change', function() {
            let provinsiId = $(this).val();
            if (provinsiId) {
                jQuery.ajax({
                    url: '/api/provinsi/' + provinsiId + '/cities',
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="city_origin"]').empty();
                        $.each(data, function(key, value) {
                            $('select[name="city_origin"]').append('<option value="' + key +
                                '">' + value + '</option>');
                        });

                    },
                });
            } else {
                $('select[name="city_origin"]').empty();
            }
        });
        $('#destination_city').select2({
            ajax: {
                url: '/api/cities',
                type: 'POST',
                dataType: 'json',
                delay: 150,
                data: function(params) {
                    return {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        search: $.trim(params.term),
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });
    </script>

</html>
