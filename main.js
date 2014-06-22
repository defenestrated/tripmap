// add any scripting here

var parchment, ww, wh, projection;

var postdata, mapdata;

var postsloaded = false, maploaded = false, domloaded = false;

function totesloaded() {
    // if (domloaded) $(".loading .status").append(" page ");
    // if (maploaded) $(".loading .status").append(" map ");
    // if (postsloaded) $(".loading .status").append(" posts ");

    console.log("posts: " + postsloaded + " // " + "map: " + maploaded + " // " + "dom: " + domloaded);
    if (postsloaded === true && maploaded === true && domloaded === true) {

        return true;
    }
    else return false;
}

pullposts();
loadjson();

$(document).ready(function() {
    domloaded = true;
    if (totesloaded()) {
        render();
    }
});

function killload() {
    $(".loading").html("<p>Ok, done!</p>").fadeOut(800, "easeInQuad");
}

function render() {
    console.log("done loading");

    ww = $(window).width(), wh = $(window).height();

    $(".copyright").css("bottom", $(".instructions").outerHeight() + 4 + "px");

    parchment = d3.select(".parchment");

    var subunits = topojson.feature(mapdata, mapdata.objects.subunits);
    projection = d3.geo.albers()
        .scale(1200)
        .translate([ww/2, wh/2])
    ;

    var mappath = d3.geo.path()
            .projection(projection);

    mapstuff = parchment.append("g").attr("class", "map-data");

    // parchment.append("path")
    //     .datum(subunits)
    //     .attr("d", path);

    mapstuff.selectAll(".pieceoland")
        .data(topojson.feature(mapdata, mapdata.objects.subunits).features)
        .enter().append("path")
        .attr("class", function(d) { return "pieceoland " + d.id; })
        .attr("d", mappath)
    ;

    booty(postdata, mapdata);

    registerEvents();
}
function registerEvents() {
    $("#closepost").on("click", function() {
        $(".postviewer").fadeOut(800, "easeOutCubic");
    });
}
function pullposts() {
    console.log("pulling posts");
    $.ajax({
        url: "wordpress/wp_api/v1/posts",
        success: function(wpvomit) {
            console.log("success");
            var onlyposts = _(wpvomit.posts).filter(function(ell, ix) {
                // console.log(ell.name + ": " + ell.type);
                return ell.type === "post";
            });

            postdata = onlyposts;
            postsloaded = true;
            if (totesloaded()) render();
        }
    });
}
function loadjson() {
    d3.json("assets/usa.json", function(error, usa) {
        if (error) return console.error(error);
        console.log(usa);
        mapdata = usa;
        maploaded = true;
        if (totesloaded()) render();
    });
}
function booty(thang, junk) {
    console.log("shakin booty:");
    console.log(thang);

    killload();

    var dots = parchment.append("g").attr("class", "goodies");

    var linepoints = [];

    _(thang).each(function(ell, ix) {
        // console.log(ell);
        var datapoints = dots.selectAll("g")
                .data(thang)
                .enter().append("g")
                .attr("class", function(d) { return "datapoint " + d.name; })
        ;

        datapoints.each(function(d, i) {
            var mapdot = d3.select(this).append("circle")
                    .attr("class", "dot")
                    .attr("r", "5px")
                    .attr("transform", function(d) {
                        linepoints.unshift(projection([d.geodata.longitude, d.geodata.latitude]));
                        return "translate(" + projection([d.geodata.longitude, d.geodata.latitude]) + ")";
                    });

            mapdot.transition()
                .duration(500)
                .delay(function(d) {
                    var eldelay = 250*(thang.length-i-1);
                    console.log(eldelay);
                    return eldelay;
                })
                .style("opacity", 1)

            mapdot.on("mouseenter", function(d) {
                d3.select(this).transition()
                    .duration(200)
                // .attr("r", "20px")
                    .style("fill", "white")
                ;
                $(".datapoint:not(." + d.name + "), .weenie").animate({
                    opacity: 0.3
                }, 200);
                // if ($(".label." + d.name + " .labelbox").length === 0) {

                //     var bbox = d3.select("text." + d.name).node().getBBox();
                //     console.log(bbox);

                //     dp.insert("rect", ":first-child")
                //         .attr("class", function(d) { return "label labelbox " + d.name; })
                //         .attr("x", bbox.x-10)
                //         .attr("y", bbox.y-5)
                //         .attr("width", bbox.width+20)
                //         .attr("height", bbox.height+10)
                //     ;
                // }

                $(".label." + d.name).css({
                    "display": "none",
                    "visibility": "visible"
                }).fadeIn(200);
            })
                .on("mouseleave", function(d) {
                    d3.select(this).transition()
                        .duration(200)
                    // .attr("r", "8px")
                        .style("fill", "darkblue")
                    ;
                    $(".label." + d.name).fadeOut(200);
                    $(".datapoint, .weenie").animate({
                        opacity: 1
                    }, 200);
                })
                .on("click", function(d) {
                    $(".postnuggets").html("");
                    var post = d3.select(".postnuggets");
                    post.append("h1").html(d.title);
                    post.append("h2").html(function() {
                        var thedate = moment(d.date).format("MMMM Do, h:mma");
                        return thedate + " <span class='sep'>//</span> " + d.geodata.address;
                        // return d.geodata.address;
                    });
                    post.append("div")
                        .attr("class", "content")
                        .html(d.content_display)
                    ;

                    $(".postviewer").fadeIn(100);
                })
            ;


            var dp =  d3.select(this);

            var ltext = dp.append("text")
                    .attr("class", function(d) { return "label " + d.name; })
                    .attr("x", function(d) {
                        return projection([d.geodata.longitude, d.geodata.latitude])[0] + 20 + "px";
                    })
                    .attr("y", function(d) {
                        return projection([d.geodata.longitude, d.geodata.latitude])[1] + "px";
                    })
                    .attr("dy", "0.35em")
                    .text(function(d) { return d.title; })
            ;
        });


    });

    // console.log(linepoints);

    var line = d3.svg.line()
            .x(function(d, i) {
                // console.log("data point #" + i + ", x: " + d[0]);
                return d[0];
            })
            .y(function(d, i) {
                // console.log("data point #" + i + ", y: " + d[1]);
                return d[1];
            })
            .interpolate("linear")
    ;


    var linepath = d3.select(".goodies").insert("path", ".datapoint")
            .attr("class", "weenie")
            .attr("d", line(linepoints))
    ;

    var linelength = linepath.node().getTotalLength();
    console.log("line length: " + linelength);

    linepath
        .attr("stroke-dasharray", linelength + " " + linelength)
        .attr("stroke-dashoffset", linelength)
        .transition()
        .duration($(".datapoint").length*250)
        .ease("linear")
        .attr("stroke-dashoffset", 0);


}
