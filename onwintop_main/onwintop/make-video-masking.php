<?php
include "init.php";
$data = R::findOne("videoprojects", "link=?", [$id]);
?>
    <?php include "includes/head.php"; ?>
    <link href="https://vjs.zencdn.net/7.19.2/video-js.css" rel="stylesheet" />
    <?php

    //get saved or default data
    if (isset($_POST['image']) && isset($_POST['data'])) {
        $vb = R::findOne("videobrandings", "community_id=? AND link=?", [$community_id, $id]);
        $vb->branding_image = $_POST['image'];
        $vb->branding_json = $_POST['data'];
        R::store($vb);
        if ($_POST['method'] == 'next') {
            $next = URL_Make("/video-project-informations/" . $id);
            echo "<script>window.location='" . $next . "';</script>";
        }
    }
    $vb = R::findOne("videobrandings", "community_id=? AND link=?", [$community_id, $id]);
    ?>
    <script src="https://unpkg.com/konva@^2/konva.min.js"></script>

    <div class="theme-layout">
        <div id='container' style='visibility:hidden'></div>
        <?php include "includes/footer.php"; ?>
    </div>
    <script src="<?php URI("js/main.min.js"); ?>"></script>
    <script src="<?php URI("js/script.js"); ?>"></script>
    <script id="jsbin-javascript">
        var appHistories = [];
        var appHistory = null;

        var upload_api = '<?php echo $_ENV['project_url']; ?>api/upload_file.php';
        var team_logo = '<?php echo $vb['team_logo']; ?>';
        var video_logo = '<?php echo $vb['video_logo']; ?>';

        function SaveData() {
            var dataURL = stage.toDataURL({ pixelRatio: 1 });
            var id = '<?php echo $id; ?>';
            $.ajax({
                url: '<?php echo $url . "api/base64_image_store.php"; ?>',
                method: 'POST',
                data: {
                    name: id,
                    code: dataURL
                },
                success: function (data) {
                    console.log(data);
                }
            })
        }

        var stage = new Konva.Stage({
            container: "container", // id of container <div>
            width: 761,
            height: 450,
        });

        const layer = new Konva.Layer();
        stage.add(layer);
        <?php
        if (strlen($vb['branding_image']) != 0) {
            $img_data = json_decode($vb['branding_json'], true);
            echo "
            var test=" . json_encode($img_data) . ";
            DisplayData(test);
            ";
        }
        ?>
        var test = '[{"type":"Rect","x":60,"y":60,"width":100,"scaleX":3.170504150390625,"scaleY":1,"height":90,"fill":"red"},{"type":"Rect","x":114.39544677734375,"y":218.4110107421875,"width":150,"scaleX":2.8799938964843754,"scaleY":1,"height":90,"fill":"green"}]';

        item_selected = false;
        element = null;

        var already_exported = false;

        function DisplayData(data) {
            stage.find('.element').destroy();
            layer.draw();
            data = JSON.parse(data);
            console.log('display request');
            data.forEach((element, i) => {
                type = element.type;
                if (type == 'Text') {
                    var simpleText = new Konva.Text({
                        x: element.x,
                        y: element.y,
                        text: element.text,
                        fontSize: element.fontSize,
                        fontFamily: element.fontFamily,
                        fill: element.fill,
                        name: "element",
                        draggable: true,
                    });
                    layer.add(simpleText);
                    layer.draw();
                }
                if (type == 'Rect') {
                    var rect = new Konva.Rect({
                        x: element.x,
                        y: element.y,
                        width: element.width,
                        height: element.height,
                        fill: element.fill,
                        name: "element"
                    });
                    // add the shape to the layer
                    rect.draggable(true);
                    layer.add(rect);
                    layer.draw();
                }
                if (type == 'Image') {
                    Konva.Image.fromURL(
                        element.url,
                        function (darthNode) {
                            darthNode.setAttrs({
                                x: element.x,
                                y: element.y,
                                height: element.height,
                                width: element.width,
                                name: "element",
                            });
                            darthNode.draggable(true);
                            layer.add(darthNode);
                            layer.draw();
                        }
                    );
                }
            })
        }
        setTimeout(function(){SaveData()},2000);
        //Saving data
    </script>
    <script src="<?php URI("js/video-editor.js"); ?>"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>
