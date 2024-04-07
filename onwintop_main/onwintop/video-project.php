<?php
include "init.php";
$data = R::findOne("videoprojects", "link=?", [$id]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>
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
                                    $next=URL_Make("/create-video-invitation/".$id);
                                    if($data['type']=='AI'){
                                        $next=URL_Make("/video-config-ai/".$id);
                                    }
                                    ?>
                                    <div class="main-wraper px-0"
                                        style="background-color:#F0F1F2 !important;font-family: 'Roboto', sans-serif;padding:0px">
                                        <div class="header wrapper" style="width:100%;background-color:#ffffff;">
                                            <div class="container px-5 py-3">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <h5><?php echo $data['name'];?></h5>
                                                    </div>
                                                    <div class="col-md-4">

                                                        <a href='<?php URL('/video-projects');?>' style="float:right;margin-right:15px;border:none"
                                                            class="btn btn-secondary px-3">Close</a>
                                                        <a href='<?php echo $next;?>'
                                                            style="float:right;margin-right:15px;background-color:var(--primary-color);border:none;"
                                                            class="btn btn-secondary px-3">Next</a>
                                                        <button style="float:right;margin-right:15px;border:none"
                                                            class="btn btn-dark px-3">Save</button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="wrapper">
                                            <div class="container px-5 py-5">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6><b>Status</b></h6>
                                                        <div class="card mt-2"
                                                            style="width: 100%;background-color:#ffffff;">
                                                            <div class="card-body">
                                                                <b class="card-title">Project Name</b>
                                                                <input type="text" value="<?php echo $data['name']; ?>" name="name"  class="form-control"></br>

                                                                <div class="row">
                                                                    <div class="col-md-10">
                                                                        <b class="card-title">Project Link</b></br>
                                                                        <a href="#" class="text-primary">
                                                                            <small><?php echo "http://localhost/onwintop/4e2uq/video-project/".$id; ?></small>
                                                                        </a>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <b>Live</b>
                                                                        <div class="custom-control custom-switch">
                                                                            <input type="checkbox" checked="false"
                                                                                class="custom-control-input"
                                                                                id="customSwitch1">
                                                                            <label class="custom-control-label"
                                                                                for="customSwitch1"></label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6><b>Insights</b></h6>
                                                        <div class="row mt-4">
                                                            <div class="col-md-4 text-center">
                                                                <div class="circle"
                                                                    style="height:125px;width:125px;border:2px solid #DDDDDF;border-radius:50%;background-color:#ffffff;display:flex;align-items:center;justify-content:center">
                                                                    <div style="display:block">
                                                                        <h2>0</h2>
                                                                        <span>Page Views</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <div class="circle"
                                                                    style="height:125px;width:125px;border:2px solid #DDDDDF;border-radius:50%;background-color:#ffffff;display:flex;align-items:center;justify-content:center">
                                                                    <div style="display:block">
                                                                        <h2>0</h2>
                                                                        <span>Clips</br>Contributed</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <div class="circle"
                                                                    style="height:125px;width:125px;border:2px solid #DDDDDF;border-radius:50%;background-color:#ffffff;display:flex;align-items:center;justify-content:center">
                                                                    <div style="display:block">
                                                                        <h2>0</h2>
                                                                        <span>Stories </br>Produces</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-5">
                                                    <div class="col-md-7">
                                                        <h6><b>Clip Locations</b></h6>
                                                        <div class="map-holder card mt-2"
                                                            style="height:300px;background-color:#ffffff;width:100%;">
                                                            <div class="card-body">
                                                                <div id="map"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <h6><b>Latest Entries</b></h6>
                                                        <div class="card mt-2">
                                                            <div class="card-body" style="width:100%">
                                                                <div class="p-5 text-center">
                                                                    <p>No Latest Entries Found</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-5">
                                                    <div class="col-md-4">
                                                        <div class="card">
                                                            <div class="card-body text-center" style="font-family: 'Open Sans', sans-serif;">
                                                                <h6 class='mb-2'><b>Project Activity</b></h6>
                                                                <img style="height:150px;width:150px;border-radius:50%"
                                                                    src="<?php URI('/images/support.webp'); ?>" alt=""
                                                                    srcset="">
                                                                <h4 class='mt-3'>Jessica Doe</h4>
                                                                <p class='mx-3 mt-2'>Please write down your
                                                                    questions/comments at the Project Activity area, I
                                                                    will get back to you.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <div class="card">
                                                            <div class="card-body" style="font-family: 'Open Sans', sans-serif;">
                                                                <h6 class='mb-2'><b>Project Activity</b></h6>
                                                                <div class="form-group">
                                                                    <textarea placeholder="Please type what you want..."
                                                                        name="" id="" rows="2"
                                                                        class="form-control"></textarea>
                                                                </div>
                                                                <button class="btn btn-warning text-white"><i
                                                                        class='fa fa-paperclip'></i></button>
                                                                <button class="btn btn-warning text-white"><i
                                                                        class='fa fa-camera'></i></button>
                                                                <button class="btn btn-warning text-white">Add</button>
                                                            </div>
                                                        </div>
                                                        <div class="card mt-2">
                                                            <div class="card-body">
                                                                <h6 class='mb-2'><b>Project Activites</b></h6>
                                                                <div class="p-5 text-center">
                                                                    No Activites Available
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