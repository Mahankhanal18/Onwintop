$(document).ready(function () {
  $("select").show();

  //Place Name Element
  $("#add_place_name").on("click tap", function () {
    var simpleText = new Konva.Text({
      x: 10,
      y: 15,
      text: "{{ Place Name }}",
      fontSize: 20,
      fontFamily: "Calibri",
      fill: "#ffffff",
      name: "element",
      draggable: true,
    });
    layer.add(simpleText);
    layer.draw();
    Render();
  });

  //Location Name Element
  $("#add_location").on("click tap", function () {
    var simpleText = new Konva.Text({
      x: 20,
      y: 25,
      text: "{{ Location }}",
      fontSize: 20,
      fontFamily: "Calibri",
      fill: "#ffffff",
      name: "element",
      draggable: true,
    });
    layer.add(simpleText);
    layer.draw();
    Render();
  });

  //Contributor Name Element
  $("#add_contributor_name").on("click tap", function () {
    var simpleText = new Konva.Text({
      x: 25,
      y: 30,
      text: "{{ Contributor Name }}",
      fontSize: 20,
      fontFamily: "Calibri",
      fill: "#ffffff",
      name: "element",
      draggable: true,
    });
    layer.add(simpleText);
    layer.draw();
    Render();
  });

  //Contributor Name Element
  $("#add_clip_date_time").on("click tap", function () {
    var simpleText = new Konva.Text({
      x: 30,
      y: 35,
      text: "{{ Date & Time }}",
      fontSize: 20,
      fontFamily: "Calibri",
      fill: "#ffffff",
      name: "element",
      draggable: true,
    });
    layer.add(simpleText);
    layer.draw();
    Render();
  });

  //Prompt 1 answer
  $("#add_prompt_ans1").on("click tap", function () {
    var simpleText = new Konva.Text({
      x: 35,
      y: 40,
      text: "{{ Prompt 1 answer will appear here }}",
      fontSize: 20,
      fontFamily: "Calibri",
      fill: "#ffffff",
      name: "element",
      draggable: true,
    });
    layer.add(simpleText);
    layer.draw();
    Render();
  });

  //Prompt 2 answer
  $("#add_prompt_ans2").on("click tap", function () {
    var simpleText = new Konva.Text({
      x: 40,
      y: 45,
      text: "{{ Prompt 2 answer will appear here }}",
      fontSize: 20,
      fontFamily: "Calibri",
      fill: "#ffffff",
      name: "element",
      draggable: true,
    });
    layer.add(simpleText);
    layer.draw();
    Render();
  });

  //Prompt 3 answer
  $("#add_prompt_ans3").on("click tap", function () {
    var simpleText = new Konva.Text({
      x: 45,
      y: 50,
      text: "{{ Prompt 3 answer will appear here }}",
      fontSize: 20,
      fontFamily: "Calibri",
      fill: "#ffffff",
      name: "element",
      draggable: true,
    });
    layer.add(simpleText);
    layer.draw();
    Render();
  });

  //Rating
  $("#add_rating").on("click tap", function () {
    var simpleText = new Konva.Text({
      x: 50,
      y: 55,
      text: "{{ Ratings will appear here }}",
      fontSize: 20,
      fontFamily: "Calibri",
      fill: "#ffffff",
      name: "element",
      draggable: true,
    });
    layer.add(simpleText);
    layer.draw();
    Render();
  });

  //Textbox Element
  $("#add_textbox").on("click tap", function () {
    //1st popup will apprear to enter text, font, font-size and color
    $("#textbox-popup").modal("show");
  });

  $("#text-form").on("submit", function (e) {
    e.preventDefault();
    text = $("#text").val();
    font = $("#text-font").val();
    size = $("#text-size").val();
    color = $("#text-color").val();
    $("#text-form")[0].reset();
    $(".modal").modal("hide");
    var simpleText = new Konva.Text({
      x: 10,
      y: 15,
      text: text,
      fontSize: size,
      fontFamily: font,
      fill: color,
      name: "element",
      draggable: true,
    });
    layer.add(simpleText);
    layer.draw();
    Render();
  });

  //Logo Element
  $("#add_logo").on("click tap", function () {
    Konva.Image.fromURL(
      team_logo,
      function (darthNode) {
        darthNode.setAttrs({
          x: 20,
          y: 20,
          height: 100,
          width: 100,
          name: "element",
        });
        darthNode.draggable(true);
        layer.add(darthNode);
        layer.draw();
        Render();
      }
    );
  });

  //Image Element
  $("#add_image").on("click tap", function () {
    //1st popup will apprear to enter text, font, font-size and color
    $("#image-popup").modal("show");
  });
  var image_url = "";
  $("#image").on("change", function () {
    thumbnail_form = new FormData();
    type = $(this).attr("id");
    $(".loading").hide();
    $(".loading").show();
    thumbnail = $("#image")[0].files[0];
    thumbnail_form.append("file", thumbnail);
    $(".action-btn").prop("disabled", true);
    $.ajax({
      url: upload_api,
      method: "post",
      data: thumbnail_form,
      contentType: false,
      processData: false,
      success: function (data) {
        data = JSON.parse(data);
        image_url = data.secure_url;
        $(".loading").hide();
        $(".action-btn").prop("disabled", false);
      },
    });
  });
  $("#image-form").on("submit", function (e) {
    e.preventDefault();
    $("#image-form")[0].reset();
    $(".modal").modal("hide");
    Konva.Image.fromURL(image_url, function (darthNode) {
      darthNode.setAttrs({
        x: 20,
        y: 20,
        height: 150,
        width: 150,
        name: "element",
      });
      darthNode.draggable(true);
      layer.add(darthNode);
      layer.draw();
      Render();
    });
  });

  //Add Rectangle
  $("#add_rectangle").on("click tap", function () {
    $("#rectangle-popup").modal("show");
  });

  $("#rectangle-form").on("submit", function (e) {
    e.preventDefault();
    color = $("#rectangle-color").val();
    $("#rectangle-popup").modal("hide");
    $("#rectangle-form")[0].reset();
    var rect = new Konva.Rect({
      x: 20,
      y: 20,
      width: 200,
      height: 100,
      fill: color,
      name:"element"
    });
    // add the shape to the layer
    rect.draggable(true);
    layer.add(rect);
    layer.draw();
    Render();
  });

  //deleteing selected element with delete button
  $(document).keydown(function (e) {
    if (e.which == 8) {
      if (element != stage && item_selected && element != null) {
        if (!element.hasName("element")) {
          return;
        }
        element.destroy();
        stage.find("Transformer").destroy();
        layer.draw();
        Render();
      }
    }
  });
});
