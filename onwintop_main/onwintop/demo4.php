<?php
include "init.php";
$data = R::findOne("videoprojects", "link=?", [$id]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Create Video Invitation -
        <?php echo $data['name']; ?> | Videos -
        <?php echo $title; ?>
    </title>
    <?php include "includes/head.php"; ?>
    <link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <style>
        .new-comment form button i {
            transform: rotate(1deg) !important;
        }

        .vjs-big-play-centered .vjs-big-play-button {
            top: 50%;
            left: 50%;
            border-radius: 50%;
            margin-top: -0.81666em;
            margin-left: -1.5em;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href=" https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        .modal-dialog {
            max-width: 750px;
            margin: 1.75rem auto;
        }

        .modal {
            top: 20% !important;
        }

        .wrapper {
            padding-left: 130px;
            padding-right: 130px;
        }

        .custom-control-input:checked~.custom-control-label::before {
            color: #fff;
            background-color: #19dd3e !important;
            border-color: #19dd3e !important;
        }

        .form-control {
            color: #000000;
        }

        ::placeholder {
            /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: #c4c4c4 !important;
            opacity: 1;
            /* Firefox */
        }
    </style>

    <script src="https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js"></script>
    <link href="https://api.tiles.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css" rel="stylesheet" />
    <script
        src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js"></script>
    <link rel="stylesheet"
        href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css"
        type="text/css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');

        #map {
            position: relative;
            top: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
        }
    </style>

</head>

<body>
    <div class="theme-layout">
        <?php include "includes/header2.php"; ?>

        <?php include "includes/nav.php"; ?>

        <section style="background-color:#f0f1f2b5">
            <div class="gap">
                <div class="container px-5">
                    <div class="row">
                        <div class="col-lg-12 px-5">
                            <div id="page-contents px-5" class="row merged20">
                                <div class="col-lg-12 py-3">

                                    <h4 class='text-secondary'>Manage Video Projects</h4></br>
                                    <a class='mb-2 mt-2' href='<?php URL('/video-projects'); ?>'>
                                        <b>
                                            << Back to Videos</b>
                                    </a>
                                    <?php
                                    if (!isset($_SESSION['user_login']) || $_SESSION['user_login'] != true) {
                                        echo '<script>window.location="' . URL_Make('/videos') . '";</script>';
                                    }
                                    ?>
                                    <div class="main-wraper px-0"
                                        style="background-color:#F0F1F2 !important;font-family: 'Roboto', sans-serif;padding:0px">
                                        <div class="header wrapper" style="width:100%;background-color:#ffffff;">
                                            <div class="container px-5 py-3">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <h5>B2b Testimonial</h5>
                                                    </div>
                                                    <div class="col-md-4">

                                                        <button style="float:right;margin-right:15px;border:none"
                                                            class="btn btn-secondary px-3">Close</button>
                                                        <button
                                                            style="float:right;margin-right:15px;background-color:var(--primary-color);border:none;"
                                                            class="btn btn-secondary px-3">Next</button>
                                                        <button style="float:right;margin-right:15px;border:none"
                                                            class="btn btn-dark px-3">Save</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="wrapper">
                                            <div class="container px-0 py-5">
                                                <div class="row mt-0">
                                                    <div class="col-md-8">
                                                        <h6> <b>Brief your contribution</b> </h6>
                                                        <div class="form-group mt-4 text-center">
                                                            <label for="">Hero video/image</label>
                                                            <div
                                                                style="display:flex;align-items:center;justify-content:center">
                                                                <div
                                                                    style="height:200px;display:flex;align-items:center;justify-content:center;width:400px;background-image:url(<?php URI('/images/demo-wall.png'); ?>);background-size:100%">
                                                                    <div class="btn-group" role="group"
                                                                        aria-label="Basic example">
                                                                        <button type="button"
                                                                            class="btn btn-secondary px-4"
                                                                            style="background-color:#00000050;color:#ffffff;border:1px solid #ffffff;"><i
                                                                                class="fa fa-video-camera"
                                                                                aria-hidden="true"></i></button>
                                                                        <button type="button"
                                                                            class="btn btn-secondary px-4"
                                                                            style="background-color:#00000050;color:#ffffff;border:1px solid #ffffff;"><i
                                                                                class="fa fa-file-image"
                                                                                aria-hidden="true"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="mt-5" style="height:auto;width:100%;">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="form-group">
                                                                        <label for="">Give your page a title <span
                                                                                class="text-danger">*</span> </label>
                                                                        <input type="text" placeholder="B2B Testimonial"
                                                                            name="title" id="" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="">Expiry date<span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="date" name="title" id=""
                                                                            class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Add an incentive to encourage your contributors</label>
                                                                        <input type="text"
                                                                            placeholder="Type here..."
                                                                            name="title" id="" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Tell your contributors how to participate</label>
                                                                        <textarea type="text"
                                                                        placeholder="Contribute to the project 'B2B Testimonial' by uploading your 10-15 second clip here. "
                                                                            name="title" rows="3" id=""
                                                                            class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Set your project rules<span
                                                                                class="text-danger">*</span> </label>
                                                                        <textarea type="text"
                                                                            placeholder="By uploading your video clip, you are granting permissions to re-use. See T&Cs for more details."
                                                                            name="title" rows="3" id=""
                                                                            class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Share some tips to get the better video contributions</label>
                                                                        <textarea type="text" name="title" rows="2"
                                                                            placeholder="-Prop up your phone so the video is stead - Ensure the video is horizontal - Use good/natural lighting and show us your personality! - This video is all about YOU!" id=""
                                                                            class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="">Link to your own terms and conditions<span class="text-danger">*</span>
                                                                        </label>
                                                                        <input type="text" placeholder="https://mydoamin.com/terms-and-conditions"
                                                                            name="title" id="" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h6><b>Preview</b>
                                                            <small><a href="" class='text-primary'>( View Live )</a></small>
                                                        </h6>
                                                        <div class="phone mt-2" style="height:auto;width:auto;border:10px solid #000000;border-radius:20px;">
                                                            <iframe src="http://localhost/onwintop/4e2uq/"
                                                                style="height:530px;width:100%;border-radius:10px"
                                                                frameborder="0"></iframe>
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
                </div>
            </div>
        </section>

        <?php include "includes/footer.php"; ?>
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script src="https://vjs.zencdn.net/7.19.2/video.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-youtube/3.0.1/Youtube.min.js"
        integrity="sha512-W11MwS4c4ZsiIeMchCx7OtlWx7yQccsPpw2dE94AEsZOa3pmSMbrcFjJ2J7qBSHjnYKe6yRuROHCUHsx8mGmhA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        mapboxgl.accessToken = 'pk.eyJ1IjoidXRwYWxlbmR1IiwiYSI6ImNsamd6NmRpNDAydGszdXBwMnZ1cjg2aGwifQ.9pk9JidzbqRZw9HQYqtKrQ';
        const map = new mapboxgl.Map({
            container: 'map', // Container ID
            style: 'mapbox://styles/mapbox/streets-v12', // Map style to use
            center: [-122.25948, 37.87221], // Starting position [lng, lat]
            zoom: 12 // Starting zoom level
        });

        const marker = new mapboxgl.Marker() // Initialize a new marker
            .setLngLat([-122.25948, 37.87221]) // Marker [lng, lat] coordinates
            .addTo(map); // Add the marker to the map

        const geocoder = new MapboxGeocoder({
            // Initialize the geocoder
            accessToken: mapboxgl.accessToken, // Set the access token
            mapboxgl: mapboxgl, // Set the mapbox-gl instance
            marker: false, // Do not use the default marker style
            placeholder: 'Search for places in Berkeley', // Placeholder text for the search bar
            bbox: [-122.30937, 37.84214, -122.23715, 37.89838], // Boundary for Berkeley
            proximity: {
                longitude: -122.25948,
                latitude: 37.87221
            } // Coordinates of UC Berkeley
        });

        // Add the geocoder to the map
        map.addControl(geocoder);

        // After the map style has loaded on the page,
        // add a source layer and default styling for a single point
        map.on('load', () => {
            map.addSource('single-point', {
                'type': 'geojson',
                'data': {
                    'type': 'FeatureCollection',
                    'features': []
                }
            });

            map.addLayer({
                'id': 'point',
                'source': 'single-point',
                'type': 'circle',
                'paint': {
                    'circle-radius': 10,
                    'circle-color': '#448ee4'
                }
            });

            // Listen for the `result` event from the Geocoder // `result` event is triggered when a user makes a selection
            //  Add a marker at the result's coordinates
            geocoder.on('result', (event) => {
                map.getSource('single-point').setData(event.result.geometry);
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
        integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = new DataTable('#table');
            $('#project-create-btn').on('click', function () {
                $('.modal').modal('hide');
                $('#project-name-modal').modal('show');
            })
        })
    </script>
</body>

</html>